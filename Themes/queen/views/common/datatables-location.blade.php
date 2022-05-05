
<script>

var table;


$(document).ready(function() {

	$.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        	}

		});

   table = $('.datatable').DataTable({
    	"language": {
  					"search": '{{getPhrase('search')}}',

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

              processing: true,

              // serverSide: true,
              
              "order": [],
              
              cache: true,

              type: 'GET',
              dom: 'Bfrtip',
              
              buttons: [

              'copy', 'csv', 'excel', 'pdf', 'print'



              ],
    });
} );

</script>