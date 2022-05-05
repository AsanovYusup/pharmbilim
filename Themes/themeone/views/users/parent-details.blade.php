@extends($layout)
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <ol class="breadcrumb">
                        <li><a href="{{PREFIX}}"><i class="mdi mdi-home"></i></a></li>
                        @if(checkRole(getUserGrade(2)))
                            <li><a href="{{URL_USERS}}">{{ getPhrase('users')}}</a></li>
                            <li class="active">{{isset($title) ? $title : ''}}</li>
                        @else
                            <li class="active">{{$title}}</li>
                        @endif
                    </ol>
                </div>
            </div>
        @include('errors.errors')
        <!-- /.row -->


            <div class="panel panel-custom " ng-controller="users_controller">
                <div class="panel-heading">
                    @if(checkRole(getUserGrade(2)))
                        <div class="pull-right messages-buttons"><a href="{{URL_USERS}}"
                                                                    class="btn  btn-primary button">{{ getPhrase('list')}}</a>
                        </div>
                    @endif

                    <h1>{{ $title }}  </h1>
                </div>

                <div class="panel-body">


                    {{ Form::model($record,
                                array('url' => ['users/parent-details/'.$record->slug],
                                'method'=>'patch')) }}
                    <?php
                    $user_record = $record;
                    ?>


                        <?php $parent_record = getUserRecord($user_record->parent_id); ?>
                        <?php $second_parent = getUserRecord($user_record->second_parent); ?>



                    <fieldset class="form-group col-md-6">

                        {{ Form::label('parent', getPhrase('parent')) }}

                        <span class="text-red">*</span>

                        {{Form::select('parent', $parent, $parent_record->id, ['placeholder' => getPhrase('select'),'class'=>'form-control',

                            'required'=> 'true', 

                            'ng-class'=>'{"has-error": formLms.parent.$touched && formLms.parent.$invalid}',



                        ]) }}

                        <div class="validation-error" ng-messages="formLms.parent.$error">

                            {!! getValidationMessage()!!}

                        </div>


                    </fieldset>

                    <fieldset class="form-group col-md-6">

                        {{ Form::label('second', getPhrase('parent')) }}

                        <span class="text-red">*</span>

                        {{Form::select('second', $second, $second_parent->id, ['placeholder' => getPhrase('select'),'class'=>'form-control',

                        'ng-class'=>'{"has-error": formLms.second.$touched && formLms.second.$invalid}',



                        ]) }}

                        <div class="validation-error" ng-messages="formLms.second.$error">

                            {!! getValidationMessage()!!}

                        </div>


                    </fieldset>

                    @if($user_record->parent_id !== null)
                        <?php $parent_record = getUserRecord($user_record->parent_id); ?>
                        <?php $second_parent = getUserRecord($user_record->second_parent); ?>

                        <div class="col-md-6">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                <tr>
                                    <td>{{getPhrase('name')}}</td>
                                    <td>{{$parent_record->name ?? null}}</td>
                                </tr>
                                <tr>
                                    <td>{{getPhrase('phone')}}</td>
                                    <td>{{$parent_record->phone ?? null}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                            <div class="col-md-6">
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                    <tr>
                                        <td>{{getPhrase('name')}}</td>
                                        <td>{{$second_parent->name ?? null}}</td>
                                    </tr>
                                    <tr>
                                        <td>{{getPhrase('phone')}}</td>
                                        <td>{{$second_parent->phone ?? null}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                    @endif

                    <div class="sem-parent-container">


                        <div class="row">
                            <div class="col-md-6">

                            </div>

                        </div>

                    </div>

                    <div class="buttons text-center">
                        <button type="submit" class="btn btn-lg btn-success button">{{getphrase('update')}}</button>
                    </div>
                    {!! Form::close() !!}

{{--                    <button id="add-parent">Добавить родителя</button>--}}
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
    @include('users.scripts.js-scripts')

{{--    <script>--}}
{{--        $('#add-parent').click(function (e) {--}}
{{--            e.preventDefault();--}}

{{--            var template = '';--}}

{{--            $(this).before(template);--}}
{{--        });--}}
{{--    </script>--}}

@stop