@extends('layouts.app')

@section('content')
<section>
  <div id="heading-breadcrumbs" class="border-top-0 border-bottom-0">
    <div class="container">
      <div class="row d-flex align-items-center flex-wrap">
        @if($type == 0)
        <div class="col-md-7">
          <h2 >過往捐贈記錄</h2>
        </div>
        <div class="col-md-5">
          <ul class="breadcrumb d-flex justify-content-end">
            <li class="breadcrumb-item"><a href="{{route('home')}}">主頁</a></li>
            <li class="breadcrumb-item active">過往捐贈記錄</li>
          </ul>
        </div>
        @else
        <div class="col-md-7">
          <h2 >過往徵求記錄</h2>
        </div>
        <div class="col-md-5">
          <ul class="breadcrumb d-flex justify-content-end">
            <li class="breadcrumb-item"><a href="{{route('home')}}">主頁</a></li>
            <li class="breadcrumb-item active">過往徵求記錄</li>
          </ul>
        </div>
        @endif
      </div>
    </div>
  </div>

  <div id="content">
    <div class="container">
      <div class="row bar">
        <div id="blog-listing-medium" class="col-md-9">
          @foreach ($Posts as $Post)
          <section class="post">
            <div class="row">
              <div class="col-md-4">
                <div class="image"><a href="{{ route('post_info', ['id' => $Post]) }}"><img  src="{{ asset($Post->post_photo) }}" alt="{{$Post->post_title}}" class="img-fluid"></a></div>
              </div>
              <div class="col-md-8">
                <h2 class="h3 mt-0"><a href="{{ route('post_info', ['id' => $Post]) }}">{{ str_limit($Post->post_title,37)}}</a></h2>
                <div class="d-flex flex-wrap justify-content-between text-xs">
                  <p class="author-category">由<a href="{{ route('post_info', ['id' => $Post]) }}">{{$Post->post_proser}}</a><a href="">{{$Post->post_proserTitle}} </a>發佈</p>
                  <p class="date-comments"><a href="{{ route('post_info', ['id' => $Post]) }}"><i class="fas fa-calendar-alt"></i> {{Carbon\Carbon::parse($Post->created_at)->format('d-m-Y H:i A 發佈 | ')}}<i class="fas fa-comments"></i>{{$Post->post_comm}} | <i class="fa fa-eye" ></i>{{ $Post->post_view}} </a></p>
                </div>
                <p class="intro">{{str_limit($Post->post_description,100)}}</p>
                <p class="read-more text-right"><a href="{{ route('post_info', ['id' => $Post]) }}"><button type="button" class="btn btn-warning btn-md ">更多資訊</button></a></p>
              </div>
            </div>
          </section>
          @endforeach
         
          <!-- Viedo 
          <section class="post">
            <div class="row">
              <div class="col-md-4">
                <div class="video">
                  <div class="embed-responsive embed-responsive-4by3">
                    <iframe src="" class="embed-responsive-item"></iframe>
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <h2 class="h3 mt-0"><a href="">Post with video</a></h2>
                <div class="d-flex flex-wrap justify-content-between text-xs">
                  <p class="author-category">By <a href="#">John Snow</a> in <a href="">Webdesign</a></p>
                  <p class="date-comments"><a href=""><i class="fa fa-calendar-o"></i> June 20, 2013</a><a href=""><i class="fa fa-comment-o"></i> 8 Comments</a></p>
                </div>
                <p class="intro">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
                <p class="read-more text-right"><a href="" class="btn btn-template-outlined">Continue reading</a></p>
              </div>
            </div>
          </section>
        -->
        <section name="pager">
          <div class="pager">
            <div style="float: right;">{{ $Posts->links() }}</div>
          </div>
        </section>
          
   
        </div>
        <div class="col-md-3">
          <div class="panel panel-default sidebar-menu">
            <div class="panel-heading">
              <h3 class="h4 panel-title">搜尋</h3>
            </div>
            <div class="panel-body">
              <form role="search">
                <div class="input-group">
                  <input type="text" placeholder="Search" class="form-control"><span class="input-group-btn">
                    <button type="submit" class="btn btn-template-main"><i class="fa fa-search"></i></button></span>
                </div>
              </form>
            </div>
          </div>
          <div class="panel panel-default sidebar-menu">
            <div class="panel-heading">
              <h3 class="h4 panel-title">聖經金句</h3>
            </div>
            <div class="panel-body text-widget">
              <p>Text!!! Improved own provided blessing may peculiar domestic. Sight house has never. No visited raising gravity outward subject my cottage mr be. Hold do at tore in park feet near my case.</p>
            </div>
          </div>        
        </div>
      </div>
    </div>
  </div>
   
</section>
@endsection
