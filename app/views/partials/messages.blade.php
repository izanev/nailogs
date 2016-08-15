<div class="container messages">
	@if (isset($success))
	  <div id="success-message" class="alert alert-success" role="alert">
		 {{ $success }}
	  </div>
	@else
		@if (isset($errors))
			@foreach($errors->all(':message') as $message)
			  <div id="form-messages" class="alert alert-danger" role="alert">
				 {{ $message }}
			  </div>
			@endforeach()
		@endif
	@endif
</div>