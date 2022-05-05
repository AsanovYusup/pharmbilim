
<?php $__env->startSection('header_scripts'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.partials.breadcrumbs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.partials.subheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div class="card mb-g">
	<div class="card-body">
		<div class="card-header bg-white d-flex align-items-center">
			<h4 class="m-0">
				Опции
				
			</h4>
			<div class="ml-auto">
				<div class="btn-group btn-group-sm">
					<a href="<?php echo e(URL_QUIZ_ADD); ?>" type="button"
						class="btn btn-primary waves-effect waves-themed"><?php echo e(getPhrase('create')); ?></a>
					<a href="<?php echo e(URL_EXAM_SERIES); ?>" type="button"
						class="btn btn-primary waves-effect waves-themed"><?php echo e(getPhrase('create_series')); ?></a>
				</div>
			</div>
		</div>
		<div class="frame-wrap p-0 border-0 m-0 table-responsive">

			<table class="table table-bordered table-striped w-100 datatable" cellspacing="0" width="100%">
				<thead>
					<tr>

						<th><?php echo e(getPhrase('title')); ?></th>
						<th><?php echo e(getPhrase('duration')); ?></th>
						<th><?php echo e(getPhrase('category')); ?></th>
						<th><?php echo e(getPhrase('is_paid')); ?></th>
						<th><?php echo e(getPhrase('total_marks')); ?></th>
						<th><?php echo e(getPhrase('action')); ?></th>

					</tr>
				</thead>

			</table>
		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
<?php $__env->startPush('custom-scripts'); ?>
<script>
	function copy(argument) {
			var dummyContent = '/exams/student/quiz/take-exam/' + argument;
		var dummy = $('<input>').val(dummyContent).attr('id', 'clipboard').appendTo('body').select();
		document.execCommand('copy');
		$('#clipboard').remove();
	}
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('common.datatables', array('route'=>URL_QUIZ_GETLIST, 'route_as_url' => TRUE), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('common.deletescript', array('route'=>URL_QUIZ_DELETE), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin.adminlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>