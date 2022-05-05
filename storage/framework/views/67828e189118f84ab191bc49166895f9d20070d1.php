
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
				<a href="<?php echo e(URL_QUIZ_CATEGORY_ADD); ?>" type="button"	class="btn btn-primary waves-effect waves-themed">Добавить категорию</a>
			</div>
		</div>
		<div class="frame-wrap p-0 border-0 m-0 table-responsive">

			<table class="table table-bordered table-striped w-100 datatable" cellspacing="0" width="100%">
				<thead>
					<tr>

						<th><?php echo e(getPhrase('category')); ?></th>
						<th><?php echo e(getPhrase('image')); ?></th>
						<th><?php echo e(getPhrase('description')); ?></th>
						<th><?php echo e(getPhrase('action')); ?></th>

					</tr>
				</thead>

			</table>
		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>
 

<?php $__env->startSection('footer_scripts'); ?>  
 <?php echo $__env->make('common.datatables', array('route'=>'quizcategories.dataTable'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 <?php echo $__env->make('common.deletescript', array('route'=>URL_QUIZ_CATEGORY_DELETE), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.adminlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>