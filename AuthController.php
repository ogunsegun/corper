<?php

namespace App\http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\http\Request;


class AuthController extends Controller
{
	public function getSignup()
	{
	  return view('auth.signup');
	}
	public function postSignup(Request $request)
	{
		$this->validate($request, [
		   'email'   => 'required|unique:users|email|max:255',
		   'Username'=> 'required|unique:users|alpha_dash|max:20',
		   'password'=> 'required|min:6',
		  'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048,'
		]);
		 user::create([
		       'email' => $request->input('email'),
			   'Username' => $request->input('Username'),
			   'password' => bcrypt($request->input('password')),
			   'avatar'  =>$request->input('avatar'),
		 ]);
		 return redirect()
		 ->route('welcome')
		 ->with('info', 'your account has been Created and you can now sign in.');
	}
     
      public function getSignin()
      {
		  return view('auth.signin');
	  }	  
	  
	  public function postSignin(Request $request)
	  {
		 $this->validate($request, [
		        'email' => 'required',
				'password' => 'required'
		 ]);
		  if (!Auth::attempt($request->only(['email', 'password']), 
		  $request->has('remember'))) {
			  return redirect()->back()->with('info', 'Could not sign you in with
			  those details.');
		  }
		  return redirect()->route('welcome')->with('info', 'You are now signed in.');
	  }
	  public function getSignout()
	  {
		 Auth::logout();
           
           return redirect()->route('welcome');		   
	  }
	  
	  
	  
	
}