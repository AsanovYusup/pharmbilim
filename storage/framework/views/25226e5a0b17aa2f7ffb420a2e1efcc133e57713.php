<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.partials.breadcrumbs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.partials.subheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('errors.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php
$user_options = null;
if($record->settings)
$user_options = json_decode($record->settings)->user_preferences;

?>



	<?php
	$button_name = getPhrase('update');
	?>
	<?php echo e(Form::model($record, 
						array('url' => URL_USERS_SETTINGS.$record->slug, 
						'method'=>'patch',
						'novalidate'=>'',
						'name'=>'formUsers ', 
						'files'=>'true' ))); ?>

<div class="row">
	<div class="col-xl-6">
		<div id="panel-1" class="panel">
			<div class="panel-hdr">
				<h2>
					<?php echo e(getPhrase('quiz_and_exam_series')); ?>

				</h2>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<div class="panel-tag">
						Выберите <code><?php echo e(getPhrase('quiz_and_exam_series')); ?></code>
					</div>
					<div class="row">
						<?php $__currentLoopData = $quiz_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php
						$checked = '';
						if($user_options) {
						if(count($user_options->quiz_categories))
						{
						if(in_array($category->id,$user_options->quiz_categories))
						$checked='checked';
						}
						}
						?>

						<div class="col-md-6 mt-4">
							<div class="custom-control custom-switch">
								<input type="checkbox" class="custom-control-input" id="quiz_categories[<?php echo e($category->id); ?>]"
									name="quiz_categories[<?php echo e($category->id); ?>]" <?php echo e($checked); ?>>
								<label class="custom-control-label"
									for="quiz_categories[<?php echo e($category->id); ?>]"><?php echo e($category->category); ?></label>
							</div>
						</div>

						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-6">
		<div id="panel-2" class="panel">
			<div class="panel-hdr">
				<h2>
					<?php echo e(getPhrase('lms')); ?>

				</h2>
			</div>
			<div class="panel-container show">
				<div class="panel-content">
					<div class="panel-tag">
						Выберите <code><?php echo e(getPhrase('lms')); ?></code>
					</div>
					<div class="row">
						<?php $__currentLoopData = $lms_category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php
						$checked = '';
						if($user_options) {
						if(count($user_options->lms_categories))
						{
						if(in_array($category->id,$user_options->lms_categories))
						$checked='checked';
						}
						}
						?>

						<div class="col-md-6 mt-4">
							<div class="custom-control custom-switch">
								<input type="checkbox" class="custom-control-input" id="lms_categories[<?php echo e($category->id); ?>]"
									name="lms_categories[<?php echo e($category->id); ?>]" <?php echo e($checked); ?>>
								<label class="custom-control-label"
									for="lms_categories[<?php echo e($category->id); ?>]"><?php echo e($category->category); ?></label>
							</div>
						</div>

						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-12">
		<button class="btn btn-lg btn-success button"><?php echo e(getPhrase('update')); ?></button>
	</div>
</div>

<?php echo Form::close(); ?>


<?php $__env->stopSection(); ?>



<?php $__env->startSection('footer_scripts'); ?>

<?php echo $__env->make('common.validations', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;

<script src="<?php echo e(JS); ?>bootstrap-toggle.min.js"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>