<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
	public function getIndex()
	{
		$friends = Auth::user()->friends();
		$requests = Auth::user()->friendRequests();
		
		return view('friends.index')
		  ->with('friends', $friends)
		  ->with('requests', $requests);
	}
	
	public function getAdd ($username)
	{
		$user = User::where('username', $username)->first();
		
		if (!$user) {
			return redirect()
			->route('welcome')
			->with('info', 'That user could not be found.');
		}
		//if you dnt want to be happing the users add them self
		 if (Auth::user()->id === $user->id) {
			 return redirect()->route('welcome');
		 }
		//
		if (Auth::user()->hasFriendRequestPending($user) || $user->
		   hasFriendRequestPending(Auth::user())) {
			return redirect()
			->route('profile.index', ['username' => $user->username])
			->with('info', 'friend request already pending.');
		}
		
		if (Auth::user()->isFriendsWith($user)) {
			return redirect()
			->route('profile.index', ['username' => $user->username])
			->with('info', 'you are already friends.');
		}
		Auth::user()->addFriend($user);
		
		return redirect()
		->route('profile.index', ['username' => $username])
		->with('info', 'Friend request sent.');
			}
			
		public function getAccept($username)	
		{
			$user = User::where('username', $username)->first();
			
			if (!$user) {
				 return redirect ()
				 ->route('welcome')
				 ->with('info', 'That user could not be found');
			}
			
		if (!Auth::user()->hasFriendRequestReceived($user)) {
			return redirect()->route('welcome');
			
		}
          Auth::user()->acceptFriendRequest($user);
         
           return redirect()
           ->route('profile.index', ['username' => $username])
           ->with('info', 'Friend request accepted.');		   
		}
}