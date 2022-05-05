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

							<li><a href="{{PREFIX}}"><i class="mdi mdi-home"></i> </a> </li>

							@if(checkRole(getUserGrade(2)))

							<li><a href="{{URL_USERS}}">{{ getPhrase('users') }}</a> </li>

							@endif

							

							@if(checkRole(getUserGrade(7)))

							<li><a href="{{URL_PARENT_CHILDREN}}">{{ getPhrase('users') }}</a> </li>

							@endif



							<li><a href="javascript:void(0);">{{ $title }}</a> </li>

						</ol>

					</div>

				

				</div>



<div class="panel panel-custom">

				 	<div class="panel-heading">						

				 		<h1>{{ $record->name }}



{{--				 		 <a class="btn btn-primary pull-right" href="{{URL_VIEW_USER_RESUME.$record->slug}}" target="_blank">Просмотр резюме</a>--}}



				 		</h1>					

				 	</div>







					<div class="panel-body">

						

				

						

						<div class="row">

               <div class="col-md-12">

                        







						<div class="row">

							<div class="col-lg-12">



						<div class="col-lg-6">			

						<div class="profile-details">

							<div class="profile-img"><img align="left" src="{{ getProfilePath($record->image,'profile')}}" alt="{{$record->name}}">

							</div>



							<div class="aouther-school" text-align="center">

								<h2>{{ $record->name}}</h2>

								<p>{{ $record->email}}</p>

							</div>



						</div>

						</div>





						<div class="col-lg-6">

						<table class="table table-bordered table-hover">

							<caption><h5>Персональные данные</h5></caption>

						

							<tr>

								<td><strong>Телефон</strong></td>

								<td>{{$record->phone}}</td>

							</tr>

							<tr>

								<td><strong>Whatsapp номер</strong></td>

								<td>{{$record->whatsapp_phone}}</td>

							</tr>


							<tr>

								<td><strong>Дата регистрации</strong></td>

								<?php $data = substr($record->created_at, 0, 10); ?>

								<?php $date = explode('-', $data); ?>

								<?php $date = $date[2].'.'.$date[1].'.'.$date[0]; ?>

								<td>{{$date}}</td>

							</tr>

							<tr>

								<td><strong>Кол-во баллов</strong></td>

								<td>{{$record->points}}</td>

							</tr>

							<!-- <tr>
								<?php $parent_record = getUserRecord($record->parent_id); ?>
								<td><strong>Руководитель</strong></td>

								<td>{{$parent_record->name ?? null}}</td>

							</tr> -->



							

						</table>

						</div>	



						</div>

						</div>





               	<div class="row">

               <div class="col-md-6 col-sm-6">

				 		<div class="media state-media box-ws">

				 			<div class="media-left">

				 				<a href="{{URL_STUDENT_EXAM_ATTEMPTS.$record->slug}}"><div class="state-icn bg-icon-info"><i class="fa fa-history"></i></div></a>

				 			</div>

				 			<div class="media-body">

				 				

								<a href="{{URL_STUDENT_EXAM_ATTEMPTS.$record->slug}}">{{ getPhrase('История эксзаменов')}}</a>

				 			</div>

				 		</div>

				 	</div>



				 	<div class="col-md-6 col-sm-6">

				 		<div class="media state-media box-ws">

				 			<div class="media-left">

				 				<a href="{{URL_STUDENT_ANALYSIS_BY_EXAM.$record->slug}}"><div class="state-icn bg-icon-success"><i class="fa fa-flag"></i></div></a>

				 			</div>

				 			<div class="media-body">

				 				

								<a href="{{URL_STUDENT_ANALYSIS_BY_EXAM.$record->slug}}">{{ getPhrase('by_exam')}}</a>

				 			</div>

				 		</div>

				 	</div>

					<div class="col-md-6 col-sm-6">

						<div class="media state-media box-ws">

							<div class="media-left">

								<a href="{{'/analysis/lms-points/'.$record->slug}}"><div class="state-icn bg-icon-purple"><i class="fa fa-video-camera"></i></div></a>

							</div>

							<div class="media-body">



								<a href="{{'/analysis/lms-points/'.$record->slug}}">Анализ видео</a>

							</div>

						</div>

					</div>

					<div class="col-md-6 col-sm-6">

						<div class="media state-media box-ws">

							<div class="media-left">

								<a href="{{'/analysis/all-points/'.$record->slug}}"><div class="state-icn bg-icon-orange"><i class="fa fa-bookmark"></i></div></a>

							</div>

							<div class="media-body">



								<a href="{{'/analysis/all-points/'.$record->slug}}">Баллы</a>

							</div>

						</div>

					</div>





{{--				 	 	<div class="col-md-6 col-sm-6">--}}

{{--				 		<div class="media state-media box-ws">--}}

{{--				 			<div class="media-left">--}}

{{--				 				<a href="{{URL_STUDENT_ANALYSIS_SUBJECT.$record->slug}}"><div class="state-icn bg-icon-purple"><i class="fa fa-key"></i></div></a>--}}

{{--				 			</div>--}}

{{--				 			<div class="media-body">--}}

{{--				 				--}}

{{--								<a href="{{URL_STUDENT_ANALYSIS_SUBJECT.$record->slug}}">{{ getPhrase('by_subject')}}</a>--}}

{{--				 			</div>--}}

{{--				 		</div>--}}

{{--				 	</div>--}}





{{--				 		<div class="col-md-6 col-sm-6">--}}

{{--				 		<div class="media state-media box-ws">--}}

{{--				 			<div class="media-left">--}}

{{--				 				<a href="{{URL_PAYMENTS_LIST.$record->slug}}"><div class="state-icn bg-icon-pink"><i class="fa fa-credit-card"></i></div></a>--}}

{{--				 			</div>--}}

{{--				 			<div class="media-body">--}}

{{--				 				--}}

{{--								<a href="{{URL_PAYMENTS_LIST.$record->slug}}">{{ getPhrase('subscriptions')}}</a>--}}

{{--				 			</div>--}}

{{--				 		</div>--}}

{{--				 	</div>--}}



				

                  </div>
                  <div class="panel panel-custom">
						<div class="panel-body packages">

						<div > 

						<table class="table table-striped table-bordered datatable" cellspacing="0" width="100%">

							<thead>

								<tr>

								 	<th>{{ getPhrase('name')}}</th>

									<th>{{ getPhrase('phone')}}</th>

									<th>{{ getPhrase('image')}}</th>

									 

									<th>{{ getPhrase('action')}}</th>

								</tr>

							</thead>

							 

						</table>

						</div>

						 



					</div>
				</div>
            

           </div>



						</div>



					</div>

				</div>

				</div>

			<!-- /.container-fluid -->

</div>

@endsection

 

<?php $url = URL_PARENT_CHILDREN_GETLIST_DETAILS.$user->slug;

 

  ?>

@section('footer_scripts')

 

@include('common.datatables', array('route'=>$url, 'route_as_url' => TRUE))


@stop

