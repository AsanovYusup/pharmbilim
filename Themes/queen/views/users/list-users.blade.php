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
				Опции
				{{-- <small>See all available options</small> --}}
			</h4>
			<div class="ml-auto">
				<div class="btn-group btn-group-sm">
					<a href="{{URL_USERS_IMPORT}}" type="button"
						class="btn btn-primary waves-effect waves-themed">{{ getPhrase('import_excel')}}</a>
					<a href="users/export" type="button"
						class="btn btn-primary waves-effect waves-themed">{{ getPhrase('export_excel')}}</a>
					<a href="{{URL_USERS_ADD}}" type="button"
						class="btn btn-primary waves-effect waves-themed">{{ getPhrase('add_user')}}</a>
				</div>
			</div>
		</div>
		<div class="frame-wrap p-0 border-0 m-0 table-responsive">

			<table class="table table-bordered table-striped w-100 datatable" cellspacing="0" width="100%">
				<thead>
					<tr>

						<th>{{ getPhrase('action')}}</th>

						<th>{{ getPhrase('ФИО')}}</th>

						<th>{{ getPhrase('date')}}</th>

						<th>{{ getPhrase('phone')}}</th>

						<th>{{ getPhrase('company')}}</th>

						<th>{{ getPhrase('Специальность')}}</th>

						<th>{{ getPhrase('region_name')}}</th>

						<th>{{ getPhrase('pharm')}}</th>

						<th>{{ getPhrase('parent')}}</th>

						<th>{{ getPhrase('role')}}</th>

						<th>{{ getPhrase('status')}}</th>

						<th>ID</th>

					</tr>
				</thead>

			</table>
		</div>
	</div>
</div>


@endsection



@section('footer_scripts')

@include('common.datatable-users', array('route'=>'users.dataTable'))

@include('common.deletescript', array('route'=>URL_USERS_DELETE))


@include('common.account-status', array('route'=>URL_USERS_STATUS))

@stop