@extends($layout)
@section('content')

@include('layouts.partials.breadcrumbs')
@include('layouts.partials.subheader')

@include('errors.errors')

@php
$user_options = null;
if($record->settings)
$user_options = json_decode($record->settings)->user_preferences;

@endphp

{{-- @if(checkRole(getUserGrade(2)))
			<a href="{{URL_USERS}}" class="btn btn-primary button">{{ getPhrase('list')}}</a>
@endif --}}

	@php
	$button_name = getPhrase('update');
	@endphp
	{{ Form::model($record, 
						array('url' => URL_USERS_SETTINGS.$record->slug, 
						'method'=>'patch',
						'novalidate'=>'',
						'name'=>'formUsers ', 
						'files'=>'true' )) 
						}}
<div class="row">
	<div class="col-xl-6">
		<div id="panel-1" class="panel">
			<div class="panel-hdr">
				<h2>
					{{getPhrase('quiz_and_exam_series')}}
				</h2>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<div class="panel-tag">
						Выберите <code>{{getPhrase('quiz_and_exam_series')}}</code>
					</div>
					<div class="row">
						@foreach($quiz_categories as $category)
						@php
						$checked = '';
						if($user_options) {
						if(count($user_options->quiz_categories))
						{
						if(in_array($category->id,$user_options->quiz_categories))
						$checked='checked';
						}
						}
						@endphp

						<div class="col-md-6 mt-4">
							<div class="custom-control custom-switch">
								<input type="checkbox" class="custom-control-input" id="quiz_categories[{{$category->id}}]"
									name="quiz_categories[{{$category->id}}]" {{$checked}}>
								<label class="custom-control-label"
									for="quiz_categories[{{$category->id}}]">{{$category->category}}</label>
							</div>
						</div>

						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-6">
		<div id="panel-2" class="panel">
			<div class="panel-hdr">
				<h2>
					{{getPhrase('lms')}}
				</h2>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<div class="panel-tag">
						Выберите <code>{{getPhrase('lms')}}</code>
					</div>
					<div class="row">
						@foreach($lms_category as $category)
						@php
						$checked = '';
						if($user_options) {
						if(count($user_options->lms_categories))
						{
						if(in_array($category->id,$user_options->lms_categories))
						$checked='checked';
						}
						}
						@endphp

						<div class="col-md-6 mt-4">
							<div class="custom-control custom-switch">
								<input type="checkbox" class="custom-control-input" id="lms_categories[{{$category->id}}]"
									name="lms_categories[{{$category->id}}]" {{$checked}}>
								<label class="custom-control-label"
									for="lms_categories[{{$category->id}}]">{{$category->category}}</label>
							</div>
						</div>

						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-12">
		<button class="btn btn-lg btn-success button">{{ getPhrase('update') }}</button>
	</div>
</div>

{!! Form::close() !!}

@endsection



@section('footer_scripts')

@include('common.validations');

<script src="{{JS}}bootstrap-toggle.min.js"></script>

@stop