
	
	<?php 	$routeValue= $route; ?> 
	<?php if(!isset($route_as_url)): ?>
	{
		<?php $routeValue =  route($route); ?>
	}
	<?php endif; ?>	

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
  					"searchPlaceholder": '<?php echo e(getPhrase('search')); ?>',
						"search": '',
						"lengthMenu": "Показать _MENU_",
						"processing": "<div class='frame-wrap'><button class='btn btn-danger rounded-pill waves-effect waves-themed' type='button' disabled=''><span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>Загрузка...</button></div>",
						"loadingRecords": "",
						"zeroRecords": "",
  					"info": "Записи с _START_ до _END_ из _TOTAL_ записей",
  					"infoEmpty": "",
  					// "paginate": {
		        //         "next":      '<?php echo e(getPhrase('next')); ?>',
		        //         "previous":  '<?php echo e(getPhrase('previous')); ?>'
		        //      },
				},
				"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100,"Все"]],
	            processing: true,
	            responsive: true,
	            serverSide: false,
	            "order": [],
	            cache: true,
	            type: 'GET',
	            ajax: '<?php echo e($routeValue); ?>',
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
	            <?php if(isset($table_columns)): ?>
	            columns: <?php echo $setData; ?>

	            <?php endif; ?>
	    }); 		
    });
  </script>
