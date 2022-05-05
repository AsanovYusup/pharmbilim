@include('layouts.partials.header')
				
		<div class="page-wrapper">
            <div class="page-inner">
                <!-- BEGIN Left Aside -->
                <aside class="page-sidebar">
                    <div class="page-logo">
                        <a href="{{ URL_HOME }}" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
                            <img src="{{IMAGE_PATH_SETTINGS.getSetting('site_logo', 'site_settings')}}" alt="{{getSetting('site_title','site_settings')}}" aria-roledescription="logo">
                            <span class="page-logo-text mr-1">{{getSetting('site_title','site_settings')}}</span>
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
                            <img src="{{ getProfilePath(Auth::user()->image, 'thumb') }}" class="profile-image rounded-circle" alt="{{Auth::user()->name}}">
                            <div class="info-card-text">
                                <a href="#" class="d-flex align-items-center text-white">
                                    <span class="text-truncate text-truncate-sm d-inline-block">
																				@if(Auth::check())
																					{{Auth::user()->name}}
																				@endif                                        
                                    </span>                                    
                                </a>
                                <span class="d-inline-block text-truncate text-truncate-sm">{{Auth::user()->region}}</span>
                            </div>
                            <img src="{{themes('img/card-backgrounds/cover-2-lg.png')}}" class="cover" alt="cover">
                            <a href="#" onclick="return false;" class="pull-trigger-btn" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
                                <i class="fal fa-angle-down"></i>
                            </a>
                        </div>
                        <ul id="js-nav-menu" class="nav-menu">
                            <li {{ isActive($active_class, 'dashboard') }}>
                                <a href="{{PREFIX}}" title="{{ getPhrase('dashboard') }} " data-filter-tags="{{ getPhrase('dashboard') }}  dashboard">
                                    <i class="fal fa-dharmachakra"></i>
                                    <span class="nav-link-text" data-i18n="nav.application_intel_analytics_dashboard">{{ getPhrase('dashboard') }} </span>
                                </a>
                            </li>

                            <li class="nav-title">Школа</li>

                            <li class="active open">
                                <a href="#" title="{{ getPhrase('users') }}" data-filter-tags="{{ getPhrase('users') }}">
                                    <i class="fal fa-users"></i>
                                    <span class="nav-link-text" data-i18n="nav.theme_settings">{{ getPhrase('users') }}</span>
                                </a>
                                <ul>
                                    <li {{ isActive($active_class, 'users') }}>
                                        <a href="{{URL_USERS}}" title="{{ getPhrase('users') }}" data-filter-tags="{{ getPhrase('users') }}">
                                            <span class="nav-link-text" data-i18n="nav.theme_settings_how_it_works">{{ getPhrase('users') }}</span>
                                        </a>
                                    </li>
                                    <li {{ isActive($active_class, 'users-unsort') }}>
                                        <a href="{{URL_USERS_UNSORTED}}" title="{{ getPhrase('users_unsorted') }}" data-filter-tags="{{ getPhrase('users_unsorted') }}">
                                            <span class="nav-link-text" data-i18n="nav.theme_settings_layout_options">{{ getPhrase('users_unsorted') }}</span>
                                        </a>
                                    </li>
                                    <li {{ isActive($active_class, 'users-region') }}>
                                        <a href="{{URL_USERS_REGION}}" title="{{ getPhrase('company_region_pharm') }}" data-filter-tags="{{ getPhrase('company_region_pharm') }}">
                                            <span class="nav-link-text" data-i18n="nav.theme_settings_theme_modes_(beta)">{{ getPhrase('company_region_pharm') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li {{ isActive($active_class, 'exams') }} > 
                                <a href="#" title="{{ getPhrase('exams') }}" data-filter-tags="{{ getPhrase('exams') }}">
                                    <i class="fal fa-window"></i>
                                    <span class="nav-link-text" data-i18n="nav.ui_components">{{ getPhrase('exams') }}</span>
                                </a>
                                <ul>
                                    <li>
                                        <a href="{{URL_QUIZ_CATEGORIES}}" title="{{ getPhrase('categories') }}" data-filter-tags="{{ getPhrase('categories') }}">
                                            <span class="nav-link-text" data-i18n="nav.ui_components_alerts">{{ getPhrase('categories') }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{URL_QUIZZES}}" title="{{ getPhrase('quiz')}}" data-filter-tags="{{ getPhrase('quiz')}}">
                                            <span class="nav-link-text" data-i18n="nav.ui_components_accordions">{{ getPhrase('quiz')}}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{URL_EXAM_SERIES}}" title="{{ getPhrase('exam_series')}}" data-filter-tags="{{ getPhrase('exam_series')}}">
                                            <span class="nav-link-text" data-i18n="nav.ui_components_badges">{{ getPhrase('exam_series')}}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{URL_QUIZ_QUESTIONBANK}}" title="{{ getPhrase('question_bank') }}" data-filter-tags="{{ getPhrase('question_bank') }}">
                                            <span class="nav-link-text" data-i18n="nav.ui_components_breadcrumbs">{{ getPhrase('question_bank') }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{URL_INSTRUCTIONS}}" title="{{ getPhrase('instructions')}}" data-filter-tags="{{ getPhrase('instructions')}}s">
                                            <span class="nav-link-text" data-i18n="nav.ui_components_buttons">{{ getPhrase('instructions')}}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{URL_MASTERSETTINGS_SUBJECTS}}" title="{{ getPhrase('subjects_master')}}" data-filter-tags="{{ getPhrase('subjects_master')}}">
                                            <span class="nav-link-text" data-i18n="nav.ui_components_button_group">{{ getPhrase('subjects_master')}}</span>
                                        </a>
                                    </li>                                    
                                </ul>
														</li>
														
                            <li {{ isActive($active_class, 'lms') }} > 
                                <a href="#" title="{{getPhrase('lms')}}" data-filter-tags="{{getPhrase('lms')}}">
                                    <i class="fal fa-bolt"></i>
                                    <span class="nav-link-text" data-i18n="nav.utilities">{{getPhrase('lms')}}</span>
                                </a>
                                <ul>																	
                                    <li>
                                        <a href="{{ URL_LMS_CATEGORIES }}" title="{{ getPhrase('categories') }}" data-filter-tags="{{ getPhrase('categories') }}">
                                            <span class="nav-link-text" data-i18n="nav.utilities_borders">{{ getPhrase('categories') }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ URL_LMS_SERIES }}" title="{{ getPhrase('series') }}" data-filter-tags="{{ getPhrase('series') }}">
                                            <span class="nav-link-text" data-i18n="nav.utilities_clearfix">{{ getPhrase('series') }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ URL_LMS_CONTENT }}" title="{{ getPhrase('contents') }}" data-filter-tags="{{ getPhrase('contents') }}">
                                            <span class="nav-link-text" data-i18n="nav.utilities_color_pallet">{{ getPhrase('contents') }}</span>
                                        </a>
                                    </li>                                    
                                </ul>
														</li>
														<li {{ isActive($active_class, 'reports') }} >
                                <a href="#" title="{{ getPhrase('payment_reports') }}" data-filter-tags="font icons">
                                    <i class="fal fa-map-marker-alt"></i>
                                    <span class="nav-link-text" data-i18n="nav.font_icons">{{ getPhrase('payment_reports') }}</span>                                    
                                </a>
                                <ul>
                                    <li>
                                        <a href="{{URL_ONLINE_PAYMENT_REPORTS}}" title="{{ getPhrase('online_payments') }}" data-filter-tags="{{ getPhrase('online_payments') }}">
                                            <span class="nav-link-text" data-i18n="nav.font_icons_fontawesome">{{ getPhrase('online_payments') }}</span>
                                        </a>                                        
                                    </li>
                                    <li>
                                        <a href="{{URL_OFFLINE_PAYMENT_REPORTS}}" title="{{ getPhrase('offline_payments') }}" data-filter-tags="{{ getPhrase('offline_payments') }}">
                                            <span class="nav-link-text" data-i18n="nav.font_icons_nextgen_icons">{{ getPhrase('offline_payments') }}</span>
                                        </a>                                        
                                    </li>
                                    <li>
                                        <a href="{{URL_PAYMENT_REPORT_EXPORT}}" title="{{ getPhrase('export') }}" data-filter-tags="{{ getPhrase('export') }}">
                                            <span class="nav-link-text" data-i18n="nav.font_icons_stack_icons">{{ getPhrase('export') }}</span>
                                        </a>
                                    </li>
                                </ul>
														</li>

														<li {{ isActive($active_class, 'coupons') }} >
                                <a href="#" title="{{ getPhrase('coupons') }}" data-filter-tags="{{ getPhrase('coupons') }}">
                                    <i class="fal fa-th-list"></i>
                                    <span class="nav-link-text" data-i18n="nav.tables">{{ getPhrase('coupons') }}</span>
                                </a>
                                <ul>
                                    <li>
                                        <a href="{{URL_COUPONS}}" title="{{ getPhrase('list') }}" data-filter-tags="{{ getPhrase('list') }}">
                                            <span class="nav-link-text" data-i18n="nav.tables_basic_tables">{{ getPhrase('list') }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{URL_COUPONS_ADD}}" title="{{ getPhrase('add') }}" data-filter-tags="{{ getPhrase('add') }}e">
                                            <span class="nav-link-text" data-i18n="nav.tables_generate_table_style">{{ getPhrase('add') }}</span>
                                        </a>
                                    </li>
                                </ul>
														</li>
														
														<li {{ isActive($active_class, 'events') }} >
                                <a href="{{URL_EVENTS}}" title="{{ getPhrase('events') }}" data-filter-tags="{{ getPhrase('events') }}">
                                    <i class="fal fa-edit"></i>
                                    <span class="nav-link-text" data-i18n="nav.form_stuff">{{ getPhrase('events') }}</span>
                                </a>
                            </li>														
														
														<li {{ isActive($active_class, 'trainings') }} >
                                <a href="{{URL_TRAININGS}}" title="{{ getPhrase('trainings') }}" data-filter-tags="{{ getPhrase('trainings') }}">
                                    <i class="fal fa-shield-alt"></i>
                                    <span class="nav-link-text" data-i18n="nav.plugins">{{ getPhrase('trainings') }}</span>
                                </a>
														</li>
														
														<li {{ isActive($active_class, 'partners') }} >
                                <a href="{{URL_PARTNERS}}" title="{{ getPhrase('partners') }}" data-filter-tags="{{ getPhrase('partners') }}">
                                    <i class="fal fa-table"></i>
                                    <span class="nav-link-text" data-i18n="nav.datatables">{{ getPhrase('partners') }}</span>
                                </a>
														</li>
														
														<li class="nav-title">Контент</li>

                            <li {{ isActive($active_class, 'messages') }} > 
                                <a href="{{URL_MESSAGES}}" title="{{ getPhrase('messages')}}" data-filter-tags="{{ getPhrase('messages')}}">
                                    <i class="fal fa-chart-pie"></i>
																		<span class="nav-link-text" data-i18n="nav.statistics">{{ getPhrase('messages')}}</span>
																		<span class="dl-ref label bg-primary-500 ml-2">{{$count = Auth::user()->newThreadsCount()}}</span>
                                </a>                                
														</li>
                            <li {{ isActive($active_class, 'feedback') }} >
                                <a href="{{URL_FEEDBACKS}}" title="{{ getPhrase('feedback') }}" data-filter-tags="{{ getPhrase('feedback') }}">
                                    <i class="fal fa-exclamation-circle"></i>
                                    <span class="nav-link-text" data-i18n="nav.notifications">{{ getPhrase('feedback') }}</span>
                                </a>
                            </li>
                            <li {{ isActive($active_class, 'pages') }} > 
                                <a href="{{URL_PAGES}}" title="{{ getPhrase('pages') }}" data-filter-tags="{{ getPhrase('pages') }}">
                                    <i class="fal fa-credit-card-front"></i>
                                    <span class="nav-link-text" data-i18n="nav.form_plugins">{{ getPhrase('pages') }}</span>
                                </a>                                
                            </li>
                            <li {{ isActive($active_class, 'blogs') }} >
                                <a href="{{URL_BLOGS}}" title="{{ getPhrase('blogs') }}" data-filter-tags="{{ getPhrase('blogs') }}">
                                    <i class="fal fa-globe"></i>
                                    <span class="nav-link-text" data-i18n="nav.miscellaneous">{{ getPhrase('blogs') }}</span>
                                </a>                                
														</li>
														<li {{ isActive($active_class, 'faqs') }} >
                                <a href="#" title="{{ getPhrase('faqs') }}" data-filter-tags="{{ getPhrase('faqs') }}">
                                    <i class="fal fa-globe"></i>
                                    <span class="nav-link-text" data-i18n="nav.miscellaneous">{{ getPhrase('faqs') }}</span>
																</a>
																<ul>
                                    <li>
                                        <a href="{{URL_FAQ_CATEGORIES}}" title="{{ getPhrase('categories') }}" data-filter-tags="{{ getPhrase('categories') }}">
                                            <span class="nav-link-text" data-i18n="nav.pages_chat">{{ getPhrase('categories') }}</span>
                                        </a>
																		</li>
																		<li>
                                        <a href="{{URL_FAQ_QUESTIONS}}" title="{{ getPhrase('faqs') }}" data-filter-tags="{{ getPhrase('faqs') }}">
                                            <span class="nav-link-text" data-i18n="nav.pages_chat">{{ getPhrase('faqs') }}</span>
                                        </a>
																		</li>
																</ul>                               
														</li>
														
														<li class="nav-title">Настройки</li>
														<li {{ isActive($active_class, 'master_settings') }} >
                                <a href="#" title="{{ getPhrase('master_settings') }}" data-filter-tags="{{ getPhrase('master_settings') }}">
                                    <i class="fal fa-plus-circle"></i>
                                    <span class="nav-link-text" data-i18n="nav.pages">{{ getPhrase('master_settings') }}</span>
                                </a>
                                <ul>
																		@if(checkRole(getUserGrade(1)))
                                    <li>
                                        <a href="{{URL_MASTERSETTINGS_SETTINGS}}" title="{{ getPhrase('settings') }}" data-filter-tags="{{ getPhrase('settings') }}">
                                            <span class="nav-link-text" data-i18n="nav.pages_chat">{{ getPhrase('settings') }}</span>
                                        </a>
																		</li>
																		@endif
                                    <li>
                                        <a href="{{URL_THEMES_LIST}}" title="{{ getPhrase('themes') }}" data-filter-tags="{{ getPhrase('themes') }}">
                                            <span class="nav-link-text" data-i18n="nav.pages_contacts">{{ getPhrase('themes') }}</span>
                                        </a>
                                    </li>
                                    <li> 
                                        <a href="{{URL_LANGUAGES_LIST}}" title="{{ getPhrase('languages') }}" data-filter-tags="{{ getPhrase('languages') }}">
                                            <span class="nav-link-text" data-i18n="nav.application_intel_marketing_dashboard">{{ getPhrase('languages') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <div class="filter-message js-filter-message bg-success-600"></div>
                    </nav>
                    <!-- END PRIMARY NAVIGATION -->
                    <!-- NAV FOOTER -->
                    @include('layouts.partials.side-nav-footer')
                    <!-- END NAV FOOTER -->
                </aside>
                <!-- END Left Aside -->
                <div class="page-content-wrapper">
										<!-- BEGIN Page Header -->										
                    <header class="page-header" role="banner">
                        <!-- we need this logo when user switches to nav-function-top -->
                        <div class="page-logo">
                            <a href="{{ URL_HOME }}" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
                                <img src="{{IMAGE_PATH_SETTINGS.getSetting('site_logo', 'site_settings')}}" alt="{{getSetting('site_title','site_settings')}}" aria-roledescription="logo">
                                <span class="page-logo-text mr-1">{{getSetting('site_title','site_settings')}}</span>
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
                            @include('layouts.partials.top-user-nav')
                        </div>
                    </header>
                    <!-- END Page Header -->
                    <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <main id="js-page-content" role="main" class="page-content">                        
												
                    {{-- content --}}
                    @yield('content')
                    {{-- contentend --}}

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
@include('layouts.partials.quick-nav')
<!-- END Quick Menu -->
<!-- BEGIN Page Settings -->
@include('layouts.partials.page-settings')
@include('layouts.partials.footer')