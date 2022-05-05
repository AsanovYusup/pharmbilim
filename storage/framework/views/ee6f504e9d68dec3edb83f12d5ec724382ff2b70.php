<?php $__env->startSection('header_scripts'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.partials.breadcrumbs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.partials.subheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div class="row">
	<div class="col-lg-7 col-xl-7 order-lg-1 order-xl-1">
			<!-- profile summary -->
			<div class="card mb-g rounded-top">
					<div class="row no-gutters row-grid">
							<div class="col-12">
									<div class="d-flex flex-column align-items-center justify-content-center p-4">
											<img src="<?php echo e(getProfilePath($record->image,'profile')); ?>" alt="<?php echo e($record->name); ?>" class="rounded-circle shadow-2 img-thumbnail" >
											<h5 class="mb-0 fw-700 text-center mt-3">
													<?php echo e($record->name); ?>

													<small class="text-muted mb-0"><?php echo e($record->region); ?></small>
											</h5>
											<div class="mt-4 text-center demo">
													<a href="tel:+996<?php echo e($record->phone); ?>" class="fs-xl" style="color:#3b5998">
															<i class="fal fa-phone"></i>
													</a>
													<?php
															$whats_num = substr($record->whatsapp_phone, -9);
													?>
													<a href="https://api.whatsapp.com/send?phone=996<?php echo e($whats_num); ?>" class="fs-xl" style="color: #075e54">
															<i class="fab fa-whatsapp"></i>
													</a>
													<a href="mailto:<?php echo e($record->email); ?>" class="fs-xl">
															<i class="fal fa-envelope"></i>
													</a>												
											</div>
									</div>
							</div>
							<div class="col-6">
									<div class="text-center py-3">
											<h5 class="mb-0 fw-700">
													<?php echo e(date('j.m.Y', strtotime($record->created_at))); ?>

													<small class="text-muted mb-0">Дата регистрации</small>
											</h5>
									</div>
							</div>
							<div class="col-6">
									<div class="text-center py-3">
											<h5 class="mb-0 fw-700">
													<?php echo e($record->points); ?>

													<small class="text-muted mb-0">Кредит-часы</small>
											</h5>
									</div>
							</div>
							
					</div>
			</div>


	</div>
	<div class="col-lg-5 col-xl-5 order-lg-1 order-xl-1">
		<div class="card mb-2">
					<div class="card-body">
							<a href="<?php echo e(URL_STUDENT_EXAM_ATTEMPTS.$record->slug); ?>" class="d-flex flex-row align-items-center">
									<div class="icon-stack display-3 flex-shrink-0">
											<i class="fal fa-circle icon-stack-3x opacity-100 color-primary-400"></i>
											<i class="fas fa-graduation-cap icon-stack-1x opacity-100 color-primary-500"></i>
									</div>
									<div class="ml-3">
											<strong>
													<?php echo e(getPhrase('История эксзаменов')); ?>

											</strong>
											<br>
											Вы можете посмотреть вашу историю экзаменов											
									</div>
							</a>
					</div>
			</div>
			<div class="card mb-2">
					<div class="card-body">
							<a href="<?php echo e('/analysis/lms-points/'.$record->slug); ?>" class="d-flex flex-row align-items-center">
									<div class="icon-stack display-3 flex-shrink-0">
											<i class="fal fa-circle icon-stack-3x opacity-100 color-success-400"></i>
											<i class="fas fa-chart-line icon-stack-1x opacity-100 color-success-500"></i>
									</div>
									<div class="ml-3">
											<strong>
													<?php echo e(getPhrase('Анализ видео')); ?>

											</strong>
											<br>
											Сделайте анализ по всем просмотренным видео урокам и вебинарам										
									</div>
							</a>
					</div>
			</div>
			<div class="card mb-2">
					<div class="card-body">
							<a href="<?php echo e(URL_STUDENT_ANALYSIS_BY_EXAM.$record->slug); ?>" class="d-flex flex-row align-items-center">
									<div class="icon-stack display-3 flex-shrink-0">
											<i class="fal fa-circle icon-stack-3x opacity-100 color-warning-400"></i>
											<i class="fas fa-question icon-stack-1x opacity-100 color-warning-500"></i>
									</div>
									<div class="ml-3">
											<strong>
													<?php echo e(getPhrase('by_exam')); ?>

											</strong>
											<br>
											Сделайте анализ по всем опросникам и использаванным попыткам.											
									</div>
							</a>
					</div>
			</div>
			<div class="card mb-2">
					<div class="card-body">
							<a href="<?php echo e('/analysis/all-points/'.$record->slug); ?>" class="d-flex flex-row align-items-center">
									<div class="icon-stack display-3 flex-shrink-0">
											<i class="fal fa-circle icon-stack-3x opacity-100 color-warning-400"></i>
											<i class="fas fa-user-clock icon-stack-1x opacity-100 color-warning-500"></i>
									</div>
									<div class="ml-3">
											<strong>
													<?php echo e(getPhrase('Кредитные часы')); ?>

											</strong>
											<br>
											Ваши кредитные часы которые вы можете потратить, на обучение в будущем.											
									</div>
							</a>
					</div>
			</div>
	</div>
</div>

<?php if(checkRole(getUserGrade(7))): ?>
<div class="card mb-g">	
	<div class="card-body">					
				<div class="frame-wrap p-0 border-0 m-0 table-responsive">

					<table class="table m-0 table-bordered table-sm table-striped datatable compact hover" cellspacing="0" width="100%">
								<thead>
										<tr>
												<th><?php echo e(getPhrase('name')); ?></th>
												<th><?php echo e(getPhrase('phone')); ?></th>
												<th><?php echo e(getPhrase('image')); ?></th>			 
												<th><?php echo e(getPhrase('action')); ?></th>
										</tr>
								</thead>

						</table>
				</div>
		</div>
</div>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php
		$url = URL_PARENT_CHILDREN_GETLIST_DETAILS.$user->slug;
?>

<?php $__env->startSection('footer_scripts'); ?>
<?php echo $__env->make('common.datatables', array('route'=>$url, 'route_as_url' => TRUE), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>