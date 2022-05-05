@extends($layout) 
@section('content')

<div class="row" ng-app="academia">
	<div class="col-xl-12">
		@include('errors.errors')
		@php
				$button_name = getPhrase('create');
				$settings = ($record) ? $settings : ''; 
		@endphp
		<div id="panel-1" class="panel">
				<div class="panel-hdr">
						<h2>
								{{$title}}
						</h2>
				</div>
				{{-- ng-init="initAngData('{{ $settings }}');" --}}
				<div class="panel-container show"  ng-controller="angLmsController">
						<div class="panel-content">

								@if ($record)

								@php
										$button_name = getPhrase('update');
								@endphp
									{{ Form::model($record, 
									array('url' => URL_LMS_CONTENT_EDIT. $record->slug, 'novalidate'=>'','name'=>'formLms ',
									'method'=>'patch', 'files' => true)) }}
								@else
									{!! Form::open(array('url' => URL_LMS_CONTENT_ADD, 
										'novalidate'=>'','name'=>'formLms ',
									'method' => 'POST', 'files' => true)) !!}
								@endif
								@include('lms.lmscontents.form_elements', 
								array('button_name'=> $button_name),
								array('subjects'=>$subjects, 'record'=>$record))
										
								{!! Form::close() !!}
						</div>
				</div>
		</div>
	</div>
</div>

@stop
@section('footer_scripts')   
@include('lms.lmscontents.scripts.js-scripts')
@include('common.validations', array('isLoaded'=>'1'));
@include('common.editor'); 
@include('common.alertify')
@push('custom-scripts')
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
	</script>
@endpush
@stop
 