@extends('master')
@section('patient')
<div class="container">

	<div class="row">
		<div class="col s8">
			<h2 class="deep-purple-text">Patients</h2>
		</div>
		<div class="col s4">
			<div class="input-field">
				{!! FORM::open(['method' => 'GET']) !!}
				{!! FORM::input('search','search', null, 
				   ['data-list' => $list,
              		'placeholder' => 'Search white ZZZS number']) 
              	!!}
				{!! FORM::close() !!}
			</div>
		</div>
	</div>

	@if($ErrorMessage)
	<div class="card-panel red lighten-2">
		{{ $ErrorMessage  }}
	</div>
	@endif


	<table class="responsive-table bordered highlight">
		@if( count($Patients) == 0)
			<div class="card-panel red lighten-1 white-text"><h5 style="text-align: center;">Array is empty!</h5></div>
		@else
		<thead>
		<tr>
			<th data-field="name">Name</th>
			<th data-field="address">Address</th>
			<th data-field="date">Date</th>
			<th data-field="number">ZZZS number</th>
		</tr>
		</thead>

		<tbody>



			@foreach ( $Patients as $patient)
				<tr>
					<td>{{ $patient->first_name  }} {{ $patient->last_name  }}</td>
					<td>{{ $patient->address }}</td>
					<td>{{ $patient->date }}</td>
					<td>{{ $patient->zzzs_number }}</td>

					<td class="td-icon">
						<a class="btn-floating modal-trigger tooltipped" data-position="top" data-delay="50" data-tooltip="Edit" href="#{{ 'editmodel'.$patient->id }}" >
							<i class="material-icons green darken-3">mode_edit</i>
						</a>
					</td>
					@can('admin')
					<td class="td-icon">
						<a class="btn-floating modal-trigger tooltipped" data-position="top" data-delay="50" data-tooltip="Delete" href="#{{ 'deletemodel'.$patient->id }}"  data-method="delete">
							<i class="material-icons red darken-1">delete</i>
						</a>
					</td>
					@endcan
					<td class="td-icon">
						<a class="btn-floating tooltipped" data-position="top" data-delay="50" data-tooltip="Table entry" href="{{ '/app/patient/detail/'.$patient->id }}">
							<i class="material-icons blue darken-2">list</i>
						</a>
					</td>
				</tr>

				<!-- Delete Patient Model-->
				<div id="{{ 'deletemodel'.$patient->id }}" class="modal bottom-sheet">
					<div class="modal-content">
						<h5>Are you sure want to delete the patient {{ $patient->first_name }} {{ $patient->last_name }} ?</h5>
					</div>
					<div class="modal-footer">

						<a href="#!" class=" modal-action modal-close waves-effect btn purple darken-3" style="margin-left: 10px;">Prekliči</a>

						{!! FORM::open([
							'method' => 'DELETE',
							'url' => ['app/patient/delete', $patient->id]]) !!}
						{!! FORM::submit('Delete', ['class' => 'btn red darken-3']) !!}
					</div>
					{!! FORM::close() !!}
				</div>

				<!-- Edit Patient Model-->
				<div id="{{ 'editmodel'.$patient->id }}" class="modal modal-fixed-footer">

					{!! FORM::model($patient,[
						'method' => 'PUT',
						'url' => ['app/patient/update', $patient->id]
					   ])
					!!}
					<div class="modal-content">
						<div class="input-field col 12">
							{!! FORM::text('first_name',null) !!}
							{!! FORM::label('first_name', 'First name:') !!}
						</div>
						<div class="input-field col 12">
							{!! FORM::text('zzzs_number',null) !!}
							{!! FORM::label('zzzs_number', 'ZZZS number:') !!}
						</div>
						<div class="input-field col 12">
							{!! FORM::text('last_name',null) !!}
							{!! FORM::label('last_name', 'Last name:') !!}
						</div>
						<div class="input-field col 12">
							{!! FORM::text('address',null) !!}
							{!! FORM::label('address', 'Address:') !!}
						</div>
						<div class="input-field col 12">
							{!! FORM::text('date', null ,array('class' => 'datepicker')) !!}
						</div>
					</div>
					<div class="modal-footer">
						<a href="#!" class=" modal-action modal-close waves-effect btn red darken-3" style="margin-left: 10px;">Cancel</a>

						{!! FORM::submit('Update', ['class' => 'btn green darken-3']) !!}
					</div>
					{!! FORM::close() !!}
				</div>
			@endforeach

		@endif
		</tbody>
	</table>



</div>


	<!-- Add Patient Button-->
    <div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
    	<a href="#modal_add" 
    		class="btn-floating btn-large tooltipped waves-effect waves-light purple darken-4 modal-trigger "
    		data-position="left" 
    		data-delay="50"
    		data-tooltip="Add new Patient">
    		<i class="material-icons">add</i>
    	</a>      
    </div>

	<!-- Add Patient Model-->
	<div id="modal_add" class="modal modal-fixed-footer">
			{!! FORM::open(['url' => 'app/patient/add']) !!}
	    <div class="modal-content">
		    <div class="input-field col 12">
			    {!! FORM::text('first_name',null) !!}
			    {!! FORM::label('first_name', 'First name:') !!}
			</div>
			<div class="input-field col 12">
				{!! FORM::text('zzzs_number',null) !!}
				{!! FORM::label('zzzs_number', 'ZZZS number:') !!}
			</div>
			<div class="input-field col 12">
			    {!! FORM::text('last_name',null) !!}
			    {!! FORM::label('last_name', 'Last name:') !!}
			</div>
			<div class="input-field col 12">
			    {!! FORM::text('address',null) !!}
			    {!! FORM::label('address', 'Address:') !!}
			</div>
			<div class="input-field col 12">
				{!! FORM::text('date', null ,array('class' => 'datepicker')) !!}
				{!! FORM::label('date', 'Date:') !!}
			</div>
		</div>
	    <div class="modal-footer">
	    	<a href="#!" class=" modal-action modal-close waves-effect btn red darken-3" style="margin-left: 10px;">Cancel</a>
	      	{!! FORM::submit('Save', ['class' => 'btn btn-primary green darken-3']) !!}
	    </div>
		{!! FORM::close() !!}
	</div>
@stop