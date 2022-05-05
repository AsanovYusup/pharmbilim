					<?php 

						$readonly = '';

							if(!checkRole(getUserGrade(4)))

							$readonly = 'readonly="true"';

						if($record)

						{

							$readonly = 'readonly="true"';

						}

						if (checkRole(getUserGrade(1))) {
							$required = ' ';
							$readonly = ' ';
						}
						else {
							$required = 'required';
						}

						?>
					 <fieldset class="form-group">


						{{ Form::label('name', getphrase('Фамилия Имя Отчество')) }}

						<span class="text-red">*</span>

						{{ Form::text('name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Иванов Иван Иванович',

							'ng-model'=>'name',

							$required,

							'ng-minlength' => '2',

							'ng-class'=>'{"has-error": formUsers.name.$touched && formUsers.name.$invalid}',



						)) }}

						<div class="validation-error" ng-messages="formUsers.name.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('minlength')!!}

						</div>

					</fieldset>


					<fieldset class="form-group" id='region_id'>


						{{ Form::label('region', getphrase('region_name')) }}

						<span class="text-red">*</span> 

						@if(checkRole(getUserGrade(2)))

						-

						{{ $record->region }}

						@if($record == null)

						{{ Form::text('region', $value = null, $attributes = array('class'=>'form-control', 'placeholder' => getphrase('region_name'),

						'ng-model'=>'region',

						$required,

						'ng-minlength' => '2',

						'ng-class'=>'{"has-error": formUsers.region.$touched && formUsers.region.$invalid}',



						)) }}

						@else 

							{{ Form::select('region', $region, $selected_region, $attributes = array('class'=>'form-control js-example-basic-single', 'placeholder' => getphrase('region_name'),

							'ng-model'=>'region',

							$required,

							'ng-minlength' => '2',

							'ng-class'=>'{"has-error": formUsers.region.$touched && formUsers.region.$invalid}',



						)) }}

						@endif 
						

						@else
						
						@if(isset($selected_region_id))

						{{ Form::text('region', $selected_region_id, $attributes = array('class'=>'form-control', 'placeholder' => getphrase('region_name'),

						'ng-model'=>'region',

						$required,

						'ng-minlength' => '2',

						'ng-class'=>'{"has-error": formUsers.region.$touched && formUsers.region.$invalid}',



						)) }}

						@else 
							{{ Form::text('region', $value = null, $attributes = array('class'=>'form-control', 'placeholder' => getphrase('region_name'),

						'ng-model'=>'region',

						$required,

						'ng-minlength' => '2',

						'ng-class'=>'{"has-error": formUsers.region.$touched && formUsers.region.$invalid}',



						)) }}
						@endif
						@endif
						<div class="validation-error" ng-messages="formUsers.region.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('minlength')!!}

						</div>

					</fieldset>

					<fieldset class="form-group">


						{{ Form::label('company', getphrase('company_name')) }}

						<span class="text-red">*</span>

						@if(checkRole(getUserGrade(2)))


							{{ $record->company }}


							@if($record == null)

								{{ Form::text('company', $value = null, $attributes = array('class'=>'form-control', 'placeholder' => getphrase('company_name'),

                                'ng-model'=>'company',

                                $required,

                                'id' => 'company',

                                'ng-minlength' => '2',

                                'ng-class'=>'{"has-error": formUsers.company.$touched && formUsers.company.$invalid}',



                                )) }}

							@else

								{{ Form::select('company', $company, $selected_company, $attributes = array('class'=>'form-control js-example-basic-single', 'placeholder' => getphrase('company_name'),

                                    'ng-model'=>'company',

                                    $required,

                                    'ng-minlength' => '2',

                                    'ng-class'=>'{"has-error": formUsers.company.$touched && formUsers.company.$invalid}',



                                )) }}

							@endif



						@else

							@if(isset($selected_company_id))

								<?php if (getRoleData($record->role_id) == 'parent'): ?>
							<?php $required = ''; ?>
							<?php else: ?>
								<?php $required = 'required'; ?>
						<?php endif ?>

								{{ Form::text('company', $selected_company_id, $attributes = array('class'=>'form-control', 'placeholder' => getphrase('company_name'),

                                'ng-model'=>'company',

                                $required,

                                'ng-minlength' => '2',

                                'ng-class'=>'{"has-error": formUsers.company.$touched && formUsers.company.$invalid}',



                                )) }}

							@else
								<?php if (getRoleData($record->role_id) == 'parent'): ?>
							<?php $required = ''; ?>
							<?php else: ?>
								<?php $required = 'required'; ?>
						<?php endif ?>

								{{ Form::text('company', $value = null, $attributes = array('class'=>'form-control', 'placeholder' => getphrase('company_name'),

                            'ng-model'=>'company',

                            $required,

                            'ng-minlength' => '2',

                            'ng-class'=>'{"has-error": formUsers.company.$touched && formUsers.company.$invalid}',



                            )) }}

							@endif
						@endif
						<div class="validation-error" ng-messages="formUsers.company.$error" >

							{!! getValidationMessage()!!}

							{!! getValidationMessage('minlength')!!}

						</div>

					</fieldset>

					<fieldset class="form-group" id='pharm_id'>

						@if($record->role_id == 9)
							{{ Form::label('pharm', 'Филиал') }}

							@php
							$placeholder = 'Филиал';
							@endphp

							@else

							{{ Form::label('pharm', getphrase('pharm_name')) }}

							@php
								$placeholder = getphrase('pharm_name');
							@endphp
						@endif



						<span class="text-red">*</span> 

						@if(checkRole(getUserGrade(2)))


						{{ $record->pharm }}

						@if($record == null)

						{{ Form::text('pharm', $value = null, $attributes = array('class'=>'form-control', 'placeholder' => $placeholder,

						'ng-model'=>'pharm',

						$required,

						'ng-minlength' => '1',

						'ng-class'=>'{"has-error": formUsers.pharm.$touched && formUsers.pharm.$invalid}',



						)) }}


						@else 

						{{ Form::select('pharm', $pharm, $selected_pharm, $attributes = array('class'=>'form-control js-example-basic-single', 'placeholder' => $placeholder,

							'ng-model'=>'pharm',

							$required,

							'ng-minlength' => '1',

							'ng-class'=>'{"has-error": formUsers.pharm.$touched && formUsers.pharm.$invalid}',



						)) }}
		

						@endif 
												

						@else
						
						@if(isset($selected_pharm_id))
						
						<?php if (getRoleData($record->role_id) == 'parent_region'): ?>
							<?php $required = ''; ?>
							<?php else: ?>
								<?php $required; ?>
						<?php endif ?>

						{{ Form::text('pharm', $selected_pharm_id, $attributes = array('class'=>'form-control', 'placeholder' => $placeholder,

						'ng-model'=>'pharm',

						$required,

						'ng-minlength' => '1',

						'ng-class'=>'{"has-error": formUsers.pharm.$touched && formUsers.pharm.$invalid}',



						)) }}

						@else 
						<?php if (getRoleData($record->role_id) == 'parent_region'): ?>
							<?php $required = ''; ?>
							<?php else: ?>
								<?php $required; ?>
						<?php endif ?>
							{{ Form::text('pharm', $value = null, $attributes = array('class'=>'form-control', 'placeholder' => $placeholder,

						'ng-model'=>'pharm',

						$required,

						'ng-minlength' => '1',

						'ng-class'=>'{"has-error": formUsers.pharm.$touched && formUsers.pharm.$invalid}',



						)) }}
						@endif
						@endif
						<div class="validation-error" ng-messages="formUsers.pharm.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('minlength')!!}

						</div>

					</fieldset>

					
					
					@if(isset($record->parent))
					<fieldset class="form-group">


						{{ Form::label('parent', getphrase('parent')) }}


						{{ Form::text('parent', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => '',


							'ng-model'=>'parent',


							'ng-class'=>'{"has-error": formUsers.parent.$touched && formUsers.parent.$invalid}',

							$readonly



						)) }}

						<div class="validation-error" ng-messages="formUsers.parent.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('minlength')!!}

						</div>

					</fieldset>
					
					@endif
					 <fieldset class="form-group">

						

						{{ Form::label('email', getphrase('email')) }}

						{{ Form::email('email', $value = null, $attributes = array('class'=>'form-control', 'placeholder' => 'jack@jarvis.com',

							'ng-model'=>'email',

							'ng-class'=>'{"has-error": formUsers.email.$touched && formUsers.email.$invalid}',

						 )) }}

						 <div class="validation-error" ng-messages="formUsers.email.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('email')!!}

						</div>

					</fieldset>

					@if(!$record)
					 <fieldset class="form-group">
					 {{ Form::label('password', getphrase('password')) }}

						<span class="text-red">*</span>

						{{ Form::password('password', $attributes = array('class'=>'form-control instruction-call',

								'placeholder' => getPhrase("password"),

								'ng-model'=>'password',

								$required,

								'ng-class'=>'{"has-error": formUsers.password.$touched && formUsers.password.$invalid}',

								'ng-minlength' => 5

							)) }}

						<div class="validation-error" ng-messages="formUsers.password.$error" >

							{!! getValidationMessage()!!}

							{!! getValidationMessage('password')!!}

						</div>


					</fieldset>

					 <fieldset class="form-group">
					 {{ Form::label('confirm_password', getphrase('confirm_password')) }}

						<span class="text-red">*</span>

						{{ Form::password('password_confirmation', $attributes = array('class'=>'form-control instruction-call',

								'placeholder' => getPhrase("confirm_password"),

								'ng-model'=>'password_confirmation',

								$required,

								'ng-class'=>'{"has-error": formUsers.password_confirmation.$touched && formUsers.password.$invalid}',

								'ng-minlength' => 5

							)) }}

						<div class="validation-error" ng-messages="formUsers.password_confirmation.$error" >

							{!! getValidationMessage()!!}

							{!! getValidationMessage('password')!!}

						</div>


					</fieldset>

                  @endif





					@if(!checkRole(['parent']))

					<fieldset class="form-group">



						{{ Form::label('role', getphrase('role')) }}

						<span class="text-red">*</span>

						<?php $disabled = (checkRole(getUserGrade(2))) ? '' :'disabled'; 

						

						$selected = getRoleData('student');

						if($record)

							$selected = $record->role_id;

						?>

						{{Form::select('role_id', $roles, $selected, ['placeholder' => getPhrase('select_role'),'class'=>'form-control', $disabled,

							'ng-model'=>'role_id',

							$required,

							'ng-class'=>'{"has-error": formUsers.role_id.$touched && formUsers.role_id.$invalid}'

						 ])}}

						  <div class="validation-error" ng-messages="formUsers.role_id.$error" >

	    					{!! getValidationMessage()!!}

	    					 

						</div>

						  

					</fieldset>

					@endif



					<fieldset class="form-group">

						

						{{ Form::label('phone', getphrase('phone')) }}

						<span class="text-red">*</span>

						{{ Form::text('phone', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 
						getPhrase('phone'),

							'ng-model'=>'phone',

							'id'=>'phone',

							$required,
							
							'ng-class'=>'{"has-error": formUsers.phone.$touched && formUsers.phone.$invalid}',


						$readonly
						)) }}

						 

						<div class="validation-error" ng-messages="formUsers.phone.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('phone')!!}

	    					{!! getValidationMessage('maxlength')!!}

						</div>

					</fieldset>

					<fieldset class="form-group">



						{{ Form::label('whatsapp_phone', 'Whatsapp номер') }}


						{{ Form::number('whatsapp_phone', $value = null , $attributes = array('class'=>'form-control', 'placeholder' =>
						'Whatsapp номер'

						)) }}


					</fieldset>

					<div class="row">

						<fieldset class="form-group col-sm-6">

						

						{{ Form::label('address', getphrase('billing_address')) }}

					 

						{{ Form::textarea('address', $value = null , $attributes = array('class'=>'form-control','rows'=>3, 'cols'=>'15', 'placeholder' => getPhrase('please_enter_your_address'),

							'ng-model'=>'address',

							)) }}

					</fieldset>



					<fieldset class='col-sm-6'>

						{{ Form::label('image', getphrase('image')) }}

						<div class="form-group row">

							<div class="col-md-6">

						

					{!! Form::file('image', array('id'=>'image_input', 'accept'=>'.png,.jpg,.jpeg')) !!}

							</div>

							<?php if(isset($record) && $record) { 

								  if($record->image!='') {

								?>

							<div class="col-md-6">

								<img src="{{ getProfilePath($record->image) }}" />



							</div>

							<?php } } ?>

						</div>

					</fieldset>

					  </div>

					

						<div class="buttons text-center">

							<button class="btn btn-lg btn-success button" 

							ng-disabled='!formUsers.$valid'>{{ $button_name }}</button>

						</div>
	
