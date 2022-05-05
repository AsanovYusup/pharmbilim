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
				<div class="btn-group btn-group-sm">
					<a href="{{URL_QUIZ_ADD}}" type="button"
						class="btn btn-primary waves-effect waves-themed">{{ getPhrase('create')}}</a>
					<a href="{{URL_EXAM_SERIES}}" type="button"
						class="btn btn-primary waves-effect waves-themed">{{ getPhrase('create_series')}}</a>
				</div>
			</div>
		</div>
		<div class="frame-wrap p-0 border-0 m-0 table-responsive">

			<table class="table table-bordered table-striped w-100 datatable" cellspacing="0" width="100%">
				<thead>
					<tr>

						<th>{{ getPhrase('title')}}</th>
						<th>{{ getPhrase('duration')}}</th>
						<th>{{ getPhrase('category')}}</th>
						<th>{{ getPhrase('is_paid')}}</th>
						<th>{{ getPhrase('total_marks')}}</th>
						<th>{{ getPhrase('action')}}</th>

					</tr>
				</thead>

			</table>
		</div>
	</div>
</div>

@endsection
@section('footer_scripts')
@push('custom-scripts')
<script>
	function copy(argument) {
			var dummyContent = '/exams/student/quiz/take-exam/' + argument;
		var dummy = $('<input>').val(dummyContent).attr('id', 'clipboard').appendTo('body').select();
		document.execCommand('copy');
		$('#clipboard').remove();
	}
</script>
@endpush
@include('common.datatables', array('route'=>URL_QUIZ_GETLIST, 'route_as_url' => TRUE))
@include('common.deletescript', array('route'=>URL_QUIZ_DELETE))
@stop

