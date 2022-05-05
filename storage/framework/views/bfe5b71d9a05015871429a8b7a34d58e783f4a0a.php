<?php $__env->startSection('content'); ?>



    <div id="page-wrapper">

        <div class="container-fluid">

            <div class="row">

                <div class="col-lg-12">

                    <ol class="breadcrumb">


                        <li><?php echo e($title); ?></li>

                    </ol>

                </div>

            </div>
            <div class="row">

    <div class="col-md-12 col-sm-12">
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-striped table-hover text-center"
                   style="background-color:#fff;">
                <caption>Видео</caption>
                <thead style="background-color: #438afe; color:#ffffff;">
                <tr>
                    <td>
                        #
                    </td>
                    <td>
                        Категория
                    </td>
                    <td>
                        Название
                    </td>
                    <td>
                        Дата начала
                    </td>
                    <td>
                        Дата окончания
                    </td>
                    <td>
                        Баллы
                    </td>
                    <td>
                        Действия
                    </td>
                </tr>
                </thead>
                <tbody>
                <?php if($user_settings['lms'] ?? null): ?>
                    <?php $__currentLoopData = $user_settings['lms']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lms): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <img src="/public/uploads/lms/series/<?php echo e($lms['image']); ?>" alt="" width="50px">
                            </td>
                            <td>
                                <?php echo e($lms['category']); ?>

                            </td>
                            <td>
                                <?php echo e($lms['name']); ?>

                            </td>
                            <td>
                                <?php echo e($lms['start_date']); ?>

                            </td>
                            <td>
                                <?php echo e($lms['end_date']); ?>

                            </td>
                            <td>
                                <?php echo e($lms['points']); ?>

                            </td>
                            <td>
                                <a href="/learning-management/series/<?php echo e($lms['slug_series']); ?>/<?php echo e($lms['slug_content']); ?>">Смотреть</a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <tr>
                        <td>Тут пока пусто</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-md-12 col-sm-12">
        <div class="table-responsive">
            <table class="table table-hover table-bordered table-striped table-hover text-center"
                   style="background-color:#fff;">
                <caption>Опросники</caption>
                <thead style="background-color: #438afe; color:#ffffff;">
                <tr>
                    <td>
                        #
                    </td>
                    <td>
                        Категория
                    </td>
                    <td>
                        Название
                    </td>
                    <td>
                        Дата начала
                    </td>
                    <td>
                        Дата окончания
                    </td>
                    <td>
                        Баллы
                    </td>
                    <td>
                        Действия
                    </td>
                </tr>
                </thead>
                <tbody>
                <?php if($user_settings['quiz'] ?? null): ?>
                    <?php $__currentLoopData = $user_settings['quiz']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $quiz): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <img src="/public/uploads/exams/categories/<?php echo e($quiz['image']); ?>" alt="" width="50px">
                            </td>
                            <?php if($key == 2): ?>
                                <td>
                                    <?php echo e($quiz['category']); ?>

                                </td>
                            <?php else: ?>
                                <td>
                                    <?php echo e($quiz['category']); ?>

                                </td>
                            <?php endif; ?>
                            <td>
                                <?php echo e($quiz['name']); ?>

                            </td>
                            <td>
                                <?php echo e($quiz['start_date']); ?>

                            </td>
                            <td>
                                <?php echo e($quiz['end_date']); ?>

                            </td>
                            <td>
                                <?php echo e($quiz['points']); ?>

                            </td>
                            <td>
                                <a href="/exams/student/quiz/take-exam/<?php echo e($quiz['slug']); ?>">Пройти</a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <tr>
                        <td>Тут пока пусто</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>


    </div>

    <!-- /#page-wrapper -->



<?php $__env->stopSection(); ?>



<?php $__env->startSection('footer_scripts'); ?>



<?php $__env->stopSection(); ?>
<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>