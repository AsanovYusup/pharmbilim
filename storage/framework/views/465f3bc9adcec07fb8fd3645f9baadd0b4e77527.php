
<?php
    $routeValue = $route;
?>

<?php if(!isset($route_as_url)): ?>
    <?php
        $routeValue = route($route);
    ?>
<?php endif; ?>

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
            $(this).html('<input type="text" class="form-control form-control-sm" placeholder=" ' + title + '" />');
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
            // lengthChange: false,
            responsive: true,
            dom:
                        /*	--- Layout Structure 
                        	--- Options
                        	l	-	length changing input control
                        	f	-	filtering input
                        	t	-	The table!
                        	i	-	Table information summary
                        	p	-	pagination control
                        	r	-	processing display element
                        	B	-	buttons
                        	R	-	ColReorder
                        	S	-	Select

                        	--- Markup
                        	< and >				- div element
                        	<"class" and >		- div with a class
                        	<"#id" and >		- div with an ID
                        	<"#id.class" and >	- div with an ID and a class

                        	--- Further reading
                        	https://datatables.net/reference/option/dom
                        	--------------------------------------
                         */
                        "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
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
                //     "next": '<?php echo e(getPhrase('next')); ?>',
                //     "previous": '<?php echo e(getPhrase('previous')); ?>'
                // },
            },
            "lengthMenu": [[100, 200, 300, 400, -1], [100, 200, 300, 400, "Все"]],
            processing: true,
            serverSide: false,
            deferRender: true,
            searching: true,
            // order: [],
            cache: true,
            // orderCellsTop: true,
            fixedHeader: false,
            ajax: {
                'url': '<?php echo e($routeValue); ?>',
                // 'type': 'POST',
                },
            buttons: {
                buttons: [                
                {
                    extend: 'copyHtml5',
                    text: 'Скопировать',
                    titleAttr: 'Copy to clipboard',
                    className: 'btn-outline-danger btn-sm mr-1',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 6, 7]
                    }
                },
                {
                    extend: 'csvHtml5',
                    text: 'CSV',
                    titleAttr: 'CSV Table',
                    className: 'btn-outline-danger btn-sm mr-1',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 6, 7]
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: 'Excel',
                    className: 'btn-outline-danger btn-sm mr-1',
                    // exportOptions: {
                    //     columns: [0, 1, 2, 3, 4, 6]
                    // }
                },
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    titleAttr: 'Pdf Table',
                    className: 'btn-outline-danger btn-sm mr-1',
                    // exportOptions: {
                    //     columns: [0, 1, 2, 3, 4, 6]
                    // }
                },
                {
                    extend: 'print',
                    text: 'Распечатать',
                    titleAttr: 'Print Table',
                    className: 'btn-outline-danger btn-sm mr-1',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 6, 7]
                    }
                },
            ],
            },

            columns: [
                { data: "11", "name":"action" },
                { data: "1","name":"name" },
                { data: "2","name":"created_at", "type": "date_de" },
                { data: "3", "name":"phone" },
                { data: "4","name":"company" },
                { data: "5","name":"college_place" },
                { data: "6","name":"region" },
                { data: "7","name":"pharm" },
                { data: "8","name":"parent_id" },
                { data: "9","name":"roles.display_name" },
                { data: "10", "name":"login_enabled" },                
                { data: "0","name":"users.id" },
            ]
        });
    });
</script>
