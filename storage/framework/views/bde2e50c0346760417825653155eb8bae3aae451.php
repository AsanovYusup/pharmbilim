


<?php $__env->startSection('content'); ?>

<div class="login-content">

		<div class="logo text-center"><img src="<?php echo e(IMAGE_PATH_SETTINGS.getSetting('site_logo', 'site_settings')); ?>" alt="" height="59" width="211" ></div>

		  <?php echo $__env->make('layouts.site-navigation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo Form::open(array('url' => URL_USERS_LOGIN, 'method' => 'POST', 'name'=>'formLanguage ', 'novalidate'=>'', 'class'=>"loginform", 'name'=>"loginForm")); ?>




		<?php echo $__env->make('errors.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>



			<div class="input-group">

				<span class="input-group-addon" id="basic-addon1"><i class="icon icon-user"></i></span>



	    		<?php echo e(Form::text('email', $value = null , $attributes = array('class'=>'form-control',

			'ng-model'=>'email',

			'required'=> 'true',
			'id'=> 'email',


			'placeholder' => getPhrase('username').'/'.getPhrase('email'),

			'ng-class'=>'{"has-error": loginForm.email.$touched && loginForm.email.$invalid}',

		))); ?>


	<div class="validation-error" ng-messages="loginForm.email.$error" >

		<?php echo getValidationMessage(); ?>


		<?php echo getValidationMessage('email'); ?>


	</div>



			</div>



			<div class="input-group">

				<span class="input-group-addon" id="basic-addon1"><i class="icon icon-lock"></i></span>

	    		<?php echo e(Form::password('password', $attributes = array('class'=>'form-control instruction-call',

			'placeholder' => getPhrase("password"),

			'ng-model'=>'registration.password',

			'required'=> 'true',
			'id'=> 'password',

			'ng-class'=>'{"has-error": loginForm.password.$touched && loginForm.password.$invalid}',

			'ng-minlength' => 5

		))); ?>


	<div class="validation-error" ng-messages="loginForm.password.$error" >

		<?php echo getValidationMessage(); ?>


		<?php echo getValidationMessage('password'); ?>


	</div>



			</div>


              <?php if($rechaptcha_status == 'yes'): ?>

				<div class="input-group">

                	 <label class="control-label">Captcha<span class="text-red">*</span></label>

		          <div class="col-md-12 form-group<?php echo e($errors->has('g-recaptcha-response') ? ' has-error' : ''); ?>">


                            <div class="col-md-6 pull-center">
                                <?php echo app('captcha')->display(); ?>


                            </div>
                        </div>


                    </div>

                <?php endif; ?>


			<div class="text-center buttons">

				<button type="submit" class="btn button btn-success btn-lg" ng-disabled='!loginForm.$valid'><?php echo e(getPhrase('login')); ?></button>

				<div class="social-logins">
					<?php if(getSetting('facebook_login', 'module')): ?>
						<a href="<?php echo e(URL_FACEBOOK_LOGIN); ?>" class="btn btn-lg btn-facebook btn-full"><i class="fa fa-facebook"></i> <?php echo e(getPhrase('login_with_facebook')); ?></a>
					<?php endif; ?>

					<?php if(getSetting('google_plus_login', 'module')): ?>
						<a href="<?php echo e(URL_GOOGLE_LOGIN); ?>" class="btn btn-lg btn-google-plus btn-full"><i class="fa fa-google-plus"></i>  <?php echo e(getPhrase('login_with_google')); ?></a>
					<?php endif; ?>

					<?php if(getSetting('facebook_login', 'module')||getSetting('google_plus_login', 'module')): ?>
					<div class="alert alert-info margintop30">
					  <strong><?php echo e(getPhrase('note')); ?>: </strong>
					  <?php echo e(getPhrase('social_logins_are_only_for_student_accounts')); ?>

					</div>
					<?php endif; ?>
				</div>

			</div>

		<?php echo Form::close(); ?>




		<div class="footer">

			<a href="javascript:void(0);" class="pull-left" data-toggle="modal" data-target="#myModal" ><i class="icon icon-question"></i> <?php echo e(getPhrase('forgot_password')); ?></a>



			<a href="<?php echo e(URL_USERS_REGISTER); ?>" class="pull-right"><i class="icon icon-add-user"></i> <?php echo e(getPhrase('register')); ?></a>

		</div>

	</div>



	<!-- Modal -->

<div id="myModal" class="modal fade" role="dialog">

  <div class="modal-dialog">

	<?php echo Form::open(array('url' => URL_USERS_FORGOT_PASSWORD, 'method' => 'POST', 'name'=>'formLanguage ', 'novalidate'=>'', 'class'=>"loginform", 'name'=>"passwordForm")); ?>


    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title"><?php echo e(getPhrase('forgot_password')); ?></h4>

      </div>

      <div class="modal-body">

        <div class="input-group">

				<span class="input-group-addon" id="basic-addon1"><i class="icon icon-email-resend"></i></span>



	    		<?php echo e(Form::email('email', $value = null , $attributes = array('class'=>'form-control',

			'ng-model'=>'email',

			'required'=> 'true',

			'placeholder' => getPhrase('email'),

			'ng-class'=>'{"has-error": passwordForm.email.$touched && passwordForm.email.$invalid}',

		))); ?>


	<div class="validation-error" ng-messages="passwordForm.email.$error" >

		<?php echo getValidationMessage(); ?>


		<?php echo getValidationMessage('email'); ?>


	</div>



			</div>

      </div>

      <div class="modal-footer">

      <div class="pull-right">

        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo e(getPhrase('close')); ?></button>

        <button type="submit" class="btn btn-primary" ng-disabled='!passwordForm.$valid'><?php echo e(getPhrase('submit')); ?></button>

        </div>

      </div>

    </div>

	<?php echo Form::close(); ?>


  </div>

</div>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('footer_scripts'); ?>

	<?php echo $__env->make('common.validations', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		     	
		     	      	<script src='https://www.google.com/recaptcha/api.js'></script>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.site', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>