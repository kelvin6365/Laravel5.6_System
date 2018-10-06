<?php

namespace awssat\Visits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;
use Spatie\Referer\Referer;

class Visits
{
    /**
     * @var mixed
     */
    protected $ipSeconds;
    /**
     * @var null
     */
    protected $subject;
    /**
     * @var bool|mixed
     */
    protected $fresh = false;
    /**
     * @var null
     */
    protected $country = null;
    /**
     * @var null
     */
    protected $referer = null;
    /**
     * @var mixed
     */
    protected $periods;
    /**
     * @var Keys
     */
    protected $keys;
    /**
     * @var Redis
     */
    public $redis;

    /**
     * Visits constructor.
     * @param $subject
     * @param string $tag|null
     */
    public function __construct($subject = null, $tag = 'visits')
    {
        $config = config('visits');
        $this->redis = Redis::connection($config['connection']);
        $this->periods = $config['periods'];
        $this->ipSeconds = $config['remember_ip'];
        $this->fresh = $config['always_fresh'];
        $this->subject = $subject;
        $this->keys = new Keys($subject, $tag);

        $this->periodsSync();
    }

    /**
     * @param $attribute
     * @return $this
     */
    public function __get($attribute)
    {
        if($this->keys->instanceOfModel && $relation = $this->subject->$attribute) {
            $this->keys->append($attribute, $relation->{$relation->getKeyName()});
        }

        return $this;
    }

    /**
     * @param $subject
     * @return $this
     */
    public function by($subject)
    {
        if($subject instanceof Model) {
            $this->keys->append(strtolower(str_singular(class_basename(get_class($subject)))),
                $subject->{$subject->getKeyName()});
        } else if (is_array($subject)) {
            $subject = collect($subject);
            $this->keys->append($subject->flip()->first(), $subject->first());
        } else {
            $this->keys->append('custom', $subject);
        }

        return $this;
    }

    /**
     * Return fresh cache from database
     * @return $this
     */
    public function fresh()
    {
        $this->fresh = true;

        return $this;
    }

    /**
     * set x seconds for ip expiration
     *
     * @param $seconds
     * @return $this
     */
    public function seconds($seconds)
    {
        $this->ipSeconds = $seconds;

        return $this;
    }


    /**
     * @param $country
     * @return $this
     */
    public function country($country)
    {
        $this->country = $country;

        return $this;
    }


    /**
     * @param $referer
     * @return $this
     */
    public function referer($referer)
    {
        $this->referer = $referer;

        return $this;
    }

    /**
     * Change period
     *
     * @param $period
     * @return $this
     */
    public function period($period)
    {
        if (in_array($period, array_keys($this->periods))) {
            $this->keys->visits = $this->keys->period($period);
        }

        return $this;
    }

    /**
     * Sync periods times
     */
    protected function periodsSync()
    {
        foreach ($this->periods as $period) {
            $periodKey = $this->keys->period($period);

            if ($this->noExpiration($periodKey)) {
                $expireInSeconds = $this->newExpiration($period);
                $this->redis->incrby($periodKey . '_total', 0);
                $this->redis->zincrby($periodKey, 0, 0);
                $this->redis->expire($periodKey, $expireInSeconds);
                $this->redis->expire($periodKey . '_total', $expireInSeconds);
            }
        }
    }

    /**
     * @param $periodKey
     * @return bool
     */
    protected function noExpiration($periodKey)
    {
        return $this->redis->ttl($periodKey) == -1 || !$this->redis->exists($periodKey);
    }

    /**
     * @param $period
     * @return int
     */
    protected function newExpiration($period)
    {
        $expireInSeconds = 0;

        switch ($period) {
            case 'day':
                $expireInSeconds = Carbon::now()->endOfDay()->timestamp - Carbon::now()->timestamp;
                break;
            case 'week':
                $expireInSeconds = Carbon::now()->endOfWeek()->timestamp - Carbon::now()->timestamp;
                break;
            case 'month':
                $expireInSeconds = Carbon::now()->endOfMonth()->timestamp - Carbon::now()->timestamp;
                break;
            case 'year':
                $expireInSeconds = Carbon::now()->endOfYear()->timestamp - Carbon::now()->timestamp;
                break;
        }

        return $expireInSeconds + 1;
    }

    /**
     * Reset methods
     *
     * @param $method
     * @param string $args
     * @return Reset
     */
    public function reset($method = 'visits', $args = '')
    {
        return new Reset($this, $method, $args);
    }

    /**
     * Fetch all time trending subjects.
     *
     * @param int $limit
     * @param bool $isLow
     * @return \Illuminate\Support\Collection|array
     */
    public function top($limit = 5, $isLow = false)
    {
        $cacheKey = $this->keys->cache($limit, $isLow);
        $cachedList = $this->cachedList($limit, $cacheKey);
        $visitsIds = $this->getVisits($limit, $this->keys->visits, $isLow);

        if($visitsIds === $cachedList->pluck('id')->toArray() && ! $this->fresh) {
            return $cachedList;
        }

        return $this->freshList($cacheKey, $visitsIds);
    }


    /**
     * Top/low countries
     *
     * @param int $limit
     * @param bool $isLow
     * @return mixed
     */
    public function countries($limit = -1, $isLow = false)
    {
        $range = $isLow ? 'zrange' : 'zrevrange';

        return $this->redis->$range($this->keys->visits . "_countries:{$this->keys->id}", 0, $limit, 'WITHSCORES');
    }

    /**
     * top/lows refs
     *
     * @param int $limit
     * @param bool $isLow
     * @return mixed
     */
    public function refs($limit = -1, $isLow = false)
    {
        $range = $isLow ? 'zrange' : 'zrevrange';

        return $this->redis->$range($this->keys->visits . "_referers:{$this->keys->id}", 0, $limit, 'WITHSCORES');
    }

    /**
     * Fetch lowest subjects.
     *
     * @param int $limit
     * @return \Illuminate\Support\Collection|array
     */
    public function low($limit = 5)
    {
        return $this->top($limit, true);
    }

    /**
     * Check for the ip is has been recorded before
     *
     * @return bool
     * @internal param $subject
     */
    public function recordedIp()
    {
        return ! $this->redis->set($this->keys->ip(request()->ip()), true, 'EX', $this->ipSeconds, 'NX');
    }

    /**
     * Get visits of model instance.
     *
     * @return mixed
     * @internal param $subject
     */
    public function count()
    {
        if ($this->country) {
            return $this->redis->zscore($this->keys->visits . "_countries:{$this->keys->id}", $this->country);
        } else if ($this->referer) {
            return $this->redis->zscore($this->keys->visits . "_referers:{$this->keys->id}", $this->referer);
        }

        return intval(
            (!$this->keys->instanceOfModel) ?
                $this->redis->get($this->keys->visits . '_total') :
                $this->redis->zscore($this->keys->visits, $this->keys->id)
        );
    }

    /**
     * use diffForHumans to show diff
     * @param $period
     * @return Carbon
     */
    public function timeLeft($period = false)
    {
        return Carbon::now()->addSeconds($this->redis->ttl(
            $period ? $this->keys->period($period) : $this->keys->ip(request()->ip())
        ));
    }


    /**
     * @param $inc
     */
    protected function recordCountry($inc)
    {
        $this->redis->zincrby($this->keys->visits . "_countries:{$this->keys->id}", $inc, $this->getCountry());
    }

    /**
     * @param $inc
     */
    protected function recordRefer($inc)
    {
        $referer = app(Referer::class)->get();
        $this->redis->zincrby($this->keys->visits . "_referers:{$this->keys->id}", $inc, $referer);
    }

    /**
     * @param $inc
     */
    protected function recordPeriods($inc)
    {
        foreach ($this->periods as $period) {
            $periodKey = $this->keys->period($period);

            $this->redis->zincrby($periodKey, $inc, $this->keys->id);
            $this->redis->incrby($periodKey . '_total', $inc);
        }
    }

    /**
     * Increment a new/old subject to the cache cache.
     *
     * @param int $inc
     * @param bool $force
     * @param bool $periods
     * @param bool $country
     * @param bool $refer
     */
    public function increment($inc = 1, $force = false, $periods = true, $country = true, $refer = true)
    {
        if ($force || !$this->recordedIp()) {
            $this->redis->zincrby($this->keys->visits, $inc, $this->keys->id);
            $this->redis->incrby($this->keys->visits . '_total', $inc);

            foreach (['country', 'refer', 'periods'] as $method) {
                $$method && $this->{'record'. studly_case($method)}($inc);
            }
        }
    }


    /**
     * @param int $inc
     * @param bool $periods
     */
    public function forceIncrement($inc = 1, $periods = true)
    {
        $this->increment($inc, true, $periods);
    }

    /**
     * Decrement a new/old subject to the cache cache.
     *
     * @param int $dec
     * @param bool $force
     */
    public function decrement($dec = 1, $force = false)
    {
        $this->increment(-$dec, $force);
    }

    /**
     * @param int $dec
     * @param bool $periods
     */
    public function forceDecrement($dec = 1, $periods = true)
    {
        $this->increment(-$dec, true, $periods);
    }

    /**
     * @param $limit
     * @param $visitsKey
     * @param bool $isLow
     * @return mixed
     */
    protected function getVisits($limit, $visitsKey, $isLow = false)
    {
        $range = $isLow ? 'zrange' : 'zrevrange';

        return array_map('intval', $this->redis->$range($visitsKey, 0, $limit - 1));
    }

    /**
     * @param $cacheKey
     * @param $visitsIds
     * @return mixed
     */
    protected function freshList($cacheKey, $visitsIds)
    {
        if (count($visitsIds)) {
            $this->redis->del($cacheKey);

            return ($this->subject)::whereIn($this->keys->primary, $visitsIds)
                ->get()
                ->sortBy(function ($subject) use ($visitsIds) {
                    return array_search($subject->{$this->keys->primary}, $visitsIds);
                })->each(function ($subject) use ($cacheKey) {
                    $this->redis->rpush($cacheKey, serialize($subject));
                });
        }

        return [];
    }

    /**
     * @param $limit
     * @param $cacheKey
     * @return \Illuminate\Support\Collection|array
     */
    protected function cachedList($limit, $cacheKey)
    {
        return collect(
            array_map('unserialize', $this->redis->lrange($cacheKey, 0, $limit - 1))
        );
    }


    /**
     *  Gets visitor country code
     * @return mixed|string
     */
    public function getCountry()
    {
        return strtolower(geoip()->getLocation()->iso_code);
    }

    /**
     * @param $period®
     * @param int $time
     * @return bool
     */
    public function expireAt($period, $time)
    {
        $periodKey = $this->keys->period($period);
        return $this->redis->expire($periodKey, $time);
    }
}
