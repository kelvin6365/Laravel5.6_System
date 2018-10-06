<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Post;
use Hashids;
use Image;
use File;
use Illuminate\Pagination\LengthAwarePaginator;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('User.user_account');
    }

    public function newpost()
    {
        
        return view('User.user_newpost');
    }

    public function editPost_page($id)
    {
       
       $edit = Post::where('id','=',Hashids::decode($id))->first();
       return view('User.user_editpost',compact('edit'));    
                
    }
    

    public function userPosts(Request $request)
    {
        $userID = Auth::user()->id;
        $userPosts = Post::where('post_proser' ,'=', $userID )->orderBy('created_at','DESC')->paginate(10);
        return view('User.user_postlist',compact('userPosts'));       

    }

        
 

    public function changePassword(Request $request)
    {
        
        if (!(Hash::check($request->get('password_old'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","你舊密碼錯誤 , 請重新輸入 。");
        }

        if(strcmp($request->get('password_old'), $request->get('password_1')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","你新舊密碼相同 , 請重新輸入 。");
        }
      

        $this->validate($request, [     
            'password_old' => 'required',
            'password_1' => 'required|confirmed|min:6',
        ]);
   

        $user = Auth::user();
        $user->password = bcrypt($request->get('password_1'));
        $user->save();
 
        return redirect()->back()->with("success","更改成功 !");

    }

    public function changeInfo(Request $request)
    {
        
        $validator = Validator::make($request->all(), [    
           
            'phone_no' => 'required|min:8|max:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with("error_info","更改失敗 !");
        }
        else {
            $user = Auth::user();
            if ($request->has('company')) {
                $user->title = $request->get('company');
            }
            $user->phone = $request->get('phone_no');
            $user->save();

            return redirect()->back()->with("success_info","更改成功 !");
        }

        
    }
}
