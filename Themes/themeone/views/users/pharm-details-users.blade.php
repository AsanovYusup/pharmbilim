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

								 	<th>{{ getPhrase('ФИО')}}</th>

									<th>{{ getPhrase('company_name')}}</th>

									<th>{{ getPhrase('region_name')}}</th>

									<th>{{ getPhrase('pharm_name')}}</th>

									<th>{{ getPhrase('role')}}</th>

									<th>{{ getPhrase('status')}}</th>

									<th>{{ getPhrase('action')}}</th>

								</tr>

							</thead>
							@foreach($record as $val)

							<?php $ar1 = getRoleNameById($val->id); ?>


							<tbody>
								<tr>
									<td><a href="{{ URL_USER_DETAILS.$val->slug }}">{{ $val->name }}</a></td>
									<td>{{ $val->company }}</td>
									<td>{{ $val->region }}</td>
									<td>{{ $val->pharm }}</td>
									<td>{{ $ar1->display_name }}</td>
									<td>

									@if($val->login_enabled == 1)
										<i class="fa fa-check text-success"></i>
									@else
										<i class="fa fa-times text-danger"></i>
									@endif

									</td>
									<td>
										<div class="dropdown more">
											<a id="dLabel" type="button" class="more-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="mdi mdi-dots-vertical"></i>
											</a>

											<ul class="dropdown-menu" aria-labelledby="dLabel">
												<li><a href="{{ URL_USERS_EDIT.$val->slug }}"><i class="fa fa-pencil"></i>{{ getPhrase("edit") }}</a></li>
												<li><a href="{{ URL_USERS_SETTINGS.$val->slug }}"><i class="fa fa-spinner"></i>{{ getPhrase("add_categories") }}</a></li>
												<li><a href="{{ URL_USERS_UPDATE_PARENT_DETAILS.$val->slug }}"><i class="fa fa-user"></i>{{ getPhrase("update_parent") }}</a></li>
												@if(checkRole(getUserGrade(1)) && $val->id!=\Auth::user()->id)
												<li><a href="javascript:void(0);" onclick="deleteRecord({{ $val->slug }});"><i class="fa fa-trash"></i>{{ getPhrase("delete") }}</a></li>
												<li><a href="javascript:void(0);" onclick="accountStatus({{ $val->slug }});"><i class="fa fa-check-circle-o"></i>{{ getPhrase("status") }}</a></li>
												@endif 
											</ul> </div>

									</td>
								</tr>
							</tbody>
							@endforeach
							 

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

 @include('common.deletelocation', array('route'=>URL_USERS_DELETE_LOCATION))

 @include('common.deletescript', array('route'=>URL_USERS_DELETE))

  @include('common.account-status', array('route'=>URL_USERS_STATUS))

@stop


