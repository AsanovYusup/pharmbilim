<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" type="text/css">

{{--<link href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css" type="text/css">--}}

{{--<link href="https://cdn.datatables.net/responsive/2.2.3/css/dataTables.responsive.css" type="text/css">--}}


{{--<script src="{{themes('js/bootstrap-toggle.min.js')}}"></script>--}}

<script src="{{themes('js/jquery.dataTables.min.js')}}"></script>

<script src="{{themes('js/dataTables.bootstrap.min.js')}}"></script>


{{--<script src="https://cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js"></script>--}}

{{--<script src="//cdn.datatables.net/buttons/1.4.2/js/buttons.flash.min.js"></script>--}}

{{--<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>--}}

{{--<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>--}}

{{--<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>--}}

{{--<script src="//cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js"></script>--}}

{{--<script src="//cdn.datatables.net/buttons/1.4.2/js/buttons.print.min.js"></script>--}}
{{----}}
{{--<script src="//cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.js"></script>--}}


<?php    $routeValue = $route; ?>



@if(!isset($route_as_url))

    {

    <?php $routeValue = route($route); ?>

    }

@endif



<?php

$setData = array();

if (isset($table_columns)) {

    foreach ($table_columns as $col) {

        $temp['data'] = $col;

        $temp['name'] = $col;

        array_push($setData, $temp);

    }

    $setData = json_encode($setData);

}

?>


<script>


    var tableObj;


    $(document).ready(function () {

        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });

        $('.datatable thead tr').clone(true).appendTo('.datatable thead');
        $('.datatable thead tr:eq(1) th').each(function (i) {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="Поиск" />');

            $('input', this).on('keyup change', function () {
                if (tableObj.column(i).search() !== this.value) {
                    tableObj
                        .column(i)
                        .search(this.value)
                        .draw();
                }
            });
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
                    "next": '{{getPhrase('next')}}',
                    "previous": '{{getPhrase('previous')}}'
                },
            },

            "lengthMenu": [[100, 200, 300, 400, -1], [100, 200, 300, 400, "Все"]],

            processing: true,

            // serverSide: true,

            "order": [],

            cache: true,

            orderCellsTop: true,
            fixedHeader: true,

            type: 'GET',

            ajax: '{{ $routeValue }}',


            buttons: [
                {
                    extend: 'copy'
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 6]
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 6]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 6]
                    }
                },
                {
                    extend: 'print'
                },
            ],

            // columns: [
            //     { data: "0","name":"users.id" },
            //     { data: "1","name":"name" },
            //     { data: "2","name":"created_at" },
            //     { data: "3", "name":"phone" },
            //     { data: "4","name":"company" },
            //     { data: "5","name":"region" },
            //     { data: "6","name":"pharm" },
            //     { data: "7","name":"parent_id" },
            //     { data: "8","name":"roles.display_name" },
            //     { data: "9", "name":"login_enabled" },
            //     { data: "10", "name":"action" },
            // ]


        });


    });

</script>
