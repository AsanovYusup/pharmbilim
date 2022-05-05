@extends($layout)
@section('header_scripts')
@stop
@section('content')
@include('layouts.partials.breadcrumbs')
@include('layouts.partials.subheader')

<div class="card mb-g">
	<div class="card-body">

		<div class="frame-wrap p-0 border-0 m-0 table-responsive">

			<table class="table table-bordered table-striped w-100 datatable" cellspacing="0" width="100%">
				<thead>
					<tr>

						<th>{{ getPhrase('title')}}</th>
						<th>{{ getPhrase('marks')}}</th>
						<th>Кол-во кредит часов</th>
						<th>{{ getPhrase('result')}}</th>
						<th>{{ getPhrase('date_exam')}}</th>

					</tr>
				</thead>

			</table>
		</div>
	</div>
</div>
@endsection
@section('footer_scripts')
@if(!$exam_record)
@include('common.datatables-parent', array('route'=>URL_STUDENT_EXAM_GETATTEMPTS.$user->slug, 'route_as_url' => 'TRUE'))
@else
@include('common.datatables-parent', array('route'=>URL_STUDENT_EXAM_GETATTEMPTS.$user->slug.'/'.$exam_record->slug, 'route_as_url' => 'TRUE'))
@endif
@stop



