<ul id="js-nav-menu" class="nav-menu">
  <li class="<?php echo e(Request::is('dashboard') ? 'active' : ''); ?>">
    <a href="<?php echo e(PREFIX); ?>" title="<?php echo e(getPhrase('dashboard')); ?> "
      data-filter-tags="<?php echo e(getPhrase('dashboard')); ?>  dashboard">
      <i class="fal fa-dharmachakra"></i>
      <span class="nav-link-text"
        data-i18n="nav.application_intel_analytics_dashboard"><?php echo e(getPhrase('dashboard')); ?> </span>
    </a>
  </li>

  <li class="nav-title">Школа</li>

  <li class="<?php echo e(Request::url() == url(URL_STUDENT_ANALYSIS_BY_EXAM.Auth::user()->slug) ? 'active' : ''); ?>">
    <a href="<?php echo e(URL_STUDENT_ANALYSIS_BY_EXAM.Auth::user()->slug); ?>" title="Опросники" data-filter-tags="Опросники">
      <i class="fal fa-window"></i>
      <span class="nav-link-text" data-i18n="nav.ui_components">Опросники</span>
    </a>
  </li>
  <li class="<?php echo e(Request::url() == url('/analysis/lms-points/'.Auth::user()->slug) ? 'active' : ''); ?>">
    <a href="/analysis/lms-points/<?php echo e(Auth::user()->slug); ?>" title="Видео" data-filter-tags="Видео">
      <i class="fal fa-video"></i>
      <span class="nav-link-text" data-i18n="nav.ui_components">Видео</span>
    </a>
  </li>
  <li class="<?php echo e(Request::url() == url('/analysis/all-points/'.Auth::user()->slug) ? 'active' : ''); ?>">
    <a href="/analysis/all-points/<?php echo e(Auth::user()->slug); ?>" title="Кредит-часы" data-filter-tags="Кредит-часы">
      <i class="fal fa-clock"></i>
      <span class="nav-link-text" data-i18n="nav.ui_components">Кредит-часы</span>
    </a>
  </li>	

  <?php if(!checkRole(getUserGrade(5))): ?>
  <li class="<?php echo e(Request::url() == url(URL_PARENT_CHILDREN) ? 'active' : ''); ?>">
    <a href="<?php echo e(URL_PARENT_CHILDREN); ?>" title="<?php echo e(getPhrase('children')); ?>" data-filter-tags="<?php echo e(getPhrase('children')); ?>">
      <i class="fal fa-user"></i>
      <span class="nav-link-text" data-i18n="nav.ui_components"><?php echo e(getPhrase('children')); ?></span>
    </a>
  </li>	
	<?php endif; ?>
  				
</ul>