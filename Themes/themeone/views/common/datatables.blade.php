<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" type="text/css">

<link href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css" type="text/css">

<link href="https://cdn.datatables.net/responsive/2.2.3/css/dataTables.responsive.css" type="text/css">




<script src="{{themes('js/bootstrap-toggle.min.js')}}"></script>

	<script src="{{themes('js/jquery.dataTables.min.js')}}"></script>

	<script src="{{themes('js/dataTables.bootstrap.min.js')}}"></script>



<script src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>

<script src="//cdn.datatables.net/buttons/1.4.2/js/buttons.flash.min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>

<script src="//cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>

<script src="//cdn.datatables.net/buttons/1.4.2/js/buttons.print.min.js"></script>

<script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.js"></script>


	
	<?php 	$routeValue= $route; ?> 



	@if(!isset($route_as_url))

	{

		<?php $routeValue =  route($route); ?>

	}

	@endif

	

	<?php  

	$setData = array();

		if(isset($table_columns))

		{

			foreach($table_columns as $col) {

				$temp['data'] = $col;

				$temp['name'] = $col;

				array_push($setData, $temp);

			}

			$setData = json_encode($setData);

		}

	?>





  <script>



  var tableObj;

  

    $(document).ready(function(){

    	$.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        	}

		});



   		 tableObj = $('.datatable').DataTable({

   		 		"language": {
  					"search": '{{getPhrase('search')}}',

  					"lengthMenu": "Показать _MENU_",

  					"processing": "Подождите...",

  					"loadingRecords": "Загрузка записей...",

  					"zeroRecords": "Записи отсутствуют.",

  					"info": "Записи с _START_ до _END_ из _TOTAL_ записей",

  					"infoEmpty": "Записи отсутствуют.",

  					"paginate": {
		                "next":      '{{getPhrase('next')}}',
		                "previous":  '{{getPhrase('previous')}}'
		             },
				},

				"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100,"Все"]],

	            processing: true,

	            responsive: true,

	            serverSide: true,

	            "order": [],

	            cache: true,

	            type: 'GET',

	            ajax: '{{ $routeValue }}',

	            // dom: 'Bfrtip',

	           //  buttons: [

				        //     'copy', 'csv', 'excel', 'pdf', 'print'



				        // ],
				buttons: [
				{
					extend: 'copy'
				},
				{
					extend: 'csv',
					exportOptions: {
						columns: [ 0, 1, 2, 3, 4, 6 ]
					}
				},
				{
					extend: 'excel',
					exportOptions: {
						columns: [ 0, 1, 2, 3, 4, 6 ]
					}
				},
				{
					extend: 'pdf',
					exportOptions: {
						columns: [ 0, 1, 2, 3, 4, 6 ]
					}
				},
				{
					extend: 'print'
				},
                ],



	            @if(isset($table_columns))

	            columns: {!!$setData!!}

	            @endif



	    });




   		

    });

  </script>
