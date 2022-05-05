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

							<li>{{ getPhrase('pharm_name') }}</li>

						</ol>

					</div>

				</div>

								

				<!-- /.row -->

				<div class="panel panel-custom">

					<div class="panel-heading">

						<div class="pull-right messages-buttons">
	 

						</div>

						<h1>{{ getPhrase('pharm_name')}}</h1>

					</div>

					
					<div class="panel-body packages">

						<div> 

						<table class="table table-striped table-bordered datatable" cellspacing="0" width="100%">

							<thead>

								<tr>

									<th>ID</th>
									<th>{{ getPhrase('pharm_name')}}</th>
									<th>{{ getPhrase('company_name')}}</th>
									<th>{{ getPhrase('region_name')}}</th>
									<th>Кол-во сотрудников</th>
									<th>Руководитель</th>
									<th>Дата создания</th>
									<th>{{ getPhrase('action') }}</th>

								</tr>

							</thead>


							
							<tbody>
								@foreach($record as $pharm)

									@php($count = getCountPharm($pharm->company, $pharm->region, $pharm->pharm_name))
									@php($parent = getParentCompany($pharm->pharm_name, 'pharm'))
								<tr>
									<td>{{$pharm->id}}</td>
									<td><a href="/users/company/details/alluser/{{$pharm->id}}">{{$pharm->pharm_name}}</a></td>
									<td>{{$pharm->company}}</td>
									<td>{{$pharm->region}}</td>
									<td>{{$count}}</td>
									<td><a href="/users/details/{{$parent->slug ?? null}}">{{$parent->name ?? null}}</a></td>
									<td>{{$pharm->created_at}}</td>
									<td>
										<div class="dropdown more">
											<a id="dLabel" type="button" class="more-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="mdi mdi-dots-vertical"></i>
											</a>
											<ul class="dropdown-menu" aria-labelledby="dLabel">
												<li><a href="{{ URL_USERS_SETTINGS_LOCATION.$pharm->slug }}"><i class="fa fa-spinner"></i>{{ getPhrase("add_categories") }}'</a></li>
												<li><a href="<?php echo "/users/edit/location/$pharm->slug"; ?>"><i class="fa fa-pencil"></i>{{ getPhrase("edit") }}</a></li>
												<li><a href="javascript:void(0);" onclick="deleteRecord('<?php echo $pharm->slug; ?>');"><i class="fa fa-trash"></i>{{ getPhrase("delete") }}</a></li>
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

