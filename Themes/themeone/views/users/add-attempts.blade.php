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

            <h1>{{ $title }}</h1>

          </div>

          <div class="panel-body packages">

            {{ Form::model($record, 

              array('url' => URL_USERS_ADD_ATTEMPTS.$record->id.'/'.$user, 

              'method'=>'patch','novalidate'=>'','name'=>'formUsers ', 'files'=>'true' )) }}

            <fieldset class="form-group">

            {{ Form::label('attempts', getphrase('all_attempts')) }}


            {{ Form::text('attempts', $value = null , $attributes = array('class'=>'form-control',

              'ng-model'=>'attempts',

              'ng-class'=>'{"has-error": formUsers.attempts.$touched && formUsers.attempts.$invalid}',



            )) }}

            <div class="validation-error" ng-messages="formUsers.attempts.$error" >

                {!! getValidationMessage()!!}

                {!! getValidationMessage('minlength')!!}

            </div>

          </fieldset>

          <div class="buttons text-center">

              <button class="btn btn-lg btn-success button" 

              ng-disabled='!formUsers.$valid'>{{ getPhrase('update') }}</button>

            </div>

          {!! Form::close() !!}

          </div>



        </div>

      </div>

      <!-- /.container-fluid -->

    </div>

@endsection

 

@section('footer_scripts')


 @include('common.deletescript', array('route'=>URL_USERS_DELETE))



  @include('common.account-status', array('route'=>URL_USERS_STATUS))

@stop

