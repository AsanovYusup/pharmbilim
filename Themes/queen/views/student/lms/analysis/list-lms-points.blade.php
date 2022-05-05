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
                        <th>Название</th>
                        <th>Тип</th>
                        <th>Кол-во просмотр. минут</th>
                        <th>Кредит-часы</th>
					</tr>
                </thead>
                
                @if($record)
                    @foreach($record as $rec)
                        <tbody>
                            <tr>
                                <td>{{ $rec->name  }}</td>
                                <td>{{ $rec->type  }}</td>
                                <td>{{ $rec->time  }}</td>
                                <td><span class="label label-success">+{{ $rec->points  }}</span></td>

                            </tr>
                        </tbody>
                    @endforeach
                @endif

			</table>
		</div>
	</div>
</div>
@endsection
@section('footer_scripts')
{{-- @include('common.datatables-location') --}}
@stop

