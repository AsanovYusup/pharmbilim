@extends('layouts.sitelayout')

@section('content')

 <!--  <section class="cs-primary-bg cs-page-banner" style="margin-top:100px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="cs-page-banner-title text-center">{{getPhrase('create_a_new_account')}}</h2>
                </div>
            </div>
        </div>
    </section> -->

  <!-- Login Section -->
  <div  style="background-image: url({{IMAGES}}login-bg.png);background-repeat: no-repeat;background-color: #f8fafb">
    <div class="container">
         <div class="row cs-row" style="margin-top: 180px">
             
            <div class="col-md12">
                <div class="cs-box-resize-sign login-box">
                   <h4 class="text-center login-head">
                   {{getPhrase('create_account')}}</h4>                   
                    <!-- Form Login/Register -->
                    	{!! Form::open(array('url' => URL_USERS_REGISTER, 'method' => 'POST', 'name'=>'formLanguage ', 'novalidate'=>'', 'class'=>"loginform", 'name'=>"registrationForm")) !!}

                        @include('errors.errors')

                        <div class="form-group">
                          
                          <label for="email">{{getPhrase('phone')}}</label><span style="color: red;">*</span>

                        {{ Form::text('phone', $value = null , $attributes = array('class'=>'form-control',

                  'placeholder' => getPhrase("phone"),

                  'ng-model'=>'phone',

                  'required'=> 'true',

                  'id'=>'phone',

                  'ng-class'=>'{"has-error": registrationForm.phone.$touched && registrationForm.phone.$invalid}',

                )) }}

              <div class="validation-error" ng-messages="registrationForm.phone.$error" >

                {!! getValidationMessage()!!}

                {!! getValidationMessage('phone')!!}

              </div>


                        </div>	
  
                    

              <?php $parent_module = getSetting('parent', 'module'); ?>

							@if(!$parent_module)

						<input type="hidden" name="is_student" value="0">

							@else

                          <div class="form-group">


                           
                             <div class="col-md-12">


							</div>

							<div class="col-md-12">

							<ul class="login-links mt-2">
                              	 <li>
                              	 	
							{{ Form::radio('is_student', 0, true, array('id'=>'free')) }}

								

								<label for="free"> <span class="  radio-button"> <i class="mdi mdi-check active"></i> </span> {{getPhrase('i_am_a_student')}}</label> 
                              	 </li>
                              	 <li>
                              	 	{{ Form::radio('is_student', 1, false, array('id'=>'paid' )) }}

								<label for="paid"> 

								<span class="  radio-button"> <i class="mdi mdi-check active"></i> </span> {{getPhrase('i_am_a_parent')}} </label>
                              	 </li>
                            </ul>

							

							</div>

                          </div>

                          @endif


                         <div class="form-group">

                             @if($rechaptcha_status == 'yes')


		               

				          <div class="col-md-12 form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}" style="margin-top: 15px">
		                           

		                           
		                                {!! app('captcha')->display() !!}

		                          

                               </div>


                             @endif


                        </div>

                      	<div class="text-center mt-2">
                           <button type="submit" class="btn button btn-primary btn-lg" ng-disabled='!registrationForm.$valid'>{{getPhrase('register')}}</button>                    		
                      	</div>
                       

                    </form>
                    <!-- Form Login/Register -->
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Login Section -->

@stop


@section('footer_scripts')

	@include('common.validations')
		     	{{-- <script src="{{JS}}recaptcha.js"></script> --}}
		     		<script src='https://www.google.com/recaptcha/api.js'></script>



@stop