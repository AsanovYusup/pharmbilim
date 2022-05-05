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



							<a href="{{URL_USERS_ADD_LOCATION}}" class="btn  btn-primary button" >{{ getPhrase('add_location')}}</a>

							 

						</div>

						<h1>{{ getPhrase('company')}}</h1>

					</div>

					<div class="panel-body packages">

						<div> 

				

						<table class="table table-striped table-bordered datatable" cellspacing="0" width="100%">

							<thead>

								<tr>

									<th>ID</th>
									<th>{{ getPhrase('company_name')}}</th>
									<th>Кол-во сотрудников</th>
									<th>Руководитель</th>
									<th>Дата создания</th>
									<th>{{ getPhrase('action') }}</th>
									

								</tr>

							</thead>

							<tbody>
								@foreach($company as $com)

									@php($count = getCountCompany($com->company_name))
									@php($parent = getParentCompany($com->company_name, 'company'))

								<tr>
									<td>{{$com->id}}</td>
									<td><a href="region/details/{{$com->company_name}}">{{$com->company_name}}</a></td>
									<td>{{$count}}</td>
									<td><a href="/users/details/{{$parent->slug ?? null}}">{{$parent->name ?? null}}</a></td>
									<td>{{$com->created_at}}</td>
									<td>
										<div class="dropdown more">
											<a id="dLabel" type="button" class="more-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="mdi mdi-dots-vertical"></i>
											</a>
											<ul class="dropdown-menu" aria-labelledby="dLabel">
												<li><a href="{{ URL_USERS_SETTINGS_LOCATION.$com->slug }}"><i class="fa fa-spinner"></i>{{ getPhrase("add_categories") }}'</a></li>
												<li><a href="<?php echo "edit/location/$com->slug"; ?>"><i class="fa fa-pencil"></i>{{ getPhrase("edit") }}</a></li>
												<li><a href="javascript:void(0);" onclick="deleteRecord('<?php echo $com->slug; ?>');"><i class="fa fa-trash"></i>{{ getPhrase("delete") }}</a></li>
											</ul>
		
										</div>

									</td>
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

 @include('common.datatables-location')

 @include('common.deletelocation', array('route'=>URL_USERS_DELETE_LOCATION))



  @include('common.account-status', array('route'=>URL_USERS_STATUS))

@stop

