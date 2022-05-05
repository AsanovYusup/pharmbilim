
@php
    $routeValue = $route;
@endphp
@if(!isset($route_as_url))    
    @php
        $routeValue = route($route);
    @endphp    
@endif
@php
    $setData = array();
    if (isset($table_columns)) {
        foreach ($table_columns as $col) {
            $temp['data'] = $col;
            $temp['name'] = $col;
            array_push($setData, $temp);
        }
        $setData = json_encode($setData);
    }
@endphp
<script>
    var tableObj;
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

        });

        // $('.datatable thead tr').clone(true).appendTo('.datatable thead');
        // $('.datatable thead tr:eq(1) th').each(function (i) {
        //     var title = $(this).text();
        //     $(this).html('<input type="text" class="form-control form-control-sm" placeholder=" ' + title + '" />');

        //     $('input', this).on('keyup change', function () {
        //         if (tableObj.column(i).search() !== this.value) {
        //             tableObj
        //                 .column(i)
        //                 .search(this.value)
        //                 .draw();
        //         }
        //     });
        // });


        tableObj = $('.datatable').DataTable({

            "language": {
                "searchPlaceholder": '{{getPhrase('search')}}',
                "search": '',
                "lengthMenu": "Показать _MENU_",
                "processing": "<div class='frame-wrap'><button class='btn btn-danger rounded-pill waves-effect waves-themed' type='button' disabled=''><span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>Загрузка...</button></div>",
                "loadingRecords": "",
                "zeroRecords": "",
                "info": "Записи с _START_ до _END_ из _TOTAL_ записей",
                "infoEmpty": "Записи отсутствуют.",
                // "paginate": {
                //     "next": '{{getPhrase('next')}}',
                //     "previous": '{{getPhrase('previous')}}'
                // },
            },

            "lengthMenu": [[10, 200, 300, 400, -1], [10, 200, 300, 400, "Все"]],

            processing: true,

            serverSide: false,

            "order": [],

            cache: true,

            orderCellsTop: true,
            fixedHeader: false,

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

            columns: [
                { data: "7", "name":"action" },                
                { data: "1","name":"name" },
                { data: "2","name":"company" },
                { data: "3", "name":"region" },
                { data: "4","name":"pharm" },
                { data: "5","name":"roles.display_name" },
                { data: "6", "name":"login_enabled" },
                { data: "0","name":"users.id" },
                
            ]

        });


    });

</script>
