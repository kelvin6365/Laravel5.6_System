<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Post_comm;
use App\Favourite;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Hashids;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Validator;
use File;
use Image;
use App\Notifications\InvoicePaid;

class PostsController extends Controller
{
    public function index($type)
    {      	     	
		$Posts = Post::where('post_type' ,'=', $type )->where('post_active' ,'=', 0 )->orderBy('created_at','DESC')->paginate(5);
        foreach ($Posts as $key => $Post) {
            $Post->post_comm = Post_comm::where('post_id','=',$Post->id)->count();
            $Post->save(); 
            $UserName = User::where('id','=',$Post->post_proser)->first();
            $Post->post_proser = $UserName->name;                     
            
        }
        return view('post',['Posts' => $Posts , 'type' =>$type]);
      
        
        
    }

    public function index_old($type)
    {               
        $Posts = Post::where('post_type' ,'=', $type )->where('post_active' ,'=', 1 )->orderBy('created_at','DESC')->paginate(5);
        foreach ($Posts as $key => $Post) {
            $UserName = User::where('id','=',$Post->post_proser)->first();
            $Post->post_proser = $UserName->name;                     
            
        }
        return view('post_old',['Posts' => $Posts , 'type' =>$type]);
      
        
        
    }

    public function post_info(Request $request , $id)
    {
        //get gpost id
        $postID = Hashids::decode($id);
        //find gpost from id
        $Post = Post::where('id' ,'=', $postID )->first();
        //view count
        $viewKey = 'blog_'.$Post->id;    
        if(!Session::has($viewKey)){
                Post::where('id' ,'=', $Post->id )->increment('post_view');
                //refresh Post
                $Post = Post::where('id' ,'=', $postID )->first();
                Session::put($viewKey,1);
            } 

        //other info
        $UserName = User::where('id','=',$Post->post_proser)->first();
                  
        $Post->post_comm = Post_comm::where('post_id','=',$Post->id)->orderBy('created_at','DESC')->count(); 
        $Post->save();     
        $Post->post_proser = $UserName->name;
        
        //get post comments
        $Post_comms = Post_comm::where('post_id','=',$Post->id)->orderBy('created_at','DESC')->paginate(5);      
           
        $favourites =Null;
        if(Auth::user()){
            $favourites = Favourite::where('user_id','=',Auth::user()->id)->where('post_id','=',$Post->id)->first();
            
        }


        return view('Info',['Post' => $Post , 'Post_comms' => $Post_comms , 'favourites' => $favourites]);		
    }

    public function post_comm(Request $request , $id) {

        
        $postID = Hashids::decode($id);   
       

        $input = Input::all();
        $rules = array(
                         
                        'comment' => 'required',   
                   
                     );  
        $validator = Validator::make($input, $rules);      
   
        if ($validator->fails()){
                    return redirect()->back()->withErrors($validator->errors())->withInput();
                }else{
                        $tab = Post_comm::create([
                                         'user_id' =>  Input::get('id'),
                                         'post_id' => $postID[0],
                                         'comm_text' => Input::get('comment'), 
                                     ]);
                  
                       
                      
                    }
        $post = Post::find($postID[0]);
        User::find($post->post_proser)->notify(new InvoicePaid($post));

        return redirect()->back();
    }

    public function newpost_post(Request $request)
    {
        $this->validate($request, [
          'post_type' => 'required',
          'post_title' => 'required',
          'photo' => 'image|mimes:jpeg,png,jpg|max:2048',
          'post_description' => 'required',
        ],
        [
            'post_type.required' => '請選擇種類 !',
            'post_title.required' => '請輸入標題 !',
            'post_description.required' => '請輸入內容 !',
        ]
        );

        
        $newPost = new Post();
        $newPost->post_type = Input::get('post_type');
        $newPost->post_title = Input::get('post_title');
        $newPost->post_description = Input::get('post_description');
        $newPost->post_proser = Auth::user()->id;
        $newPost->post_photo = "img/Item/no_image.png";
        $newPost->post_view = 0;
        $newPost->post_comm = 0;
        $newPost->post_active = 0;
        $newPost->save();
        if ($request->hasFile('photo')) {
            $background = Image::canvas(900, 675);
            $image = $request->file('photo');
            $name = date('dmYHis').Hashids::encode($newPost->id).$newPost->post_type.'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/img/Item');
            $imagePath = "img/Item/".  $name;
           // $image->move($destinationPath, $name);

            $newImage = Image::make(Input::file('photo'))->resize(900, 675, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });
            $background->insert($newImage, 'center');
            $background->save($imagePath);
            $newPost->post_photo = $imagePath;
            $newPost->save();
        }
        $postUrl = Hashids::encode($newPost->id);
        return redirect()->back()->with("success_info","發佈成功 !")->with('postUrl',$postUrl)->with('routeview','post_info');

           
    }

    public function editPost_edit(Request $request,$id)
    {        
        $this->validate($request, [          
          'post_title' => 'required',
          'photo' => 'image|mimes:jpeg,png,jpg|max:2048',
          'post_description' => 'required',
        ],
        [
            'post_type.required' => '請選擇種類 !',
            'post_title.required' => '請輸入標題 !',
            'post_description.required' => '請輸入內容 !',
        ]
        );
       
        $edit = Post::where('id','=',Hashids::decode($id))->first();       

        $edit->post_title = Input::get('post_title');
        $edit->post_description = Input::get('post_description');

        if ($request->hasFile('photo')) {
            if($edit->post_photo != 'img/Item/no_image.png')                 
            {
                File::delete($edit->post_photo);
            }    

            $background = Image::canvas(900, 675);
            $image = $request->file('photo');
            $name =  date('dmYHis').$id.$edit->post_type.'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/img/Item');
            $imagePath = "img/Item/".  $name;
           // $image->move($destinationPath, $name);

            $newImage = Image::make(Input::file('photo'))->resize(900, 675, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });
            $background->insert($newImage, 'center');
            $background->save($imagePath);
            $edit->post_photo = $imagePath;             
        }   
        $edit->save();
        $postUrl = Hashids::encode($edit->id);
        return redirect()->back()->with("success_info","修改發佈成功 !")->with('postUrl',$postUrl)->with('routeview','post_info');
                
    }

    public function destroy($id)
    {            
        $deletePost = Post::where('id','=',Hashids::decode($id))->first();
        if($deletePost->post_photo != 'img/Item/no_image.png')
        {
            File::delete($deletePost->post_photo);
        }
        
        $deletePost->delete();
        return redirect()->back();         
       
    }

   
}
