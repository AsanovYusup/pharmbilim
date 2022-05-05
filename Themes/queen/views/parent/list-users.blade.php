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
			</h4>
			<div class="ml-auto">
				<div class="btn-group btn-group-sm">
					<a href="/parent/export/{{$user->slug}}" type="button"
						class="btn btn-primary waves-effect waves-themed">{{ getPhrase('export_excel')}}</a>
				</div>
			</div>
		</div>
		<div class="frame-wrap p-0 border-0 m-0 table-responsive">

			<table class="table table-bordered table-striped w-100 datatable" cellspacing="0" width="100%">
				<thead>
					<tr>

						<th>{{ getPhrase('name')}}</th>
						<th>{{ getPhrase('phone')}}</th>
						<th>{{ getPhrase('company')}}</th>
						<th>{{ getPhrase('region')}}</th>
						<th>{{ getPhrase('pharm')}}</th>
						<th>{{ getPhrase('role')}}</th>
						<th>{{ getPhrase('action')}}</th>

					</tr>
				</thead>

			</table>
		</div>
	</div>
</div>

@endsection
@php
		$url = URL_PARENT_CHILDREN_GETLIST.$user->slug;
@endphp
@section('footer_scripts')
@include('common.datatables-parent', array('route'=>$url, 'route_as_url' => TRUE))
@stop

