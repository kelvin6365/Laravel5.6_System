<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Post_comm;
use App\User;
use App\Brand;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gPosts = Post::where('post_type' ,'=', 0 )->where('post_active' ,'=', 0 )->orderBy('created_at','DESC')->limit(8)->get();
        $aPosts = Post::where('post_type' ,'=', 1 )->where('post_active' ,'=', 0 )->orderBy('created_at','DESC')->limit(8)->get();
        $brands = Brand::orderBy('id','DESC')->get();
        foreach ($gPosts as $key => $gpost) {
            $gpost->post_comm = Post_comm::where('post_id','=',$gpost->id)->orderBy('created_at','DESC')->count();
            $gpost->save();
            $UserName = User::where('id','=',$gpost->post_proser)->first();
            $gpost->post_proser = $UserName->name;
            
        }

        foreach ($aPosts as $key => $apost) {
            $apost->post_comm = Post_comm::where('post_id','=',$apost->id)->orderBy('created_at','DESC')->count();
            $apost->save();
            $UserName = User::where('id','=',$apost->post_proser)->first();
            $apost->post_proser = $UserName->name;
            
        }
        return view('home',compact('gPosts','aPosts','brands'));
    }

    
}
