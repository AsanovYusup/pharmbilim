@extends($layout)
@section('header_scripts')
@stop
@section('content')
@include('layouts.partials.breadcrumbs')
@include('layouts.partials.subheader')


<div class="card mb-g">
	<div class="card-body">
		<div class="card-header bg-white d-flex align-items-center">
			<h4 class="m-0">
				{{ $title }}
				{{-- <small>See all available options</small> --}}
			</h4>
			<div class="ml-auto">
				<a href="{{URL_USERS_ADD_LOCATION}}" type="button"
					class="btn btn-primary waves-effect waves-themed">{{ getPhrase('add_location')}}</a>
			</div>
		</div>
		<div class="frame-wrap p-0 border-0 m-0 table-responsive">

			<table class="table table-bordered table-striped w-100 datatable" cellspacing="0" width="100%">
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
							<div class="col text-center">
								<div class="btn-group">
									<button type="button" class="btn btn-xs btn-success btn-icon rounded waves-effect waves-themed"
										data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fal fa-cog"></i>
									</button>
									<div class="dropdown-menu">
										<a class="dropdown-item" href="{{ URL_USERS_SETTINGS_LOCATION.$com->slug }}"><i
												class="fal fa-spinner"></i> {{ getPhrase("add_categories") }}'</a>
										<a class="dropdown-item" href="<?php echo "edit/location/$com->slug"; ?>"><i
												class="fal fa-pencil"></i> {{ getPhrase("edit") }}</a>
										<a class="dropdown-item" href="javascript:void(0);"
											onclick="deleteRecord('<?php echo $com->slug; ?>');"><i
												class="fal fa-trash"></i> {{ getPhrase("delete") }}</a>
									</div>
								</div>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

@endsection



@section('footer_scripts')

{{-- @include('common.datatables-location') --}}

@include('common.deletelocation', array('route'=>URL_USERS_DELETE_LOCATION))



@include('common.account-status', array('route'=>URL_USERS_STATUS))

@stop