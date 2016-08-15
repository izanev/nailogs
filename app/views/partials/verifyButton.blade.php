@if (!$user->is_verified)
	<a href="{{ route('users.verify', array('user_id' => $user->id)) }}" class="btn btn-success">Verify</a>
@endif