@extends('layouts.app')

@section('content')
<section>
  <div id="heading-breadcrumbs" class="border-top-0 border-bottom-0">
    <div class="container">
      <div class="row d-flex align-items-center flex-wrap">
        <div class="col-md-7">
          <h2>我的發佈</h2>
        </div>
        <div class="col-md-5">
          <ul class="breadcrumb d-flex justify-content-end">
            <li class="breadcrumb-item"><a href="{{route('home')}}">主頁</a></li>
        	<li class="breadcrumb-item active">我的發佈</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div id="content">
    <div class="container">
      <div class="row bar">
        <div id="customer-favlist" class="col-lg-9 clearfix">
          <table id="mytable" class="table table-striped">
             
                    <thead>
                      <tr>
                        <th>種類</th>
                        <th>標題</th>   
                        <th>留言/瀏覽</th>                     
                        <th>發佈時間</th>
                        <th>發佈狀態</th>
                        <th>功能</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- class="badge badge-info /success / danger/ warning -->
                      @foreach($userPosts as $key => $userPost)
                      <tr>
                      @if($userPost->post_type == 0)                        
                        <td class="badge-info">捐贈區</td>
                        <td><a href="{{ route('post_info', ['id' => Hashids::encode($userPost->id) ]) }}" >{{  $userPost->post_title}}</a></td>   
                        <td><i class="fas fa-comments" style="color: green;"></i> {{  $userPost->post_comm}} <i class="fa fa-eye" style="color: green;"></i> {{  $userPost->post_view}}</td>            
                        <td>{{Carbon\Carbon::parse($userPost->created_at)->format(' d-m-Y  H:i A ')}}</td>                       
                     
                        @if($userPost->post_active == 0)
                        <td style="color: Green;">發佈中</td>
                        <td>
                          <div>                          
                            <form method="POST" action="{{ route('delectpost', ['id' => Hashids::encode($userPost->id) ]) }}">
                              <a href="{{ route('user_editpost_page', ['id' => Hashids::encode($userPost->id) ]) }}" ><button type="button" class="btn btn-primary btn-sm pull-left">修改</button></a> 
                              {{ csrf_field() }}
                               {{ method_field('DELETE') }}
                               <button type="submit" class="btn btn-danger btn-sm pull-right">移除</button>
                            </form>
                          </div>                          
                        </td>
                        @else
                        <td style="color: grey;">已關閉</td>
                        <td>
                          <button type="button" class="btn btn-sm">關閉</button></a>
                        </td>
                        @endif
              
                        
                      @else
                        <td class="badge-success" center>徵求區</td>
                        <td><a href="{{ route('post_info', ['id' => Hashids::encode($userPost->id) ]) }}" >{{  $userPost->post_title}}</a></td>  
                        <td><i class="fas fa-comments" style="color: green;"></i> {{  $userPost->post_comm}} <i class="fa fa-eye" style="color: green;"></i> {{  $userPost->post_view}}</td>              
                        <td>{{Carbon\Carbon::parse($userPost->created_at)->format(' d-m-Y  H:i A ')}}</td>                       
                     
                        @if($userPost->post_active == 0)
                        <td style="color: Green;">發佈中</td>
                        <td>
                          <div>  
                            <form method="POST" action="{{ route('delectpost', ['id' => Hashids::encode($userPost->id) ]) }}">
                              <a href="{{ route('user_editpost_page', ['id' => Hashids::encode($userPost->id)]) }}" ><button type="button" class="btn btn-primary btn-sm">修改</button></a>
                              {{ csrf_field() }}
                               {{ method_field('DELETE') }}
                               <button type="submit" class="btn btn-danger btn-sm">移除</button>
                            </form>
                          </div>      
                        </td>
                        @else
                        <td style="color: grey;">已關閉</td>
                        <td>
                          <button type="button" class="btn btn-sm">關閉</button></a>
                        </td>
                        @endif
              
                        
                      @endif
                                  
                        
                       
                      </tr>  
                      @endforeach                                   
                    </tbody>                    
                  </table>
                  <div class="pager">
                   <div style="float: right;">{{ $userPosts->links() }}</div>
                  </div>       
        </div>
          
      
        <div class="col-lg-3 mt-4 mt-lg-0">
          <!-- CUSTOMER MENU -->
          <div class="panel panel-default sidebar-menu">
            <div class="panel-heading">
              <h3 class="h4 panel-title">用戶功能</h3>
            </div>
            <div class="panel-body">
              <ul class="nav nav-pills flex-column text-sm">
                <li class="nav-item"><a href="{{ route('account') }}" class="nav-link "><i class="fa fa-user-alt"></i> 我的帳戶</a></li>
                <li class="nav-item"><a href="{{ route('newpost') }}" class="nav-link"><i class="fas fa-plus-circle"></i> 登記捐贈/徵求</a></li>
                <li class="nav-item"><a href="{{route('favlist')}}" class="nav-link "><i class="fa fa-heart"></i> 我的最愛</a></li>
                <li class="nav-item"><a href="{{ route('userposts') }}" class="nav-link active"><i class="fa fa-list"></i> 我的發佈</a></li>
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
