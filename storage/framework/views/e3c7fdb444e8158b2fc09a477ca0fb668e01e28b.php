
<?php $__env->startSection('content'); ?>


<div class="row" ng-app="academia">
	<div class="col-xl-12">
		<?php echo $__env->make('errors.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<div id="panel-1" class="panel">
				<div class="panel-hdr">
						<h2>
								<?php echo e($title); ?>

						</h2>
				</div>
				<div class="panel-container show">
						<div class="panel-content">
								<?php
										$button_name = getPhrase('create');
								?>

								<?php if($record): ?>

								<?php
										$button_name = getPhrase('update');
								?>
									<?php echo e(Form::model($record, 
									array('url' => URL_QUIZ_EDIT.'/'.$record->slug, 
									'method'=>'patch', 'files' => true, 'name'=>'formQuiz ', 'novalidate'=>'','files'=>TRUE))); ?>

								<?php else: ?>
									<?php echo Form::open(array('url' => URL_QUIZ_ADD, 'method' => 'POST', 'files' => true, 'name'=>'formQuiz ', 'novalidate'=>'','files'=>TRUE)); ?>

								<?php endif; ?>

								<?php echo $__env->make('exams.quiz.form_elements', 
								array('button_name'=> $button_name),
								array(	'categories' 		=> $categories,
										'instructions' 		=> $instructions,
										'record'			=> $record,					 		
										'exam_types'			=> $exam_types
										), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>					 		

								<?php echo Form::close(); ?>

						</div>
				</div>
		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
<?php echo $__env->make('common.validations', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startPush('custom_styles'); ?>
		<link rel="stylesheet" media="screen, print" href="<?php echo e(themes('css/formplugins/bootstrap-datepicker/bootstrap-datepicker.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('custom-scripts'); ?>
		
		<script src="<?php echo e(themes('js/formplugins/bootstrap-datepicker/bootstrap-datepicker.js')); ?>"></script>
		<script>
			$('.input-daterange').datepicker({
					autoclose: true,
					startDate: "0d",
						format: '<?php echo e(getDateFormat()); ?>',
			});
		</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

 

 
<?php echo $__env->make('layouts.admin.adminlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>