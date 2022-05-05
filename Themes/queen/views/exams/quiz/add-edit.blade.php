@extends('layouts.admin.adminlayout')
@section('content')


<div class="row" ng-app="academia">
	<div class="col-xl-12">
		@include('errors.errors')
		<div id="panel-1" class="panel">
				<div class="panel-hdr">
						<h2>
								{{$title}}
						</h2>
				</div>
				<div class="panel-container show">
						<div class="panel-content">
								@php
										$button_name = getPhrase('create');
								@endphp

								@if ($record)

								@php
										$button_name = getPhrase('update');
								@endphp
									{{ Form::model($record, 
									array('url' => URL_QUIZ_EDIT.'/'.$record->slug, 
									'method'=>'patch', 'files' => true, 'name'=>'formQuiz ', 'novalidate'=>'','files'=>TRUE)) }}
								@else
									{!! Form::open(array('url' => URL_QUIZ_ADD, 'method' => 'POST', 'files' => true, 'name'=>'formQuiz ', 'novalidate'=>'','files'=>TRUE)) !!}
								@endif

								@include('exams.quiz.form_elements', 
								array('button_name'=> $button_name),
								array(	'categories' 		=> $categories,
										'instructions' 		=> $instructions,
										'record'			=> $record,					 		
										'exam_types'			=> $exam_types
										))					 		

								{!! Form::close() !!}
						</div>
				</div>
		</div>
	</div>
</div>

@stop
@section('footer_scripts')
@include('common.validations')
@push('custom_styles')
		<link rel="stylesheet" media="screen, print" href="{{themes('css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css')}}">
@endpush
@push('custom-scripts')
		
		<script src="{{themes('js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
		<script>
			$('.input-daterange').datepicker({
					autoclose: true,
					startDate: "0d",
						format: '{{getDateFormat()}}',
			});
		</script>
@endpush

@stop

 

 