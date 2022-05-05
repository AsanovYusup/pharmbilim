@extends($layout)

@section('content')<div id="page-wrapper">

<div class="container-fluid">

<!-- Page Heading -->

<div class="row">

<div class="col-lg-12">

<ol class="breadcrumb">

<li><a href="{{PREFIX}}"><i class="mdi mdi-home"></i></a> </li>

@if(checkRole(getUserGrade(2)))

<li><a href="{{URL_USERS}}">{{ getPhrase('users')}}</a> </li>

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

@if(checkRole(getUserGrade(2))) 

<div class="pull-right messages-buttons"><a href="{{URL_USERS}}" class="btn  btn-primary button" >{{ getPhrase('list')}}</a></div>

@endif

<h1>{{ $title }}  </h1>

</div>



<div class="panel-body form-auth-style">

<?php $button_name = getPhrase('create'); ?>

@if ($record)

<?php $button_name = getPhrase('update'); ?>

{{ Form::model($record, 

array('url' => URL_USERS_EDIT.$record->slug, 

'method'=>'patch','novalidate'=>'','name'=>'formUsers ', 'files'=>'true' )) }}

@else

{!! Form::open(array('url' => URL_USERS_ADD, 'method' => 'POST', 'novalidate'=>'','name'=>'formUsers ', 'files'=>'true')) !!}

@endif



@include('users.form_elements', array('button_name'=> $button_name, 'record' => $record))



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


@if(checkRole(getUserGrade(2))) 

<script>

$("#region_id option[value!='']").remove();
$("#pharm_id option[value!='']").remove();
$('#pharm_id').hide();
$('#region_id').hide();

$('#company').change(function(event) {

  var value = $(this).val();
  var phone = $('#phone').val();
  var op = " ";

  $.ajaxSetup({

    headers: {

      'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')

    }

  });
  
  $.ajax({
    type: "GET",
    url: '/users/edit/' + phone,
    data: {company:value},
    success: function(param)
    {

      for (var i = 0; i < param.length; i++){
        op += '<option value="'+param[i].region_display_name+'">'+param[i].region_name+'</option>';
      }
      $("#region_id option[value!='']").remove();
      $('#region').append(op);
      $('#region_id').show();
    },
    error: function(){
      console.log('error');
    }
  });
  
});

$('#region').change(function(event) {

  var company = $('#company').val();
  var value = $(this).val();
  var phone = $('#phone').val();
  var op = " ";

  $.ajaxSetup({

    headers: {

      'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')

    }

  });
  
  $.ajax({
    type: "GET",
    url: '/users/edit/' + phone,
    data: {region:value, com:company},
    success: function(param)
    {
      for (var i = 0; i < param.length; i++){
        op += '<option value="'+param[i].pharm_display_name+'">'+param[i].pharm_name+'</option>';
      }
      $("#pharm_id option[value!='']").remove();
      $('#pharm').append(op);
      $('#pharm_id').show();
    },
    error: function(){
      console.log('error');
    }
  });
  
});
</script>

@endif


 <script>

 	var file = document.getElementById('image_input');



file.onchange = function(e){

    var ext = this.value.match(/\.([^\.]+)$/)[1];

    switch(ext)

    {

        case 'jpg':

        case 'jpeg':

        case 'png':



     

            break;

        default:

               alertify.error("{{getPhrase('file_type_not_allowed')}}");

            this.value='';

    }

};

 </script>

@stop

<div id="myModal" class="modal fade" role="dialog">



  <div class="modal-dialog">



    {!! Form::open(array('url' => 'users/create/activate/', 'method' => 'POST', 'name'=>'formLanguage ', 'novalidate'=>'', 'class'=>"loginform", 'name'=>"registrationFormConfirm")) !!}

                        @include('errors.errors')   



    <!-- Modal content-->



    <div class="modal-content">



      <div class="modal-header">



        <button type="button" class="close" data-dismiss="modal">&times;</button>



        <h4 class="modal-title text-center">{{getPhrase('activate')}}</h4>



      </div>



      <div class="modal-body">



        <div class="form-group">

                           {{ Form::text('code', $value = null , $attributes = array('class'=>'form-control',

                                    'placeholder' => getPhrase("Код подтверждения"),

                                    'ng-model'=>'code',

                                    'required'=> 'true', 

                                    'ng-class'=>'{"has-error": registrationForm.code.$touched && registrationForm.code.$invalid}',

                                    'ng-minlength' => '5',

                                )) }}

                                    <div class="validation-error" ng-messages="registrationForm.code.$error" >

                                        {!! getValidationMessage()!!}

                                        {!! getValidationMessage('minlength')!!}

                                        {!! getValidationMessage('pattern')!!}

                                    </div>

                        </div>

            </div>


      <div class="modal-footer">



      <div class="text-center mt-2">


        <button type="submit" class="btn button btn-primary btn-lg" ng-disabled='!registrationFormConfirm.$valid'>{{getPhrase('Отправить')}}</button>



        </div>


      </div>



    </div>



    {!! Form::close() !!}



  </div>



</div>
