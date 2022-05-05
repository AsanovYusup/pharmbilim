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
        <!-- The order of scripts is irrelevant. Please check out the plugin pages for more details about these plugins below: -->
        <script src="{{themes('js/dependency/moment/moment.js')}}"></script>
        <script src="{{themes('js/miscellaneous/fullcalendar/fullcalendar.bundle.js')}}"></script>
        <script src="{{themes('js/statistics/sparkline/sparkline.bundle.js')}}"></script>
        <script src="{{themes('js/statistics/easypiechart/easypiechart.bundle.js')}}"></script>
        <script src="{{themes('js/statistics/flot/flot.bundle.js')}}"></script>
        <script src="{{themes('js/miscellaneous/jqvmap/jqvmap.bundle.js')}}"></script>
        <script src="{{themes('js/formplugins/select2/select2.bundle.js')}}"></script>
        <script src="{{themes('js/datagrid/datatables/datatables.bundle.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
       

        <script type="text/javascript">
            /* Activate smart panels */
            $('#js-page-content').smartPanel();
            $('.select2').select2();
        </script>
        
        
        @yield('footer_scripts')
        @stack('custom-scripts')
    </body>
    <!-- END Body -->
</html>