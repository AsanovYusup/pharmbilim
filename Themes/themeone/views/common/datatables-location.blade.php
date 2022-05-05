<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" type="text/css">

<link href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css" type="text/css">







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