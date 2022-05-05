
<fieldset class="form-group">


	{{ Form::label('title', getphrase('title_events')) }}

	<span class="text-red">*</span>

	{{ Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getphrase('title_events'),

	'ng-model'=>'title',

	'required',

	'ng-minlength' => '2',

	'ng-class'=>'{"has-error": events.title.$touched && events.title.$invalid}',



	)) }}

	<div class="validation-error" ng-messages="events.title.$error" >

		{!! getValidationMessage()!!}

		{!! getValidationMessage('minlength')!!}

	</div>

</fieldset>

<fieldset class="form-group">


	{{ Form::label('description', getphrase('description')) }}

	<span class="text-red">*</span>

	{{ Form::text('description', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getphrase('description'),

	'ng-model'=>'description',

	'required',

	'ng-minlength' => '2',

	'ng-class'=>'{"has-error": events.description.$touched && events.description.$invalid}',



	)) }}

	<div class="validation-error" ng-messages="events.description.$error" >

		{!! getValidationMessage()!!}

		{!! getValidationMessage('minlength')!!}

	</div>

</fieldset>

<fieldset class="form-group input-daterange">


	{{ Form::label('date', getphrase('date_events')) }}

	<span class="text-red">*</span>

	{{ Form::text('date', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => '2015/7/17',

	'ng-model'=>'date',

	'id' => 'datetimepicker',

	'autocomplete' => 'off',

	'required',

	'ng-minlength' => '2',

	'ng-class'=>'{"has-error": events.date.$touched && events.date.$invalid}',



	)) }}

	<div class="validation-error" ng-messages="events.date.$error" >

		{!! getValidationMessage()!!}

		{!! getValidationMessage('minlength')!!}

	</div>

</fieldset>

<fieldset class="form-group">


	{{ Form::label('url', getphrase('url')) }}

	{{ Form::text('url', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getphrase('url'),

	'ng-model'=>'url',

	'ng-minlength' => '2',

	'ng-class'=>'{"has-error": events.url.$touched && events.url.$invalid}',



	)) }}

	<div class="validation-error" ng-messages="events.url.$error" >

		{!! getValidationMessage()!!}

		{!! getValidationMessage('minlength')!!}

	</div>

</fieldset>



<div class="buttons text-center">

	<button class="btn btn-lg btn-success button" 

	ng-disabled='!events.$valid'>{{ $button_name }}</button>

</div>

