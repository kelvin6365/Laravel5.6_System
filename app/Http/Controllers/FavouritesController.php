<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favourite;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Hashids;
use Response;

class FavouritesController extends Controller
{
    public function index(){
    	$userID = Auth::user()->id;
    	$userFavourites = Favourite::where('user_id','=',$userID)->orderBy('created_at','DESC')->paginate(10);    	

    	
    	return view('User.user_favlist',['userFavourites' => $userFavourites ]);

    }

    public function store()
 	{
		$userID = Auth::user()->id;
		$Post_id = Input::get('Post_id');
		$hasData = Favourite::where('user_id','=',$userID)->where('post_id','=',$Post_id)->first();
		if(empty($hasData))
		{
			
			
			$favourite = new Favourite;
			$favourite -> user_id = $userID;
			$favourite -> post_id = $Post_id;
			$favourite->save();
				
			$response = array(
	            'status' => 'success',
	            'msg' => 'Setting created successfully',
	        );
	        return Response::json($response); 
		}
		else
		{		
			Favourite::where('user_id','=',$userID)->where('post_id','=',$Post_id)->delete();
			$response = array(
	            'status' => 'success',
	            'msg' => 'Setting created successfully',
	        );
			return Response::json($response); 
		}
		

	}
	
	/**
	 * Grab the lettingId and detach it from the likes and then find the Letting
	 * and record the activity.
	 *
	 * @param $lettingId
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws FavouriteNotFoundException
	 */
	public function destroy($id)
	{
		Favourite::where('id','=',$id)->delete();
		//$favourites->delete();

		return redirect()->back();
	}

	
}
