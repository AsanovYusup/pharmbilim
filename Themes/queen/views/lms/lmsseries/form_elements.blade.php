<div class="row">

	<fieldset class="form-group col-md-6">
		{{ Form::label('title', getphrase('title')) }}
		<span class="text-red">*</span>
		{{ Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('series_title'),
							'ng-model'=>'title',  
							'required'=> 'true',
							'ng-class'=>'{"has-error": formLms.title.$touched && formLms.title.$invalid}',
							'ng-minlength' => '2',
							'ng-maxlength' => '40',
							)) }}
		<div class="validation-error" ng-messages="formLms.title.$error">
			{!! getValidationMessage()!!}
			{!! getValidationMessage('pattern')!!}
			{!! getValidationMessage('minlength')!!}
			{!! getValidationMessage('maxlength')!!}
		</div>
	</fieldset>

	<fieldset class="form-group col-md-6">
		{{ Form::label('lms_category_id', getPhrase('lms_category')) }}
		<span class="text-red">*</span>
		{{Form::select('lms_category_id', $categories, null, ['placeholder' => getPhrase('select'),'class'=>'form-control', 
						'ng-model'=>'lms_category_id',
							'required'=> 'true', 		 
							'ng-class'=>'{"has-error": formLms.lms_category_id.$touched && formLms.lms_category_id.$invalid}',
						]) }}
		<div class="validation-error" ng-messages="formLms.lms_category_id.$error">
			{!! getValidationMessage()!!}
		</div>
	</fieldset>

</div>

<div class="row">
	<?php $payment_options = array('1'=>getPhrase('paid'), '0'=>getPhrase('free'));?>
	<fieldset class="form-group col-md-6">
		{{ Form::label('is_paid', getphrase('is_paid')) }}
		<span class="text-red">*</span>
		{{Form::select('is_paid', $payment_options, null, ['placeholder' => getPhrase('select'),'class'=>'form-control', 
			'ng-model'=>'is_paid',
			'required'=> 'true', 
			'ng-minlength' => '2',
			'ng-maxlength' => '20',
			'ng-class'=>'{"has-error": formLms.is_paid.$touched && formLms.is_paid.$invalid}',
		]) }}
		<div class="validation-error" ng-messages="formLms.is_paid.$error">
			{!! getValidationMessage()!!}
		</div>
	</fieldset>

	<div class="col-md-6" ng-if="is_paid==1">



		<div class="row">
			<fieldset class="form-group col-md-6">
			{{ Form::label('validity', getphrase('validity')) }}
			<span class="text-red">*</span>
			{{ Form::number('validity', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('validity_in_days'),
				'ng-model'=>'validity',
				'string-to-number'=>'true',
				'min'=>'-1',
				'required'=> 'true', 
				'string-to-number'=>'true',
				'ng-class'=>'{"has-error": formLms.validity.$touched && formLms.validity.$invalid}',
				)) }}

			<div class="validation-error" ng-messages="formLms.validity.$error">
				{!! getValidationMessage()!!}
				{!! getValidationMessage('number')!!}
			</div>
		</fieldset>

		<fieldset class="form-group col-md-6">
			{{ Form::label('cost', getphrase('cost')) }}
			<span class="text-red">*</span>
			{{ Form::number('cost', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => '40',
				'min'=>'0',		 
				'ng-model'=>'cost', 
				'required'=> 'true',
				'string-to-number'=>'true',
				'ng-class'=>'{"has-error": formLms.cost.$touched && formLms.cost.$invalid}',			 
				)) }}

			<div class="validation-error" ng-messages="formLms.cost.$error">
				{!! getValidationMessage()!!}
				{!! getValidationMessage('number')!!}
			</div>
		</fieldset>
		</div>

	</div>
</div>



<div class="row">
	<fieldset class="form-group col-md-6">
		{{ Form::label('total_items', getphrase('total_items')) }}
		<span class="text-red">*</span>
		{{ Form::text('total_items', $value = null , $attributes = array('class'=>'form-control','readonly'=>'true')) }}
	</fieldset>

	<fieldset class="form-group col-md-6">
		<label class="form-label">{{getphrase('image')}}</label>
		<div class="custom-file">
			<input type="file" class="custom-file-input" name="examimage" accept=".png,.jpg,.jpeg" id="image_input">
			<label class="custom-file-label" for="image_input">Выберите картинку</label>
		</div>
		<div class="validation-error" ng-messages="formCategories.image.$error">
			{!! getValidationMessage('image')!!}
		</div>
	</fieldset>

	<fieldset class="form-group col-md-2">
		@if($record)
		@if($record->image)
		<?php $examSettings = getExamSettings(); ?>
		<img src="{{ IMAGE_PATH_UPLOAD_LMS_SERIES.$record->image }}" height="100" width="100">
		@endif
		@endif
	</fieldset>
</div>

<div class="input-daterange" id="dp">
	<div class="row">
	@php
		$date_from = date('Y/m/d');
		$date_to = date('Y/m/d');	
	@endphp
	@if ($record)
			@php
					$date_from = $record->start_date;
					$date_to = $record->end_date;
			@endphp
	@endif

			<fieldset class="form-group col-md-6">
				{{ Form::label('start_date', getphrase('start_date')) }}
				{{ Form::text('start_date', $value = $date_from , $attributes = array('class'=>'input-sm form-control', 'placeholder' => '2015/7/17')) }}
			</fieldset>

			<fieldset class="form-group col-md-6">
				{{ Form::label('end_date', getphrase('end_date')) }}
				{{ Form::text('end_date', $value = $date_to , $attributes = array('class'=>'input-sm form-control', 'placeholder' => '2015/7/17')) }}
			</fieldset>
			
		</div>
</div>



<div class="row">
	<?php $options = array('1'=>'Да', '0'=>'Нет');?>
	<fieldset class="form-group col-md-6">
		{{ Form::label('show_in_front', 'Включить чат') }}
		<span class="text-red">*</span>
		{{Form::select('show_in_front', $options, null, ['placeholder' => getPhrase('select'),'class'=>'form-control', 
			'ng-model'=>'show_in_front',
			'required'=> 'true', 
			'ng-class'=>'{"has-error": formLms.show_in_front.$touched && formLms.show_in_front.$invalid}',
		]) }}
		<div class="validation-error" ng-messages="formLms.show_in_front.$error">
			{!! getValidationMessage()!!}
		</div>
	</fieldset>

	<fieldset class="form-group col-md-6">
		{{ Form::label('is_popular', getphrase('is_popular')) }}
		<span class="text-red">*</span>
		{{Form::select('is_popular', $options, null, ['placeholder' => getPhrase('select'),'class'=>'form-control', 
			'ng-model'=>'is_popular',			
			'required'=> 'true',
			'ng-class'=>'{"has-error": formLms.is_popular.$touched && formLms.is_popular.$invalid}',
		]) }}
		<div class="validation-error" ng-messages="formLms.is_popular.$error">
			{!! getValidationMessage()!!}
		</div>
	</fieldset>
</div>

<div class="row">
	<fieldset class="form-group  col-md-6">
		{{ Form::label('short_description', getphrase('short_description')) }}
		{{ Form::textarea('short_description', $value = null , $attributes = array('class'=>'form-control ckeditor', 'rows'=>'5', 'placeholder' => getPhrase('short_description'))) }}
	</fieldset>

	<fieldset class="form-group  col-md-6">
		{{ Form::label('description', getphrase('description')) }}
		{{ Form::textarea('description', $value = null , $attributes = array('class'=>'form-control ckeditor', 'rows'=>'5', 'placeholder' => getPhrase('description'))) }}
	</fieldset>

</div>
<div class="buttons text-center">
	<button class="btn btn-lg btn-success button" ng-disabled='!formLms.$valid'>{{ $button_name }}</button>
</div>