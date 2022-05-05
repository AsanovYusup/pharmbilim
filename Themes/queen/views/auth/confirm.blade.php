@extends('layouts.auth')
@section('content')


<div class="row">
  <div class="col-xl-12">
      <h2 class="fs-xxl fw-500 mt-4 text-white text-center">
          {{getPhrase('Верификация')}}         
          <small class="h3 fw-300 mt-3 mb-5 text-white opacity-60 hidden-sm-down">
              Вставьте пожалуйста <span class="text-danger">ПИН</span> код, который мыотправили вам на телефон.
          </small>
      </h2>
  </div>
  <div class="col-xl-6 ml-auto mr-auto">
      <div class="card p-4 rounded-plus bg-faded">          
          <div class="alert alert-primary text-dark" role="alert">
              <strong>Внимание!</strong> Если вы не получили <span class="text-danger">ПИН</span> код в течении 5 минут, нажмите на кнопку <span class="text-danger">отправить ещё раз</span>.
          </div>                     
          {!! Form::open(array('url' => URL_USERS_CONFIRM, 'method' => 'POST', 'name'=>'formLanguage ', 'novalidate'=>'', 'id'=>"confirm", 'name'=>"registrationForm", 'class'=>'needs-validation')) !!}
              <div class="form-group">
                  <label class="form-label" for="phone">{{getPhrase("Код подтверждения")}}:</label>
                  {{ Form::text('code', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase("Код подтверждения"), 'required'=> 'true')) }}
                  <div class="invalid-feedback">{!! getValidationMessage()!!}{!! getValidationMessage('minlength')!!} {!! getValidationMessage('pattern')!!}</div>
                  <div class="help-block">Укажите ПИН код для продолжения регистрации. В формате: <span class="text-danger">556677</span></div>
              </div>
              <div class="form-group row">
                  @if(isset($session))
                    <div id="countdown" class="mt-2">
                      <p>Выслать код повторно через <span class="display">60</span></p>
                      <button type="submit" style="display: none;" class="btn-link" name="post" value="submit">Отправить еще раз</button>
                    </div>  
                  @endif               
              </div>           

              <div class="form-group row">
                  <div class="col-6 pr-1">
                      <a class="btn btn-block btn-secondary btn-lg mt-2" href="/user/confirmation">У меня уже есть код!</a>
                  </div>                  
                  <div class="col-6 pl-1">
                      <button id="js-login-btn" type="submit" class="btn btn-block btn-danger btn-lg mt-2">{{getPhrase('Отправить')}}</button>
                  </div>
              </div>
          {!! Form::close() !!}
      </div>
  </div>
</div>


<div class="modal fade" id="default-example-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    Придумайте пароль!
                    <small class="m-0 opacity-70">
                        Очень важно придумать надежный пароль, чтобы вашим аккаунтом не смогли могли воспользоваться злоумышленники.
                    </small>
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            {!! Form::open(array('url' => URL_USERS_REGISTER_CONFIRM, 'method' => 'POST', 'name'=>'formLanguage ', 'novalidate'=>'','class'=>"password_form", 'name'=>"registrationFormConfirm")) !!}
            <div class="modal-body">
                   
                  <div class="form-group">
                      <label class="form-label" for="addon-wrapping-left">Пароль</label>
                      <div class="input-group flex-nowrap">
                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fal fa-phone"></i></span>
                          </div>
                          {{ Form::password('password', $attributes = array('class'=>'form-control instruction-call','id'=>'password','placeholder' => getPhrase("Не менее 6 символов в длину"), 'required'=> 'true')) }}
                      </div>
                  </div>
                  <div class="form-group">
                      @if(isset($var))
                      {{ Form::hidden('id', $var) }}
                      @endif
                  </div>
                  <div class="form-group">
                      <label class="form-label" for="addon-wrapping-left">Подтвердите пароль</label>
                      <div class="input-group flex-nowrap">
                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fal fa-phone"></i></span>
                          </div>
                          {{ Form::password('password_confirmation', $attributes = array('class'=>'form-control instruction-call','id'=>'confirm_password','placeholder' => getPhrase("Подтвердите пароль"),'required'=> 'true', 'compare-to' =>"registration.password" )) }}
                      </div>
                      <div class="invalid-feedback">
                        @foreach ($errors->all() as $error)
                          {!! $errors->first() !!}
                        @endforeach
                      </div>
                  </div>                  
                                
            </div>  
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{getPhrase('Закрыть')}}</button>
                <button type="submit" class="btn btn-primary js-waves-off">{{getPhrase('Сохранить')}}</button>
            </div> 
            {!! Form::close() !!}              
        </div>
    </div>
</div>
@stop
@section('footer_scripts')
@push('custom-styles')
    <link rel="stylesheet" media="screen, print" href="{{themes('css/notifications/toastr/toastr.css')}}">
@endpush
@push('custom-scripts')
    <script src="{{themes('js/notifications/toastr/toastr.js')}}"></script>
    <script src="{{themes('js/formplugins/inputmask/inputmask.bundle.js')}}"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    @if (Session::get('error'))
    <script>
        toastr["error"]("{{ Session::get('error') }}", "Ошибка!");
    </script>
    @endif

    @if (Session::get('success'))
    <script>
        toastr["success"]("{{ Session::get('success') }}", "Успех!");
    </script>
    @endif
    
    <script>
        @if (isset($error))
        $('#default-example-modal').modal('show');
        @endif
    </script>

    <script>
    (function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
        });
    }, false);
    })();
    toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": true,
    "onclick": null,
    "showDuration": 300,
    "hideDuration": 100,
    "timeOut": 5000,
    "extendedTimeOut": 1000,
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
    }
    $(document).ready(function()
    {
        $("._phonemask").inputmask("(999)999-999");
    });
    </script>
@endpush                  
@stop