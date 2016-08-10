@extends('layouts.admin')

@section('content-inner')
	<div class="container">
		<h1>NAI Logs Home</h1>
		<h2>Latest Cases</h2>
		<table class="table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Name</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>1</td>
					<td><a href="#">Something happened</a></td>
				</tr>
			</tbody>
		</table>

		[pagination]
	</div> <!-- /container -->
@stop
