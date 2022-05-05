@extends('layouts.auth')
@section('content')

{{-- {{env('SMS_LOGIN')}} --}}

<div class="row">
  <div class="col-xl-12">
      <h2 class="fs-xxl fw-500 mt-4 text-white text-center">
          {{getPhrase('Регистрация')}}          
          <small class="h3 fw-300 mt-3 mb-5 text-white opacity-60 hidden-sm-down">
              Пройдите регистрацию СЕЙЧАС, ведь это БЕСПЛАТНО!
              <br>Всё просто, вам лишь нужно ввести необходимый данные,
              <br>По форменной анкете ниже, удачи )
          </small>
      </h2>
  </div>
  <div class="col-xl-6 ml-auto mr-auto">
      <div class="card p-4 rounded-plus bg-faded">          
          <div class="alert alert-primary text-dark" role="alert">
              <strong>Внимание!</strong> Проверьте правильность ввода своего номера, в течении 5 минут к вам на телефон придёт <span class="text-danger">СМС</span> уведомление с одноразовым <span class="text-danger">ПИН</span> кодом на сайт.
          </div>                             
          {!! Form::open(array('url' => URL_USERS_REGISTER, 'method' => 'POST', 'name'=>'formLanguage ', 'novalidate'=>'', 'id'=>"js-login", 'name'=>"registrationForm", 'class'=>'needs-validation')) !!}

            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">+996</span>
                </div>
                {{ Form::text('phone', $value = null , $attributes = array('class'=>'form-control form-control-lg _phonemask','required'=> 'true', 'id'=> 'phone','placeholder' => 'Номер телефона', 'autocomplete'=>'on')) }}
            </div>
              <div class="help-block">Укажите телефон для регистрации. В формате: <span class="text-danger">555666777</span></div>
              <div class="form-group row mt-5">
                  <div class="col-6 pr-1">
                        <div class="custom-control custom-radio">
                        {{ Form::radio('is_student', 5, true, array('id'=>'free', 'class' => 'custom-control-input', 'name' => 'ac_role', 'checked'=>'')) }}
                        <label class="custom-control-label" for="free">{{getPhrase('i_am_a_student')}}</label>
                    </div>
                    <div class="custom-control custom-radio mt-2">
                        {{ Form::radio('is_student', 9, false, array('id'=>'paid', 'class' => 'custom-control-input', 'name' => 'ac_role')) }}
                        <label class="custom-control-label" for="paid">Я врач</label>
                    </div>
                  </div>
                  <div class="col-6 pl-1">
                      <div class="custom-control custom-checkbox">
                          {{ Form::checkbox('policy', 0,false, array('id'=>'policy', 'class' => 'custom-control-input', 'required' => '')) }}
                          <label class="custom-control-label" for="policy">Я ознакомлен(a) с</label>
                          <div class="invalid-feedback">Ознакомьтесь с политикой конфиденциальности</div>
                          <div class="help-clock"><a target="_blank" href="/site/privacy-policy">Политикой конфиденциальности</a></div>
                      </div>
                  </div>                  
              </div>
              <div class="form-group">
                  @if($rechaptcha_status == 'yes')
                    <div class="col-md-12 form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}" style="margin-top: 15px">
                        {!! app('captcha')->display() !!}
                    </div>
                  @endif
              </div>             

              <div class="form-group row">
                  <div class="col-6 pr-1">
                      <a class="btn btn-block btn-secondary btn-lg mt-2" href="user/confirmation">У меня уже есть код!</a>
                  </div>                  
                  <div class="col-6 pl-1">
                      <button id="js-login-btn" type="submit" class="btn btn-block btn-danger btn-lg mt-2">{{getPhrase('Регистрация')}}</button>
                  </div>
              </div>
          {!! Form::close() !!}
      </div>
  </div>
</div>
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
@section('footer_scripts')
