<div class="row">

	<fieldset class="form-group col-md-6">
		<?php echo e(Form::label('title', getphrase('title'))); ?>

		<span class="text-danger">*</span>

		<?php echo e(Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('quiz_title'),
		'ng-model'=>'title',
		'required'=> 'true', 
		'ng-class'=>'{"has-error": formQuiz.title.$touched && formQuiz.title.$invalid}',
		'ng-minlength' => '4',
		'ng-maxlength' => '40',
		))); ?>


		<div class="validation-error" ng-messages="formQuiz.title.$error">
			<?php echo getValidationMessage(); ?>

			<?php echo getValidationMessage('pattern'); ?>

			<?php echo getValidationMessage('minlength'); ?>

			<?php echo getValidationMessage('maxlength'); ?>

		</div>

	</fieldset>

	<fieldset class="form-group col-md-6">
		<?php echo e(Form::label('category_id', getphrase('category'))); ?>

		<span class="text-danger">*</span>
		<?php echo e(Form::select('category_id', $categories, null, ['class'=>'form-control'])); ?>

	</fieldset>
	
</div>



<div class="row">

	<fieldset class="form-group col-md-6">
		<?php echo e(Form::label('dueration', getphrase('duration'))); ?>

		<span class="text-danger">*</span>

		<?php echo e(Form::number('dueration', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('enter_value_in_minutes'),
		'min'=>1,
		'ng-model'=>'dueration', 
		'required'=> 'true',
		'string-to-number'=> 'true', 
		'ng-class'=>'{"has-error": formQuiz.dueration.$touched && formQuiz.dueration.$invalid}',
		))); ?>


		<div class="validation-error" ng-messages="formQuiz.dueration.$error">
			<?php echo getValidationMessage(); ?>

			<?php echo getValidationMessage('number'); ?>

		</div>
	</fieldset>

	<fieldset class="form-group col-md-6">
		<?php echo e(Form::label('attempts', getphrase('attempts'))); ?>

		<?php echo e(Form::number('attempts', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('count_attempts'),
		))); ?>

	</fieldset>

	<fieldset class="form-group col-md-6">

		<?php echo e(Form::label('points', "Кредит часы")); ?>

		<?php echo e(Form::number('points', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => "Баллы",
		))); ?>


	</fieldset>

	<fieldset class="form-group col-md-3">
		<?php echo e(Form::label('total_marks', getphrase('total_marks'))); ?>

		<span class="text-danger">*</span>
		<?php echo e(Form::text('total_marks', $value = null , $attributes = array('class'=>'form-control','readonly'=>'true'))); ?>

	</fieldset>

	<fieldset class="form-group col-md-3">
		<?php echo e(Form::label('pass_percentage', getphrase('pass_percentage'))); ?>


		<span class="text-danger">*</span>

		<?php echo e(Form::number('pass_percentage', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => '40',
		'min'=>'1',
		'max' =>'100',
		'ng-model'=>'pass_percentage', 
		'required'=> 'true', 
		'string-to-number'=> 'true',
		'ng-class'=>'{"has-error": formQuiz.pass_percentage.$touched && formQuiz.pass_percentage.$invalid}',
			))); ?>


		<div class="validation-error" ng-messages="formQuiz.pass_percentage.$error">
			<?php echo getValidationMessage(); ?>

			<?php echo getValidationMessage('number'); ?>

		</div>
	</fieldset>

</div>



<div class="row">
	
	<fieldset class="form-group col-md-6">

		<?php echo e(Form::label('negative_mark', getphrase('negative_mark'))); ?>

		<span class="text-danger">*</span>
		<?php echo e(Form::number('negative_mark', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => '40',
		'min'=>'0',
		'max' =>'100',
		'ng-model'=>'negative_mark', 
		'required'=> 'true', 
		'string-to-number'=> 'true', 
		'ng-class'=>'{"has-error": formQuiz.negative_mark.$touched && formQuiz.negative_mark.$invalid}',
			))); ?>


		<div class="validation-error" ng-messages="formQuiz.negative_mark.$error">
			<?php echo getValidationMessage(); ?>

			<?php echo getValidationMessage('number'); ?>

		</div>

	</fieldset>

	<fieldset class="form-group col-md-6">
		<?php echo e(Form::label('instructions_page_id', getphrase('instructions_page'))); ?>

		<span class="text-danger">*</span>
		<?php echo e(Form::select('instructions_page_id', $instructions, null, ['class'=>'form-control'])); ?>

	</fieldset>

</div>



<div class="input-daterange">
<div class="row">
	<?php
		$date_from = date('Y/m/d');
		$date_to = date('Y/m/d');	
	?>
	<?php if($record): ?>
			<?php
					$date_from = $record->start_date;
					$date_to = $record->end_date;
			?>
	<?php endif; ?>

			<fieldset class="form-group col-md-6">
				<?php echo e(Form::label('start_date', getphrase('start_date'))); ?>

				<?php echo e(Form::text('start_date', $value = $date_from , $attributes = array('class'=>'input-sm form-control', 'placeholder' => '2015/7/17'))); ?>

			</fieldset>

			<fieldset class="form-group col-md-6">
				<?php echo e(Form::label('end_date', getphrase('end_date'))); ?>

				<?php echo e(Form::text('end_date', $value = $date_to , $attributes = array('class'=>'input-sm form-control', 'placeholder' => '2015/7/17'))); ?>

			</fieldset>
		</div>

	

</div>



<div class="row">

	<?php
			$payment_options = array('1'=>'Платный', '0'=>'Бесплатный');
	?>

	<fieldset class="form-group col-md-6">
		<?php echo e(Form::label('is_paid', getphrase('is_paid'))); ?>

		<span class="text-danger">*</span>
		<?php echo e(Form::select('is_paid', $payment_options, null, ['placeholder' => getPhrase('select'),'class'=>'form-control', 
			'ng-model'=>'is_paid',
			'required'=> 'true', 
			'ng-minlength' => '2',
			'ng-maxlength' => '20',
			'ng-class'=>'{"has-error": formQuiz.is_paid.$touched && formQuiz.is_paid.$invalid}',
		])); ?>


		<div class="validation-error" ng-messages="formQuiz.is_paid.$error">
			<?php echo getValidationMessage(); ?>

		</div>
	</fieldset>





	<div ng-if="is_paid==1" class="form-group col-md-6">
		<div class="row">
			<fieldset class="form-group col-md-6">

				<?php echo e(Form::label('validity', getphrase('validity'))); ?>

				<span class="text-danger">*</span>
				<?php echo e(Form::number('validity', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('validity_in_days'),
				'ng-model'=>'validity',
				'string-to-number'=> 'true',
				'min'=>'1',
				'required'=> 'true', 
				'ng-class'=>'{"has-error": formQuiz.validity.$touched && formQuiz.validity.$invalid}',
				))); ?>


				<div class="validation-error" ng-messages="formQuiz.validity.$error">
					<?php echo getValidationMessage(); ?>

					<?php echo getValidationMessage('number'); ?>

				</div>

			</fieldset>

			<fieldset class="form-group col-md-6">

				<?php echo e(Form::label('cost', getphrase('cost'))); ?>

				<span class="text-danger">*</span>
				<?php echo e(Form::number('cost', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => '40',
					'min'=>'0',
					'ng-model'=>'cost', 
					'required'=> 'true', 
					'string-to-number'=> 'true',
					'ng-class'=>'{"has-error": formQuiz.cost.$touched && formQuiz.cost.$invalid}',
					))); ?>


				<div class="validation-error" ng-messages="formQuiz.cost.$error">
					<?php echo getValidationMessage(); ?>

					<?php echo getValidationMessage('number'); ?>

				</div>

			</fieldset>
		</div>
	</div>
</div>

<?php
		$options  = array('1'=>'Да', '0'=>'Нет');
?>

<div class="row">
	<fieldset class="form-group col-md-6">
		
		<?php echo e(Form::label('show_in_front', getPhrase('show_in_home_page'))); ?>

		<span class="text-danger">*</span>
		<?php echo e(Form::select('show_in_front', $options, null, ['placeholder' => getPhrase('select'),'class'=>'form-control', 
			'ng-model'=>'show_in_front',
			'required'=> 'true', 
			'ng-minlength' => '2',
			'ng-maxlength' => '20',
			'ng-class'=>'{"has-error": formQuiz.show_in_front.$touched && formQuiz.show_in_front.$invalid}',
		])); ?>

		<div class="validation-error" ng-messages="formQuiz.show_in_front.$error">
			<?php echo getValidationMessage(); ?>

		</div>
	</fieldset>

	<fieldset class="form-group col-md-6">
		<?php echo e(Form::label('exam_type', getphrase('exam_type'))); ?>

		<span class="text-danger">*</span>
		<?php echo e(Form::select('exam_type', $exam_types, null, ['class'=>'form-control','ng-model'=>'exam_type'])); ?>

	</fieldset>
</div>



<div class="row">

	<?php
			$language_options = array('1'=>'Да', '0'=>'Нет');
	?>

	<fieldset class="form-group col-md-6">
		<?php echo e(Form::label('has_language', getPhrase('It_has_other_language'))); ?>

		<span class="text-danger">*</span>
		<?php echo e(Form::select('has_language', $language_options, null, ['placeholder' => getPhrase('select'),'class'=>'form-control', 
		'ng-model'=>'has_language',
		'required'=> 'true', 
		'ng-class'=>'{"has-error": formQuiz.has_language.$touched && formQuiz.has_language.$invalid}',
		])); ?>

		<div class="validation-error" ng-messages="formQuiz.has_language.$error">
			<?php echo getValidationMessage(); ?>

		</div>
	</fieldset>

	<fieldset class="form-group col-md-6">
		<?php echo e(Form::label('is_popular', getPhrase('is_popular'))); ?>

		<span class="text-danger">*</span>
		<?php echo e(Form::select('is_popular', $options, null, ['placeholder' => getPhrase('select'),'class'=>'form-control', 
			'ng-model'=>'is_popular',
			'required'=> 'true', 
			'ng-class'=>'{"has-error": formQuiz.is_popular.$touched && formQuiz.is_popular.$invalid}',
		])); ?>

		<div class="validation-error" ng-messages="formQuiz.is_popular.$error">
			<?php echo getValidationMessage(); ?>

		</div>
	</fieldset>

	<?php
			$languages_data = getLangugesOptions();
	?>

	<fieldset class="form-group col-md-6" ng-if="has_language == 1">
		<?php echo e(Form::label('language_name', getPhrase('add_language'))); ?>

		<span class="text-danger">*</span>
		<?php echo e(Form::select('language_name', $languages_data, null, ['placeholder' => getPhrase('select'),'class'=>'form-control', 
		'ng-model'=>'language_name',
		'required'=> 'true', 
		'ng-class'=>'{"has-error": formQuiz.language_name.$touched && formQuiz.language_name.$invalid}',
		])); ?>

		<div class="validation-error" ng-messages="formQuiz.language_name.$error">
			<?php echo getValidationMessage(); ?>

		</div>
	</fieldset>
</div>







<div class="row">

	<fieldset class="form-group col-md-6">
		<label class="form-label"><?php echo e(getphrase('image')); ?></label>
		<div class="custom-file">
					<input type="file" class="custom-file-input" name="examimage" accept=".png,.jpg,.jpeg" id="image_input">
					<label class="custom-file-label" for="image_input">Выберите картинку</label>
		</div>
	</fieldset>

	<fieldset class="form-group col-md-6">
		<?php if($record): ?>
			<?php if($record->image): ?>
			<?php
					$examSettings = getExamSettings();
			?>
			<img src="<?php echo e(PREFIX.$examSettings->categoryImagepath.$record->image); ?>" height="100" width="100">
			<?php endif; ?>
		<?php endif; ?>
	</fieldset>
</div>

<div class="row">

	<fieldset class="form-group col-md-12">
		<?php echo e(Form::label('description', getphrase('description'))); ?>

		<?php echo e(Form::textarea('description', $value = null , $attributes = array('class'=>'form-control', 'rows'=>'5', 'placeholder' => getPhrase('description')))); ?>

	</fieldset>

	<div class="buttons text-center col-md-12">	
		<button class="btn btn-lg btn-success button" ng-disabled='!formQuiz.$valid'><?php echo e($button_name); ?></button>	
	</div>

</div>
