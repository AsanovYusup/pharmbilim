
					 <fieldset class="form-group">

						

						{{ Form::label('code', getphrase('activation_code')) }}

						<span class="text-red">*</span>

						{{ Form::text('code', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Введите код подтверждения',

							'ng-model'=>'code',

							'required'=> 'true', 

							'ng-minlength' => '5',

							'ng-class'=>'{"has-error": formUsers.code.$touched && formUsers.code.$invalid}',



						)) }}

						<div class="validation-error" ng-messages="formUsers.code.$error" >

	    					{!! getValidationMessage()!!}

	    					{!! getValidationMessage('minlength')!!}

						</div>

					</fieldset>


					

						<div class="buttons text-center">

							<button class="btn btn-lg btn-success button" 

							ng-disabled='!formUsers.$valid'>{{ $button_name }}</button>

						</div>

						
							<div id="countdown" class="mt-2">

					        <p>Выслать код повторно через <span class="display">60</span> 
					        </p>

					        <button type="submit" style="display: none;" class="btn-link" name="post" value="submit">Отправить еще раз</button>


					        </div>  
						