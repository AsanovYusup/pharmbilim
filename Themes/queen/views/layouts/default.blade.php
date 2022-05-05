<!DOCTYPE html>
<html lang="ru" dir="{{ (App\Language::isDefaultLanuageRtl()) ? 'rtl' : 'ltr' }}">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="{{getSetting('meta_description', 'seo_settings')}}">

				<meta name="keywords" content="{{getSetting('meta_keywords', 'seo_settings')}}">

				<meta name="csrf_token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
				
				<link rel="icon" href="{{IMAGE_PATH_SETTINGS.getSetting('site_favicon', 'site_settings')}}" type="image/x-icon" />

				<title>@yield('title') {{ isset($title) ? $title : getSetting('site_title','site_settings') }}</title>
        <!-- Call App Mode on ios devices -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <!-- Remove Tap Highlight on Windows Phone IE -->
				<meta name="msapplication-tap-highlight" content="no">
				
				@yield('header_scripts')
        <!-- base css -->
        <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="{{themes('css/vendors.bundle.css')}}">
        <link id="appbundle" rel="stylesheet" media="screen, print" href="{{themes('css/app.bundle.css')}}">
        <link id="mytheme" rel="stylesheet" media="screen, print" href="#">
        <link id="myskin" rel="stylesheet" media="screen, print" href="{{themes('css/skins/skin-master.css')}}">
        <!-- Place favicon.ico in the root directory -->
        <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
        <link rel="mask-icon" href="img/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="stylesheet" media="screen, print" href="{{themes('css/miscellaneous/reactions/reactions.css')}}">
        <link rel="stylesheet" media="screen, print" href="{{themes('css/miscellaneous/fullcalendar/fullcalendar.bundle.css')}}">
        <link rel="stylesheet" media="screen, print" href="{{themes('css/miscellaneous/jqvmap/jqvmap.bundle.css')}}">
        <link rel="stylesheet" media="screen, print" href="{{themes('css/custom.css')}}">
    </head>
    <!-- BEGIN Body -->
    <!-- Possible Classes

		* 'header-function-fixed'         - header is in a fixed at all times
		* 'nav-function-fixed'            - left panel is fixed
		* 'nav-function-minify'			  - skew nav to maximize space
		* 'nav-function-hidden'           - roll mouse on edge to reveal
		* 'nav-function-top'              - relocate left pane to top
		* 'mod-main-boxed'                - encapsulates to a container
		* 'nav-mobile-push'               - content pushed on menu reveal
		* 'nav-mobile-no-overlay'         - removes mesh on menu reveal
		* 'nav-mobile-slide-out'          - content overlaps menu
		* 'mod-bigger-font'               - content fonts are bigger for readability
		* 'mod-high-contrast'             - 4.5:1 text contrast ratio
		* 'mod-color-blind'               - color vision deficiency
		* 'mod-pace-custom'               - preloader will be inside content
		* 'mod-clean-page-bg'             - adds more whitespace
		* 'mod-hide-nav-icons'            - invisible navigation icons
		* 'mod-disable-animation'         - disables css based animations
		* 'mod-hide-info-card'            - hides info card from left panel
		* 'mod-lean-subheader'            - distinguished page header
		* 'mod-nav-link'                  - clear breakdown of nav links

		>>> more settings are described inside documentation page >>>
	-->
    <body class="mod-bg-1 mod-nav-link ">
        <!-- DOC: script to save and load page settings -->
        <script>
            /**
             *	This script should be placed right after the body tag for fast execution 
             *	Note: the script is written in pure javascript and does not depend on thirdparty library
             **/
            'use strict';

            var classHolder = document.getElementsByTagName("BODY")[0],
                /** 
                 * Load from localstorage
                 **/
                themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
                {},
                themeURL = themeSettings.themeURL || '',
                themeOptions = themeSettings.themeOptions || '';
            /** 
             * Load theme options
             **/
            if (themeSettings.themeOptions)
            {
                classHolder.className = themeSettings.themeOptions;
                console.log("%c✔ Theme settings loaded", "color: #148f32");
            }
            else
            {
                console.log("%c✔ Heads up! Theme settings is empty or does not exist, loading default settings...", "color: #ed1c24");
            }
            if (themeSettings.themeURL && !document.getElementById('mytheme'))
            {
                var cssfile = document.createElement('link');
                cssfile.id = 'mytheme';
                cssfile.rel = 'stylesheet';
                cssfile.href = themeURL;
                document.getElementsByTagName('head')[0].appendChild(cssfile);

            }
            else if (themeSettings.themeURL && document.getElementById('mytheme'))
            {
                document.getElementById('mytheme').href = themeSettings.themeURL;
            }
            /** 
             * Save to localstorage 
             **/
            var saveSettings = function()
            {
                themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function(item)
                {
                    return /^(nav|header|footer|mod|display)-/i.test(item);
                }).join(' ');
                if (document.getElementById('mytheme'))
                {
                    themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
                };
                localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
            }
            /** 
             * Reset settings
             **/
            var resetSettings = function()
            {
                localStorage.setItem("themeSettings", "");
            }

				</script>
				
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
                        
                        @if(checkRole(getUserGrade(2)))
                          @extends('layouts.nav.admin-nav')                           
                        @else
                          @extends('layouts.nav.students-nav')                            
                        @endif


                        <div class="filter-message js-filter-message bg-success-600"></div>
                    </nav>
                    <!-- END PRIMARY NAVIGATION -->
                    <!-- NAV FOOTER -->
                    <div class="nav-footer shadow-top">
                        <a href="#" onclick="return false;" data-action="toggle" data-class="nav-function-minify" class="hidden-md-down">
                            <i class="ni ni-chevron-right"></i>
                            <i class="ni ni-chevron-right"></i>
                        </a>
                        <ul class="list-table m-auto nav-footer-buttons">
                            <li>
                                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Chat logs">
                                    <i class="fal fa-comments"></i>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Support Chat">
                                    <i class="fal fa-life-ring"></i>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Make a call">
                                    <i class="fal fa-phone"></i>
                                </a>
                            </li>
                        </ul>
                    </div> <!-- END NAV FOOTER -->
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
                        <div class="search">
                            <form class="app-forms hidden-xs-down" role="search" action="page_search.html" autocomplete="off">
                                <input type="text" id="search-field" placeholder="Search for anything" class="form-control" tabindex="1">
                                <a href="#" onclick="return false;" class="btn-danger btn-search-close js-waves-off d-none" data-action="toggle" data-class="mobile-search-on">
                                    <i class="fal fa-times"></i>
                                </a>
                            </form>
                        </div>
                        <div class="ml-auto d-flex">
                            <!-- activate app search icon (mobile) -->
                            <div class="hidden-sm-up">
                                <a href="#" class="header-icon" data-action="toggle" data-class="mobile-search-on" data-focus="search-field" title="Search">
                                    <i class="fal fa-search"></i>
                                </a>
                            </div>
                            <!-- app settings -->
                            <div class="hidden-md-down">
                                <a href="#" class="header-icon" data-toggle="modal" data-target=".js-modal-settings">
                                    <i class="fal fa-cog"></i>
                                </a>
                            </div>                            
                            <!-- app message -->
                            <a href="#" class="header-icon" data-toggle="modal" data-target=".js-modal-messenger">
                                <i class="fal fa-globe"></i>
                                <span class="badge badge-icon">!</span>
                            </a>
                            <!-- app notification -->
                            <div>
                                <a href="#" class="header-icon" data-toggle="dropdown" title="You got 11 notifications">
                                    <i class="fal fa-bell"></i>
                                    <span class="badge badge-icon">11</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-animated dropdown-xl">
                                    <div class="dropdown-header bg-trans-gradient d-flex justify-content-center align-items-center rounded-top mb-2">
                                        <h4 class="m-0 text-center color-white">
                                            11 New
                                            <small class="mb-0 opacity-80">Уведомления</small>
                                        </h4>
                                    </div>
                                    <ul class="nav nav-tabs nav-tabs-clean" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link px-4 fs-md js-waves-on fw-500" data-toggle="tab" href="#tab-messages" data-i18n="drpdwn.messages">Messages</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link px-4 fs-md js-waves-on fw-500" data-toggle="tab" href="#tab-feeds" data-i18n="drpdwn.feeds">Подписки</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link px-4 fs-md js-waves-on fw-500" data-toggle="tab" href="#tab-events" data-i18n="drpdwn.events">Events</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content tab-notification">
                                        <div class="tab-pane active p-3 text-center">
                                            <h5 class="mt-4 pt-4 fw-500">
                                                <span class="d-block fa-3x pb-4 text-muted">
                                                    <i class="ni ni-arrow-up text-gradient opacity-70"></i>
                                                </span> Select a tab above to activate
                                                <small class="mt-3 fs-b fw-400 text-muted">
                                                    This blank page message helps protect your privacy, or you can show the first message here automatically through
                                                    <a href="#">settings page</a>
                                                </small>
                                            </h5>
                                        </div>
                                        <div class="tab-pane" id="tab-messages" role="tabpanel">
                                            <div class="custom-scroll h-100">
                                                <ul class="notification">
                                                    <li class="unread">
                                                        <a href="#" class="d-flex align-items-center">
                                                            <span class="status mr-2">
                                                                <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-c.png')"></span>
                                                            </span>
                                                            <span class="d-flex flex-column flex-1 ml-1">
                                                                <span class="name">Melissa Ayre <span class="badge badge-primary fw-n position-absolute pos-top pos-right mt-1">INBOX</span></span>
                                                                <span class="msg-a fs-sm">Re: New security codes</span>
                                                                <span class="msg-b fs-xs">Hello again and thanks for being part...</span>
                                                                <span class="fs-nano text-muted mt-1">56 seconds ago</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="unread">
                                                        <a href="#" class="d-flex align-items-center">
                                                            <span class="status mr-2">
                                                                <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-a.png')"></span>
                                                            </span>
                                                            <span class="d-flex flex-column flex-1 ml-1">
                                                                <span class="name">Adison Lee</span>
                                                                <span class="msg-a fs-sm">Msed quia non numquam eius</span>
                                                                <span class="fs-nano text-muted mt-1">2 minutes ago</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="d-flex align-items-center">
                                                            <span class="status status-success mr-2">
                                                                <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-b.png')"></span>
                                                            </span>
                                                            <span class="d-flex flex-column flex-1 ml-1">
                                                                <span class="name">Oliver Kopyuv</span>
                                                                <span class="msg-a fs-sm">Msed quia non numquam eius</span>
                                                                <span class="fs-nano text-muted mt-1">3 days ago</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="d-flex align-items-center">
                                                            <span class="status status-warning mr-2">
                                                                <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-e.png')"></span>
                                                            </span>
                                                            <span class="d-flex flex-column flex-1 ml-1">
                                                                <span class="name">Dr. John Cook PhD</span>
                                                                <span class="msg-a fs-sm">Msed quia non numquam eius</span>
                                                                <span class="fs-nano text-muted mt-1">2 weeks ago</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="d-flex align-items-center">
                                                            <span class="status status-success mr-2">
                                                                <!-- <img src="img/demo/avatars/avatar-m.png" data-src="img/demo/avatars/avatar-h.png" class="profile-image rounded-circle" alt="Sarah McBrook" /> -->
                                                                <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-h.png')"></span>
                                                            </span>
                                                            <span class="d-flex flex-column flex-1 ml-1">
                                                                <span class="name">Sarah McBrook</span>
                                                                <span class="msg-a fs-sm">Msed quia non numquam eius</span>
                                                                <span class="fs-nano text-muted mt-1">3 weeks ago</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="d-flex align-items-center">
                                                            <span class="status status-success mr-2">
                                                                <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-m.png')"></span>
                                                            </span>
                                                            <span class="d-flex flex-column flex-1 ml-1">
                                                                <span class="name">Anothony Bezyeth</span>
                                                                <span class="msg-a fs-sm">Msed quia non numquam eius</span>
                                                                <span class="fs-nano text-muted mt-1">one month ago</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="d-flex align-items-center">
                                                            <span class="status status-danger mr-2">
                                                                <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-j.png')"></span>
                                                            </span>
                                                            <span class="d-flex flex-column flex-1 ml-1">
                                                                <span class="name">Lisa Hatchensen</span>
                                                                <span class="msg-a fs-sm">Msed quia non numquam eius</span>
                                                                <span class="fs-nano text-muted mt-1">one year ago</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab-feeds" role="tabpanel">
                                            <div class="custom-scroll h-100">
                                                <ul class="notification">

																									<?php $newUsers = (new App\User())->getLatestUsers(); ?>
																										@foreach($newUsers as $user)

																										<li>
                                                        <div class="d-flex align-items-center show-child-on-hover">
                                                            <span class="d-flex flex-column flex-1">
                                                                <span class="name d-flex align-items-center">Добавлен новый пользователь <span class="badge badge-success fw-n ml-1">{{ getRoleData($user->role_id)}}</span></span>
                                                                <span class="msg-a fs-sm">
                                                                    <a href="{{URL_USER_DETAILS.$user->slug}}">{{ucfirst($user->name)}}</a>
                                                                </span>
                                                                <span class="fs-nano text-muted mt-1">{{$user->updated_at->diffForHumans()}}</span>
                                                            </span>                                                            
                                                        </div>
                                                    </li>
																										@endforeach

                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab-events" role="tabpanel">
                                            <div class="d-flex flex-column h-100">
                                                <div class="h-auto">
                                                    <table class="table table-bordered table-calendar m-0 w-100 h-100 border-0">
                                                        <tr>
                                                            <th colspan="7" class="pt-3 pb-2 pl-3 pr-3 text-center">
                                                                <div class="js-get-date h5 mb-2">[your date here]</div>
                                                            </th>
                                                        </tr>
                                                        <tr class="text-center">
                                                            <th>Sun</th>
                                                            <th>Mon</th>
                                                            <th>Tue</th>
                                                            <th>Wed</th>
                                                            <th>Thu</th>
                                                            <th>Fri</th>
                                                            <th>Sat</th>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted bg-faded">30</td>
                                                            <td>1</td>
                                                            <td>2</td>
                                                            <td>3</td>
                                                            <td>4</td>
                                                            <td>5</td>
                                                            <td><i class="fal fa-birthday-cake mt-1 ml-1 position-absolute pos-left pos-top text-primary"></i> 6</td>
                                                        </tr>
                                                        <tr>
                                                            <td>7</td>
                                                            <td>8</td>
                                                            <td>9</td>
                                                            <td class="bg-primary-300 pattern-0">10</td>
                                                            <td>11</td>
                                                            <td>12</td>
                                                            <td>13</td>
                                                        </tr>
                                                        <tr>
                                                            <td>14</td>
                                                            <td>15</td>
                                                            <td>16</td>
                                                            <td>17</td>
                                                            <td>18</td>
                                                            <td>19</td>
                                                            <td>20</td>
                                                        </tr>
                                                        <tr>
                                                            <td>21</td>
                                                            <td>22</td>
                                                            <td>23</td>
                                                            <td>24</td>
                                                            <td>25</td>
                                                            <td>26</td>
                                                            <td>27</td>
                                                        </tr>
                                                        <tr>
                                                            <td>28</td>
                                                            <td>29</td>
                                                            <td>30</td>
                                                            <td>31</td>
                                                            <td class="text-muted bg-faded">1</td>
                                                            <td class="text-muted bg-faded">2</td>
                                                            <td class="text-muted bg-faded">3</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="flex-1 custom-scroll">
                                                    <div class="p-2">
                                                        <div class="d-flex align-items-center text-left mb-3">
                                                            <div class="width-5 fw-300 text-primary l-h-n mr-1 align-self-start fs-xxl">
                                                                15
                                                            </div>
                                                            <div class="flex-1">
                                                                <div class="d-flex flex-column">
                                                                    <span class="l-h-n fs-md fw-500 opacity-70">
                                                                        October 2020
                                                                    </span>
                                                                    <span class="l-h-n fs-nano fw-400 text-secondary">
                                                                        Friday
                                                                    </span>
                                                                </div>
                                                                <div class="mt-3">
                                                                    <p>
                                                                        <strong>2:30PM</strong> - Doctor's appointment
                                                                    </p>
                                                                    <p>
                                                                        <strong>3:30PM</strong> - Report overview
                                                                    </p>
                                                                    <p>
                                                                        <strong>4:30PM</strong> - Meeting with Donnah V.
                                                                    </p>
                                                                    <p>
                                                                        <strong>5:30PM</strong> - Late Lunch
                                                                    </p>
                                                                    <p>
                                                                        <strong>6:30PM</strong> - Report Compression
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="py-2 px-3 bg-faded d-block rounded-bottom text-right border-faded border-bottom-0 border-right-0 border-left-0">
                                        <a href="#" class="fs-xs fw-500 ml-auto">view all notifications</a>
                                    </div>
                                </div>
                            </div>
                            <!-- app user menu -->
                            <div>
                                <a href="#" data-toggle="dropdown" title="{{Auth::user()->name}}" class="header-icon d-flex align-items-center justify-content-center ml-2">
                                    <img src="{{ getProfilePath(Auth::user()->image, 'thumb') }}" alt="{{Auth::user()->name}}" class="profile-image rounded-circle">
                                    <!-- you can also add username next to the avatar with the codes below:
									<span class="ml-1 mr-1 text-truncate text-truncate-header hidden-xs-down">Me</span>
									<i class="ni ni-chevron-down hidden-xs-down"></i> -->
																</a>	

                                <div class="dropdown-menu dropdown-menu-animated dropdown-lg">
                                    <div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
                                        <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
                                            <span class="mr-2">
                                                <img src="{{ getProfilePath(Auth::user()->image, 'thumb') }}" alt="{{Auth::user()->name}}" class="rounded-circle profile-image" >
                                            </span>
                                            <div class="info-card-text">
                                                <div class="fs-lg text-truncate text-truncate-lg">{{Auth::user()->name}}</div>
                                                <span class="text-truncate text-truncate-md opacity-80">{{Auth::user()->region}}</span>
                                            </div>
                                        </div>
                                    </div>
																		<div class="dropdown-divider m-0"></div>
																		{{-- change password --}}
                                    <a href="{{URL_USERS_CHANGE_PASSWORD}}{{Auth::user()->slug}}" class="dropdown-item">
                                        <span data-i18n="drpdwn.reset_layout">{{ getPhrase('change_password') }}</span>
                                    </a>
                                    <a href="{{URL_USERS_EDIT}}{{Auth::user()->slug}}" class="dropdown-item">
                                        <span data-i18n="drpdwn.settings">{{ getPhrase('my_profile') }}</span>
                                    </a>
																		<div class="dropdown-divider m-0"></div>
                                    <a href="{{URL_LANGUAGES_LIST}}" class="dropdown-item">
                                        <span data-i18n="drpdwn.languages">{{ getPhrase('languages') }}</span>
                                    </a>
                                    <div class="dropdown-divider m-0"></div>
                                    <a class="dropdown-item fw-500 pt-3 pb-3" href="{{URL_USERS_LOGOUT}}">
                                        <span data-i18n="drpdwn.page-logout">{{ getPhrase('logout') }}</span>
                                        <span class="float-right fw-n">&commat;{{Auth::user()->name}}</span>
                                    </a>
                                </div>
                            </div>
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
        <nav class="shortcut-menu d-none d-sm-block">
            <input type="checkbox" class="menu-open" name="menu-open" id="menu_open" />
            <label for="menu_open" class="menu-open-button ">
                <span class="app-shortcut-icon d-block"></span>
            </label>
            <a href="#" class="menu-item btn" data-toggle="tooltip" data-placement="left" title="Scroll Top">
                <i class="fal fa-arrow-up"></i>
            </a>
            <a href="page_login.html" class="menu-item btn" data-toggle="tooltip" data-placement="left" title="Logout">
                <i class="fal fa-sign-out"></i>
            </a>
            <a href="#" class="menu-item btn" data-action="app-fullscreen" data-toggle="tooltip" data-placement="left" title="Full Screen">
                <i class="fal fa-expand"></i>
            </a>
            <a href="#" class="menu-item btn" data-action="app-print" data-toggle="tooltip" data-placement="left" title="Print page">
                <i class="fal fa-print"></i>
            </a>
            <a href="#" class="menu-item btn" data-action="app-voice" data-toggle="tooltip" data-placement="left" title="Voice command">
                <i class="fal fa-microphone"></i>
            </a>
        </nav>
				<!-- END Quick Menu -->
				
        <!-- BEGIN Messenger -->
        <div class="modal fade js-modal-messenger modal-backdrop-transparent" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-right">
                <div class="modal-content h-100">
                    <div class="dropdown-header bg-trans-gradient d-flex align-items-center w-100">
                        <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
                            <span class="mr-2">
                                <span class="rounded-circle profile-image d-block" style="background-image:url('img/demo/avatars/avatar-d.png'); background-size: cover;"></span>
                            </span>
                            <div class="info-card-text">
                                <a href="javascript:void(0);" class="fs-lg text-truncate text-truncate-lg text-white" data-toggle="dropdown" aria-expanded="false">
                                    Tracey Chang
                                    <i class="fal fa-angle-down d-inline-block ml-1 text-white fs-md"></i>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Send Email</a>
                                    <a class="dropdown-item" href="#">Create Appointment</a>
                                    <a class="dropdown-item" href="#">Block User</a>
                                </div>
                                <span class="text-truncate text-truncate-md opacity-80">IT Director</span>
                            </div>
                        </div>
                        <button type="button" class="close text-white position-absolute pos-top pos-right p-2 m-1 mr-2" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                        </button>
                    </div>
                    <div class="modal-body p-0 h-100 d-flex">
                        <!-- BEGIN msgr-list -->
                        <div class="msgr-list d-flex flex-column bg-faded border-faded border-top-0 border-right-0 border-bottom-0 position-absolute pos-top pos-bottom">
                            <div>
                                <div class="height-4 width-3 h3 m-0 d-flex justify-content-center flex-column color-primary-500 pl-3 mt-2">
                                    <i class="fal fa-search"></i>
                                </div>
                                <input type="text" class="form-control bg-white" id="msgr_listfilter_input" placeholder="Filter contacts" aria-label="FriendSearch" data-listfilter="#js-msgr-listfilter">
                            </div>
                            <div class="flex-1 h-100 custom-scroll">
                                <div class="w-100">
                                    <ul id="js-msgr-listfilter" class="list-unstyled m-0">
                                        <li>
                                            <a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white" data-filter-tags="tracey chang online">
                                                <div class="d-table-cell align-middle status status-success status-sm ">
                                                    <span class="profile-image-md rounded-circle d-block" style="background-image:url('img/demo/avatars/avatar-d.png'); background-size: cover;"></span>
                                                </div>
                                                <div class="d-table-cell w-100 align-middle pl-2 pr-2">
                                                    <div class="text-truncate text-truncate-md">
                                                        Tracey Chang
                                                        <small class="d-block font-italic text-success fs-xs">
                                                            Online
                                                        </small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white" data-filter-tags="oliver kopyuv online">
                                                <div class="d-table-cell align-middle status status-success status-sm ">
                                                    <span class="profile-image-md rounded-circle d-block" style="background-image:url('img/demo/avatars/avatar-b.png'); background-size: cover;"></span>
                                                </div>
                                                <div class="d-table-cell w-100 align-middle pl-2 pr-2">
                                                    <div class="text-truncate text-truncate-md">
                                                        Oliver Kopyuv
                                                        <small class="d-block font-italic text-success fs-xs">
                                                            Online
                                                        </small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white" data-filter-tags="dr john cook phd away">
                                                <div class="d-table-cell align-middle status status-warning status-sm ">
                                                    <span class="profile-image-md rounded-circle d-block" style="background-image:url('img/demo/avatars/avatar-e.png'); background-size: cover;"></span>
                                                </div>
                                                <div class="d-table-cell w-100 align-middle pl-2 pr-2">
                                                    <div class="text-truncate text-truncate-md">
                                                        Dr. John Cook PhD
                                                        <small class="d-block font-italic fs-xs">
                                                            Away
                                                        </small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white" data-filter-tags="ali amdaney online">
                                                <div class="d-table-cell align-middle status status-success status-sm ">
                                                    <span class="profile-image-md rounded-circle d-block" style="background-image:url('img/demo/avatars/avatar-g.png'); background-size: cover;"></span>
                                                </div>
                                                <div class="d-table-cell w-100 align-middle pl-2 pr-2">
                                                    <div class="text-truncate text-truncate-md">
                                                        Ali Amdaney
                                                        <small class="d-block font-italic fs-xs text-success">
                                                            Online
                                                        </small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white" data-filter-tags="sarah mcbrook online">
                                                <div class="d-table-cell align-middle status status-success status-sm">
                                                    <span class="profile-image-md rounded-circle d-block" style="background-image:url('img/demo/avatars/avatar-h.png'); background-size: cover;"></span>
                                                </div>
                                                <div class="d-table-cell w-100 align-middle pl-2 pr-2">
                                                    <div class="text-truncate text-truncate-md">
                                                        Sarah McBrook
                                                        <small class="d-block font-italic fs-xs text-success">
                                                            Online
                                                        </small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white" data-filter-tags="ali amdaney offline">
                                                <div class="d-table-cell align-middle status status-sm">
                                                    <span class="profile-image-md rounded-circle d-block" style="background-image:url('img/demo/avatars/avatar-a.png'); background-size: cover;"></span>
                                                </div>
                                                <div class="d-table-cell w-100 align-middle pl-2 pr-2">
                                                    <div class="text-truncate text-truncate-md">
                                                        oliver.kopyuv@gotbootstrap.com
                                                        <small class="d-block font-italic fs-xs">
                                                            Offline
                                                        </small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white" data-filter-tags="ali amdaney busy">
                                                <div class="d-table-cell align-middle status status-danger status-sm">
                                                    <span class="profile-image-md rounded-circle d-block" style="background-image:url('img/demo/avatars/avatar-j.png'); background-size: cover;"></span>
                                                </div>
                                                <div class="d-table-cell w-100 align-middle pl-2 pr-2">
                                                    <div class="text-truncate text-truncate-md">
                                                        oliver.kopyuv@gotbootstrap.com
                                                        <small class="d-block font-italic fs-xs text-danger">
                                                            Busy
                                                        </small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white" data-filter-tags="ali amdaney offline">
                                                <div class="d-table-cell align-middle status status-sm">
                                                    <span class="profile-image-md rounded-circle d-block" style="background-image:url('img/demo/avatars/avatar-c.png'); background-size: cover;"></span>
                                                </div>
                                                <div class="d-table-cell w-100 align-middle pl-2 pr-2">
                                                    <div class="text-truncate text-truncate-md">
                                                        oliver.kopyuv@gotbootstrap.com
                                                        <small class="d-block font-italic fs-xs">
                                                            Offline
                                                        </small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white" data-filter-tags="ali amdaney inactive">
                                                <div class="d-table-cell align-middle">
                                                    <span class="profile-image-md rounded-circle d-block" style="background-image:url('img/demo/avatars/avatar-m.png'); background-size: cover;"></span>
                                                </div>
                                                <div class="d-table-cell w-100 align-middle pl-2 pr-2">
                                                    <div class="text-truncate text-truncate-md">
                                                        +714651347790
                                                        <small class="d-block font-italic fs-xs opacity-50">
                                                            Missed Call
                                                        </small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="filter-message js-filter-message"></div>
                                </div>
                            </div>
                            <div>
                                <a class="fs-xl d-flex align-items-center p-3">
                                    <i class="fal fa-cogs"></i>
                                </a>
                            </div>
                        </div>
                        <!-- END msgr-list -->
                        <!-- BEGIN msgr -->
                        <div class="msgr d-flex h-100 flex-column bg-white">
                            <!-- BEGIN custom-scroll -->
                            <div class="custom-scroll flex-1 h-100">
                                <div id="chat_container" class="w-100 p-4">
                                    <!-- start .chat-segment -->
                                    <div class="chat-segment">
                                        <div class="time-stamp text-center mb-2 fw-400">
                                            Jun 19
                                        </div>
                                    </div>
                                    <!--  end .chat-segment -->
                                    <!-- start .chat-segment -->
                                    <div class="chat-segment chat-segment-sent">
                                        <div class="chat-message">
                                            <p>
                                                Hey Tracey, did you get my files?
                                            </p>
                                        </div>
                                        <div class="text-right fw-300 text-muted mt-1 fs-xs">
                                            3:00 pm
                                        </div>
                                    </div>
                                    <!--  end .chat-segment -->
                                    <!-- start .chat-segment -->
                                    <div class="chat-segment chat-segment-get">
                                        <div class="chat-message">
                                            <p>
                                                Hi
                                            </p>
                                            <p>
                                                Sorry going through a busy time in office. Yes I analyzed the solution.
                                            </p>
                                            <p>
                                                It will require some resource, which I could not manage.
                                            </p>
                                        </div>
                                        <div class="fw-300 text-muted mt-1 fs-xs">
                                            3:24 pm
                                        </div>
                                    </div>
                                    <!--  end .chat-segment -->
                                    <!-- start .chat-segment -->
                                    <div class="chat-segment chat-segment-sent chat-start">
                                        <div class="chat-message">
                                            <p>
                                                Okay
                                            </p>
                                        </div>
                                    </div>
                                    <!--  end .chat-segment -->
                                    <!-- start .chat-segment -->
                                    <div class="chat-segment chat-segment-sent chat-end">
                                        <div class="chat-message">
                                            <p>
                                                Sending you some dough today, you can allocate the resources to this project.
                                            </p>
                                        </div>
                                        <div class="text-right fw-300 text-muted mt-1 fs-xs">
                                            3:26 pm
                                        </div>
                                    </div>
                                    <!--  end .chat-segment -->
                                    <!-- start .chat-segment -->
                                    <div class="chat-segment chat-segment-get chat-start">
                                        <div class="chat-message">
                                            <p>
                                                Perfect. Thanks a lot!
                                            </p>
                                        </div>
                                    </div>
                                    <!--  end .chat-segment -->
                                    <!-- start .chat-segment -->
                                    <div class="chat-segment chat-segment-get">
                                        <div class="chat-message">
                                            <p>
                                                I will have them ready by tonight.
                                            </p>
                                        </div>
                                    </div>
                                    <!--  end .chat-segment -->
                                    <!-- start .chat-segment -->
                                    <div class="chat-segment chat-segment-get chat-end">
                                        <div class="chat-message">
                                            <p>
                                                Cheers
                                            </p>
                                        </div>
                                    </div>
                                    <!--  end .chat-segment -->
                                    <!-- start .chat-segment for timestamp -->
                                    <div class="chat-segment">
                                        <div class="time-stamp text-center mb-2 fw-400">
                                            Jun 20
                                        </div>
                                    </div>
                                    <!--  end .chat-segment for timestamp -->
                                </div>
                            </div>
                            <!-- END custom-scroll  -->
                            <!-- BEGIN msgr__chatinput -->
                            <div class="d-flex flex-column">
                                <div class="border-faded border-right-0 border-bottom-0 border-left-0 flex-1 mr-3 ml-3 position-relative shadow-top">
                                    <div class="pt-3 pb-1 pr-0 pl-0 rounded-0" tabindex="-1">
                                        <div id="msgr_input" contenteditable="true" data-placeholder="Type your message here..." class="height-10 form-content-editable"></div>
                                    </div>
                                </div>
                                <div class="height-8 px-3 d-flex flex-row align-items-center flex-wrap flex-shrink-0">
                                    <a href="javascript:void(0);" class="btn btn-icon fs-xl width-1 mr-1" data-toggle="tooltip" data-original-title="More options" data-placement="top">
                                        <i class="fal fa-ellipsis-v-alt color-fusion-300"></i>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-icon fs-xl mr-1" data-toggle="tooltip" data-original-title="Attach files" data-placement="top">
                                        <i class="fal fa-paperclip color-fusion-300"></i>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-icon fs-xl mr-1" data-toggle="tooltip" data-original-title="Insert photo" data-placement="top">
                                        <i class="fal fa-camera color-fusion-300"></i>
                                    </a>
                                    <div class="ml-auto">
                                        <a href="javascript:void(0);" class="btn btn-info">Send</a>
                                    </div>
                                </div>
                            </div>
                            <!-- END msgr__chatinput -->
                        </div>
                        <!-- END msgr -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END Messenger -->
        <!-- BEGIN Page Settings -->
        <div class="modal fade js-modal-settings modal-backdrop-transparent" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-right modal-md">
                <div class="modal-content">
                    <div class="dropdown-header bg-trans-gradient d-flex justify-content-center align-items-center w-100">
                        <h4 class="m-0 text-center color-white">
                            Layout Settings
                            <small class="mb-0 opacity-80">User Interface Settings</small>
                        </h4>
                        <button type="button" class="close text-white position-absolute pos-top pos-right p-2 m-1 mr-2" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="settings-panel">
                            <div class="mt-4 d-table w-100 px-5">
                                <div class="d-table-cell align-middle">
                                    <h5 class="p-0">
                                        App Layout
                                    </h5>
                                </div>
                            </div>
                            <div class="list" id="fh">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="header-function-fixed"></a>
                                <span class="onoffswitch-title">Fixed Header</span>
                                <span class="onoffswitch-title-desc">header is in a fixed at all times</span>
                            </div>
                            <div class="list" id="nff">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-function-fixed"></a>
                                <span class="onoffswitch-title">Fixed Navigation</span>
                                <span class="onoffswitch-title-desc">left panel is fixed</span>
                            </div>
                            <div class="list" id="nfm">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-function-minify"></a>
                                <span class="onoffswitch-title">Minify Navigation</span>
                                <span class="onoffswitch-title-desc">Skew nav to maximize space</span>
                            </div>
                            <div class="list" id="nfh">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-function-hidden"></a>
                                <span class="onoffswitch-title">Hide Navigation</span>
                                <span class="onoffswitch-title-desc">roll mouse on edge to reveal</span>
                            </div>
                            <div class="list" id="nft">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-function-top"></a>
                                <span class="onoffswitch-title">Top Navigation</span>
                                <span class="onoffswitch-title-desc">Relocate left pane to top</span>
                            </div>
                            <div class="list" id="fff">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="footer-function-fixed"></a>
                                <span class="onoffswitch-title">Fixed Footer</span>
                                <span class="onoffswitch-title-desc">page footer is fixed</span>
                            </div>
                            <div class="list" id="mmb">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-main-boxed"></a>
                                <span class="onoffswitch-title">Boxed Layout</span>
                                <span class="onoffswitch-title-desc">Encapsulates to a container</span>
                            </div>
                            <div class="expanded">
                                <ul class="mb-3 mt-1">
                                    <li>
                                        <div class="bg-fusion-50" data-action="toggle" data-class="mod-bg-1"></div>
                                    </li>
                                    <li>
                                        <div class="bg-warning-200" data-action="toggle" data-class="mod-bg-2"></div>
                                    </li>
                                    <li>
                                        <div class="bg-primary-200" data-action="toggle" data-class="mod-bg-3"></div>
                                    </li>
                                    <li>
                                        <div class="bg-success-300" data-action="toggle" data-class="mod-bg-4"></div>
                                    </li>
                                    <li>
                                        <div class="bg-white border" data-action="toggle" data-class="mod-bg-none"></div>
                                    </li>
                                </ul>
                                <div class="list" id="mbgf">
                                    <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-fixed-bg"></a>
                                    <span class="onoffswitch-title">Fixed Background</span>
                                </div>
                            </div>
                            <div class="mt-4 d-table w-100 px-5">
                                <div class="d-table-cell align-middle">
                                    <h5 class="p-0">
                                        Mobile Menu
                                    </h5>
                                </div>
                            </div>
                            <div class="list" id="nmp">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-mobile-push"></a>
                                <span class="onoffswitch-title">Push Content</span>
                                <span class="onoffswitch-title-desc">Content pushed on menu reveal</span>
                            </div>
                            <div class="list" id="nmno">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-mobile-no-overlay"></a>
                                <span class="onoffswitch-title">No Overlay</span>
                                <span class="onoffswitch-title-desc">Removes mesh on menu reveal</span>
                            </div>
                            <div class="list" id="sldo">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-mobile-slide-out"></a>
                                <span class="onoffswitch-title">Off-Canvas <sup>(beta)</sup></span>
                                <span class="onoffswitch-title-desc">Content overlaps menu</span>
                            </div>
                            <div class="mt-4 d-table w-100 px-5">
                                <div class="d-table-cell align-middle">
                                    <h5 class="p-0">
                                        Accessibility
                                    </h5>
                                </div>
                            </div>
                            <div class="list" id="mbf">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-bigger-font"></a>
                                <span class="onoffswitch-title">Bigger Content Font</span>
                                <span class="onoffswitch-title-desc">content fonts are bigger for readability</span>
                            </div>
                            <div class="list" id="mhc">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-high-contrast"></a>
                                <span class="onoffswitch-title">High Contrast Text (WCAG 2 AA)</span>
                                <span class="onoffswitch-title-desc">4.5:1 text contrast ratio</span>
                            </div>
                            <div class="list" id="mcb">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-color-blind"></a>
                                <span class="onoffswitch-title">Daltonism <sup>(beta)</sup> </span>
                                <span class="onoffswitch-title-desc">color vision deficiency</span>
                            </div>
                            <div class="list" id="mpc">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-pace-custom"></a>
                                <span class="onoffswitch-title">Preloader Inside</span>
                                <span class="onoffswitch-title-desc">preloader will be inside content</span>
                            </div>
                            <div class="list" id="mpi">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-panel-icon"></a>
                                <span class="onoffswitch-title">SmartPanel Icons (not Panels)</span>
                                <span class="onoffswitch-title-desc">smartpanel buttons will appear as icons</span>
                            </div>
                            <div class="mt-4 d-table w-100 px-5">
                                <div class="d-table-cell align-middle">
                                    <h5 class="p-0">
                                        Global Modifications
                                    </h5>
                                </div>
                            </div>
                            <div class="list" id="mcbg">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-clean-page-bg"></a>
                                <span class="onoffswitch-title">Clean Page Background</span>
                                <span class="onoffswitch-title-desc">adds more whitespace</span>
                            </div>
                            <div class="list" id="mhni">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-hide-nav-icons"></a>
                                <span class="onoffswitch-title">Hide Navigation Icons</span>
                                <span class="onoffswitch-title-desc">invisible navigation icons</span>
                            </div>
                            <div class="list" id="dan">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-disable-animation"></a>
                                <span class="onoffswitch-title">Disable CSS Animation</span>
                                <span class="onoffswitch-title-desc">Disables CSS based animations</span>
                            </div>
                            <div class="list" id="mhic">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-hide-info-card"></a>
                                <span class="onoffswitch-title">Hide Info Card</span>
                                <span class="onoffswitch-title-desc">Hides info card from left panel</span>
                            </div>
                            <div class="list" id="mlph">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-lean-subheader"></a>
                                <span class="onoffswitch-title">Lean Subheader</span>
                                <span class="onoffswitch-title-desc">distinguished page header</span>
                            </div>
                            <div class="list" id="mnl">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-nav-link"></a>
                                <span class="onoffswitch-title">Hierarchical Navigation</span>
                                <span class="onoffswitch-title-desc">Clear breakdown of nav links</span>
                            </div>
                            <div class="list" id="mdn">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-nav-dark"></a>
                                <span class="onoffswitch-title">Dark Navigation</span>
                                <span class="onoffswitch-title-desc">Navigation background is darkend</span>
                            </div>
                            <hr class="mb-0 mt-4">
                            <div class="mt-4 d-table w-100 pl-5 pr-3">
                                <div class="d-table-cell align-middle">
                                    <h5 class="p-0">
                                        Global Font Size
                                    </h5>
                                </div>
                            </div>
                            <div class="list mt-1">
                                <div class="btn-group btn-group-sm btn-group-toggle my-2" data-toggle="buttons">
                                    <label class="btn btn-default btn-sm" data-action="toggle-swap" data-class="root-text-sm" data-target="html">
                                        <input type="radio" name="changeFrontSize"> SM
                                    </label>
                                    <label class="btn btn-default btn-sm" data-action="toggle-swap" data-class="root-text" data-target="html">
                                        <input type="radio" name="changeFrontSize" checked=""> MD
                                    </label>
                                    <label class="btn btn-default btn-sm" data-action="toggle-swap" data-class="root-text-lg" data-target="html">
                                        <input type="radio" name="changeFrontSize"> LG
                                    </label>
                                    <label class="btn btn-default btn-sm" data-action="toggle-swap" data-class="root-text-xl" data-target="html">
                                        <input type="radio" name="changeFrontSize"> XL
                                    </label>
                                </div>
                                <span class="onoffswitch-title-desc d-block mb-0">Change <strong>root</strong> font size to effect rem
                                    values (resets on page refresh)</span>
                            </div>
                            <hr class="mb-0 mt-4">
                            <div class="mt-4 d-table w-100 pl-5 pr-3">
                                <div class="d-table-cell align-middle">
                                    <h5 class="p-0 pr-2 d-flex">
                                        Theme colors
                                        <a href="#" class="ml-auto fw-400 fs-xs" data-toggle="popover" data-trigger="focus" data-placement="top" title="" data-html="true" data-content="The settings below uses <code>localStorage</code> to load the external <strong>CSS</strong> file as an overlap to the base css. Due to network latency and <strong>CPU utilization</strong>, you may experience a brief flickering effect on page load which may show the intial applied theme for a split second. Setting the prefered style/theme in the header will prevent this from happening." data-original-title="<span class='text-primary'><i class='fal fa-exclamation-triangle mr-1'></i> Heads up!</span>" data-template="<div class=&quot;popover bg-white border-white&quot; role=&quot;tooltip&quot;><div class=&quot;arrow&quot;></div><h3 class=&quot;popover-header bg-transparent&quot;></h3><div class=&quot;popover-body fs-xs&quot;></div></div>"><i class="fal fa-info-circle mr-1"></i> more info</a>
                                    </h5>
                                </div>
                            </div>
                            <div class="expanded theme-colors pl-5 pr-3">
                                <ul class="m-0">
                                    <li>
                                        <a href="#" id="myapp-0" data-action="theme-update" data-themesave data-theme="" data-toggle="tooltip" data-placement="top" title="Wisteria (base css)" data-original-title="Wisteria (base css)"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-1" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-1.css" data-toggle="tooltip" data-placement="top" title="Tapestry" data-original-title="Tapestry"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-2" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-2.css" data-toggle="tooltip" data-placement="top" title="Atlantis" data-original-title="Atlantis"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-3" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-3.css" data-toggle="tooltip" data-placement="top" title="Indigo" data-original-title="Indigo"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-4" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-4.css" data-toggle="tooltip" data-placement="top" title="Dodger Blue" data-original-title="Dodger Blue"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-5" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-5.css" data-toggle="tooltip" data-placement="top" title="Tradewind" data-original-title="Tradewind"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-6" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-6.css" data-toggle="tooltip" data-placement="top" title="Cranberry" data-original-title="Cranberry"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-7" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-7.css" data-toggle="tooltip" data-placement="top" title="Oslo Gray" data-original-title="Oslo Gray"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-8" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-8.css" data-toggle="tooltip" data-placement="top" title="Chetwode Blue" data-original-title="Chetwode Blue"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-9" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-9.css" data-toggle="tooltip" data-placement="top" title="Apricot" data-original-title="Apricot"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-10" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-10.css" data-toggle="tooltip" data-placement="top" title="Blue Smoke" data-original-title="Blue Smoke"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-11" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-11.css" data-toggle="tooltip" data-placement="top" title="Green Smoke" data-original-title="Green Smoke"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-12" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-12.css" data-toggle="tooltip" data-placement="top" title="Wild Blue Yonder" data-original-title="Wild Blue Yonder"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-13" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-13.css" data-toggle="tooltip" data-placement="top" title="Emerald" data-original-title="Emerald"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-14" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-14.css" data-toggle="tooltip" data-placement="top" title="Supernova" data-original-title="Supernova"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-15" data-action="theme-update" data-themesave data-theme="css/themes/cust-theme-15.css" data-toggle="tooltip" data-placement="top" title="Hoki" data-original-title="Hoki"></a>
                                    </li>
                                </ul>
                            </div>
                            <hr class="mb-0 mt-4">
                            <div class="mt-4 d-table w-100 pl-5 pr-3">
                                <div class="d-table-cell align-middle">
                                    <h5 class="p-0 pr-2 d-flex">
                                        Theme Modes (beta)
                                        <a href="#" class="ml-auto fw-400 fs-xs" data-toggle="popover" data-trigger="focus" data-placement="top" title="" data-html="true" data-content="This is a brand new technique we are introducing which uses CSS variables to infiltrate color options. While this has been working nicely on modern browsers without much issues, some users <strong>may still face issues on Internet Explorer </strong>. Until these issues are resolved or Internet Explorer improves, this feature will remain in Beta" data-original-title="<span class='text-primary'><i class='fal fa-question-circle mr-1'></i> Why beta?</span>" data-template="<div class=&quot;popover bg-white border-white&quot; role=&quot;tooltip&quot;><div class=&quot;arrow&quot;></div><h3 class=&quot;popover-header bg-transparent&quot;></h3><div class=&quot;popover-body fs-xs&quot;></div></div>"><i class="fal fa-question-circle mr-1"></i> why beta?</a>
                                    </h5>
                                </div>
                            </div>
                            <div class="pl-5 pr-3 py-3">
                                <div class="ie-only alert alert-warning d-none">
                                    <h6>Internet Explorer Issue</h6>
                                    This particular component may not work as expected in Internet Explorer. Please use with caution.
                                </div>
                                <div class="row no-gutters">
                                    <div class="col-4 pr-2 text-center">
                                        <div id="skin-default" data-action="toggle-replace" data-replaceclass="mod-skin-light mod-skin-dark" data-class="" data-toggle="tooltip" data-placement="top" title="" class="d-flex bg-white border border-primary rounded overflow-hidden text-success js-waves-on" data-original-title="Default Mode" style="height: 80px">
                                            <div class="bg-primary-600 bg-primary-gradient px-2 pt-0 border-right border-primary"></div>
                                            <div class="d-flex flex-column flex-1">
                                                <div class="bg-white border-bottom border-primary py-1"></div>
                                                <div class="bg-faded flex-1 pt-3 pb-3 px-2">
                                                    <div class="py-3" style="background:url('img/demo/s-1.png') top left no-repeat;background-size: 100%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                        Default
                                    </div>
                                    <div class="col-4 px-1 text-center">
                                        <div id="skin-light" data-action="toggle-replace" data-replaceclass="mod-skin-dark" data-class="mod-skin-light" data-toggle="tooltip" data-placement="top" title="" class="d-flex bg-white border border-secondary rounded overflow-hidden text-success js-waves-on" data-original-title="Light Mode" style="height: 80px">
                                            <div class="bg-white px-2 pt-0 border-right border-"></div>
                                            <div class="d-flex flex-column flex-1">
                                                <div class="bg-white border-bottom border- py-1"></div>
                                                <div class="bg-white flex-1 pt-3 pb-3 px-2">
                                                    <div class="py-3" style="background:url('img/demo/s-1.png') top left no-repeat;background-size: 100%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                        Light
                                    </div>
                                    <div class="col-4 pl-2 text-center">
                                        <div id="skin-dark" data-action="toggle-replace" data-replaceclass="mod-skin-light" data-class="mod-skin-dark" data-toggle="tooltip" data-placement="top" title="" class="d-flex bg-white border border-dark rounded overflow-hidden text-success js-waves-on" data-original-title="Dark Mode" style="height: 80px">
                                            <div class="bg-fusion-500 px-2 pt-0 border-right"></div>
                                            <div class="d-flex flex-column flex-1">
                                                <div class="bg-fusion-600 border-bottom py-1"></div>
                                                <div class="bg-fusion-300 flex-1 pt-3 pb-3 px-2">
                                                    <div class="py-3 opacity-30" style="background:url('img/demo/s-1.png') top left no-repeat;background-size: 100%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                        Dark
                                    </div>
                                </div>
                            </div>
                            <hr class="mb-0 mt-4">
                            <div class="pl-5 pr-3 py-3 bg-faded">
                                <div class="row no-gutters">
                                    <div class="col-6 pr-1">
                                        <a href="#" class="btn btn-outline-danger fw-500 btn-block" data-action="app-reset">Reset Settings</a>
                                    </div>
                                    <div class="col-6 pl-1">
                                        <a href="#" class="btn btn-danger fw-500 btn-block" data-action="factory-reset">Factory Reset</a>
                                    </div>
                                </div>
                            </div>
                        </div> <span id="saving"></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Page Settings -->
        <!-- base vendor bundle: 
			 DOC: if you remove pace.js from core please note on Internet Explorer some CSS animations may execute before a page is fully loaded, resulting 'jump' animations 
						+ pace.js (recommended)
						+ jquery.js (core)
						+ jquery-ui-cust.js (core)
						+ popper.js (core)
						+ bootstrap.js (core)
						+ slimscroll.js (extension)
						+ app.navigation.js (core)
						+ ba-throttle-debounce.js (core)
						+ waves.js (extension)
						+ smartpanels.js (extension)
						+ src/../jquery-snippets.js (core) -->
        <script src="{{themes('js/vendors.bundle.js')}}"></script>
        <script src="{{themes('js/app.bundle.js')}}"></script>
        <script type="text/javascript">
            /* Activate smart panels */
            $('#js-page-content').smartPanel();

        </script>
        <!-- The order of scripts is irrelevant. Please check out the plugin pages for more details about these plugins below: -->
        <script src="{{themes('js/dependency/moment/moment.js')}}"></script>
        <script src="{{themes('js/miscellaneous/fullcalendar/fullcalendar.bundle.js')}}"></script>
        <script src="{{themes('js/statistics/sparkline/sparkline.bundle.js')}}"></script>
        <script src="{{themes('js/statistics/easypiechart/easypiechart.bundle.js')}}"></script>
        <script src="{{themes('js/statistics/flot/flot.bundle.js')}}"></script>
        <script src="{{themes('js/miscellaneous/jqvmap/jqvmap.bundle.js')}}"></script>
        <script>
            $(document).ready(function()
            {
                //$('#js-page-content').smartPanel(); 

                //
                //
                var dataSetPie = [
                {
                    label: "Asia",
                    data: 4119630000,
                    color: color.primary._500
                },
                {
                    label: "Latin America",
                    data: 590950000,
                    color: color.info._500
                },
                {
                    label: "Africa",
                    data: 1012960000,
                    color: color.warning._500
                },
                {
                    label: "Oceania",
                    data: 95100000,
                    color: color.danger._500
                },
                {
                    label: "Europe",
                    data: 727080000,
                    color: color.success._500
                },
                {
                    label: "North America",
                    data: 344120000,
                    color: color.fusion._400
                }];


                $.plot($("#flotPie"), dataSetPie,
                {
                    series:
                    {
                        pie:
                        {
                            innerRadius: 0.5,
                            show: true,
                            radius: 1,
                            label:
                            {
                                show: true,
                                radius: 2 / 3,
                                threshold: 0.1
                            }
                        }
                    },
                    legend:
                    {
                        show: false
                    }
                });


                $.plot('#flotBar1', [
                {
                    data: [
                        [1, 0],
                        [2, 0],
                        [3, 0],
                        [4, 1],
                        [5, 3],
                        [6, 3],
                        [7, 10],
                        [8, 11],
                        [9, 10],
                        [10, 9],
                        [11, 12],
                        [12, 8],
                        [13, 10],
                        [14, 6],
                        [15, 3]
                    ],
                    bars:
                    {
                        show: true,
                        lineWidth: 0,
                        fillColor: color.fusion._50,
                        barWidth: .3,
                        order: 'left'
                    }
                },
                {
                    data: [
                        [1, 0],
                        [2, 0],
                        [3, 1],
                        [4, 2],
                        [5, 2],
                        [6, 5],
                        [7, 8],
                        [8, 12],
                        [9, 10],
                        [10, 11],
                        [11, 3]
                    ],
                    bars:
                    {
                        show: true,
                        lineWidth: 0,
                        fillColor: color.success._500,
                        barWidth: .3,
                        align: 'right'
                    }
                }],
                {
                    grid:
                    {
                        borderWidth: 0,
                    },
                    yaxis:
                    {
                        min: 0,
                        max: 15,
                        tickColor: 'rgba(0,0,0,0.05)',
                        ticks: [
                            [0, ''],
                            [5, '$5000'],
                            [10, '$25000'],
                            [15, '$45000']
                        ],
                        font:
                        {
                            color: '#444',
                            size: 10
                        }
                    },
                    xaxis:
                    {
                        mode: 'categories',
                        tickColor: 'rgba(0,0,0,0.05)',
                        ticks: [
                            [0, '3am'],
                            [1, '4am'],
                            [2, '5am'],
                            [3, '6am'],
                            [4, '7am'],
                            [5, '8am'],
                            [6, '9am'],
                            [7, '10am'],
                            [8, '11am'],
                            [9, '12nn'],
                            [10, '1pm'],
                            [11, '2pm'],
                            [12, '3pm'],
                            [13, '4pm'],
                            [14, '5pm']
                        ],
                        font:
                        {
                            color: '#999',
                            size: 9
                        }
                    }
                });


                /*
                 * VECTOR MAP
                 */

                var data_array = {
                    "af": "16.63",
                    "al": "0",
                    "dz": "158.97",
                    "ao": "85.81",
                    "ag": "1.1",
                    "ar": "351.02",
                    "am": "8.83",
                    "au": "1219.72",
                    "at": "366.26",
                    "az": "52.17",
                    "bs": "7.54",
                    "bh": "21.73",
                    "bd": "105.4",
                    "bb": "3.96",
                    "by": "52.89",
                    "be": "461.33",
                    "bz": "1.43",
                    "bj": "6.49",
                    "bt": "1.4",
                    "bo": "19.18",
                    "ba": "16.2",
                    "bw": "12.5",
                    "br": "2023.53",
                    "bn": "11.96",
                    "bg": "44.84",
                    "bf": "8.67",
                    "bi": "1.47",
                    "kh": "11.36",
                    "cm": "21.88",
                    "ca": "1563.66",
                    "cv": "1.57",
                    "cf": "2.11",
                    "td": "7.59",
                    "cl": "199.18",
                    "cn": "5745.13",
                    "co": "283.11",
                    "km": "0.56",
                    "cd": "12.6",
                    "cg": "11.88",
                    "cr": "35.02",
                    "ci": "22.38",
                    "hr": "59.92",
                    "cy": "22.75",
                    "cz": "195.23",
                    "dk": "304.56",
                    "dj": "1.14",
                    "dm": "0.38",
                    "do": "50.87",
                    "ec": "61.49",
                    "eg": "216.83",
                    "sv": "21.8",
                    "gq": "14.55",
                    "er": "2.25",
                    "ee": "19.22",
                    "et": "30.94",
                    "fj": "3.15",
                    "fi": "231.98",
                    "fr": "2555.44",
                    "ga": "12.56",
                    "gm": "1.04",
                    "ge": "11.23",
                    "de": "3305.9",
                    "gh": "18.06",
                    "gr": "305.01",
                    "gd": "0.65",
                    "gt": "40.77",
                    "gn": "4.34",
                    "gw": "0.83",
                    "gy": "2.2",
                    "ht": "6.5",
                    "hn": "15.34",
                    "hk": "226.49",
                    "hu": "132.28",
                    "is": "0",
                    "in": "1430.02",
                    "id": "695.06",
                    "ir": "337.9",
                    "iq": "84.14",
                    "ie": "204.14",
                    "il": "201.25",
                    "it": "2036.69",
                    "jm": "13.74",
                    "jp": "5390.9",
                    "jo": "27.13",
                    "kz": "129.76",
                    "ke": "32.42",
                    "ki": "0.15",
                    "kw": "117.32",
                    "kg": "4.44",
                    "la": "6.34",
                    "lv": "23.39",
                    "lb": "39.15",
                    "ls": "1.8",
                    "lr": "0.98",
                    "lt": "35.73",
                    "lu": "52.43",
                    "mk": "9.58",
                    "mg": "8.33",
                    "mw": "5.04",
                    "my": "218.95",
                    "mv": "1.43",
                    "ml": "9.08",
                    "mt": "7.8",
                    "mr": "3.49",
                    "mu": "9.43",
                    "mx": "1004.04",
                    "md": "5.36",
                    "rw": "5.69",
                    "ws": "0.55",
                    "st": "0.19",
                    "sa": "434.44",
                    "sn": "12.66",
                    "rs": "38.92",
                    "sc": "0.92",
                    "sl": "1.9",
                    "sg": "217.38",
                    "sk": "86.26",
                    "si": "46.44",
                    "sb": "0.67",
                    "za": "354.41",
                    "es": "1374.78",
                    "lk": "48.24",
                    "kn": "0.56",
                    "lc": "1",
                    "vc": "0.58",
                    "sd": "65.93",
                    "sr": "3.3",
                    "sz": "3.17",
                    "se": "444.59",
                    "ch": "522.44",
                    "sy": "59.63",
                    "tw": "426.98",
                    "tj": "5.58",
                    "tz": "22.43",
                    "th": "312.61",
                    "tl": "0.62",
                    "tg": "3.07",
                    "to": "0.3",
                    "tt": "21.2",
                    "tn": "43.86",
                    "tr": "729.05",
                    "tm": "0",
                    "ug": "17.12",
                    "ua": "136.56",
                    "ae": "239.65",
                    "gb": "2258.57",
                    "us": "14624.18",
                    "uy": "40.71",
                    "uz": "37.72",
                    "vu": "0.72",
                    "ve": "285.21",
                    "vn": "101.99",
                    "ye": "30.02",
                    "zm": "15.69",
                    "zw": "0"
                };

                $('#vector-map').vectorMap(
                {
                    map: 'world_en',
                    backgroundColor: 'transparent',
                    color: color.warning._50,
                    borderOpacity: 0.5,
                    borderWidth: 1,
                    hoverColor: color.success._300,
                    hoverOpacity: null,
                    selectedColor: color.success._500,
                    selectedRegions: ['US'],
                    enableZoom: true,
                    showTooltip: true,
                    scaleColors: [color.primary._400, color.primary._50],
                    values: data_array,
                    normalizeFunction: 'polynomial',
                    onRegionClick: function(element, code, region)
                    {
                        /*var message = 'You clicked "'
						+ region
						+ '" which has the code: '
						+ code.toLowerCase();
			 
					console.log(message);*/

                        var randomNumber = Math.floor(Math.random() * 10000000);
                        var arrow;

                        if (Math.random() >= 0.5 == true)
                        {
                            arrow = '<div class="ml-2 d-inline-flex"><i class="fal fa-caret-up text-success fs-xs"></i></div>'
                        }
                        else
                        {
                            arrow = '<div class="ml-2 d-inline-flex"><i class="fal fa-caret-down text-danger fs-xs"></i></div>'
                        }

                        $('.js-jqvmap-flag').attr('src', 'https://lipis.github.io/flag-icon-css/flags/4x3/' + code.toLowerCase() + '.svg');
                        $('.js-jqvmap-country').html(region + ' - ' + '$' + randomNumber.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + arrow);
                    }
                });


                /* TAB 1: UPDATING CHART */
                var data = [],
                    totalPoints = 200;
                var getRandomData = function()
                {
                    if (data.length > 0)
                        data = data.slice(1);

                    // do a random walk
                    while (data.length < totalPoints)
                    {
                        var prev = data.length > 0 ? data[data.length - 1] : 50;
                        var y = prev + Math.random() * 10 - 5;
                        if (y < 0)
                            y = 0;
                        if (y > 100)
                            y = 100;
                        data.push(y);
                    }

                    // zip the generated y values with the x values
                    var res = [];
                    for (var i = 0; i < data.length; ++i)
                        res.push([i, data[i]])
                    return res;
                }
                // setup control widget
                var updateInterval = 1500;
                $("#updating-chart").val(updateInterval).change(function()
                {

                    var v = $(this).val();
                    if (v && !isNaN(+v))
                    {
                        updateInterval = +v;
                        $(this).val("" + updateInterval);
                    }

                });
                // setup plot
                var options = {
                    colors: [color.primary._700],
                    series:
                    {
                        lines:
                        {
                            show: true,
                            lineWidth: 0.5,
                            fill: 0.9,
                            fillColor:
                            {
                                colors: [
                                {
                                    opacity: 0.6
                                },
                                {
                                    opacity: 0
                                }]
                            },
                        },

                        shadowSize: 0 // Drawing is faster without shadows
                    },
                    grid:
                    {
                        borderColor: 'rgba(0,0,0,0.05)',
                        borderWidth: 1,
                        labelMargin: 5
                    },
                    xaxis:
                    {
                        color: '#F0F0F0',
                        tickColor: 'rgba(0,0,0,0.05)',
                        font:
                        {
                            size: 10,
                            color: '#999'
                        }
                    },
                    yaxis:
                    {
                        min: 0,
                        max: 100,
                        color: '#F0F0F0',
                        tickColor: 'rgba(0,0,0,0.05)',
                        font:
                        {
                            size: 10,
                            color: '#999'
                        }
                    }
                };
                var plot = $.plot($("#updating-chart"), [getRandomData()], options);
                /* live switch */
                $('input[type="checkbox"]#start_interval').click(function()
                {
                    if ($(this).prop('checked'))
                    {
                        $on = true;
                        updateInterval = 1500;
                        update();
                    }
                    else
                    {
                        clearInterval(updateInterval);
                        $on = false;
                    }
                });
                var update = function()
                {
                    if ($on == true)
                    {
                        plot.setData([getRandomData()]);
                        plot.draw();
                        setTimeout(update, updateInterval);

                    }
                    else
                    {
                        clearInterval(updateInterval)
                    }

                }



                /*calendar */
                var todayDate = moment().startOf('day');
                var YM = todayDate.format('YYYY-MM');
                var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
                var TODAY = todayDate.format('YYYY-MM-DD');
                var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');


                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl,
                {
                    plugins: ['dayGrid', 'list', 'timeGrid', 'interaction', 'bootstrap'],
                    themeSystem: 'bootstrap',
                    timeZone: 'UTC',
                    //dateAlignment: "month", //week, month
                    buttonText:
                    {
                        today: 'today',
                        month: 'month',
                        week: 'week',
                        day: 'day',
                        list: 'list'
                    },
                    eventTimeFormat:
                    {
                        hour: 'numeric',
                        minute: '2-digit',
                        meridiem: 'short'
                    },
                    navLinks: true,
                    header:
                    {
                        left: 'title',
                        center: '',
                        right: 'today prev,next'
                    },
                    footer:
                    {
                        left: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek',
                        center: '',
                        right: ''
                    },
                    editable: true,
                    eventLimit: true, // allow "more" link when too many events
                    events: [
                    {
                        title: 'All Day Event',
                        start: YM + '-01',
                        description: 'This is a test description', //this is currently bugged: https://github.com/fullcalendar/fullcalendar/issues/1795
                        className: "border-warning bg-warning text-dark"
                    },
                    {
                        title: 'Reporting',
                        start: YM + '-14T13:30:00',
                        end: YM + '-14',
                        className: "bg-white border-primary text-primary"
                    },
                    {
                        title: 'Surgery oncall',
                        start: YM + '-02',
                        end: YM + '-03',
                        className: "bg-primary border-primary text-white"
                    },
                    {
                        title: 'NextGen Expo 2019 - Product Release',
                        start: YM + '-03',
                        end: YM + '-05',
                        className: "bg-info border-info text-white"
                    },
                    {
                        title: 'Dinner',
                        start: YM + '-12',
                        end: YM + '-10'
                    },
                    {
                        id: 999,
                        title: 'Repeating Event',
                        start: YM + '-09T16:00:00',
                        className: "bg-danger border-danger text-white"
                    },
                    {
                        id: 1000,
                        title: 'Repeating Event',
                        start: YM + '-16T16:00:00'
                    },
                    {
                        title: 'Conference',
                        start: YESTERDAY,
                        end: TOMORROW,
                        className: "bg-success border-success text-white"
                    },
                    {
                        title: 'Meeting',
                        start: TODAY + 'T10:30:00',
                        end: TODAY + 'T12:30:00',
                        className: "bg-primary text-white border-primary"
                    },
                    {
                        title: 'Lunch',
                        start: TODAY + 'T12:00:00',
                        className: "bg-info border-info"
                    },
                    {
                        title: 'Meeting',
                        start: TODAY + 'T14:30:00',
                        className: "bg-warning text-dark border-warning"
                    },
                    {
                        title: 'Happy Hour',
                        start: TODAY + 'T17:30:00',
                        className: "bg-success border-success text-white"
                    },
                    {
                        title: 'Dinner',
                        start: TODAY + 'T20:00:00',
                        className: "bg-danger border-danger text-white"
                    },
                    {
                        title: 'Birthday Party',
                        start: TOMORROW + 'T07:00:00',
                        className: "bg-primary text-white border-primary text-white"
                    },
                    {
                        title: 'Gotbootstrap Meeting',
                        url: 'http://gotbootstrap.com/',
                        start: YM + '-28',
                        className: "bg-info border-info text-white"
                    }],
                    viewSkeletonRender: function()
                    {
                        $('.fc-toolbar .btn-default').addClass('btn-sm');
                        $('.fc-header-toolbar h2').addClass('fs-md');
                        $('#calendar').addClass('fc-reset-order')
                    },

                });

                calendar.render();
            });

        </script>
        @yield('footer_scripts')
    </body>
    <!-- END Body -->
</html>