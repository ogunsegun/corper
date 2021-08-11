<?php

namespace App\http\Controllers;

use Auth;
use App\Models\Status;
use App\http\Controllers\Controller;


class HomeController extends Controller
{
	public function index()
	{
		if (Auth::check()) {
			$statuses = Status::notReply()->where(function($query) {
				return $query->where('user_id', Auth::user()->id)
				  ->orWhereIn('user_id', Auth::user()->friends()->pluck('id'));  //only laravel 5.1 down use lists() but from 5.3 up us pluck()
				
			})
			->orderBy('created_at', 'desc')
			->paginate(10);
			
		
			
			return view('timeline.index')
			  ->with('statuses', $statuses);
		}
		
		return view('welcome');
	}
}