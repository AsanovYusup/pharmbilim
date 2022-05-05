<!DOCTYPE html>
<html lang="ru" dir="{{ (App\Language::isDefaultLanuageRtl()) ? 'rtl' : 'ltr' }}">
    <head>
        <meta charset="utf-8">
        <meta name="description" content="{{getSetting('meta_description', 'seo_settings')}}">
		<meta name="keywords" content="{{getSetting('meta_keywords', 'seo_settings')}}">                
		<meta name="csrf_token" content="{{ csrf_token() }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="msapplication-tap-highlight" content="no">
				
		<link rel="icon" href="{{IMAGE_PATH_SETTINGS.getSetting('site_favicon', 'site_settings')}}" type="image/x-icon" />

		<title>@yield('title') {{ isset($title) ? $title : getSetting('site_title','site_settings') }}</title>
        <!-- Call App Mode on ios devices -->
        <!-- Remove Tap Highlight on Windows Phone IE -->
				
        <!-- base css -->
        <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="{{themes('css/vendors.bundle.css')}}">
        <link id="appbundle" rel="stylesheet" media="screen, print" href="{{themes('css/app.bundle.css')}}">
        {{-- <link id="mytheme" rel="stylesheet" media="screen, print" href="#"> --}}
        <link id="myskin" rel="stylesheet" media="screen, print" href="{{themes('css/skins/skin-master.css')}}">
        <!-- Place favicon.ico in the root directory -->
        {{-- <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png"> --}}
        <link rel="mask-icon" href="img/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="stylesheet" media="screen, print" href="{{themes('css/miscellaneous/reactions/reactions.css')}}">
        <link rel="stylesheet" media="screen, print" href="{{themes('css/miscellaneous/fullcalendar/fullcalendar.bundle.css')}}">
        <link rel="stylesheet" media="screen, print" href="{{themes('css/miscellaneous/jqvmap/jqvmap.bundle.css')}}">
        <link rel="stylesheet" media="screen, print" href="{{themes('css/formplugins/select2/select2.bundle.css')}}">
        <link rel="stylesheet" media="screen, print" href="{{themes('css/datagrid/datatables/datatables.bundle.css')}}">
        <link rel="stylesheet" media="screen, print" href="{{themes('css/fa-brands.css')}}">
        <link rel="stylesheet" media="screen, print" href="{{themes('css/fa-solid.css')}}">
        <link rel="stylesheet" media="screen, print" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
        


        @yield('header_scripts')
        @stack('custom_styles')
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