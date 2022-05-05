@extends($layout)
@section('content')
@include('layouts.partials.breadcrumbs')
@include('layouts.partials.subheader')

<div class="row">
    <div class="col-xl-12">
        <div id="panel-4" class="panel">
            <div class="panel-hdr color-warning-800">
                <h2>
                    {{$title}}
                </h2>
            </div>
            <div class="panel-container show">
                <div class="panel-content">
                    {{ Form::model($record,
                                array('url' => ['users/parent-details/'.$record->slug],
                                'method'=>'patch')) }}
                    <?php
                    $user_record = $record;
                    ?>


                    <?php $parent_record = getUserRecord($user_record->parent_id); ?>
                    <?php $second_parent = getUserRecord($user_record->second_parent); ?>



                    <div class="row">
                        <fieldset class="form-group col-md-6">
                            {{ Form::label('parent', getPhrase('parent')) }}
                            <span class="text-red">*</span>
                            {{Form::select('parent', $parent, $parent_record->id, ['placeholder' => getPhrase('select'),'class'=>'select2 form-control',

                            'required'=> 'true', 
                            'ng-class'=>'{"has-error": formLms.parent.$touched && formLms.parent.$invalid}',
                        ]) }}

                        </fieldset>

                        <fieldset class="form-group col-md-6">
                            {{ Form::label('second', getPhrase('parent')) }}
                            <span class="text-red">*</span>
                            {{Form::select('second', $second, $second_parent->id, ['placeholder' => getPhrase('select'),'class'=>'select2 form-control',
                        'ng-class'=>'{"has-error": formLms.second.$touched && formLms.second.$invalid}',
                        ]) }}                            
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
                    </div>

                    @endif

                    <div class="buttons text-center">
                        <button type="submit" class="btn btn-lg btn-success button">{{getphrase('update')}}</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer_scripts')
@include('common.validations')
@include('common.alertify')
@include('users.scripts.js-scripts')


@stop