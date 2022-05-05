<?php $__env->startSection('header_scripts'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.partials.breadcrumbs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.partials.subheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div class="card mb-g">
	<div class="card-body">

		<div class="frame-wrap p-0 border-0 m-0 table-responsive">

			<table class="table table-bordered table-striped w-100 datatable" cellspacing="0" width="100%">
				<thead>
					<tr>

						<th><?php echo e(getPhrase('title')); ?></th>
						<th><?php echo e(getPhrase('duration')); ?></th>
						<th>Максимальный % прохождения</th>
						<th>Использованные попытки</th>

					</tr>
				</thead>

			</table>
		</div>
	</div>
</div>


<?php $__env->stopSection(); ?>

 



<?php $__env->startSection('footer_scripts'); ?>

  

 <?php echo $__env->make('common.datatables-parent', array('route'=>URL_STUDENT_EXAM_ANALYSIS_BYEXAM.$user->slug, 'route_as_url' => 'TRUE'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>









<?php $__env->stopSection(); ?>


<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>