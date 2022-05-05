
<fieldset class="form-group">


	{{ Form::label('title', "Название") }}

	<span class="text-red">*</span>

	{{ Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => "Название",

	'ng-model'=>'title',

	'required',

	'ng-minlength' => '2',

	'ng-class'=>'{"has-error": partners.title.$touched && partners.title.$invalid}',



	)) }}

	<div class="validation-error" ng-messages="partners.title.$error" >

		{!! getValidationMessage()!!}

		{!! getValidationMessage('minlength')!!}

	</div>

</fieldset>




<fieldset class="form-group">


	{{ Form::label('img', 'Изображение') }}

	{{ Form::file('img', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Изображение',

	'ng-model'=>'img',

	'ng-class'=>'{"has-error": partners.img.$touched && partners.img.$invalid}',



	)) }}

	<div class="validation-error" ng-messages="partners.img.$error" >

		{!! getValidationMessage()!!}

		{!! getValidationMessage('minlength')!!}

	</div>

</fieldset>



<div class="buttons text-center">

	<button class="btn btn-lg btn-success button" 

	ng-disabled='!partners.$valid'>{{ $button_name }}</button>

</div>

