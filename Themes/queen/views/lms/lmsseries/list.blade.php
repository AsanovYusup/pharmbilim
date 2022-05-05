@extends('layouts.admin.adminlayout')
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
				<a href="{{URL_LMS_SERIES_ADD}}" type="button"
						class="btn btn-primary waves-effect waves-themed">{{ getPhrase('create')}}</a>
			</div>
		</div>
		<div class="frame-wrap p-0 border-0 m-0 table-responsive">

			<table class="table table-bordered table-striped w-100 datatable" cellspacing="0" width="100%">
				<thead>
					<tr>
						
						<th>{{ getPhrase('title')}}</th>
						<th>{{ getPhrase('image')}}</th>
						<th>{{ getPhrase('is_paid')}}</th>
						<th>{{ getPhrase('cost')}}</th>
						<th>{{ getPhrase('validity')}}</th>
						<th>{{ getPhrase('total_items')}}</th>
						<th>{{ getPhrase('show_in_home_page')}}</th>
						<th>{{ getPhrase('action')}}</th>

					</tr>
				</thead>

			</table>
		</div>
	</div>
</div>

@endsection
@section('footer_scripts')  
@include('common.datatables', array('route'=>URL_LMS_SERIES_AJAXLIST, 'route_as_url' => TRUE))
@include('common.deletescript', array('route'=>URL_LMS_SERIES_DELETE))
@stop
