@extends('layouts.app')

@section('content')
<section>
  <div id="heading-breadcrumbs" class="border-top-0 border-bottom-0">
    <div class="container">
      <div class="row d-flex align-items-center flex-wrap">
        <div class="col-md-7">
          <h2>登記表格</h2>
        </div>
        <div class="col-md-5">
          <ul class="breadcrumb d-flex justify-content-end">
            <li class="breadcrumb-item"><a href="{{route('home')}}">主頁</a></li>
        	<li class="breadcrumb-item active">登記表格</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div id="content">
    <div class="container">
      <div class="row bar">
        <div id="customer-account" class="col-lg-9 clearfix">          
          @if(Auth::user()->active == 1)
          <p style="color: Red;" ><a>*你的用戶正待審核中 , 將會視為"未審核用戶"" , 請耐心等待 。 審核成功後才可發佈 。 </a></p>
          @else
       
            <div class="heading">
              <h3 class="text-uppercase">登記表格</h3>
            </div>
            @if (count($errors)>0)
                @foreach($errors->all() as $error)
                <div class="alert alert-danger">
                    {{ $error }}
                </div>
                @endforeach
            @endif
            @if (session('success_info'))
              <div class="alert alert-success">
                  {{ session('success_info') }} <a href="{{route(session('routeview'), ['id' => session('postUrl')])}}">接此前往!</a>
              </div>
            @endif
            <form  role="form" method="post" action="{{route('newpost_post')}}" enctype="multipart/form-data" >
              {{csrf_field()}}          

              <div class="form-group">
                <div class="row">
                    <label class="col-md-3 control-label" for="title" style="font-size: 18px;">種類</label>  
                    <div class="col-md-7">
                      <p>{{Form::radio('post_type', '0' )}} <font color="Green">捐贈</font>
                      {{Form::radio('post_type', '1')}} <font color="Blue">徵求</font></p>
                    </div>   
                </div>                  
              </div>  

              <div class="form-group">
                <div class="row">
                    <label class="col-md-3 control-label" for="title" style="font-size: 18px; padding-top: 4px;">標題</label>  
                    <div class="col-md-7">
                      <input id="post_title" name="post_title"  class="form-control input-md" type="text" value="{{old('post_title')}}"> 
                    </div>   
                </div>                  
              </div>    

              <div class="form-group">
                <div class="row">
                    <label class="col-md-3 control-label" for="post_description" style="font-size: 18px; padding-top: 4px;">內容</label>  
                    <div class="col-md-7">
                      <textarea id="post_description" name="post_description"  class="form-control input-md" >{{ old('post_description') }}</textarea> 
                    </div>   
                </div>                  
              </div>   

              <div class="form-group">
                <div class="row">
                    <label class="col-md-3 control-label" for="photo" style="font-size: 18px; padding-top: 4px;">圖片上傳</label>  
                    <div class="col-md-7">
                      {{Form::file('photo',old('photo'))}}
                    </div>   
                </div>                  
              </div>    
             
              <div class=" text-center">
                <button type="submit" class="btn btn-template-outlined"><i class="fas fa-plus-square"></i> 發佈</button>
              </div>
           

            </form>
         
          @endif          
          
          
        </div>
        <div class="col-lg-3 mt-4 mt-lg-0">
          <!-- CUSTOMER MENU -->
          <div class="panel panel-default sidebar-menu">
            <div class="panel-heading">
              <h3 class="h4 panel-title">用戶功能</h3>
            </div>
            <div class="panel-body">
              <ul class="nav nav-pills flex-column text-sm">
                <li class="nav-item"><a href="{{ route('account') }}" class="nav-link"><i class="fa fa-user-alt"></i> 我的帳戶</a></li>
                <li class="nav-item"><a href="{{ route('newpost') }}" class="nav-link active"><i class="fas fa-plus-circle"></i> 登記捐贈/徵求</a></li>
                <li class="nav-item"><a href="{{route('favlist')}}" class="nav-link"><i class="fa fa-heart "></i> 我的最愛</a></li>
                <li class="nav-item"><a href="{{ route('userposts') }}" class="nav-link"><i class="fa fa-list"></i> 我的發佈</a></li>
                <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-sign-out-alt"></i> 登出</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection