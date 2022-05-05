@extends('layouts.sitelayout')



@section('content')



    

       <!-- Login Section -->

       <div  style="background-image: url({{IMAGES}}login-bg.png);background-repeat: no-repeat;background-color: #f8fafb">

    <div class="container">

        <div class="row cs-row" style="margin-top: 180px">

        

            <div class="col-md-12">
    
                <div class="cs-box-resize  login-box">

                 <h4 class="text-center login-head">{{getPhrase('Логин')}}</h4>

                    <!-- Form Login/Register -->

                    	{!! Form::open(array('url' => URL_USERS_LOGIN, 'method' => 'POST', 'name'=>'formLanguage ', 'novalidate'=>'',  'class'=>"loginform", 'name'=>"loginForm")) !!}
                        
                        


                        @include('errors.errors')	


                        
                        <div class="form-group">



                        	<label for="phone">{{getPhrase('Телефон')}}:</label>



                            {{ Form::text('phone', $value = null , $attributes = array('class'=>'form-control',



        								'ng-model'=>'phone',



        								'required'=> 'true',



        								'id'=> 'phone',



                        'placeholder' => 'Номер телефона',



        								'ng-class'=>'{"has-error": loginForm.phone.$touched && loginForm.phone.$invalid}',



									     )) }}



        								<div class="validation-error" ng-messages="loginForm.phone.$error" >



        									{!! getValidationMessage()!!}



        									{!! getValidationMessage('phone')!!}


        								</div>



                        </div>



                        <div class="form-group">

                            <label for="pwd">Пароль:</label>



                           {{ Form::password('password', $attributes = array('class'=>'form-control instruction-call',



      									'placeholder' => getPhrase("Пароль"),



      									'ng-model'=>'registration.password',



      									'required'=> 'true', 

      									'id'=> 'password', 



      									'ng-class'=>'{"has-error": loginForm.password.$touched && loginForm.password.$invalid}',



      									'ng-minlength' => 5



          								)) }}



          							<div class="validation-error" ng-messages="loginForm.password.$error" >



          								{!! getValidationMessage()!!}



          								{!! getValidationMessage('password')!!}



          							</div>



                        </div>





                         <div class="form-group">



                             @if($rechaptcha_status == 'yes')





		               



				          <div class="  form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">

		                           



		                            

		                                {!! app('captcha')->display() !!}



		                            



                               </div>





                             @endif





                        </div>



                      	<button type="submit" class="btn button btn-primary btn-lg col-md-6" id="button-auth" ng-disabled='!loginForm.$valid' style="margin-left: 85px;">{{getPhrase('Войти')}}</button>



                    </form>

                    <br>



                     <div class="row">

                      <div class="col-md-6" >

                    @if(getSetting('facebook_login', 'module'))

                      <a href="{{URL_FACEBOOK_LOGIN}}" class="btn btn-primary btn-sm"><i class="fa fa-facebook"></i> {{getPhrase('facebook')}}</a>

                    @endif

                    </div>

                     <div class="col-md-6" >

                    @if(getSetting('google_plus_login', 'module'))  

                      <a href="{{URL_GOOGLE_LOGIN}}" class="btn btn-danger btn-sm"><i class="fa fa-google-plus"></i>  {{getPhrase('google+')}}</a>

                    @endif

                  </div>

                    

                    <div class="col-md-12">

                    @if(getSetting('facebook_login', 'module')||getSetting('google_plus_login', 'module'))

                    <br>

                    <div class="alert alert-info margintop30">

                      <strong>{{getPhrase('note')}}: </strong>

                      {{getPhrase('social_logins_are_only_for_student_accounts')}}

                    </div>

                    @endif



                    </div>

        </div>

        <br>

                    <ul class="login-links mt-2 login-display">

                               <li><a href="{{URL_USERS_REGISTER}}">{{getPhrase('Регистрация')}}</a></li>

                               <li> <a href="javascript:void(0);" class="pull-left" data-toggle="modal" data-target="#myModal" ><i class="icon icon-question"></i> {{getPhrase('Сбросить пароль')}}</a></li>

                            </ul>



                    <!-- Form Login/Register -->

                </div>

            </div>

        </div>

    </div>

    <!-- Login Section -->





	<!-- Modal -->




<div id="myModal" class="modal fade" role="dialog">



  <div class="modal-dialog">



  {!! Form::open(array('url' => URL_USERS_FORGOT_PASSWORD, 'method' => 'POST', 'name'=>'formLanguage ', 'novalidate'=>'', 'class'=>"loginform", 'name'=>"passwordForm")) !!}



    <!-- Modal content-->



    <div class="modal-content">



      <div class="modal-header">



        <button type="button" class="close" data-dismiss="modal">&times;</button>



        <h4 class="modal-title">{{getPhrase('Сбросить пароль')}}</h4>



      </div>



      <div class="modal-body">



        <div class="form-group">

          <label>Номер телефона</label>



         







          {{ Form::text('phone_1', $value = null , $attributes = array('class'=>'form-control',




      'required'=> 'true',

      'id'=> 'phone_1',



      'placeholder' => getPhrase('773 471 233'),



      'ng-class'=>'{"has-error": passwordForm.phone_1.$touched && passwordForm.phone_1.$invalid}',



    )) }}



  <div class="validation-error" ng-messages="passwordForm.phone_1.$error" >



    {!! getValidationMessage()!!}



    {!! getValidationMessage('phone_1')!!}



  </div>







      </div>



      </div>



      <div class="modal-footer">



      <div class="pull-right">



        <button type="button" class="btn btn-default" data-dismiss="modal">{{getPhrase('Закрыть')}}</button>



        <button type="submit" id="submit_1" class="btn btn-primary" ng-disabled='!passwordForm.$valid'>{{getPhrase('Отправить')}}</button>



        </div>



      </div>



    </div>



  {!! Form::close() !!}



  </div>



</div>





@stop







@section('footer_scripts')



	@include('common.validations')

    

    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script>
              $(document).ready(function() {
              $.mask.definitions['9'] = '';
              $.mask.definitions['d'] = '[0-9]';
              $("#phone").mask("ddddddddd");
              $("#phone_1").mask("ddddddddd");
              });
            </script>
 

@stop