<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
	public function postStatus(Request $request)
	{
		$this->validate($request, [
		   'status' => 'required|max:500',
		]);
		
		Auth::user()->statuses()->create([
		   'body' => $request->input('status'),
				]);
				
				return redirect()
				->route('welcome')
				->with('info', 'Status posted');
		
	}
	
	public function postReply(Request $request, $statusId)
	{
		$this->validate($request, [
	     "reply-{$statusId}" => 'required|max:2000',
		    ], [
			  'required' => 'The reply body is required'
		]);
		
		$status = Status::notReply()->find($statusId);
		
		if(!$status) {
			return redirect()->route('welcome');
		}
		//u can use Auth::user()->id !== $status->user->id as message to reply back to your own message
		if(!Auth::user()->isFriendswith($status->user) && Auth::user()->id !==
		$status->user->id) {
			
		}
		
		$reply = Status::create([
		  'body' => $request->input("reply-{$statusId}"),
		  ])->user()->associate(Auth::user());
		  
		  $status->replies()->save($reply);
		  
		  return redirect()->back();
	}
}