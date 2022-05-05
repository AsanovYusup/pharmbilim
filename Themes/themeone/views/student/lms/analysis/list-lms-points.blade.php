@extends($layout)

@section('header_scripts')

    <link href="{{CSS}}ajax-datatables.css" rel="stylesheet">

@stop

@section('content')



    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->

            <div class="row">

                <div class="col-lg-12">

                    <ol class="breadcrumb">

                        <li><a href="{{PREFIX}}"><i class="mdi mdi-home"></i></a> </li>

                        <li>{{ $title }}</li>

                    </ol>

                </div>

            </div>



            <!-- /.row -->

            <div class="panel panel-custom">

                <div class="panel-heading">



{{--                    <div class="pull-right messages-buttons">--}}


{{--                        <a href="/trainings/add" class="btn  btn-primary button" >Добавить тренинг</a>--}}


{{--                    </div>--}}

                    <h1>{{ $title }}</h1>

                </div>

                <div class="panel-body packages">

                    <div>

                        <table class="table table-striped table-bordered datatable" cellspacing="0" width="100%">

                            <thead>

                            <tr>


                                <th>Категория</th>
                                <th>Название</th>
                                <th>Тип</th>
                                <th>Кол-во просмотр. минут</th>
                                <th>Дата просмотра</th>
                                <th>Баллы</th>

{{--                                <th>{{ getPhrase('action')}}</th>--}}


                            </tr>

                            </thead>


                            @if($record)

                                @foreach($record as $rec)
                                    <tbody>
                                    <tr>
                                        <td>{{ $rec->category  }}</td>
                                        <td>{{ $rec->name  }}</td>
                                        <td>{{ $rec->type  }}</td>
                                        <td>{{ $rec->time  }}</td>
                                        <td>{{ $rec->date  }}</td>
                                        <td><span class="label label-success">+{{ $rec->points  }}</span></td>

                                    </tr>
                                    </tbody>
                                @endforeach

                            @endif

                        </table>

                    </div>





                </div>



            </div>

        </div>

        <!-- /.container-fluid -->

    </div>

@endsection



@section('footer_scripts')

    @include('common.datatables-location')


@stop

