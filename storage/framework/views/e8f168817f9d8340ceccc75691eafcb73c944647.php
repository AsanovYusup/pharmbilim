<?php 
	$questions 	= $data['questions'];
	$quiz 		= $data['quiz'];
	if(isset($data['current_state']))
    $cState     = $data['current_state'];

 ?>
<div class="panel-heading">
					<h2>Time Status</h2>
				</div>
				<div class="panel-body">
				 
					<div id="timerdiv" class="countdown-styled ">
						<span id="hours"><?php echo e($data['time_hours']); ?></span> : 
						<span id="mins"><?php echo e($data['time_minutes']); ?></span> : 
						<span id="seconds">00</span>

					</div>
					 
				</div>
				<div class="panel-heading countdount-heading">
					<h2><?php echo e(getPhrase('total_time')); ?> <span class="pull-right"><?php echo e($data['atime_hours']); ?>:<?php echo e($data['atime_minutes']); ?>:00</span></h2>
				</div>


				 	<div class="panel-body">
					<div class="sub-heading">
						<h3><?php echo e($quiz->title); ?></h3>
						<p><?php echo e(ucfirst($quiz->category->category) .' '. getPhrase('category')); ?></p>
					</div>
					<ul class="question-palette" id="pallete_list">
						<?php for($i=0; $i<count($questions); $i++): ?>

						<?php 
								$default_class = 'not-visited';
								if(isset($cState) && $cState) {
								if(array_key_exists($questions[$i]->id, $cState))
									$default_class = 'answered';
							}
						?>

						<li  class="palette pallete-elements <?php echo e($default_class); ?>" onclick="showSpecificQuestion(<?php echo e($i); ?>);">
						<span><?php echo e($i+1); ?></span>
						</li>

						<?php endfor; ?>
					</ul>
				</div>
				<hr>
				<div class="panel-heading">
					<h2><?php echo e(getPhrase('summary')); ?></h2>
				</div>
				<div class="panel-body">
					<ul class="legends">
						<li  class="palette answered"><span id="palette_total_answered">1</span> <?php echo e(getPhrase('answered')); ?></li>
						<li  class="palette marked"><span id="palette_total_marked">2</span> <?php echo e(getPhrase('marked')); ?></li>
						<li  class="palette not-answered"><span id="palette_total_not_answered">3</span> <?php echo e(getPhrase('not_answered')); ?></li>
						<li  class="palette not-visited"><span id="palette_total_not_visited">4</span> <?php echo e(getPhrase('not_visited')); ?></li>
					</ul>
				</div>
