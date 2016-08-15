@extends('layouts.admin')

@section('content-inner')
	<div class="container">
		<h1>Users</h1>
		<table class="table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Username</th>
					<th>Email</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($users as $user):
				<tr>
					<td>{{ $user->id; }}</td>
					<td>{{ $user->username; }}</td>
					<td>{{ $user->email; }}</td>
					<td>{{ $showVerificationStatus($user) }} @include('partials.verifyButton', array('user' => $user))</td>
				</tr>
				@endforeach
			</tbody>
		</table>

		{{ $users->links() }}
	</div> <!-- /container -->
@stop
