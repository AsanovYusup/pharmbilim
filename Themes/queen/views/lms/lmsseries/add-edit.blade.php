@extends('layouts.admin.adminlayout')
@section('content')

<div class="row" ng-app="academia">
	<div class="col-xl-12">
		@include('errors.errors')
		@php
				$button_name = getPhrase('create');
		@endphp
		<div id="panel-1" class="panel">
				<div class="panel-hdr">
						<h2>
								{{$title}}
						</h2>
				</div>
				{{-- ng-init="initAngData('{{ $settings }}');" --}}
				<div class="panel-container show">
						<div class="panel-content">

								@if ($record)

								@php
										$button_name = getPhrase('update');
								@endphp
									{{ Form::model($record, 
										array('url' => URL_LMS_SERIES_EDIT.$record->slug, 
										'method'=>'patch', 'files' => true, 'name'=>'formLms ', 'novalidate'=>'')) }}
									@else
										{!! Form::open(array('url' => URL_LMS_SERIES_ADD, 'method' => 'POST', 'files' => true, 'name'=>'formLms ', 'novalidate'=>'')) !!}
									@endif
									

									@include('lms.lmsseries.form_elements', 
									array('button_name'=> $button_name),
									array('record'=>$record,
									'categories' => $categories))
											
									{!! Form::close() !!}
						</div>
				</div>
		</div>
	</div>
</div>



@stop

@section('footer_scripts')
 @include('common.validations');
 @include('common.editor');
 @include('common.alertify')
 @push('custom_styles')
		<link rel="stylesheet" media="screen, print" href="{{themes('css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css')}}">
@endpush
@push('custom-scripts')		
		<script src="{{themes('js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
	<script>
		var file = document.getElementById('image_input');

		file.onchange = function(e){
		var ext = this.value.match(/\.([^\.]+)$/)[1];
		switch(ext)
		{
				case 'jpg':
				case 'jpeg':
				case 'png':

			
						break;
				default:
								alertify.error("{{getPhrase('file_type_not_allowed')}}");
						this.value='';
		}
		};

		$('.input-daterange').datepicker({
				autoclose: true,
				startDate: "0d",
					format: '{{getDateFormat()}}',
		});
	</script>
@endpush    
@stop
 
 