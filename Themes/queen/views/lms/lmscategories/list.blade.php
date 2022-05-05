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
				<a href="{{URL_LMS_CATEGORIES_ADD}}" type="button"
						class="btn btn-primary waves-effect waves-themed">{{ getPhrase('create')}}</a>
			</div>
		</div>
		<div class="frame-wrap p-0 border-0 m-0 table-responsive">

			<table class="table table-bordered table-striped w-100 datatable" cellspacing="0" width="100%">
				<thead>
					<tr>
						
						<th>{{ getPhrase('category')}}</th>
						<th>{{ getPhrase('image')}}</th>
						<th>{{ getPhrase('description')}}</th>
						<th>{{ getPhrase('action')}}</th>

					</tr>
				</thead>

			</table>
		</div>
	</div>
</div>

@endsection
@section('footer_scripts')
@include('common.datatables', array('route'=>'lmscategories.dataTable'))
@include('common.deletescript', array('route'=>URL_LMS_CATEGORIES_DELETE))
@stop

