					<?php 

						$readonly = '';

							if(!checkRole(getUserGrade(4)))

							$readonly = 'readonly="true"';

						if($record)

						{

							$readonly = 'readonly="true"';
							$required = 'asdasd';
						}else {
							$required = 'required';
						}
						?>
					 <fieldset class="form-group">


						{{ Form::label('company_name', getphrase('company_name')) }}

						<span class="text-red">*</span>

						{{ Form::text('company_name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('company_name'),

							'ng-model'=>'company_name',

							$required,

							'ng-minlength' => '2',

							'ng-class'=>'{"has-error": formLocation.company_name.$touched && formLocation.company_name.$invalid}',



						)) }}

						<div class="validation-error" ng-messages="formLocation.company_name.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('minlength')!!}

						</div>

					</fieldset>

					<fieldset class="form-group">


						{{ Form::label('region_name', getphrase('region_name')) }}

						<span class="text-red">*</span>

						{{ Form::text('region_name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('region_name'),

							'ng-model'=>'region_name',

							$required,

							'ng-minlength' => '2',

							'ng-class'=>'{"has-error": formLocation.region_name.$touched && formLocation.region_name.$invalid}',



						)) }}

						<div class="validation-error" ng-messages="formLocation.region_name.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('minlength')!!}

						</div>

					</fieldset>

					<fieldset class="form-group">


						{{ Form::label('pharm_name', getphrase('pharm_name')) }}

						<span class="text-red">*</span>

						{{ Form::text('pharm_name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('pharm_name'),

							'ng-model'=>'pharm_name',

							$required,

							'ng-minlength' => '2',

							'ng-class'=>'{"has-error": formLocation.pharm_name.$touched && formLocation.pharm_name.$invalid}',



						)) }}

						<div class="validation-error" ng-messages="formLocation.pharm_name.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('minlength')!!}

						</div>

					</fieldset>


						<div class="buttons text-center">

							<button class="btn btn-lg btn-success button" 

							ng-disabled='!formLocation.$valid'>{{ $button_name }}</button>

						</div>
	
