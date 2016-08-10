@extends('layouts.base')

@section('headcss')
	@parent
	<link href="{{ asset('assets/css/login.css') }}" rel="stylesheet">
@stop

@section('content')
	<div class="container">
		<!-- if there are login errors, show them here -->
		@if (count($errors))
		<div class="alert alert-danger">Please enter correct username and password.</div>
		@endif

		{{ Form::open(array('url' => 'login', 'class' => 'form-signin', 'method' => 'post')) }}
			<h2 class="form-signin-heading">Please sign in</h2>
			{{ Form::label('inputEmail', 'Email Address', ['class' => 'sr-only']) }}
			{{ Form::text('inputEmail', Input::old('username'), array('name' => 'username', 'class' => 'form-control', 'required', 'autofocus', 'placeholder' => 'Username / Email address')) }}
			{{ Form::label('inputPassword', 'Password', ['class' => 'sr-only']) }}
			<input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
			
			<div class="checkbox">
			<label>
				<input type="checkbox" name="rememberme" value="1"> Remember me
			</label>
			</div>
			<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>

			<a href="{{ route('register') }}">Register</a>

			<br />

		{{ Form::close() }}
	</div> <!-- /container -->
@stop
