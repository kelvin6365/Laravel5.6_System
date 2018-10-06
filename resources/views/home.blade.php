@extends('layouts.app')

@section('content')
 <section style="background: url('{{ asset('img/Slideshow/photogrid.jpg') }}') center center repeat; background-size: cover;" class="relative-positioned">
        <!-- Carousel Start-->
        <div class="home-carousel">
          <div class="dark-mask mask-primary"></div>
          <div class="container">
            <div class="homepage owl-carousel">
              <div class="item">
                <div class="row">
                  <div class="col-md-5 text-right">
                    <p><img src="img/logo.png" alt="" class="ml-auto"></p>
                    <h1>Multipurpose responsive theme</h1>
                    <p>Business. Corporate. Agency.<br>Portfolio. Blog. E-commerce.</p>
                  </div>
                  <div class="col-md-7"><img src="img/Slideshow/demo.png" alt="" class="img-fluid"></div>
                </div>
              </div>
              <div class="item">
                <div class="row">
                  <div class="col-md-7 text-center"><img src="img/Slideshow/demo.png" alt="" class="img-fluid"></div>
                  <div class="col-md-5">
                    <h2>46 HTML pages full of features</h2>
                    <ul class="list-unstyled">
                      <li>Sliders and carousels</li>
                      <li>4 Header variations</li>
                      <li>Google maps, Forms, Megamenu, CSS3 Animations and much more</li>
                      <li>+ 11 extra pages showing template features</li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="row">
                  <div class="col-md-5 text-right">
                    <h1>Design</h1>
                    <ul class="list-unstyled">
                      <li>Clean and elegant design</li>
                      <li>Full width and boxed mode</li>
                      <li>Easily readable Roboto font and awesome icons</li>
                      <li>7 preprepared colour variations</li>
                    </ul>
                  </div>
                  <div class="col-md-7"><img src="img/Slideshow/demo.png" alt="" class="img-fluid"></div>
                </div>
              </div>
              <div class="item">
                <div class="row">
                  <div class="col-md-7"><img src="img/Slideshow/demo.png" alt="" class="img-fluid"></div>
                  <div class="col-md-5">
                    <h1>Easy to customize</h1>
                    <ul class="list-unstyled">
                      <li>7 preprepared colour variations.</li>
                      <li>Easily to change fonts</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Carousel End-->
</section>

<!-- Item show -->
<section class="bar background-white no-mb">
<div class="container">
  <div class="col-md-12">
    <div class="heading text-center">
      <h2>最新物資捐贈</h2>
    </div>
    <p class="lead" align="center">如你有多餘物資並希望捐贈出來，不妨在此捐贈。<a href="{{ route('post',['type' => 0])}}" >查看更多物資捐贈!</a></p>
    <div class="row">
      @foreach($gPosts as $key => $gPost)
      <div class="col-lg-3">
        <div class="home-blog-post">
          <div class="image"><img src="{{ asset($gPost->post_photo) }} " alt="{{$gPost->title}}" class="img-fluid" >
            <div class="overlay d-flex align-items-center justify-content-center"><a href="{{ route('post_info', ['id' => $gPost]) }}" class="btn btn-template-outlined-white"><i class="fas fa-comments"></i> {{$gPost->post_comm}} 留言 | <i class="fa fa-eye" ></i> {{ $gPost->post_view}} 瀏覽</a></div>
          </div>
          <div class="text">
            <h4><a href="{{ route('post_info', ['id' => $gPost]) }}">{{str_limit($gPost->post_title,15)}} </a></h4>
            <div style="height: 40px;"><p class="author-category">由 <a href="#">{{$gPost->post_proser}}</a> 在 <a href="#">{{Carbon\Carbon::parse($gPost->created_at)->format('d-m-Y H:i A 發佈')}}</a></p></div>
            <div style="height: 100px;"><p class="intro" >{{str_limit($gPost->post_description,120)}}</p></div>
            <a href="{{ route('post_info', ['id' => $gPost]) }}" class="btn btn-template-outlined">更多資訊</a>
          </div>
        </div>
      </div>    
      @endforeach
    
    </div>
  </div>
</div>
</section>

<!--
<section class="bar no-mb">
<div class="container">
  <div class="col-md-12">
    <div class="heading text-center">
      <h2>Who are we?</h2>
    </div>
    <div class="row text-center">
      <div class="col-md-3">
        <div data-animate="fadeInUp" class="team-member">
          <div class="image"><a href="team-member.html"><img src="img/person-1.jpg" alt="" class="img-fluid rounded-circle"></a></div>
          <h3><a href="team-member.html">Han Solo</a></h3>
          <p class="role">Founder</p>
          <ul class="social list-inline">
            <li class="list-inline-item"><a href="#" class="external facebook"><i class="fa fa-facebook"></i></a></li>
            <li class="list-inline-item"><a href="#" class="external gplus"><i class="fa fa-google-plus"></i></a></li>
            <li class="list-inline-item"><a href="#" class="external twitter"><i class="fa fa-twitter"></i></a></li>
            <li class="list-inline-item"><a href="#" class="email"><i class="fa fa-envelope"></i></a></li>
          </ul>
          <div class="text">
            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
          </div>
        </div>
      </div>
 
      <div data-animate="fadeInUp" class="col-md-3">
        <div class="team-member">
          <div class="image"><a href="team-member.html"><img src="img/person-2.jpg" alt="" class="img-fluid rounded-circle"></a></div>
          <h3><a href="team-member.html">Luke Skywalker</a></h3>
          <p class="role">CTO</p>
          <ul class="social list-inline">
            <li class="list-inline-item"><a href="#" class="external facebook"><i class="fa fa-facebook"></i></a></li>
            <li class="list-inline-item"><a href="#" class="external gplus"><i class="fa fa-google-plus"></i></a></li>
            <li class="list-inline-item"><a href="#" class="external twitter"><i class="fa fa-twitter"></i></a></li>
            <li class="list-inline-item"><a href="#" class="email"><i class="fa fa-envelope"></i></a></li>
          </ul>
          <div class="text">
            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
          </div>
        </div>
      </div>
  
      <div data-animate="fadeInUp" class="col-md-3">
        <div class="team-member">
          <div class="image"><a href="team-member.html"><img src="img/person-3.png" alt="" class="img-fluid rounded-circle"></a></div>
          <h3><a href="team-member.html">Princess Leia</a></h3>
          <p class="role">Team Leader</p>
          <ul class="social list-inline">
            <li class="list-inline-item"><a href="#" class="external facebook"><i class="fa fa-facebook"></i></a></li>
            <li class="list-inline-item"><a href="#" class="external gplus"><i class="fa fa-google-plus"></i></a></li>
            <li class="list-inline-item"><a href="#" class="external twitter"><i class="fa fa-twitter"></i></a></li>
            <li class="list-inline-item"><a href="#" class="email"><i class="fa fa-envelope"></i></a></li>
          </ul>
          <div class="text">
            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
          </div>
        </div>
      </div>
   
      <div data-animate="fadeInUp" class="col-md-3">
        <div class="team-member">
          <div class="image"><a href="team-member.html"><img src="img/person-4.jpg" alt="" class="img-fluid rounded-circle"></a></div>
          <h3><a href="team-member.html">Jabba Hut</a></h3>
          <p class="role">Lead Developer</p>
          <ul class="social list-inline">
            <li class="list-inline-item"><a href="#" class="external facebook"><i class="fa fa-facebook"></i></a></li>
            <li class="list-inline-item"><a href="#" class="external gplus"><i class="fa fa-google-plus"></i></a></li>
            <li class="list-inline-item"><a href="#" class="external twitter"><i class="fa fa-twitter"></i></a></li>
            <li class="list-inline-item"><a href="#" class="email"><i class="fa fa-envelope"></i></a></li>
          </ul>
          <div class="text">
            <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
-->
<section style="background: url(img/fixed-background-2.jpg) center top no-repeat; background-size: cover;" class="bar no-mb color-white text-center bg-fixed relative-positioned">
<div class="dark-mask"></div>
<div class="container">
  <div class="icon icon-outlined icon-lg"><i class="fas fa-hands-helping"></i></div>
  <h3 class="text-uppercase">物品用完 或 不再需要時 是否只能成為垃圾，能否再用?</h3>
  <p class="lead">我們希望提供一個平台，讓幫助貧困家庭及支持環保的朋友可以在此發佈資訊。</p>
  <p class="text-center"><a href="" class="btn btn-template-outlined-white btn-lg">了解更多!</a></p>
</div>
</section>

<section class="bar background-white no-mb">
<div class="container">
  <div class="col-md-12">
    <div class="heading text-center">
      <h2>最新物資徵求</h2>
    </div>
    <p class="lead" align="center">如你有多餘物資並希望捐贈出來，不妨留意一下物質徵求，幫助有需要的人。<a href="{{route('post',['type' => 1])}}">查看更多!</a></p>
    <div class="row">
      @foreach($aPosts as $key => $aPost)
      <div class="col-lg-3">
        <div class="home-blog-post">
          <div class="image"><img src="{{ asset($aPost->post_photo) }}" alt="{{$aPost->title}}" class="img-fluid" >
            <div class="overlay d-flex align-items-center justify-content-center"><a href="{{ route('post_info', ['id' => $aPost]) }}" class="btn btn-template-outlined-white"><i class="fas fa-comments"></i> {{$aPost->post_comm}} 留言 | <i class="fa fa-eye" ></i> {{ $aPost->post_view}} 瀏覽</a></div>
          </div>
          <div class="text">
            <h4><a href="{{ route('post_info', ['id' => $aPost]) }}">{{str_limit($aPost->post_title,15)}} </a></h4>
            <div style="height: 40px;"><p class="author-category">由 <a href="#">{{$aPost->post_proser}}</a> 在 <a href="#">{{Carbon\Carbon::parse($aPost->created_at)->format('d-m-Y H:i A 發佈')}}</a></p></div>
            <div style="height: 100px;"><p class="intro" >{{str_limit($aPost->post_description,120)}}</p></div>
            <a href="{{ route('post_info', ['id' => $aPost]) }}" class="btn btn-template-outlined">更多資訊</a>
          </div>
        </div>
      </div>    
      @endforeach
    
    </div>
  </div>
</div>
</section>

<section class="bar bg-gray no-mb">
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <ul class="list-unstyled owl-carousel customers no-mb">
        @foreach($brands as $key => $brand)
        <li class="item"><img src="{{ asset($brand->img_path) }}" alt="" class="img-fluid"></li>      
        @endforeach  
      </ul>
    </div>
  </div>
</div>
</section>



<!--  Thank you Words -->
<!--
<section class="bar background-pentagon no-mb">
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="heading text-center">
        <h2>Testimonials</h2>
      </div>
      <p class="lead">We have worked with many clients and we always like to hear they come out from the cooperation happy and satisfied. Have a look what our clients said about us.</p>
   //   Carousel Start
      <ul class="owl-carousel testimonials list-unstyled equal-height">
        <li class="item">
          <div class="testimonial d-flex flex-wrap">
            <div class="text">
              <p>One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin. He lay on his armour-like back, and if he lifted his head a little he could see his brown belly, slightly domed and divided by arches into stiff sections.</p>
            </div>
            <div class="bottom d-flex align-items-center justify-content-between align-self-end">
              <div class="icon"><i class="fa fa-quote-left"></i></div>
              <div class="testimonial-info d-flex">
                <div class="title">
                  <h5>John McIntyre</h5>
                  <p>CEO, TransTech</p>
                </div>
                <div class="avatar"><img alt="" src="img/person-1.jpg" class="img-fluid"></div>
              </div>
            </div>
          </div>
        </li>
        <li class="item">
          <div class="testimonial d-flex flex-wrap">
            <div class="text">
              <p>The bedding was hardly able to cover it and seemed ready to slide off any moment. His many legs, pitifully thin compared with the size of the rest of him, waved about helplessly as he looked. "What's happened to me? " he thought. It wasn't a dream.</p>
            </div>
            <div class="bottom d-flex align-items-center justify-content-between align-self-end">
              <div class="icon"><i class="fa fa-quote-left"></i></div>
              <div class="testimonial-info d-flex">
                <div class="title">
                  <h5>John McIntyre</h5>
                  <p>CEO, TransTech</p>
                </div>
                <div class="avatar"><img alt="" src="img/person-2.jpg" class="img-fluid"></div>
              </div>
            </div>
          </div>
        </li>
        <li class="item">
          <div class="testimonial d-flex flex-wrap">
            <div class="text">
              <p>His room, a proper human room although a little too small, lay peacefully between its four familiar walls.</p>
              <p>A collection of textile samples lay spread out on the table - Samsa was a travelling salesman - and above it there hung a picture that he had recently cut out of an illustrated magazine and housed in a nice, gilded frame.</p>
            </div>
            <div class="bottom d-flex align-items-center justify-content-between align-self-end">
              <div class="icon"><i class="fa fa-quote-left"></i></div>
              <div class="testimonial-info d-flex">
                <div class="title">
                  <h5>John McIntyre</h5>
                  <p>CEO, TransTech</p>
                </div>
                <div class="avatar"><img alt="" src="img/person-3.png" class="img-fluid"></div>
              </div>
            </div>
          </div>
        </li>
        <li class="item">
          <div class="testimonial d-flex flex-wrap">
            <div class="text">
              <p>It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad.</p>
            </div>
            <div class="bottom d-flex align-items-center justify-content-between align-self-end">
              <div class="icon"><i class="fa fa-quote-left"></i></div>
              <div class="testimonial-info d-flex">
                <div class="title">
                  <h5>John McIntyre</h5>
                  <p>CEO, TransTech</p>
                </div>
                <div class="avatar"><img alt="" src="img/person-4.jpg" class="img-fluid"></div>
              </div>
            </div>
          </div>
        </li>
        <li class="item">
          <div class="testimonial d-flex flex-wrap">
            <div class="text">
              <p>It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that covered the whole of her lower arm towards the viewer. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad. Gregor then turned to look out the window at the dull weather. Drops of rain could be heard hitting the pane, which made him feel quite sad.</p>
            </div>
            <div class="bottom d-flex align-items-center justify-content-between align-self-end">
              <div class="icon"><i class="fa fa-quote-left"></i></div>
              <div class="testimonial-info d-flex">
                <div class="title">
                  <h5>John McIntyre</h5>
                  <p>CEO, TransTech</p>
                </div>
                <div class="avatar"><img alt="" src="img/person-1.jpg" class="img-fluid"></div>
              </div>
            </div>
          </div>
        </li>
      </ul>
      // Carousel End
    </div>
  </div>
</div>
</section>
-->
@if(!Auth::check())
      <!-- GET IT-->
      <div class="get-it">
        <div class="container">
          <div class="row">
            <div class="col-lg-8 text-center p-3">
              <h3>歡迎加入! 一起幫助別人也為環保 盡一分力!</h3>
            </div>
            <div class="col-lg-4 text-center p-3">   <a href=" {{ route('register') }} " class="btn btn-template-outlined-white">加入會員</a></div>
          </div>
        </div>
      </div>

@else
@endif

@endsection
