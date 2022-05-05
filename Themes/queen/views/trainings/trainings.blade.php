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



                    <div class="pull-right messages-buttons">


                        <a href="/trainings/add" class="btn  btn-primary button" >Добавить тренинг</a>


                    </div>

                    <h1>{{ $title }}</h1>

                </div>

                <div class="panel-body packages">

                    <div>

                        <table class="table table-striped table-bordered datatable" cellspacing="0" width="100%">

                            <thead>

                            <tr>


                                <th>Тема</th>

                                <th>Ведущий</th>

                                <th>Дата</th>

                                <th>Место проведения</th>

                                <th>{{ getPhrase('action')}}</th>


                            </tr>

                            </thead>


                            @if($record)

                                @foreach($record as $rec)
                                    <tbody>
                                    <tr>
                                        <td>{{ $rec->theme  }}</td>
                                        <td>{{ $rec->lead  }}</td>
                                        <td>{{ $rec->date  }}</td>
                                        <td>{{ $rec->location  }}</td>
                                        <td>
                                            <div class="dropdown more">
                                                <a id="dLabel" type="button" class="more-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="mdi mdi-dots-vertical"></i>
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                    <li><a href="{{'trainings/edit/'.$rec->slug}}"><i class="fa fa-pencil"></i>{{ getPhrase("edit") }}</a></li>
                                                    <li><a href="javascript:void(0);" onclick="deleteRecord('<?php echo $rec->slug; ?>');"><i class="fa fa-trash"></i>{{ getPhrase("delete") }}</a></li>
                                                </ul>

                                            </div>
                                        </td>
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

    @include('common.deletelocation', array('route'=>'/trainings/delete/'))


@stop

