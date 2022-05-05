<?php $__env->startSection('content'); ?>



 <div class="col col-md-6 col-lg-7 hidden-sm-down">
    <h2 class="fs-xxl fw-500 mt-4 text-white">
        Учитесь и развивайтесь! </br>
        С онлайн платформой PharmBilim!
        <small class="h3 fw-300 mt-3 mb-5 text-white opacity-60">
            Тут вы найдете для себя много интересного, чего не научат по книгам и в ВУЗАХ
        </small>
    </h2>
    <a href="#" class="fs-lg fw-500 text-white opacity-70">Читать далее &gt;&gt;</a>
    <div class="d-sm-flex flex-column align-items-center justify-content-center d-md-block">
        <div class="px-0 py-1 mt-5 text-white fs-nano opacity-50">
           Мы в социальных сетях:
        </div>
        <div class="d-flex flex-row opacity-70">
            <a href="https://www.facebook.com/pharmbilim-103489064634093" class="mr-2 fs-xxl text-white">
                <i class="fab fa-facebook-square"></i>
            </a>
            
            <a href="https://www.youtube.com/channel/UChrYfshnTNa_FVl4Boy6OCA" class="mr-2 fs-xxl text-white">
                <i class="fab fa-youtube-square"></i>
            </a>
            <a href="#" class="mr-2 fs-xxl text-white">
                <i class="fab fa-linkedin"></i>
            </a>
        </div>
    </div>
</div>
<div class="col-sm-12 col-md-6 col-lg-5 col-xl-4 ml-auto">
    <h1 class="text-white fw-300 mb-3 d-sm-block d-md-none">
        Авторизация
    </h1>
    <div class="card p-4 rounded-plus bg-faded">
        <?php echo e(Form::open(array('url' => URL_USERS_LOGIN, 'method' => 'POST', 'name'=>'formLanguage ', 'novalidate'=>'',  'id'=>"js-login", 'class'=>'needs-validation'))); ?>

            <h1>Войти</h1>
            <!-- if there are login errors, show them here -->

            <div class="form-group">
                <label class="form-label" for="phone"><?php echo e(getPhrase('Телефон')); ?>:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">+996</span>
                    </div>
                    <?php echo e(Form::text('phone', $value = null , $attributes = array('class'=>'form-control form-control-lg _phonemask','required'=> 'true', 'id'=> 'phone','placeholder' => 'Номер телефона', 'autocomplete'=>'off'))); ?>

                </div>
                <div class="invalid-feedback"><?php echo getValidationMessage(); ?><?php echo getValidationMessage('phone'); ?></div>
                <div class="help-block">Ваш номер телефона, пример: (555)666-777</div>
            </div>



            <div class="form-group">
                <label class="form-label" for="password"><?php echo e(getPhrase('Пароль')); ?></label>
                <?php echo e(Form::password('password', $attributes = array('class'=>'form-control form-control-lg','placeholder' => getPhrase("Пароль"),'required'=> 'true', 'id'=> 'password',))); ?>

                <div class="invalid-feedback"><?php echo getValidationMessage(); ?><?php echo getValidationMessage('password'); ?></div>
                <div class="help-block">Ваш пароль</div>
            </div>
            <div class="form-group text-left">
                <?php if($rechaptcha_status == 'yes'): ?>
				          <div class="form-group<?php echo e($errors->has('g-recaptcha-response') ? ' has-error' : ''); ?>">
                      <?php echo app('captcha')->display(); ?>

                  </div>
                <?php endif; ?>
            </div>
            <div class="form-group text-left">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="rememberme">
                    <label class="custom-control-label" for="rememberme"> Запомнить меня</label>
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col-lg-12 my-2">
                    <button type="submit" class="btn btn-info btn-block btn-lg"><?php echo e(getPhrase('Войти')); ?> <i class="fab fa-google"></i></button>
                </div>
                <div class="col-lg-12">
                    <a type="button" class="btn btn-block btn-lg btn-outline-primary waves-effect waves-themed" data-toggle="modal" data-target=".example-modal-default-transparent"><?php echo e(getPhrase('Забыли пароль?')); ?></a>
                </div>
            </div>
          <?php echo e(Form::close()); ?>

    </div>
</div>


<div class="modal fade example-modal-default-transparent" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-transparent" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-white">
                    Забыли пароль?
                    <small class="m-0 text-white opacity-70">
                        Введите номер телефона, и мы отправим вам новый!
                    </small>
                </h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fal fa-times"></i></span>
                </button>
            </div>
            <?php echo Form::open(array('url' => URL_USERS_FORGOT_PASSWORD, 'method' => 'POST', 'name'=>'formLanguage ', 'novalidate'=>'', 'class'=>"loginform", 'name'=>"passwordForm")); ?>

            <div class="modal-body text-white">
                  <div class="form-group">
                      <label class="form-label" for="addon-wrapping-left">Номер телефона</label>
                      <div class="input-group flex-nowrap">
                          <div class="input-group-prepend">
                              <span class="input-group-text">+996</span>
                          </div>
                          <?php echo e(Form::text('phone_1', $value = null , $attributes = array('class'=>'form-control _phonemask', 'required'=> 'true', 'id'=> 'addon-wrapping-left', 'placeholder' => 'Телефон', 'aria-describedby' => 'addon-wrapping-left'))); ?>

                      </div>
                  </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(getPhrase('Закрыть')); ?></button>
                <button type="submit" class="btn btn-primary"><?php echo e(getPhrase('Отправить')); ?></button>
            </div>
            <?php echo Form::close(); ?>

        </div>
    </div>
</div>

<?php $__env->startPush('custom-styles'); ?>
    <link rel="stylesheet" media="screen, print" href="<?php echo e(themes('css/notifications/toastr/toastr.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('custom-scripts'); ?>
    <script src="<?php echo e(themes('js/notifications/toastr/toastr.js')); ?>"></script>
    <script src="<?php echo e(themes('js/formplugins/inputmask/inputmask.bundle.js')); ?>"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <?php if(Session::get('error')): ?>
    <script>
        toastr["error"]("<?php echo e(Session::get('error')); ?>", "Ошибка!");
    </script>
    <?php endif; ?>

    <?php if(Session::get('success')): ?>
    <script>
        toastr["success"]("<?php echo e(Session::get('success')); ?>", "Успех!");
    </script>
    <?php endif; ?>
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
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>

<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>