@extends('layouts.app')

@section('content')
<section>
  <div id="heading-breadcrumbs" class="border-top-0 border-bottom-0">
    <div class="container">
      <div class="row d-flex align-items-center flex-wrap">
        <div class="col-md-7">
          <h2>我的帳戶</h2>
        </div>
        <div class="col-md-5">
          <ul class="breadcrumb d-flex justify-content-end">
            <li class="breadcrumb-item"><a href="{{route('home')}}">主頁</a></li>
        	<li class="breadcrumb-item active">我的帳戶</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div id="content">
    <div class="container">
      <div class="row bar">
        <div id="customer-account" class="col-lg-9 clearfix">
          <p class="lead">請填寫正確個人資料 , 以便核實身份及用作聯絡之用途 。</p>
          @if(Auth::user()->active == 1)
          <p style="color: Red;" ><a>*你的用戶正待審核中 , 將會視為"未審核用戶"" , 請耐心等待 。 審核成功後將會轉為"認正用戶" 。 </a></p>
          @else
          <p style="color: Green;" ><a>*你的用戶為"認正用戶" 。 </a></p>
          @endif
          <p class="text-muted">*個人資料只供 捐贈 / 徵求 物資的聯絡之用 , 絕不用作其他商業用途 。</p>
          <div class="box">
            <div class="heading">
              <h3 class="text-uppercase">個人資料</h3>
            </div>
            @if (session('error_info'))
                <div class="alert alert-danger">
                    {{ session('error_info') }}
                </div>
            @endif
            @if (session('success_info'))
              <div class="alert alert-success">
                  {{ session('success_info') }}
              </div>
            @endif
            <form  role="form" method="post" action="{{route('change_info')}}">
              {{csrf_field()}}
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="username">用戶姓名 </label>
                    <label for="company" style="font-size: 6px;color: Green;">*對外顥示之稱呼 eg: 李先生 / 陳姑娘 等等</label>
                    <input id="username" type="text" class="form-control" value ="{{ Auth::user()->name }}" >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="useemail">電郵</label>
                    <input id="useemail" type="text" class="form-control" value ="{{ Auth::user()->email }}" readonly="true">
                  </div>
                </div>            
              </div>          
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="company">公司 / 機構</label>
                    <label for="company" style="font-size: 6px;color: Green;">*選填</label>
                    <input name="company" id="company" type="text" class="form-control" value ="{{ Auth::user()->title }}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="phone_no">聯絡電話</label>
                    <label for="phone_no" style="font-size: 6px;color: Red;">*必填</label>                   
                    <input name="phone_no" id="phone_no" type="text" class="form-control" value="{{ Auth::user()->phone }}" required>
                  </div>
                </div>
              </div>             
              <div class="row">
                 <!--
                <div class="col-md-6 col-lg-3">
                  <div class="form-group">
                    <label for="city">Company</label>
                    <input id="city" type="text" class="form-control">
                  </div>
                </div>
                <div class="col-md-6 col-lg-3">
                  <div class="form-group">
                    <label for="zip">ZIP</label>
                    <input id="zip" type="text" class="form-control">
                  </div>
                </div>
                <div class="col-md-6 col-lg-3">
                  <div class="form-group">
                    <label for="state">State</label>
                    <select id="state" class="form-control"></select>
                  </div>
                </div>
                <div class="col-md-6 col-lg-3">
                  <div class="form-group">
                    <label for="country">Country</label>
                    <select id="country" class="form-control"></select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="phone">Telephone</label>
                    <input id="phone" type="text" class="form-control">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="email_account">Email</label>
                    <input id="email_account" type="text" class="form-control">
                  </div>
                </div>
                -->
                <div class="col-md-12 text-center">
                  <button type="submit" class="btn btn-template-outlined"><i class="fa fa-save"></i> 送出更改</button>
                </div>
              </div>

            </form>
          </div>
          @if (Auth::user()->reby != 2)
          <div class="box">
          	<div class="heading">
              <h3 class="text-uppercase">更改密碼</h3>
            </div>
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
              <div class="alert alert-success">
                  {{ session('success') }}
              </div>
            @endif
            <form method="POST" action="{{ route('change_password') }}" aria-label="{{ __('Reset Password') }}">
             {{ csrf_field() }}         
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="password_old">舊密碼</label>
                    <input name="password_old" id="password_old" type="password" class="form-control{{ $errors->has('password_old') ? ' has-error' : '' }}">
                    @if ($errors->has('password_old'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_old') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="password_1">新密碼</label>
                    <input name="password_1" id="password_1" type="password" class="form-control{{ $errors->has('password_1') ? ' has-error' : '' }}">
                    @if ($errors->has('password_1'))
                        <span class="help-block">
                            <strong style="color: red;">*新密碼不一致 , 請重新輸入新密碼 。</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="password_1-confirm">再次輸入新密碼</label>
                    <input name="password_1_confirmation" id="password_1-confirm" type="password" class="form-control">
                  </div>
                </div>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-template-outlined"><i class="fa fa-save"></i> 更改密碼</button>
              </div>
            </form>            
          </div>
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
                <li class="nav-item"><a href="{{ route('account') }}" class="nav-link active"><i class="fa fa-user-alt"></i> 我的帳戶</a></li>
                <li class="nav-item"><a href="{{ route('newpost') }}" class="nav-link "><i class="fas fa-plus-circle"></i> 登記捐贈/徵求</a></li>
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