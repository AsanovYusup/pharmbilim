@extends('layouts.sitelayout')

@section('content')

  <div  style="background-image: url({{IMAGES}}login-bg.png);background-repeat: no-repeat;background-color: #f8fafb">
    <div class="container">
         <div class="row cs-row" style="margin-top: 180px">
             
            <div class="col-md12">
                <div class="cs-box-resize-sign login-box">
                   <h4 class="text-center login-head">
                   {{getPhrase('Верификация')}}</h4>

                        {!! Form::open(array('url' => URL_USERS_CONFIRM, 'method' => 'POST', 'name'=>'formLanguage ', 'novalidate'=>'', 'class'=>"confirm", 'name'=>"registrationForm")) !!}

                        @include('errors.errors')   

                        <div class="form-group">

                           {{ Form::text('code', $value = null , $attributes = array('class'=>'form-control',

                                    'placeholder' => getPhrase("Код подтверждения"),

                                    'ng-model'=>'name',

                                    'ng-pattern' => getRegexPattern('name'),

                                    'required'=> 'true', 

                                    'ng-class'=>'{"has-error": registrationForm.name.$touched && registrationForm.name.$invalid}',

                                    'ng-minlength' => '5',

                                )) }}

                                    <div class="validation-error" ng-messages="registrationForm.name.$error" >

                                        {!! getValidationMessage()!!}

                                        {!! getValidationMessage('minlength')!!}

                                        {!! getValidationMessage('pattern')!!}

                                    </div>

                        </div>
                        
                        <div class="text-center mt-2">
                            <button type="submit" class="btn button btn-primary btn-lg" ng-disabled='!registrationForm.$valid'>{{getPhrase('Отправить')}}</button>
                        </div>
                        @if(isset($session))
                         <div id="countdown" class="mt-2">

					        <p>Выслать код повторно через <span class="display">60</span> 
					        </p>

					        <button type="submit" style="display: none;" class="btn-link" name="post" value="submit">Отправить еще раз</button>


        				</div>  
        				@endif

                    </form>
                    <!-- Form Login/Register -->
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Login Section -->


    <div id="myModal" class="modal fade" role="dialog">



  <div class="modal-dialog">



    {!! Form::open(array('url' => 'register/confirm', 'method' => 'POST', 'name'=>'formLanguage ', 'novalidate'=>'', 'class'=>"loginform", 'name'=>"registrationFormConfirm")) !!}



    <!-- Modal content-->



    <div class="modal-content">



      <div class="modal-header">



        <button type="button" class="close" data-dismiss="modal">&times;</button>



        <h4 class="modal-title text-center">{{getPhrase('Укажите пароль')}}</h4>



      </div>



      <div class="modal-body">



        <div class="form-group">

          <label>Пароль</label>



                 







            {{ Form::password('password', $attributes = array('class'=>'form-control instruction-call',

                                'placeholder' => getPhrase("Не менее 6 символов в длину"),

                                'ng-model'=>'registration.password',

                                'required'=> 'true', 

                                'ng-class'=>'{"has-error": registrationForm.password.$touched && registrationForm.password.$invalid}',

                                'ng-minlength' => 5

                            )) }}


    <div class="validation-error" ng-messages="registrationForm.password.$error" >

                            {!! getValidationMessage()!!}

                            {!! getValidationMessage('password')!!}

                        </div>
            </div>
            @if(isset($var))
            {{ Form::hidden('id', $var) }}
            @endif
            <div class="form-group">

          <label>Подтвердите пароль</label>



            {{ Form::password('password_confirmation', $attributes = array('class'=>'form-control instruction-call',

            'placeholder' => getPhrase("Подтвердите пароль"),

            'ng-model'=>'registration.password_confirmation',

            'required'=> 'true', 

            'ng-class'=>'{"has-error": registrationForm.password_confirmation.$touched && registrationForm.password_confirmation.$invalid}',

            'ng-minlength' => 5,

            'compare-to' =>"registration.password"



        )) }}

   <div class="validation-error" ng-messages="registrationForm.password_confirmation.$error" >



        {!! getValidationMessage()!!}



        {!! getValidationMessage('confirmPassword')!!}



    </div>







            </div>



      </div>



      <div class="modal-footer">



      <div class="text-center mt-2">


        <button type="submit" class="btn button btn-primary btn-lg" ng-disabled='!registrationFormConfirm.$valid'>{{getPhrase('Отправить')}}</button>



        </div>


      </div>



    </div>



    {!! Form::close() !!}



  </div>



</div>





@stop



@section('footer_scripts')

    @include('common.validations')
                {{-- <script src="{{JS}}recaptcha.js"></script> --}}
                    <script src='https://www.google.com/recaptcha/api.js'></script>
    
                    <script>
                        @if (isset($error))
                        $('#myModal').modal('show');
                        @endif
                    </script>


@stop