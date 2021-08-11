@extends('layout.default')

@section('Corper', ' Corper')

@section('sidebar')
  @parent
   
	@stop

@section('Content')
<h3>Sign up</h3>
	<div class="row">
	   <div class="col-lg-6">
	      <form class="form-vertical" role="form" method="post" action="{{route('auth.signup')}}"  enctype="multipart/form-data">
 <!--email code-->
		  <div class="form-group{{$errors->has('email') ? ' has-error' :
		  ''}}">
		   <label for="email" class="control-label">Your email address</label>
		     <input type="text" name="email" class="form-control" id="email"
			 value="{{Request::old('email') ?: ''}}">
			 @if ($errors->has('email'))
				 <span class="help-block">{{ $errors->first('email') }}</span>
			 @endif
			 </div>
<!---username code-->
			   <div class="form-group{{$errors->has('Username') ? ' has-error' :
		  ''}}">
			    <label for="username" class="control-label">Choose a username</label>
				<input type="text" name="Username" class="form-control" id="Username"
				value="{{Request::old('Username') ?: ''}}">
				@if ($errors->has('Username'))
				 <span class="help-block">{{ $errors->first('Username') }}</span>
			 @endif
				</div>
<!---password-->			
				<div class="form-group{{$errors->has('password') ? ' has-error' :
		  ''}}">
			    <label for="password" class="control-label">Choose a password</label>
				<input type="password" name="password" class="form-control" id="password"
				value="">
				 @if ($errors->has('password'))
				 <span class="help-block">{{ $errors->first('password') }}</span>
			 @endif
				</div>
<!----photo upload--->
   <div class="form-group{{$errors->has('avatar') ? ' has-error' :
		  ''}}">
			    <label for="Avatar" class="control-label">Phone</label>
				<input type="file" name="Avatar" class="form-control" id="Avatar"
				value="{{Request::old('avatar')?:Auth::user()->avatar}}">
				 @if ($errors->has('avatar'))
				 <span class="help-block">{{ $errors->first('avatar') }}</span>
			 @endif
				</div>				
						
				<div class="form-group">
				<button type="submit" class="btn btn-default">Sign up</button>
				</div>
				<input type="hidden" name="_token" value="{{Session::token()}}">
				</form>
			</div>	
	 </div> 


	 @stop