<?php


namespace App\Http\Controllers;

use DB;
use App\Models\User;
use Illuminate\http\Request;

class SearchController extends Controller
{
	public function getResults(Request $request)
	{
		$query = $request->input('query');
		
		if(!$query){
			return redirect()->route('welcome');
		}
		  $users = User::where(DB::raw("CONCAT(first_name, '', last_name)"), '
		  LIKE', "%{$query}%")
		        ->orwhere('username', 'LIKE', "%{$query}%") 
				->get(); 
				
				 
		   return view('search.results')->with('users', $users);
	}
} 