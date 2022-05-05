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


							<a href="{{URL_EVENTS_ADD}}" class="btn  btn-primary button" >Добавить событие</a>


						</div>

						<h1>{{ $title }}</h1>

					</div>

					<div class="panel-body packages">

						<div> 

						<table class="table table-striped table-bordered datatable" cellspacing="0" width="100%">

							<thead>

								<tr>


								 	<th>{{ getPhrase('title_events')}}</th>

								 	<th>{{ getPhrase('description')}}</th>

									<th>{{ getPhrase('date_events')}}</th>

									<th>{{ getPhrase('url')}}</th>

									<th>{{ getPhrase('action')}}</th>


								</tr>

							</thead>


							@if($record)

							@foreach($record as $rec)
							<tbody>
								<tr>
									<td>{{ $rec->title  }}</td>
									<td>{{ $rec->description  }}</td>
									<td>{{ $rec->date  }}</td>
									<td>{{ $rec->url  }}</td>
									<td>
										<div class="dropdown more">
											<a id="dLabel" type="button" class="more-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												<i class="mdi mdi-dots-vertical"></i>
											</a>
											<ul class="dropdown-menu" aria-labelledby="dLabel">
												<li><a href="{{URL_EVENTS_EDIT.$rec->slug}}"><i class="fa fa-pencil"></i>{{ getPhrase("edit") }}</a></li>
												<li><a href="javascript:void(0);" onclick="deleteRecord('<?php echo $rec->slug; ?>');"><i class="fa fa-trash"></i>{{ getPhrase("delete") }}</a></li>
											</ul>
		
										</div>
									</td>
								</tr>
							</tbody>
							@endforeach

							@endif

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

 @include('common.deletelocation', array('route'=>URL_EVENTS_DELETE))


  @include('common.account-status', array('route'=>URL_USERS_STATUS))

@stop

