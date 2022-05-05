<div class="row mb-5">  
<?php
    $options = json_decode($question->answers); 
    $correct_answers = $question->correct_answers;
    $index = 1;

?>
<?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $submitted_value = '';                                            
        if($user_answers && count($user_answers))  {                                                    
            if($user_answers[0] == $index)
                $submitted_value = 'checked';
        }

    ?>
        <div class="col-md-3">
            <div class="custom-control custom-checkbox">
                <?php if(isset($user_answers[0]) && $correct_answers == $index && $correct_answers == $user_answers[0]): ?>
                    <input type="checkbox" class="custom-control-input is-valid" id="<?php echo e($question_number); ?>-<?php echo e($index); ?>" <?php echo e($submitted_value); ?> disabled>
                    <label class="custom-control-label text-success" for="<?php echo e($question_number); ?>-<?php echo e($index); ?>"><?php echo $option->option_value; ?></label>
                <?php elseif(isset($user_answers[0]) && $correct_answers !== $index && $user_answers[0] == $index): ?>
                    <input type="checkbox" class="custom-control-input is-invalid" id="<?php echo e($question_number); ?>-<?php echo e($index); ?>" <?php echo e($submitted_value); ?> disabled>
                    <label class="custom-control-label text-danger" for="<?php echo e($question_number); ?>-<?php echo e($index); ?>"><?php echo $option->option_value; ?></label>
                <?php else: ?>
                    <input type="checkbox" class="custom-control-input" id="<?php echo e($question_number); ?>-<?php echo e($index); ?>" disabled>
                    <label class="custom-control-label" for="<?php echo e($question_number); ?>-<?php echo e($index); ?>"><?php echo $option->option_value; ?></label>
                <?php endif; ?>
            </div>
        </div>
    <?php
        $index++;
    ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>