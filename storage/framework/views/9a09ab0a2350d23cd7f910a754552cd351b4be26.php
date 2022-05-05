
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
            <th><?php echo e(getPhrase('exams')); ?></th>
            <th>Осталось попыток</th>
            <th><?php echo e(getPhrase('action')); ?></th>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <th><?php echo e(getTitleAttempts($arr->quizzes_id)->title); ?></th>
            <th><?php echo e($arr->attempts); ?></th>
            <th>
              <div class="col text-center">
								<div class="btn-group">
									<button type="button" class="btn btn-xs btn-success btn-icon rounded waves-effect waves-themed"
										data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fal fa-cog"></i>
									</button>
									<div class="dropdown-menu">
										<a class="dropdown-item" href="<?php echo e(URL_USERS_ADD_ATTEMPTS.$arr->id.'/'.$user->slug); ?>"><i
                          class="fal fa-pencil"></i> <?php echo e(getPhrase("edit_attempts")); ?></a>
									</div>
								</div>
							</div>
            </th>
          </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>