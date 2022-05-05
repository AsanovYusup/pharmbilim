@extends($layout)

@section('content')<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->

        <div class="row">

            <div class="col-lg-12">

                <ol class="breadcrumb">

                    <li><a href="{{PREFIX}}"><i class="mdi mdi-home"></i></a> </li>

                    @if(checkRole(getUserGrade(2)))

                        <li class="active">{{isset($title) ? $title : ''}}</li>

                    @else

                        <li class="active">{{$title}}</li>

                    @endif

                </ol>

            </div>

        </div>

    @include('errors.errors')

    <!-- /.row -->



        <div class="panel panel-custom col-lg-6  col-lg-offset-3">

            <div class="panel-heading">

                <h1>{{ $title }}  </h1>

            </div>



            <div class="panel-body form-auth-style">

                <?php $button_name = getPhrase('create'); ?>

                @if ($record)

                    <?php $button_name = getPhrase('update'); ?>

                    {{ Form::model($record,

                    array('url' => '/partners/update/'.$record->slug,

                    'method'=>'patch','novalidate'=>'','name'=>'partners ', 'files'=>'true' )) }}

                @else

                    {!! Form::open(array('url' => '/partners/add/', 'method' => 'POST', 'novalidate'=>'','name'=>'partners ', 'files'=>'true')) !!}

                @endif



                @include('partners.form_elements_partners', array('button_name'=> $button_name, 'record' => $record))



                {!! Form::close() !!}

            </div>

        </div>

    </div>

    <!-- /.container-fluid -->

</div>

<!-- /#page-wrapper -->

@endsection



@section('footer_scripts')

    @include('common.validations')

    @include('common.alertify')

    <script src="{{themes('js/jquery.datetimepicker.full.min.js')}}"></script>

    <script>
        jQuery('#datetimepicker').datetimepicker({
            format: 'Y-m-d H:i:s'
        });
    </script>

@stop
