
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
                        <th>Название</th>
                        <th>Тип</th>
                        <th>Кол-во просмотр. минут</th>
                        <th>Кредит-часы</th>
					</tr>
                </thead>
                
                <?php if($record): ?>
                    <?php $__currentLoopData = $record; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tbody>
                            <tr>
                                <td><?php echo e($rec->name); ?></td>
                                <td><?php echo e($rec->type); ?></td>
                                <td><?php echo e($rec->time); ?></td>
                                <td><span class="label label-success">+<?php echo e($rec->points); ?></span></td>

                            </tr>
                        </tbody>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

			</table>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>