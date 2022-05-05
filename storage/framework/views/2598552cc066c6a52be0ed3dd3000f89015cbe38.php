<div class="subject-sidebar" id="subjectSidebar" >

			<div class="panel panel-custom">

				<div class="panel-heading">

					<h2 class="text-uppercase subject-title"> <i class="icon-school-hub"></i> <?php echo e(getPhrase('subjects')); ?> </h2>

				</div>

				<div class="panel-body subject-list-box">

					<ul>

					<?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

						<li onclick="showSubjectQuestion('subject_<?php echo e($r->id); ?>');">

							<a href="javascript:void(0);">

								<i class="icon icon-folders"></i>

								<h6><?php echo e($r->subject_title); ?></h6>

								

							</a>

						</li>

					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

						 

						 

					</ul>

				</div>

			</div>

		</div>