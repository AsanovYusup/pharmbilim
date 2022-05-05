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

            <div> 

            <table class="table table-striped table-bordered datatable" cellspacing="0" width="100%">

              <thead>

                <tr>

                  <th>{{ getPhrase('exams')}}</th>

                  <th>Осталось попыток</th>

                  <th>{{ getPhrase('action')}}</th>

                </tr>

              </thead>

               <tbody>

                  @foreach($array as $arr)
                  <tr>
                    <th>{{getTitleAttempts($arr->quizzes_id)->title}}</th>
                    <th>{{$arr->attempts}}</th>
                    <th>
                      <div class="dropdown more">
                        <a id="dLabel" type="button" class="more-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="mdi mdi-dots-vertical"></i>
                          <ul class="dropdown-menu" aria-labelledby="dLabel">
                            <li><a href="{{URL_USERS_ADD_ATTEMPTS.$arr->id.'/'.$user->slug}}"><i class="fa fa-pencil"></i>{{ getPhrase("edit_attempts") }}</a></li>
                          </ul>
                        </a>
                        </div>
                    </th>
                  </tr>
                  @endforeach
               </tbody>

            </table>

            </div>

             



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

