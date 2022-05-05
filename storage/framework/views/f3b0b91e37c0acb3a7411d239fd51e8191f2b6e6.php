<?php echo $__env->make('layouts.partials.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				
		<div class="page-wrapper">
            <div class="page-inner">
                <!-- BEGIN Left Aside -->
                <aside class="page-sidebar">
                    <div class="page-logo">
                        <a href="<?php echo e(URL_HOME); ?>" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
                            <img src="<?php echo e(IMAGE_PATH_SETTINGS.getSetting('site_logo', 'site_settings')); ?>" alt="<?php echo e(getSetting('site_title','site_settings')); ?>" aria-roledescription="logo">
                            <span class="page-logo-text mr-1"><?php echo e(getSetting('site_title','site_settings')); ?></span>
                            <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
                            <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
                        </a>
                    </div>
                    <!-- BEGIN PRIMARY NAVIGATION -->
                    <nav id="js-primary-nav" class="primary-nav" role="navigation">
                        <div class="nav-filter">
                            <div class="position-relative">
                                <input type="text" id="nav_filter_input" placeholder="Filter menu" class="form-control" tabindex="0">
                                <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                                    <i class="fal fa-chevron-up"></i>
                                </a>
                            </div>
												</div>	

                        <div class="info-card">
                            <img src="<?php echo e(getProfilePath(Auth::user()->image, 'thumb')); ?>" class="profile-image rounded-circle" alt="<?php echo e(Auth::user()->name); ?>">
                            <div class="info-card-text">
                                <a href="#" class="d-flex align-items-center text-white">
                                    <span class="text-truncate text-truncate-sm d-inline-block">
																				<?php if(Auth::check()): ?>
																					<?php echo e(Auth::user()->name); ?>

																				<?php endif; ?>                                        
                                    </span>                                    
                                </a>
                                <span class="d-inline-block text-truncate text-truncate-sm"><?php echo e(Auth::user()->region); ?></span>
                            </div>
                            <img src="<?php echo e(themes('img/card-backgrounds/cover-2-lg.png')); ?>" class="cover" alt="cover">
                            <a href="#" onclick="return false;" class="pull-trigger-btn" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
                                <i class="fal fa-angle-down"></i>
                            </a>
                        </div>
                        <ul id="js-nav-menu" class="nav-menu">
                            <li <?php echo e(isActive($active_class, 'dashboard')); ?>>
                                <a href="<?php echo e(PREFIX); ?>" title="<?php echo e(getPhrase('dashboard')); ?> " data-filter-tags="<?php echo e(getPhrase('dashboard')); ?>  dashboard">
                                    <i class="fal fa-dharmachakra"></i>
                                    <span class="nav-link-text" data-i18n="nav.application_intel_analytics_dashboard"><?php echo e(getPhrase('dashboard')); ?> </span>
                                </a>
                            </li>

                            <li class="nav-title">Школа</li>

                            <li class="active open">
                                <a href="#" title="<?php echo e(getPhrase('users')); ?>" data-filter-tags="<?php echo e(getPhrase('users')); ?>">
                                    <i class="fal fa-users"></i>
                                    <span class="nav-link-text" data-i18n="nav.theme_settings"><?php echo e(getPhrase('users')); ?></span>
                                </a>
                                <ul>
                                    <li <?php echo e(isActive($active_class, 'users')); ?>>
                                        <a href="<?php echo e(URL_USERS); ?>" title="<?php echo e(getPhrase('users')); ?>" data-filter-tags="<?php echo e(getPhrase('users')); ?>">
                                            <span class="nav-link-text" data-i18n="nav.theme_settings_how_it_works"><?php echo e(getPhrase('users')); ?></span>
                                        </a>
                                    </li>
                                    <li <?php echo e(isActive($active_class, 'users-unsort')); ?>>
                                        <a href="<?php echo e(URL_USERS_UNSORTED); ?>" title="<?php echo e(getPhrase('users_unsorted')); ?>" data-filter-tags="<?php echo e(getPhrase('users_unsorted')); ?>">
                                            <span class="nav-link-text" data-i18n="nav.theme_settings_layout_options"><?php echo e(getPhrase('users_unsorted')); ?></span>
                                        </a>
                                    </li>
                                    <li <?php echo e(isActive($active_class, 'users-region')); ?>>
                                        <a href="<?php echo e(URL_USERS_REGION); ?>" title="<?php echo e(getPhrase('company_region_pharm')); ?>" data-filter-tags="<?php echo e(getPhrase('company_region_pharm')); ?>">
                                            <span class="nav-link-text" data-i18n="nav.theme_settings_theme_modes_(beta)"><?php echo e(getPhrase('company_region_pharm')); ?></span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li <?php echo e(isActive($active_class, 'exams')); ?> > 
                                <a href="#" title="<?php echo e(getPhrase('exams')); ?>" data-filter-tags="<?php echo e(getPhrase('exams')); ?>">
                                    <i class="fal fa-window"></i>
                                    <span class="nav-link-text" data-i18n="nav.ui_components"><?php echo e(getPhrase('exams')); ?></span>
                                </a>
                                <ul>
                                    <li>
                                        <a href="<?php echo e(URL_QUIZ_CATEGORIES); ?>" title="<?php echo e(getPhrase('categories')); ?>" data-filter-tags="<?php echo e(getPhrase('categories')); ?>">
                                            <span class="nav-link-text" data-i18n="nav.ui_components_alerts"><?php echo e(getPhrase('categories')); ?></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(URL_QUIZZES); ?>" title="<?php echo e(getPhrase('quiz')); ?>" data-filter-tags="<?php echo e(getPhrase('quiz')); ?>">
                                            <span class="nav-link-text" data-i18n="nav.ui_components_accordions"><?php echo e(getPhrase('quiz')); ?></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(URL_EXAM_SERIES); ?>" title="<?php echo e(getPhrase('exam_series')); ?>" data-filter-tags="<?php echo e(getPhrase('exam_series')); ?>">
                                            <span class="nav-link-text" data-i18n="nav.ui_components_badges"><?php echo e(getPhrase('exam_series')); ?></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(URL_QUIZ_QUESTIONBANK); ?>" title="<?php echo e(getPhrase('question_bank')); ?>" data-filter-tags="<?php echo e(getPhrase('question_bank')); ?>">
                                            <span class="nav-link-text" data-i18n="nav.ui_components_breadcrumbs"><?php echo e(getPhrase('question_bank')); ?></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(URL_INSTRUCTIONS); ?>" title="<?php echo e(getPhrase('instructions')); ?>" data-filter-tags="<?php echo e(getPhrase('instructions')); ?>s">
                                            <span class="nav-link-text" data-i18n="nav.ui_components_buttons"><?php echo e(getPhrase('instructions')); ?></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(URL_MASTERSETTINGS_SUBJECTS); ?>" title="<?php echo e(getPhrase('subjects_master')); ?>" data-filter-tags="<?php echo e(getPhrase('subjects_master')); ?>">
                                            <span class="nav-link-text" data-i18n="nav.ui_components_button_group"><?php echo e(getPhrase('subjects_master')); ?></span>
                                        </a>
                                    </li>                                    
                                </ul>
														</li>
														
                            <li <?php echo e(isActive($active_class, 'lms')); ?> > 
                                <a href="#" title="<?php echo e(getPhrase('lms')); ?>" data-filter-tags="<?php echo e(getPhrase('lms')); ?>">
                                    <i class="fal fa-bolt"></i>
                                    <span class="nav-link-text" data-i18n="nav.utilities"><?php echo e(getPhrase('lms')); ?></span>
                                </a>
                                <ul>																	
                                    <li>
                                        <a href="<?php echo e(URL_LMS_CATEGORIES); ?>" title="<?php echo e(getPhrase('categories')); ?>" data-filter-tags="<?php echo e(getPhrase('categories')); ?>">
                                            <span class="nav-link-text" data-i18n="nav.utilities_borders"><?php echo e(getPhrase('categories')); ?></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(URL_LMS_SERIES); ?>" title="<?php echo e(getPhrase('series')); ?>" data-filter-tags="<?php echo e(getPhrase('series')); ?>">
                                            <span class="nav-link-text" data-i18n="nav.utilities_clearfix"><?php echo e(getPhrase('series')); ?></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(URL_LMS_CONTENT); ?>" title="<?php echo e(getPhrase('contents')); ?>" data-filter-tags="<?php echo e(getPhrase('contents')); ?>">
                                            <span class="nav-link-text" data-i18n="nav.utilities_color_pallet"><?php echo e(getPhrase('contents')); ?></span>
                                        </a>
                                    </li>                                    
                                </ul>
														</li>
														<li <?php echo e(isActive($active_class, 'reports')); ?> >
                                <a href="#" title="<?php echo e(getPhrase('payment_reports')); ?>" data-filter-tags="font icons">
                                    <i class="fal fa-map-marker-alt"></i>
                                    <span class="nav-link-text" data-i18n="nav.font_icons"><?php echo e(getPhrase('payment_reports')); ?></span>                                    
                                </a>
                                <ul>
                                    <li>
                                        <a href="<?php echo e(URL_ONLINE_PAYMENT_REPORTS); ?>" title="<?php echo e(getPhrase('online_payments')); ?>" data-filter-tags="<?php echo e(getPhrase('online_payments')); ?>">
                                            <span class="nav-link-text" data-i18n="nav.font_icons_fontawesome"><?php echo e(getPhrase('online_payments')); ?></span>
                                        </a>                                        
                                    </li>
                                    <li>
                                        <a href="<?php echo e(URL_OFFLINE_PAYMENT_REPORTS); ?>" title="<?php echo e(getPhrase('offline_payments')); ?>" data-filter-tags="<?php echo e(getPhrase('offline_payments')); ?>">
                                            <span class="nav-link-text" data-i18n="nav.font_icons_nextgen_icons"><?php echo e(getPhrase('offline_payments')); ?></span>
                                        </a>                                        
                                    </li>
                                    <li>
                                        <a href="<?php echo e(URL_PAYMENT_REPORT_EXPORT); ?>" title="<?php echo e(getPhrase('export')); ?>" data-filter-tags="<?php echo e(getPhrase('export')); ?>">
                                            <span class="nav-link-text" data-i18n="nav.font_icons_stack_icons"><?php echo e(getPhrase('export')); ?></span>
                                        </a>
                                    </li>
                                </ul>
														</li>

														<li <?php echo e(isActive($active_class, 'coupons')); ?> >
                                <a href="#" title="<?php echo e(getPhrase('coupons')); ?>" data-filter-tags="<?php echo e(getPhrase('coupons')); ?>">
                                    <i class="fal fa-th-list"></i>
                                    <span class="nav-link-text" data-i18n="nav.tables"><?php echo e(getPhrase('coupons')); ?></span>
                                </a>
                                <ul>
                                    <li>
                                        <a href="<?php echo e(URL_COUPONS); ?>" title="<?php echo e(getPhrase('list')); ?>" data-filter-tags="<?php echo e(getPhrase('list')); ?>">
                                            <span class="nav-link-text" data-i18n="nav.tables_basic_tables"><?php echo e(getPhrase('list')); ?></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo e(URL_COUPONS_ADD); ?>" title="<?php echo e(getPhrase('add')); ?>" data-filter-tags="<?php echo e(getPhrase('add')); ?>e">
                                            <span class="nav-link-text" data-i18n="nav.tables_generate_table_style"><?php echo e(getPhrase('add')); ?></span>
                                        </a>
                                    </li>
                                </ul>
														</li>
														
														<li <?php echo e(isActive($active_class, 'events')); ?> >
                                <a href="<?php echo e(URL_EVENTS); ?>" title="<?php echo e(getPhrase('events')); ?>" data-filter-tags="<?php echo e(getPhrase('events')); ?>">
                                    <i class="fal fa-edit"></i>
                                    <span class="nav-link-text" data-i18n="nav.form_stuff"><?php echo e(getPhrase('events')); ?></span>
                                </a>
                            </li>														
														
														<li <?php echo e(isActive($active_class, 'trainings')); ?> >
                                <a href="<?php echo e(URL_TRAININGS); ?>" title="<?php echo e(getPhrase('trainings')); ?>" data-filter-tags="<?php echo e(getPhrase('trainings')); ?>">
                                    <i class="fal fa-shield-alt"></i>
                                    <span class="nav-link-text" data-i18n="nav.plugins"><?php echo e(getPhrase('trainings')); ?></span>
                                </a>
														</li>
														
														<li <?php echo e(isActive($active_class, 'partners')); ?> >
                                <a href="<?php echo e(URL_PARTNERS); ?>" title="<?php echo e(getPhrase('partners')); ?>" data-filter-tags="<?php echo e(getPhrase('partners')); ?>">
                                    <i class="fal fa-table"></i>
                                    <span class="nav-link-text" data-i18n="nav.datatables"><?php echo e(getPhrase('partners')); ?></span>
                                </a>
														</li>
														
														<li class="nav-title">Контент</li>

                            <li <?php echo e(isActive($active_class, 'messages')); ?> > 
                                <a href="<?php echo e(URL_MESSAGES); ?>" title="<?php echo e(getPhrase('messages')); ?>" data-filter-tags="<?php echo e(getPhrase('messages')); ?>">
                                    <i class="fal fa-chart-pie"></i>
																		<span class="nav-link-text" data-i18n="nav.statistics"><?php echo e(getPhrase('messages')); ?></span>
																		<span class="dl-ref label bg-primary-500 ml-2"><?php echo e($count = Auth::user()->newThreadsCount()); ?></span>
                                </a>                                
														</li>
                            <li <?php echo e(isActive($active_class, 'feedback')); ?> >
                                <a href="<?php echo e(URL_FEEDBACKS); ?>" title="<?php echo e(getPhrase('feedback')); ?>" data-filter-tags="<?php echo e(getPhrase('feedback')); ?>">
                                    <i class="fal fa-exclamation-circle"></i>
                                    <span class="nav-link-text" data-i18n="nav.notifications"><?php echo e(getPhrase('feedback')); ?></span>
                                </a>
                            </li>
                            <li <?php echo e(isActive($active_class, 'pages')); ?> > 
                                <a href="<?php echo e(URL_PAGES); ?>" title="<?php echo e(getPhrase('pages')); ?>" data-filter-tags="<?php echo e(getPhrase('pages')); ?>">
                                    <i class="fal fa-credit-card-front"></i>
                                    <span class="nav-link-text" data-i18n="nav.form_plugins"><?php echo e(getPhrase('pages')); ?></span>
                                </a>                                
                            </li>
                            <li <?php echo e(isActive($active_class, 'blogs')); ?> >
                                <a href="<?php echo e(URL_BLOGS); ?>" title="<?php echo e(getPhrase('blogs')); ?>" data-filter-tags="<?php echo e(getPhrase('blogs')); ?>">
                                    <i class="fal fa-globe"></i>
                                    <span class="nav-link-text" data-i18n="nav.miscellaneous"><?php echo e(getPhrase('blogs')); ?></span>
                                </a>                                
														</li>
														<li <?php echo e(isActive($active_class, 'faqs')); ?> >
                                <a href="#" title="<?php echo e(getPhrase('faqs')); ?>" data-filter-tags="<?php echo e(getPhrase('faqs')); ?>">
                                    <i class="fal fa-globe"></i>
                                    <span class="nav-link-text" data-i18n="nav.miscellaneous"><?php echo e(getPhrase('faqs')); ?></span>
																</a>
																<ul>
                                    <li>
                                        <a href="<?php echo e(URL_FAQ_CATEGORIES); ?>" title="<?php echo e(getPhrase('categories')); ?>" data-filter-tags="<?php echo e(getPhrase('categories')); ?>">
                                            <span class="nav-link-text" data-i18n="nav.pages_chat"><?php echo e(getPhrase('categories')); ?></span>
                                        </a>
																		</li>
																		<li>
                                        <a href="<?php echo e(URL_FAQ_QUESTIONS); ?>" title="<?php echo e(getPhrase('faqs')); ?>" data-filter-tags="<?php echo e(getPhrase('faqs')); ?>">
                                            <span class="nav-link-text" data-i18n="nav.pages_chat"><?php echo e(getPhrase('faqs')); ?></span>
                                        </a>
																		</li>
																</ul>                               
														</li>
														
														<li class="nav-title">Настройки</li>
														<li <?php echo e(isActive($active_class, 'master_settings')); ?> >
                                <a href="#" title="<?php echo e(getPhrase('master_settings')); ?>" data-filter-tags="<?php echo e(getPhrase('master_settings')); ?>">
                                    <i class="fal fa-plus-circle"></i>
                                    <span class="nav-link-text" data-i18n="nav.pages"><?php echo e(getPhrase('master_settings')); ?></span>
                                </a>
                                <ul>
																		<?php if(checkRole(getUserGrade(1))): ?>
                                    <li>
                                        <a href="<?php echo e(URL_MASTERSETTINGS_SETTINGS); ?>" title="<?php echo e(getPhrase('settings')); ?>" data-filter-tags="<?php echo e(getPhrase('settings')); ?>">
                                            <span class="nav-link-text" data-i18n="nav.pages_chat"><?php echo e(getPhrase('settings')); ?></span>
                                        </a>
																		</li>
																		<?php endif; ?>
                                    <li>
                                        <a href="<?php echo e(URL_THEMES_LIST); ?>" title="<?php echo e(getPhrase('themes')); ?>" data-filter-tags="<?php echo e(getPhrase('themes')); ?>">
                                            <span class="nav-link-text" data-i18n="nav.pages_contacts"><?php echo e(getPhrase('themes')); ?></span>
                                        </a>
                                    </li>
                                    <li> 
                                        <a href="<?php echo e(URL_LANGUAGES_LIST); ?>" title="<?php echo e(getPhrase('languages')); ?>" data-filter-tags="<?php echo e(getPhrase('languages')); ?>">
                                            <span class="nav-link-text" data-i18n="nav.application_intel_marketing_dashboard"><?php echo e(getPhrase('languages')); ?></span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <div class="filter-message js-filter-message bg-success-600"></div>
                    </nav>
                    <!-- END PRIMARY NAVIGATION -->
                    <!-- NAV FOOTER -->
                    <?php echo $__env->make('layouts.partials.side-nav-footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <!-- END NAV FOOTER -->
                </aside>
                <!-- END Left Aside -->
                <div class="page-content-wrapper">
										<!-- BEGIN Page Header -->										
                    <header class="page-header" role="banner">
                        <!-- we need this logo when user switches to nav-function-top -->
                        <div class="page-logo">
                            <a href="<?php echo e(URL_HOME); ?>" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
                                <img src="<?php echo e(IMAGE_PATH_SETTINGS.getSetting('site_logo', 'site_settings')); ?>" alt="<?php echo e(getSetting('site_title','site_settings')); ?>" aria-roledescription="logo">
                                <span class="page-logo-text mr-1"><?php echo e(getSetting('site_title','site_settings')); ?></span>
                                <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
                                <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
                            </a>
                        </div>
                        <!-- DOC: nav menu layout change shortcut -->
                        <div class="hidden-md-down dropdown-icon-menu position-relative">
                            <a href="#" class="header-btn btn js-waves-off" data-action="toggle" data-class="nav-function-hidden" title="Hide Navigation">
                                <i class="ni ni-menu"></i>
                            </a>
                            <ul>
                                <li>
                                    <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-minify" title="Minify Navigation">
                                        <i class="ni ni-minify-nav"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-fixed" title="Lock Navigation">
                                        <i class="ni ni-lock-nav"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- DOC: mobile button appears during mobile width -->
                        <div class="hidden-lg-up">
                            <a href="#" class="header-btn btn press-scale-down" data-action="toggle" data-class="mobile-nav-on">
                                <i class="ni ni-menu"></i>
                            </a>
                        </div>
                        <div class="ml-auto d-flex">
                            <!-- app settings -->
                            <div class="hidden-md-down">
                                <a href="#" class="header-icon" data-toggle="modal" data-target=".js-modal-settings">
                                    <i class="fal fa-cog"></i>
                                </a>
                            </div> 
                            <!-- app user menu -->
                            <?php echo $__env->make('layouts.partials.top-user-nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                    </header>
                    <!-- END Page Header -->
                    <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <main id="js-page-content" role="main" class="page-content">                        
												
                    
                    <?php echo $__env->yieldContent('content'); ?>
                    

                    </main>
                    <!-- this overlay is activated only when mobile menu is triggered -->
                    <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
                    <!-- BEGIN Page Footer -->
                    <footer class="page-footer" role="contentinfo">
                        <div class="d-flex align-items-center flex-1 text-muted">
                            <span class="hidden-md-down fw-700">2020 © Pharmbilim</span>
                        </div>
                        <div>
                            <ul class="list-table m-0">
                                <li><a href="intel_introduction.html" class="text-secondary fw-700">О нас</a></li>
                                <li class="pl-3"><a href="info_app_licensing.html" class="text-secondary fw-700">Лицензии</a></li>
                                <li class="pl-3"><a href="info_app_docs.html" class="text-secondary fw-700">Документация</a></li>
                            </ul>
                        </div>
                    </footer>
										<!-- END Page Footer -->
										
                    <!-- BEGIN Shortcuts -->
                    <div class="modal fade modal-backdrop-transparent" id="modal-shortcut" tabindex="-1" role="dialog" aria-labelledby="modal-shortcut" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-top modal-transparent" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <ul class="app-list w-auto h-auto p-0 text-left">
                                        <li>
                                            <a href="intel_introduction.html" class="app-list-item text-white border-0 m-0">
                                                <div class="icon-stack">
                                                    <i class="base base-7 icon-stack-3x opacity-100 color-primary-500 "></i>
                                                    <i class="base base-7 icon-stack-2x opacity-100 color-primary-300 "></i>
                                                    <i class="fal fa-home icon-stack-1x opacity-100 color-white"></i>
                                                </div>
                                                <span class="app-list-name">
                                                    Home
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="page_inbox_general.html" class="app-list-item text-white border-0 m-0">
                                                <div class="icon-stack">
                                                    <i class="base base-7 icon-stack-3x opacity-100 color-success-500 "></i>
                                                    <i class="base base-7 icon-stack-2x opacity-100 color-success-300 "></i>
                                                    <i class="ni ni-envelope icon-stack-1x text-white"></i>
                                                </div>
                                                <span class="app-list-name">
                                                    Inbox
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="intel_introduction.html" class="app-list-item text-white border-0 m-0">
                                                <div class="icon-stack">
                                                    <i class="base base-7 icon-stack-2x opacity-100 color-primary-300 "></i>
                                                    <i class="fal fa-plus icon-stack-1x opacity-100 color-white"></i>
                                                </div>
                                                <span class="app-list-name">
                                                    Add More
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
										<!-- END Shortcuts -->
										
                    <!-- BEGIN Color profile -->
                    <!-- this area is hidden and will not be seen on screens or screen readers -->
                    <!-- we use this only for CSS color refernce for JS stuff -->
                    <p id="js-color-profile" class="d-none">
                        <span class="color-primary-50"></span>
                        <span class="color-primary-100"></span>
                        <span class="color-primary-200"></span>
                        <span class="color-primary-300"></span>
                        <span class="color-primary-400"></span>
                        <span class="color-primary-500"></span>
                        <span class="color-primary-600"></span>
                        <span class="color-primary-700"></span>
                        <span class="color-primary-800"></span>
                        <span class="color-primary-900"></span>
                        <span class="color-info-50"></span>
                        <span class="color-info-100"></span>
                        <span class="color-info-200"></span>
                        <span class="color-info-300"></span>
                        <span class="color-info-400"></span>
                        <span class="color-info-500"></span>
                        <span class="color-info-600"></span>
                        <span class="color-info-700"></span>
                        <span class="color-info-800"></span>
                        <span class="color-info-900"></span>
                        <span class="color-danger-50"></span>
                        <span class="color-danger-100"></span>
                        <span class="color-danger-200"></span>
                        <span class="color-danger-300"></span>
                        <span class="color-danger-400"></span>
                        <span class="color-danger-500"></span>
                        <span class="color-danger-600"></span>
                        <span class="color-danger-700"></span>
                        <span class="color-danger-800"></span>
                        <span class="color-danger-900"></span>
                        <span class="color-warning-50"></span>
                        <span class="color-warning-100"></span>
                        <span class="color-warning-200"></span>
                        <span class="color-warning-300"></span>
                        <span class="color-warning-400"></span>
                        <span class="color-warning-500"></span>
                        <span class="color-warning-600"></span>
                        <span class="color-warning-700"></span>
                        <span class="color-warning-800"></span>
                        <span class="color-warning-900"></span>
                        <span class="color-success-50"></span>
                        <span class="color-success-100"></span>
                        <span class="color-success-200"></span>
                        <span class="color-success-300"></span>
                        <span class="color-success-400"></span>
                        <span class="color-success-500"></span>
                        <span class="color-success-600"></span>
                        <span class="color-success-700"></span>
                        <span class="color-success-800"></span>
                        <span class="color-success-900"></span>
                        <span class="color-fusion-50"></span>
                        <span class="color-fusion-100"></span>
                        <span class="color-fusion-200"></span>
                        <span class="color-fusion-300"></span>
                        <span class="color-fusion-400"></span>
                        <span class="color-fusion-500"></span>
                        <span class="color-fusion-600"></span>
                        <span class="color-fusion-700"></span>
                        <span class="color-fusion-800"></span>
                        <span class="color-fusion-900"></span>
                    </p>
                    <!-- END Color profile -->
                </div>
            </div>
        </div>
<!-- END Page Wrapper -->
<!-- BEGIN Quick Menu -->
<!-- to add more items, please make sure to change the variable '$menu-items: number;' in your _page-components-shortcut.scss -->
<?php echo $__env->make('layouts.partials.quick-nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!-- END Quick Menu -->
<!-- BEGIN Page Settings -->
<?php echo $__env->make('layouts.partials.page-settings', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('layouts.partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>