<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="all,follow">
    <meta name="userId" content="{{ Auth::check() ? Auth::user()->id : '' }}">

    <title>{{ config('app.name', 'LittleBoy') }}</title>       

    
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ url('vendor/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="{{ url('vendor/font-awesome/css/all.css') }}">
    <!-- Google fonts - Roboto-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,700">
    <!-- Bootstrap Select-->
    <link rel="stylesheet" href="{{ url('vendor/bootstrap-select/css/bootstrap-select.min.css') }}">
    <!-- owl carousel-->
    <link rel="stylesheet" href="{{ url('vendor/owl.carousel/assets/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ url('vendor/owl.carousel/assets/owl.theme.default.css') }}">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ url('css/style.default.css') }}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{ url('css/custom.css') }}">
    <link rel="stylesheet" href="{{ url('css/item.css') }}">
    <!-- Favicon and apple touch icons-->
    <link rel="shortcut icon" href="{{ url('img/favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ url('img/apple-touch-icon.png') }}">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ url('img/apple-touch-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ url('img/apple-touch-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ url('img/apple-touch-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ url('img/apple-touch-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ url('img/apple-touch-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ url('img/apple-touch-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ url('img/apple-touch-icon-152x152.png') }}">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

    
</head>

    
<body> 
      
<!-- Top bar-->
<div class="top-bar" id="app">
    <div class="container">
      <div class="row d-flex align-items-center">
        <div class="col-md-6 d-md-block d-none">
          <p>Contact us on +420 777 555 333 or hello@universal.com.</p>
        </div>
        <div class="col-md-6">
          <div class="d-flex justify-content-md-end justify-content-between">
            <ul class="list-inline contact-info d-block d-md-none">
              <li class="list-inline-item"><a href="#"><i class="fa fa-phone"></i></a></li>
              <li class="list-inline-item"><a href="#"><i class="fa fa-envelope"></i></a></li>
            </ul>          

            <ul class="navbar-nav " >
                <div class="login" >
                     @guest
                        <li class="nav-item" >
                            <a href="#" data-toggle="modal" data-target="#login-modal" class="login-btn"><i class="fa fa-sign-in-alt"></i><span class="d-none d-md-inline-block">用戶登入</span></a>
                       
                            <a href="{{ route('register') }}" class="signup-btn"><i class="fas fa-user-plus"></i><span class="d-none d-md-inline-block">註冊用戶</span></a>
                        </li>
                        @else     
                        <notification v-bind:notifications="notifications"></notification>                   
                        <li class="nav-item navbar-toggler-right" style="display:inline;">                            
                            <a id="navbarDropdown" class="dropdown-toggle"  href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><i class="fa fa-user"></i> {{ Auth::user()->name }}<span class="caret"></span></a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item"  href="{{route('account')}}" style="font-size: 12px;">
                                   <i class="fa fa-user"></i> 我的帳戶
                                </a>
                                <a class="dropdown-item"  href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();" style="font-size: 12px;">
                                   <i class="fa fa-sign-out-alt"></i> 登出
                                </a>


                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </div>
            </ul>
            <!--
            <ul class="social-custom list-inline">
              <li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
              <li class="list-inline-item"><a href="#"><i class="fa fa-google-plus"></i></a></li>
              <li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
              <li class="list-inline-item"><a href="#"><i class="fa fa-envelope"></i></a></li>
            </ul>
        -->
          </div>
        </div>
      </div>
    </div>
</div>
<!-- Top bar end-->
<!-- Login Modal-->
<div id="login-modal" tabindex="-1" role="dialog" aria-labelledby="login-modalLabel" aria-hidden="true" class="modal fade">
    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
        @csrf
        <div role="document" class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 id="login-modalLabel" class="modal-title">用戶登入</h4>
              <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
              <form action="customer-orders.html" method="get">
                <div class="form-group">
                  <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="電鄱" required autofocus >
                   @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                    @endif
                </div>
                <div class="form-group">
                  <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="密碼" required >
                   @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                    @endif
                </div>
                <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                記錄用戶登入
                            </label>
                        </div>
                    </div>
                </div>
                <p class="text-center">
                  <button type="submit" class="btn btn-template-outlined"><i class="fa fa-sign-in-alt fa-lg"></i> 登入</button>
                  <a href="{{route('facebook_login')}}" class="btn btn-template-outlined"><i class="fab fa-facebook-square fa-lg" style="color: blue;"></i> 由 Facebook 登入</a>
                </p>
              </form>
              <p class="text-center text-muted">仍未註冊?</p>
              <p class="text-center text-muted"><a href="{{ route('register') }}"><strong>現在註冊吧!</strong></a> 成為用戶後可使用更多功能!</p>
            </div>
          </div>
        </div>
    </form>
</div>
<!-- Login modal end-->
<!-- Navbar Start-->
<header class="nav-holder make-sticky">
    <div id="navbar" role="navigation" class="navbar navbar-expand-lg">
      <div class="container"><a href="{{ route('home') }}" class="navbar-brand home"><img src="{{ URL::asset('img/logo.png') }}" alt="Universal logo" class="d-none d-md-inline-block"><img src="{{ URL::asset('img/logo-small.png')}}" alt="Universal logo" class="d-inline-block d-md-none"><span class="sr-only">Universal - go to homepage</span></a>
        <button type="button" data-toggle="collapse" data-target="#navigation" class="navbar-toggler btn-template-outlined"><span class="sr-only">Toggle navigation</span><i class="fa fa-align-justify"></i></button>
        <div id="navigation" class="navbar-collapse collapse">
          <ul class="nav navbar-nav ml-auto">
            <li class="nav-item dropdown active">
              <a href="{{ url('/') }}" >主頁 <b class="caret"></b></a>
             <!-- 
              <a href="#" data-toggle="dropdown" class="dropdown-toggle">Home <b class="caret"></b></a>
             <ul class="dropdown-menu">
                <li class="dropdown-item"><a href="index.html" class="nav-link">Option 1: Default Page</a></li>
                <li class="dropdown-item"><a href="index2.html" class="nav-link">Option 2: Application</a></li>
                <li class="dropdown-item"><a href="index3.html" class="nav-link">Option 3: Startup</a></li>
                <li class="dropdown-item"><a href="index4.html" class="nav-link">Option 4: Agency</a></li>
                <li class="dropdown-item"><a href="index5.html" class="nav-link">Option 5: Portfolio</a></li>
              </ul>
            -->
            </li>
            <li class="nav-item dropdown menu-large"><a href="#" data-toggle="dropdown" class="dropdown-toggle">物資捐贈<b class="caret"></b></a>
              <ul class="dropdown-menu megamenu">
                <li>
                  <div class="row">
                    <div class="col-lg-6"><img src="{{ URL::asset('img/Menu/donation.jpg')}}" alt="" class="img-fluid d-none d-lg-block"></div>
                    <div class="col-lg-3 col-md-6">
                      <h5>捐贈區</h5>
                      <ul class="list-unstyled mb-3">
                        <li class="nav-item"><a href="{{ route('post', ['type' => '0']) }}" class="nav-link">最新捐贈總覽</a></li>
                        <li class="nav-item"><a href="{{ route('post_old', ['type' => 0]) }}" class="nav-link">過往捐贈記錄</a></li>                
                      </ul>
                    </div>
                    <div class="col-lg-3 col-md-6">
                      <h5>提供捐贈</h5>
                      <ul class="list-unstyled mb-3">
                        @guest
                        <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">請先登入</a></li>
                        @else
                        <li class="nav-item"><a href="{{ route('newpost') }}" class="nav-link">登記表格</a></li>
                        <li class="nav-item"><a href="{{ route('userposts') }}" class="nav-link">捐贈狀態(檢示/修改/刪除)</a></li>
                        @endguest
                      </ul>
                    </div>
                  </div>
                </li>
              </ul>
            </li>
            <li class="nav-item dropdown menu-large"><a href="#" data-toggle="dropdown" class="dropdown-toggle">物資徵求<b class="caret"></b></a>
              <ul class="dropdown-menu megamenu">
                <li>
                  <div class="row">
                    <div class="col-lg-6"><img src="{{ URL::asset('img/Menu/ask.png')}}" alt="" class="img-fluid d-none d-lg-block"></div>
                    <div class="col-lg-3 col-md-6">
                      <h5>徵求區</h5>
                      <ul class="list-unstyled mb-3">
                        <li class="nav-item"><a href="{{ route('post', ['type' => '1']) }}" class="nav-link">最新徵求總覽</a></li>
                        <li class="nav-item"><a href="{{ route('post_old', ['type' => 1]) }}" class="nav-link">過往徵求記錄</a></li>
                   
                      </ul>
                    </div>
                    <div class="col-lg-3 col-md-6">
                      <h5>徵求物資</h5>
                      <ul class="list-unstyled mb-3">
                        @guest
                        <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">請先登入</a></li>
                        @else
                        <li class="nav-item"><a href="{{ route('newpost') }}" class="nav-link">登記表格</a></li>
                        <li class="nav-item"><a href="{{ route('userposts') }}" class="nav-link">徵求狀態(檢示/修改/刪除)</a></li>                        
                        @endguest                        
                      </ul>                         
                    </div>
                  </div>
                </li>
              </ul>
            </li>

            <!-- ========== FULL WIDTH MEGAMENU ==================-->
            <!--
            <li class="nav-item dropdown menu-large"><a href="#" data-toggle="dropdown" data-hover="dropdown" data-delay="200" class="dropdown-toggle">All Pages <b class="caret"></b></a>
              <ul class="dropdown-menu megamenu">
                <li>
                  <div class="row">
                    <div class="col-md-6 col-lg-3">
                      <h5>Home</h5>
                      <ul class="list-unstyled mb-3">
                        <li class="nav-item"><a href="index.html" class="nav-link">Option 1: Default Page</a></li>
                        <li class="nav-item"><a href="index2.html" class="nav-link">Option 2: Application</a></li>
                        <li class="nav-item"><a href="index3.html" class="nav-link">Option 3: Startup</a></li>
                        <li class="nav-item"><a href="index4.html" class="nav-link">Option 4: Agency</a></li>
                        <li class="nav-item"><a href="index5.html" class="nav-link">Option 5: Portfolio</a></li>
                      </ul>
                      <h5>About</h5>
                      <ul class="list-unstyled mb-3">
                        <li class="nav-item"><a href="about.html" class="nav-link">About us</a></li>
                        <li class="nav-item"><a href="team.html" class="nav-link">Our team</a></li>
                        <li class="nav-item"><a href="team-member.html" class="nav-link">Team member</a></li>
                        <li class="nav-item"><a href="services.html" class="nav-link">Services</a></li>
                      </ul>
                      <h5>Marketing</h5>
                      <ul class="list-unstyled mb-3">
                        <li class="nav-item"><a href="packages.html" class="nav-link">Packages</a></li>
                      </ul>
                    </div>
                    <div class="col-md-6 col-lg-3">
                      <h5>Portfolio</h5>
                      <ul class="list-unstyled mb-3">
                        <li class="nav-item"><a href="portfolio-2.html" class="nav-link">2 columns</a></li>
                        <li class="nav-item"><a href="portfolio-no-space-2.html" class="nav-link">2 columns with negative space</a></li>
                        <li class="nav-item"><a href="portfolio-3.html" class="nav-link">3 columns</a></li>
                        <li class="nav-item"><a href="portfolio-no-space-3.html" class="nav-link">3 columns with negative space</a></li>
                        <li class="nav-item"><a href="portfolio-4.html" class="nav-link">4 columns</a></li>
                        <li class="nav-item"><a href="portfolio-no-space-4.html" class="nav-link">4 columns with negative space</a></li>
                        <li class="nav-item"><a href="portfolio-detail.html" class="nav-link">Portfolio - detail</a></li>
                        <li class="nav-item"><a href="portfolio-detail-2.html" class="nav-link">Portfolio - detail 2</a></li>
                      </ul>
                      <h5>User pages</h5>
                      <ul class="list-unstyled mb-3">
                        <li class="nav-item"><a href="customer-register.html" class="nav-link">Register / login</a></li>
                        <li class="nav-item"><a href="customer-orders.html" class="nav-link">Orders history</a></li>
                        <li class="nav-item"><a href="customer-order.html" class="nav-link">Order history detail</a></li>
                        <li class="nav-item"><a href="customer-wishlist.html" class="nav-link">Wishlist</a></li>
                        <li class="nav-item"><a href="customer-account.html" class="nav-link">Customer account / change password</a></li>
                      </ul>
                    </div>
                    <div class="col-md-6 col-lg-3">
                      <h5>Shop</h5>
                      <ul class="list-unstyled mb-3">
                        <li class="nav-item"><a href="shop-category.html" class="nav-link">Category - sidebar right</a></li>
                        <li class="nav-item"><a href="shop-category-left.html" class="nav-link">Category - sidebar left</a></li>
                        <li class="nav-item"><a href="shop-category-full.html" class="nav-link">Category - full width</a></li>
                        <li class="nav-item"><a href="shop-detail.html" class="nav-link">Product detail</a></li>
                      </ul>
                      <h5>Shop - order process</h5>
                      <ul class="list-unstyled mb-3">
                        <li class="nav-item"><a href="shop-basket.html" class="nav-link">Shopping cart</a></li>
                        <li class="nav-item"><a href="shop-checkout1.html" class="nav-link">Checkout - step 1</a></li>
                        <li class="nav-item"><a href="shop-checkout2.html" class="nav-link">Checkout - step 2</a></li>
                        <li class="nav-item"><a href="shop-checkout3.html" class="nav-link">Checkout - step 3</a></li>
                        <li class="nav-item"><a href="shop-checkout4.html" class="nav-link">Checkout - step 4</a></li>
                      </ul>
                    </div>
                    <div class="col-md-6 col-lg-3">
                      <h5>Contact</h5>
                      <ul class="list-unstyled mb-3">
                        <li class="nav-item"><a href="contact.html" class="nav-link">Contact</a></li>
                        <li class="nav-item"><a href="contact2.html" class="nav-link">Contact - version 2</a></li>
                        <li class="nav-item"><a href="contact3.html" class="nav-link">Contact - version 3</a></li>
                      </ul>
                      <h5>Pages</h5>
                      <ul class="list-unstyled mb-3">
                        <li class="nav-item"><a href="text.html" class="nav-link">Text page</a></li>
                        <li class="nav-item"><a href="text-left.html" class="nav-link">Text page - left sidebar</a></li>
                        <li class="nav-item"><a href="text-full.html" class="nav-link">Text page - full width</a></li>
                        <li class="nav-item"><a href="faq.html" class="nav-link">FAQ</a></li>
                        <li class="nav-item"><a href="404.html" class="nav-link">404 page</a></li>
                      </ul>
                      <h5>Blog</h5>
                      <ul class="list-unstyled mb-3">
                        <li class="nav-item"><a href="blog.html" class="nav-link">Blog listing big</a></li>
                        <li class="nav-item"><a href="blog-medium.html" class="nav-link">Blog listing medium</a></li>
                        <li class="nav-item"><a href="blog-small.html" class="nav-link">Blog listing small</a></li>
                        <li class="nav-item"><a href="blog-post.html" class="nav-link">Blog Post</a></li>
                      </ul>
                    </div>
                  </div>
                </li>
              </ul>
            </li>
          -->
            <!-- ========== FULL WIDTH MEGAMENU END ==================-->
            <!-- ========== Contact dropdown ==================-->
            <li class="nav-item dropdown"><a href="#" >聯絡我們 <b class="caret"></b></a>

          <!--
            <li class="nav-item dropdown"><a href="javascript: void(0)" data-toggle="dropdown" class="dropdown-toggle">聯絡我們 <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li class="dropdown-item"><a href="contact.html" class="nav-link">Contact option 1</a></li>
                <li class="dropdown-item"><a href="contact2.html" class="nav-link">Contact option 2</a></li>
                <li class="dropdown-item"><a href="contact3.html" class="nav-link">Contact option 3</a></li>
              </ul>
          -->

            </li>
            <!-- ========== Contact dropdown end ==================-->
          </ul>
        </div>
        <div id="search" class="collapse clearfix">
          <form role="search" class="navbar-form">
            <div class="input-group">
              <input type="text" placeholder="Search" class="form-control"><span class="input-group-btn">
                <button type="submit" class="btn btn-template-main"><i class="fa fa-search"></i></button></span>
            </div>
          </form>
        </div>
      </div>
    </div>
</header>              
 <!-- Navbar End-->

 <!--content-->
   @yield('content')

 <!--Content End-->


 <!-- FOOTER -->
<footer class="main-footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-3">
          <h4 class="h6">關於我們</h4>
          <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.</p>
          <hr>
          <h4 class="h6">Join Our Monthly Newsletter</h4>
          <form>
            <div class="input-group">
              <input type="text" class="form-control">
              <div class="input-group-append">
                <button type="button" class="btn btn-secondary"><i class="fa fa-send"></i></button>
              </div>
            </div>
          </form>
          <hr class="d-block d-lg-none">
        </div>
        <div class="col-lg-3">
          <h4 class="h6">最新消息</h4>
          <ul class="list-unstyled footer-blog-list">
            @foreach(array_slice($allposts,0,3); as $key => $allpost)
            <li class="d-flex align-items-center">
              <div class="image"><img src="{{ URL::asset($allpost['post_photo'])}}" alt="..." class="img-fluid"></div>
              <div class="text">

                @if($allpost['post_type'] == 0)
                <h6 class="mb-0" style="padding-top: 5px;"> <span style="background-color: #17a2b8;">&nbsp捐贈&nbsp</span></h6>
                <h5 class="mb-0" style="padding-bottom: 15px;"><a href="{{ route('post_info', ['id' => Hashids::encode($allpost['id'] ) ]) }}"> 
                @else 
                <h6 class="mb-0" style="padding-top: 5px;"> <span style="background-color: #28a745;">&nbsp徵求&nbsp</span> </h6>
                <h5 class="mb-0" style="padding-bottom: 15px;"><a href="{{ route('post_info', ['id' => Hashids::encode($allpost['id'])  ]) }}">
                @endif

              

                {{str_limit($allpost['post_title'],15)}}</a></h5>
              </div>
            </li>
            @endforeach
          </ul>
          <hr class="d-block d-lg-none">
        </div>
        <div class="col-lg-3">
          <h4 class="h6">聯絡我們</h4>
          <p class="text-uppercase"><strong>Universal Ltd.</strong><br>13/25 New Avenue <br>Newtown upon River <br>45Y 73J <br>England <br><strong>Great Britain</strong></p><a href="#" class="btn btn-template-main">Go to contact page</a>
          <hr class="d-block d-lg-none">
        </div>
        <div class="col-lg-3">
          <ul class="list-inline photo-stream">
            <li class="list-inline-item"><a href="#"><img src="{{ URL::asset('img/Footer/demo_ig.jpg')}}" alt="..." class="img-fluid"></a></li>
            <li class="list-inline-item"><a href="#"><img src="{{ URL::asset('img/Footer/demo_ig.jpg')}}" alt="..." class="img-fluid"></a></li>
            <li class="list-inline-item"><a href="#"><img src="{{ URL::asset('img/Footer/demo_ig.jpg')}}" alt="..." class="img-fluid"></a></li>
            <li class="list-inline-item"><a href="#"><img src="{{ URL::asset('img/Footer/demo_ig.jpg')}}" alt="..." class="img-fluid"></a></li>
            <li class="list-inline-item"><a href="#"><img src="{{ URL::asset('img/Footer/demo_ig.jpg')}}" alt="..." class="img-fluid"></a></li>
            <li class="list-inline-item"><a href="#"><img src="{{ URL::asset('img/Footer/demo_ig.jpg')}}" alt="..." class="img-fluid"></a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="copyrights">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 text-center-md">
            <p>&copy; 2018. Little Boy / Website by <a href="https://dreamplugs.com">Dreamplugs</a></p>
          </div>
          <div class="col-lg-8 text-right text-center-md">
            <p> 来自: {{$location}}</p>
            <p></p>
          
          </div>
        </div>
      </div>
    </div>
</footer>

    <!-- Javascript files-->
  
    <script src="{{ asset('js/app.js') }}"></script>

    <script src="{{ url('vendor/popper.js/umd/popper.min.js') }}"> </script>
    <script src="{{ url('vendor/jquery.cookie/jquery.cookie.js') }}"> </script>
    <script src="{{ url('vendor/waypoints/lib/jquery.waypoints.min.js') }}"> </script>
    
    <script src="{{ url('js/jquery.parallax-1.1.3.js') }}"></script>
    <script src="{{ url('vendor/jquery.scrollto/jquery.scrollTo.min.js') }}"></script>
    
    
    
    
    <script src="{{ url('vendor/jquery.counterup/jquery.counterup.min.js') }}"> </script>
    <script src="{{ url('vendor/owl.carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ url('vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js') }}"></script>
    
    <script src="{{ url('vendor/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
    
    <script src="{{ url('js/front.js') }}"></script>
    <script src="{{ url('js/like.js') }}"></script>
    <script>
      $("input#post_title").on({
        keydown: function(e) {
          if (e.which === 32)
            return false;
        },
        change: function() {
          this.value = this.value.replace(/\s/g, "");
        }
      });
    </script>

</body>
</html>
