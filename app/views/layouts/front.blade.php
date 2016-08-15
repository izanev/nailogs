@extends('layouts.base')

@section('content-messages')
	@include('partials.messages')
@stop

@section('content')

@yield('content-messages')

@yield('content-inner')

@stop