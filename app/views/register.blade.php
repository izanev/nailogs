@extends('layouts.front')

@section('headcss')
	@parent
	<link href="{{ asset('assets/css/register.css') }}" rel="stylesheet">
@stop

@section('content-inner')
	<div class="container">
		<!-- if there are login errors, show them here -->
		@if (count($errors))
			@foreach ($errors as $error)
				<div class="alert alert-danger">{{ $error }}</div>
			@endforeach
		@endif

		{{ Form::open(array('route' => 'doRegister', 'class' => 'form-register', 'method' => 'post')) }}
			<h2 class="form-register-heading">Register</h2>
			{{ Form::label('inputEmail', 'Username', ['class' => 'sr-only']) }}
			{{ Form::text('inputEmail', Input::old('username'), array('name' => 'username', 'class' => 'form-control', 'required', 'autofocus', 'placeholder' => 'Username')) }}

			{{ Form::label('inputEmail', 'E-Mail Address', ['class' => 'sr-only']) }}
			{{ Form::text('inputEmail', Input::old('email'), array('name' => 'email', 'class' => 'form-control', 'required', 'autofocus', 'placeholder' => 'E-Mail Address')) }}

			{{ Form::label('inputEmailRepeat', 'Repeat E-Mail Address', ['class' => 'sr-only']) }}
			{{ Form::text('inputEmailRepeat', Input::old('email'), array('class' => 'form-control', 'required', 'autofocus', 'placeholder' => 'Repeat E-Mail Address')) }}

			{{ Form::label('inputPassword', 'Password', ['class' => 'sr-only']) }}
			<input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>

			{{ Form::label('inputPasswordRepeat', 'Password', ['class' => 'sr-only']) }}
			<input type="password" id="inputPasswordRepeat" class="form-control" placeholder="Repeat Password" required>

			<button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>

			<a href="{{ route('login') }}">Have an account? Login</a>

		{{ Form::close() }}
	</div> <!-- /container -->
@stop
