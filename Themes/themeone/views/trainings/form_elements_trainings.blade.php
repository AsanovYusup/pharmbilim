
<fieldset class="form-group">


	{{ Form::label('theme', "Тема тренинга") }}

	<span class="text-red">*</span>

	{{ Form::text('theme', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => "Тема тренинга",

	'ng-model'=>'theme',

	'required',

	'ng-minlength' => '2',

	'ng-class'=>'{"has-error": trainings.theme.$touched && trainings.theme.$invalid}',



	)) }}

	<div class="validation-error" ng-messages="trainings.theme.$error" >

		{!! getValidationMessage()!!}

		{!! getValidationMessage('minlength')!!}

	</div>

</fieldset>

<fieldset class="form-group">


	{{ Form::label('lead', 'Ведущий') }}

	<span class="text-red">*</span>

	{{ Form::text('lead', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Ведущий',

	'ng-model'=>'lead',

	'required',

	'ng-minlength' => '2',

	'ng-class'=>'{"has-error": trainings.lead.$touched && trainings.lead.$invalid}',



	)) }}

	<div class="validation-error" ng-messages="trainings.lead.$error" >

		{!! getValidationMessage()!!}

		{!! getValidationMessage('minlength')!!}

	</div>

</fieldset>

<fieldset class="form-group input-daterange">


	{{ Form::label('date', 'Дата') }}	

	<span class="text-red">*</span>

	{{ Form::text('date', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => '2015/7/17',

	'ng-model'=>'date',

	'id' => 'datetimepicker',

	'autocomplete' => 'off',

	'required',

	'ng-minlength' => '2',

	'ng-class'=>'{"has-error": trainings.date.$touched && trainings.date.$invalid}',



	)) }}

	<div class="validation-error" ng-messages="trainings.date.$error" >

		{!! getValidationMessage()!!}

		{!! getValidationMessage('minlength')!!}

	</div>

</fieldset>

<fieldset class="form-group">


	{{ Form::label('location', 'Место проведения') }}

	{{ Form::text('location', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Место проведения',

	'ng-model'=>'location',

	'ng-minlength' => '2',

	'ng-class'=>'{"has-error": trainings.location.$touched && trainings.location.$invalid}',



	)) }}

	<div class="validation-error" ng-messages="trainings.location.$error" >

		{!! getValidationMessage()!!}

		{!! getValidationMessage('minlength')!!}

	</div>

</fieldset>


<fieldset class="form-group">


	{{ Form::label('img', 'Изображение') }}

	{{ Form::file('img', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Изображение',

	'ng-model'=>'img',

	'ng-class'=>'{"has-error": trainings.img.$touched && trainings.img.$invalid}',



	)) }}

	<div class="validation-error" ng-messages="trainings.img.$error" >

		{!! getValidationMessage()!!}

		{!! getValidationMessage('minlength')!!}

	</div>

</fieldset>



<div class="buttons text-center">

	<button class="btn btn-lg btn-success button" 

	ng-disabled='!trainings.$valid'>{{ $button_name }}</button>

</div>

