@extends('layouts.base')

@section('content-messages')
	@include('partials.messages')
@stop

@section('headcss')
	@parent
	<link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">
@stop

@section('content')

<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">NAI Logs</a>
		</div>
		<div id="navbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="active"><a href="{{ route('home') }}">Home</a></li>
				<li><a href="#about">Cases</a></li>
				<li><a href="#contact">Reports</a></li>
				@if ($canManageUsers())
				<li><a href="{{ route('users.list') }}">Users</a></li>
				@endif
			</ul>

			<div class="nav-profile pull-right" style="line-height: 49px;">
				<img class="avatar" src="" />
				<span class="name" style="color: #fefefe;">{{ $authUser->username }}</span>
				<a href="#profile" class="btn btn-success">Profile</a>
				<a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
			</div>
		</div>
		<!--/.nav-collapse -->
	</div>
</nav>

@yield('content-messages')

@yield('content-inner')

<footer class="footer">
	<div class="container">
		<p class="text-muted">Footer content</p>
	</div>
</footer>
<!-- /.container -->

@stop