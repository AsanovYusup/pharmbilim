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

                        <th>Вид</th>
                        <th>Название</th>
                        <th>Дата</th>
                        <th>Баллы</th>

					</tr>
                </thead>
                
                @if($record)
                    @foreach($record as $rec)
                        <tbody>
                        <tr>
                            <td>{{ $rec['view']  }}</td>
                            <td>{{ $rec['name']  }}</td>
                            <td>{{ $rec['date']  }}</td>

                            @if($rec['type'] == '+')
                                <td><span class="label label-success">{{ $rec['type']  }}{{ $rec['points']  }}</span></td>
                            @else
                                <td><span class="label label-danger">{{ $rec['type']  }}{{ $rec['points']  }}</span></td>

                            @endif
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

