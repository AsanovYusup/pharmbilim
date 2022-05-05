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
            <th>{{ getPhrase('exams')}}</th>
            <th>Осталось попыток</th>
            <th>{{ getPhrase('action')}}</th>
          </tr>
        </thead>
        <tbody>
          @foreach($array as $arr)
          <tr>
            <th>{{getTitleAttempts($arr->quizzes_id)->title}}</th>
            <th>{{$arr->attempts}}</th>
            <th>
              <div class="col text-center">
								<div class="btn-group">
									<button type="button" class="btn btn-xs btn-success btn-icon rounded waves-effect waves-themed"
										data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<i class="fal fa-cog"></i>
									</button>
									<div class="dropdown-menu">
										<a class="dropdown-item" href="{{URL_USERS_ADD_ATTEMPTS.$arr->id.'/'.$user->slug}}"><i
                          class="fal fa-pencil"></i> {{ getPhrase("edit_attempts") }}</a>
									</div>
								</div>
							</div>
            </th>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
@section('footer_scripts')
@stop