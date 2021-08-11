<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\http\Request;
use Image;

class ProfileController extends Controller
{
	public function getProfile($username)
	{
		$user = User::where('username', $username)->first();
		   if (!$user) {
			   abort(404);
		   }
		
		$statuses = $user->statuses()->notReply()->get();
		
		return view('profile.index')
		->with('user', $user)
		->with('statuses', $statuses)
		->with('authUserIsFriend', Auth::user()->isFriendswith($user));
	}
	
	public function getEdit()
	{
		return view('profile.edit');
	}
	
	public function postEdit(Request $request)
	{
		$this->validate($request, [ 
		   'first_name' => 'alpha|max:50',
		   'last_name'  => 'alpha|max:50',
		   'location'  => 'max:25',
		   'plateau'   => 'max:25',
		   'service_state' => 'max:20',
		    'zip'          => 'max:10',
			'gender' => 'max:20',
			'status' => 'max:200',
			'state'        => 'max:20',
		
			
				
		]);
		
	
		
		Auth::user()->update([
		   'first_name' => $request->input('first_name'),
		   'last_name'  => $request->input('last_name'),
		   'location'  => $request->input('location'),
		   'plateau'   => $request->input('plateau'),
		   'service_state' => $request->input('service_state'),
		    'zip'          => $request->input('zip'),
		   'gender' =>$request->input('gender'),
			'status' =>$request->input('status'),
			'state'        => $request->input('state'),
		//	'profile_image' =>$request->input('profile_image'),
			
		]);
		
		return redirect()
		->route('profile.edit')
		->with('info', 'Your profile has been updated.');
	}
	
	public function getpictureAvatar()
	{
		return view('profile.pictureAvatar');
	}
	
	public function postpictureAvatar(Request $request)
	{
	   if($request->hasFile('avatar')){
		   $avatar = $request->file('avatar');
		   $filename = time().".". $avatar->getClientOriginalExtension();
		   Image::make($avatar)->save(public_path('img/avatar/'.$filename));
		   $user = Auth::user();
		   $user->avatar = $filename;
		   $user->save();
	   }
	    
		return redirect()
		->route('profile.pictureAvatar')
		->with('info', 'Your profile has been updated.');
	}	
}	