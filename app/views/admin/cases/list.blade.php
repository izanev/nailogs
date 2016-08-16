@extends('layouts.admin')

@section('content-inner')
	<div class="container">
		<h1>Cases</h1>
		@include('partials.addCaseButton')

		<h2>Search Cases</h2>
		{{ Form::model($caseSearch, array('class' => 'form-case-search', 'method' => 'get')) }}
			<div class="filters">
				<div class="row">
					<div class="form-group col-lg-4">
						{{ Form::label('report_by', 'Reported By') }}
						{{ Form::text('report_by', Input::old('report_by'), array('name' => 'report_by', 'class' => 'form-control')) }}
					</div>
					<div class="form-group col-lg-2">
						{{ Form::label('report_date_start', 'Since') }}
						{{ Form::text('report_start', \Form::dateValue('report_date_start'), array('name' => 'report_date_start', 'readonly', 'class' => 'form-control datepicker')) }}
					</div>
					<div class="form-group col-lg-2">
						{{ Form::label('report_date_end', 'Before') }}
						{{ Form::text('report_date_end', null, array('name' => 'report_date_end', 'readonly', 'class' => 'form-control datepicker')) }}
					</div>
				</div>
				<div class="row">
					<div class="form-group col-lg-4">
						{{ Form::label('resort', 'Resort', array('class' => 'sr-only')) }}
						{{ Form::text('resort', Input::old('resort'), array('name' => 'resort', 'class' => 'form-control', 'placeholder' => 'Resort')) }}
					</div>
					<div class="form-group col-lg-4">
						{{ Form::label('hotel', 'Hotel', array('class' => 'sr-only')) }}
						{{ Form::text('hotel', Input::old('hotel'), array('name' => 'hotel', 'class' => 'form-control', 'placeholder' => 'Hotel')) }}
					</div>
					<div class="form-group col-lg-4">
						{{ Form::label('client_name', 'Client Name', array('class' => 'sr-only')) }}
						{{ Form::text('client_name', Input::old('client_name'), array('name' => 'client_name', 'class' => 'form-control', 'placeholder' => 'Client Name')) }}
					</div>
				</div>
			</div>

			@include('partials.searchCasesButton', array('isForm' => true))

			@if (count($cases))
				<table class="table">
					<thead>
						<tr>
							<th>No.</th>
							<th>Ref.</th>
							<th>Acomm. & resort</th>
							<th>Date of Accident</th>
							<th>Date Reported</th>
							<th>Weather Conditions</th>
							<th>Location</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($cases as $case):
						<tr>
							<td>{{ $case->id; }}</td>
							<td><a href="{{ route('cases.view', array('case_id' => $case->id)); }}">{{ $case->ref_no; }}</a></td>
							<td>{{ $renderCaseResort($case); }}</td>
							<td>{{ $renderDate($case->accident_date); }}</td>
							<td>{{ $renderDate($case->report_date); }}</td>
							<td>{{ $case->weather_conditions; }}</td>
							<td>{{ $case->location; }}</td>
							<td>
								@include('partials.removeCaseButton', array('case' => $case))
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			@else
				No results found.
			@endif

		{{ Form::close() }}

		{{ $cases->links() }}

	</div> <!-- /container -->
@stop
