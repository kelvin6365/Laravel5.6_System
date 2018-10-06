<?php

namespace awssat\Visits;

use Illuminate\Database\Eloquent\Model;

class Keys
{
    public $prefix;
    public $testing = '';
    public $modelName = false;
    public $id;
    public $visits;
    public $primary = 'id';
    public $instanceOfModel = false;
    public $tag;

    /**
     * Keys constructor.
     * @param $subject
     * @param $tag
     */
    public function __construct($subject, $tag)
    {
        $this->modelName = strtolower(str_plural(class_basename(is_string($subject) ? $subject : get_class($subject))));
        $this->prefix = config('visits.redis_keys_prefix');
        $this->testing = app()->environment('testing') ? 'testing:' : '';
        $this->primary = (new $subject)->getKeyName();
        $this->tag = $tag;
        $this->visits = $this->visits($subject);

        if ($subject instanceof Model) {
            $this->instanceOfModel = true;
            $this->modelName = strtolower(str_singular(class_basename(get_class($subject))));
            $this->id = $subject->{$subject->getKeyName()};
        }
    }

    /**
     * Get cache key
     *
     * @param $key
     * @return string
     */
    public function visits($key)
    {
        return "{$this->prefix}:$this->testing" .
            strtolower(str_plural(class_basename(is_string($key) ? $key : get_class($key))))
            . "_{$this->tag}";
    }

    /**
     * @param $ip
     * @return string
     */
    public function ip($ip)
    {
        return $this->visits . '_' .
            snake_case("recorded_ips:" . ($this->instanceOfModel ? "{$this->id}:" : '') . $ip);
    }


    /**
     * @param $limit
     * @param $isLow
     * @return string
     */
    public function cache($limit = '*', $isLow = false)
    {
        $key = $this->visits . "_lists";

        if ($limit == '*') {
            return "{$key}:*";
        }

        return "{$key}:" . ($isLow ? "low" : "top") . "{$limit}";
    }

    /**
     * @param $period
     * @return string
     */
    public function period($period)
    {
        return "{$this->visits}_{$period}";
    }

    /**
     * @param $relation
     * @param $id
     */
    public function append($relation, $id)
    {
        $this->visits .= "_{$relation}_{$id}";
    }
}