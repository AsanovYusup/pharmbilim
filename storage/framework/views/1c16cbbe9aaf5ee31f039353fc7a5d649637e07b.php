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
					<a href="<?php echo e(URL_USERS_IMPORT); ?>" type="button"
						class="btn btn-primary waves-effect waves-themed"><?php echo e(getPhrase('import_excel')); ?></a>
					<a href="users/export" type="button"
						class="btn btn-primary waves-effect waves-themed"><?php echo e(getPhrase('export_excel')); ?></a>
					<a href="<?php echo e(URL_USERS_ADD); ?>" type="button"
						class="btn btn-primary waves-effect waves-themed"><?php echo e(getPhrase('add_user')); ?></a>
				</div>
			</div>
		</div>
		<div class="frame-wrap p-0 border-0 m-0 table-responsive">

			<table class="table table-bordered table-striped w-100 datatable" cellspacing="0" width="100%">
				<thead>
					<tr>

						<th><?php echo e(getPhrase('action')); ?></th>

						<th><?php echo e(getPhrase('ФИО')); ?></th>

						<th><?php echo e(getPhrase('date')); ?></th>

						<th><?php echo e(getPhrase('phone')); ?></th>

						<th><?php echo e(getPhrase('company')); ?></th>

						<th><?php echo e(getPhrase('Специальность')); ?></th>

						<th><?php echo e(getPhrase('region_name')); ?></th>

						<th><?php echo e(getPhrase('pharm')); ?></th>

						<th><?php echo e(getPhrase('parent')); ?></th>

						<th><?php echo e(getPhrase('role')); ?></th>

						<th><?php echo e(getPhrase('status')); ?></th>

						<th>ID</th>

					</tr>
				</thead>

			</table>
		</div>
	</div>
</div>


<?php $__env->stopSection(); ?>



<?php $__env->startSection('footer_scripts'); ?>

<?php echo $__env->make('common.datatable-users', array('route'=>'users.dataTable'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('common.deletescript', array('route'=>URL_USERS_DELETE), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<?php echo $__env->make('common.account-status', array('route'=>URL_USERS_STATUS), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>