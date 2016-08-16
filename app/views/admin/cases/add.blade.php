@extends('layouts.admin')

@section('content-inner')
	<div class="container">
		<h1>Cases</h1>
		<h2>Add Case</h2>

		{{ Form::model($case, array('files' => true, 'url' => $submitRoute, 'class' => 'form-case-add', 'method' => 'post')) }}
			<div class="row">
				<div class="form-group col-lg-8">
					{{ Form::label('client_name', 'Client Name') }}
					{{ Form::text('client_name', Input::old('client_name'), array('name' => 'client_name', 'class' => 'form-control', 'required')) }}
				</div>
				<div class="form-group col-lg-2">
					{{ Form::label('child_age', 'Age (if child)') }}
					{{ Form::number('child_age', Input::old('child_age'), array('type' => 'number', 'min' => 0, 'max' => 18, 'name' => 'child_age', 'class' => 'form-control', 'required')) }}
				</div>
				<div class="form-group col-lg-2">
					{{ Form::label('ref_no', 'Reference No.') }}
					{{ Form::text('ref_no', Input::old('ref_no'), array('name' => 'ref_no', 'class' => 'form-control', 'required')) }}
				</div>
			</div>

			<div class="row">
				<div class="form-group col-lg-5">
					{{ Form::label('hotel', 'Hotel') }}
					{{ Form::text('hotel', Input::old('hotel'), array('name' => 'hotel', 'class' => 'form-control', 'required')) }}
				</div>
				<div class="form-group col-lg-1">
					{{ Form::label('room_number', 'Room') }}
					{{ Form::text('room_number', Input::old('room_number'), array('name' => 'room_number', 'class' => 'form-control', 'required')) }}
				</div>
				<div class="form-group col-lg-4">
					{{ Form::label('resort', 'Resort') }}
					{{ Form::text('resort', Input::old('resort'), array('name' => 'resort', 'class' => 'form-control', 'required')) }}
				</div>
				<div class="form-group col-lg-2">
					{{ Form::label('arrival_date', 'Arrival Date') }}
					{{ Form::text('arrival_date', Input::old('arrival_date'), array('name' => 'arrival_date', 'readonly', 'class' => 'form-control datepicker', 'required')) }}
				</div>
			</div>
			<div class="row">
				<div class="form-group col-lg-2">
					{{ Form::label('accident_date', 'Date of Accident') }}
					{{ Form::text('accident_date', Input::old('accident_date'), array('name' => 'accident_date', 'readonly', 'class' => 'form-control datepicker', 'required')) }}
				</div>
				<div class="form-group col-lg-10">
					{{ Form::label('location', 'Location') }}
					{{ Form::text('location', Input::old('location'), array('name' => 'location', 'class' => 'form-control', 'required')) }}
				</div>
			</div>
			<div class="row">
				<div class="form-group col-lg-12">
					{{ Form::label('weather_conditions', 'Weather Conditions') }}
					{{ Form::text('weather_conditions', Input::old('weather_conditions'), array('name' => 'weather_conditions', 'class' => 'form-control')) }}
				</div>
			</div>
			<div class="row">
				<div class="form-group col-lg-2">
					{{ Form::label('report_date', 'Date Reported') }}
					{{ Form::text('report_date', Input::old('report_date'), array('name' => 'report_date', 'readonly', 'class' => 'form-control datepicker', 'required')) }}
				</div>
			</div>
			<div class="row">
				<div class="form-group col-lg-12">
					{{ Form::label('description', 'Description') }}
					{{ Form::textarea('description', Input::old('description'), array('name' => 'description', 'class' => 'form-control', 'required')) }}
				</div>
			</div>
			<div class="row">
				<div class="form-group col-lg-12">
					{{ Form::label('guest_opinion', 'Guest Opinion') }}
					{{ Form::text('guest_opinion', Input::old('guest_opinion'), array('name' => 'guest_opinion', 'class' => 'form-control', 'required')) }}
				</div>
			</div>
			<div class="row">
				<div class="form-group col-lg-12">
					{{ Form::label('action_taken', 'Action taken by BH representative') }}
					{{ Form::text('action_taken', Input::old('action_taken'), array('name' => 'action_taken', 'class' => 'form-control')) }}
				</div>
			</div>

			<fieldset>
				<legend>To be completed by representative</legend>
				<div class="row">
					<div class="form-group col-lg-2">
						{{ Form::label('inspection_date', 'Inspection date') }}
						{{ Form::text('inspection_date', Input::old('inspection_date'), array('name' => 'inspection_date', 'readonly', 'class' => 'form-control datepicker', 'required')) }}
					</div>
				</div>
				<div class="row">
					<div class="form-group col-lg-4">
						{{ Form::label('files1', 'Document #1') }}
						{{ Form::file('files[]', Input::old('file1'), array('id' => 'file1', 'class' => 'form-control', 'multiple')) }}
					</div>
					<div class="form-group col-lg-4">
						{{ Form::label('files2', 'Document #2') }}
						{{ Form::file('files[]', Input::old('file2'), array('id' => 'file2', 'class' => 'form-control', 'multiple')) }}
					</div>
					<div class="form-group col-lg-4">
						{{ Form::label('files3', 'Document #3') }}
						{{ Form::file('files[]', Input::old('file3'), array('id' => 'file3', 'class' => 'form-control', 'multiple')) }}
					</div>
				</div>
				<div class="row">
					<div class="form-group col-lg-12">
						{{ Form::label('factual_account', 'Factual Account of the accident') }}
						{{ Form::textarea('factual_account', Input::old('factual_account'), array('name' => 'factual_account', 'class' => 'form-control')) }}
					</div>
				</div>
				<div class="row">
					<div class="form-group col-lg-12">
						{{ Form::label('medical_assistance', 'Medical assistance provided') }}
						{{ Form::textarea('medical_assistance', Input::old('medical_assistance'), array('name' => 'medical_assistance', 'class' => 'form-control')) }}
					</div>
				</div>
			</fieldset>
			<div class="row">
				<div class="form-group col-lg-3">
					<button class="btn btn-lg btn-primary btn-block" type="submit">Add</button>
				</div>
			</div>
		{{ Form::close() }}
	</div> <!-- /container -->
@stop
