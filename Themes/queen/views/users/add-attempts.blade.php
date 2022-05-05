@extends($layout)
@section('header_scripts')
@stop
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
            <div class="panel-toolbar">
                <button class="btn btn-panel waves-effect waves-themed" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
            </div>
        </div>
        <div class="panel-container show">
            <div class="panel-content">
                {{ Form::model($record, 
                  array('url' => URL_USERS_ADD_ATTEMPTS.$record->id.'/'.$user,
                  'method'=>'patch','novalidate'=>'','name'=>'formUsers ', 'files'=>'true' )) }}
                  <fieldset class="form-group">
                    {{ Form::label('attempts', getphrase('Текущее количество попыток')) }}
                    {{ Form::text('attempts', $value = null , $attributes = array('class'=>'form-control',
                      'ng-model'=>'attempts',
                      'ng-class'=>'{"has-error": formUsers.attempts.$touched && formUsers.attempts.$invalid}',
                    )) }}
                  </fieldset>

              <div class="buttons text-center">
                  <button class="btn btn-lg btn-success button">{{ getPhrase('update') }}</button>
                </div>
              {!! Form::close() !!}
            </div>
        </div>
    </div>
  </div>
</div>

@endsection
@section('footer_scripts')
@stop

