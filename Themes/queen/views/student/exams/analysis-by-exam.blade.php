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
						<th>{{ getPhrase('duration')}}</th>
						<th>Максимальный % прохождения</th>
						<th>Использованные попытки</th>

					</tr>
				</thead>

			</table>
		</div>
	</div>
</div>


@endsection

 



@section('footer_scripts')

  

 @include('common.datatables-parent', array('route'=>URL_STUDENT_EXAM_ANALYSIS_BYEXAM.$user->slug, 'route_as_url' => 'TRUE'))



{{--@include('common.chart', array($chart_data,'ids' => array('myChart1' )));--}}





@stop

