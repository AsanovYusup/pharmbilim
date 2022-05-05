@extends('layouts.admin.adminlayout')
@section('header_scripts')
@stop
@section('content')

<ol class="breadcrumb page-breadcrumb">
		<li class="breadcrumb-item"><a href="{{PREFIX}}"><i class="fal fa-house-return"></i></a></li>
		<li class="breadcrumb-item active">{{ $title }}</li>
		<li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
</ol>
<div class="subheader">
		<h1 class="subheader-title">
				<i class="subheader-icon fal fa-users"></i> {{ $title }} 
		</h1>
		<div class="subheader-block d-lg-flex align-items-center">
				<div class="d-inline-flex flex-column justify-content-center mr-3">
						<span class="fw-300 fs-xs d-block opacity-50">
								<small>EXPENSES</small>
						</span>
						<span class="fw-500 fs-xl d-block color-primary-500">
								$47,000
						</span>
				</div>
				<span class="sparklines hidden-lg-down" sparkType="bar" sparkBarColor="#886ab5" sparkHeight="32px" sparkBarWidth="5px" values="3,4,3,6,7,3,3,6,2,6,4"></span>
		</div>
		<div class="subheader-block d-lg-flex align-items-center border-faded border-right-0 border-top-0 border-bottom-0 ml-3 pl-3">
				<div class="d-inline-flex flex-column justify-content-center mr-3">
						<span class="fw-300 fs-xs d-block opacity-50">
								<small>MY PROFITS</small>
						</span>
						<span class="fw-500 fs-xl d-block color-danger-500">
								$38,500
						</span>
				</div>
				<span class="sparklines hidden-lg-down" sparkType="bar" sparkBarColor="#fe6bb0" sparkHeight="32px" sparkBarWidth="5px" values="1,4,3,6,5,3,9,6,5,9,7"></span>
		</div>
</div>

				
<div class="card mb-g">	
		<div class="card-body">
					<div class="card-header bg-white d-flex align-items-center">
							<h4 class="m-0">
									Опции
									{{-- <small>See all available options</small> --}}
							</h4>
							<div class="ml-auto">
									<div class="btn-group btn-group-sm">
											<a href="{{URL_QUESTIONBAMK_IMPORT}}" type="button" class="btn btn-primary waves-effect waves-themed">{{ getPhrase('import_questions')}}</a>
											<a href="{{URL_SUBJECTS_ADD}}" type="button" class="btn btn-primary waves-effect waves-themed">{{ getPhrase('add_subject')}}</a>											
									</div>
							</div>
					</div>					
					<div class="frame-wrap p-0 border-0 m-0 table-responsive">

						<table class="table m-0 table-bordered table-sm table-striped datatable compact hover" cellspacing="0" width="100%">
									<thead>
											<tr>
													<th>{{ getPhrase('subject')}}</th>
													{{-- <th>{{ getPhrase('code')}}</th> --}}
									 				<th>{{ getPhrase('action')}}</th>

											</tr>
									</thead>

							</table>
					</div>
			</div>
	</div>

@endsection
 

@section('footer_scripts')
  
 @include('common.datatables', array('route'=> URL_QUESTIONBANK_GETLIST, 'route_as_url' => 'TRUE'))
 @include('common.deletescript', array('route'=> URL_QUESTIONBANK_DELETE))

@stop
