@extends('layouts.app')

@section('content')
<section>
  <div id="heading-breadcrumbs" class="border-top-0 border-bottom-0">
    <div class="container">
      <div class="row d-flex align-items-center flex-wrap">
        <div class="col-md-7">
          <h2 >{{$Post->post_title}}</h2>
        </div>
        <div class="col-md-5">
          @if($Post->post_type == 0)
          <ul class="breadcrumb d-flex justify-content-end">
            <li class="breadcrumb-item"><a href="{{route('home')}}">主頁</a></li>
            @if($Post->post_active == 0)
            <li class="breadcrumb-item"><a href="{{route('post', ['type' => '0'])}}">捐贈總覽</a></li>
            @else
            <li class="breadcrumb-item"><a href="{{route('post_old', ['type' => 0])}}">過往捐贈記錄</a></li>
            @endif

            <li class="breadcrumb-item active">{{$Post->post_title}}</li>
          </ul>
          @else
          <ul class="breadcrumb d-flex justify-content-end">
            <li class="breadcrumb-item"><a href="{{route('home')}}">主頁</a></li>
            @if($Post->post_active == 0)
            <li class="breadcrumb-item"><a href="{{route('post', ['type' => '1'])}}">徵求總覽</a></li>
            @else
            <li class="breadcrumb-item"><a href="{{route('post_old', ['type' => 1])}}">過往捐贈記錄</a></li>
            @endif

            <li class="breadcrumb-item active">{{$Post->post_title}}</li>
          </ul>
          @endif
        </div>
      </div>
    </div>
  </div>

  <div id="content">
    <div class="container">
      <div class="row bar">
        <!-- LEFT COLUMN _________________________________________________________-->
        <div id="blog-post" class="col-md-9">
          <p class="text-muted text-uppercase mb-small text-right text-sm">由<a href="#">{{$Post->post_proser}}</a>  {{Carbon\Carbon::parse($Post->created_at)->format('於 d-m-Y 的 H:i A 發佈')}} | <i class="fa fa-eye" aria-hidden="true"></i>{{$Post->post_view}}次瀏覽 | <i class="fas fa-comments"></i>{{$Post->post_comm}}次留言</p>          
          <div id="post-content">            
            <p><img src="{{ URL::asset($Post->post_photo)}}" alt="Example blog post alt" class="img-fluid"></p>
            <h2>
             {{$Post->post_title}}
              <div class="text-right">
               @if(Auth::check()) 
                @include('partials.favourite_button')
               @endif  
              </div>                
            </h2>
            
            <blockquote class="blockquote" style="background-color: #f0f0f5;">
              <p class="text-sm"><strong>捐贈內容:</strong></p>
              <p class="text-sm">{{$Post->post_description}}</p>
            </blockquote>            
            
          </div>
          
          <div id="comments">
            <h4 class="text-uppercase">總共 {{$Post->post_comm}} 個留言 </h4>
            <h6 class="text-uppercase">由新至舊排序</h6>
             @foreach($Post_comms as $key => $Post_comm)
            <div class="row comment">
              <div class="col-sm-3 col-md-2 text-center-xs">
                <p><img src="{{ URL::asset($Post_comm->User->avatar) }}" alt="" class="img-fluid rounded-circle"></p>
              </div>             
              <div class="col-sm-9 col-md-10">
                <h5 class="text-uppercase">{{$Post_comm->User->name}}</h5>
                <p class="posted"><i class="fa fa-clock-o"></i> {{Carbon\Carbon::parse($Post_comm->created_at)->format('於 d-m-Y 的 H:i A 留言')}}</p>
                <p>{{$Post_comm->comm_text}}</p>
                <p class="reply"><a href="#"><i class="fa fa-reply"></i> Reply</a></p>
              </div>

            </div> 
            @endforeach  
            <div class="pager">
              <div style="float: center;">{{ $Post_comms->links() }}</div>
            </div>         
          </div>

          <div id="comment-form">
            @if (Auth::check())

              @if( $Post->post_active == 0) 
              <h4 class="text-uppercase">用戶留言</h4>

              <form  role="form" method="post" action="{{route('post_info_comm', ['id' => $Post])}}">
                {{csrf_field()}}
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="name">名稱 <span class="required text-primary">*</span></label>
                      <input id="id" name="id" value="{{Auth::user()->id}}" type="text" class="form-control" hidden>
                      <input id="name" name="name" type="text" value="{{Auth::user()->name}}" class="form-control" readonly="true">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="comm_email">電郵 <span class="required text-primary">*</span></label>
                      <input id="comm_email" name="comm_email" type="text" value="{{Auth::user()->email}}" class="form-control" readonly="true">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label for="comment">內容 <span class="required text-primary">*</span></label>
                      <textarea id="comment" name="comment" rows="4" class="form-control" required></textarea>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12 text-right">
                    <button type="submit" class="btn btn-template-outlined"><i class="fa fa-comment-o"></i> Post comment</button>
                  </div>
                </div>
              </form>
              @else
              <h4 class="text-uppercase">此發佈已關閉!</h4>
              @endif
            @else
            <h4 class="text-uppercase">請先 <a href="{{ route('login') }}">登入</a> 或 <a href="{{ route('register') }}">註冊</a> 才進行留言!</h4>
            @endif
          </div>
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
