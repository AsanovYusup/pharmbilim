@extends($layout)
@section('header_scripts')
@stop
@section('content')
@include('layouts.partials.breadcrumbs')
@include('layouts.partials.subheader')

<div class="row">
	<div class="col-lg-7 col-xl-7 order-lg-1 order-xl-1">
			<!-- profile summary -->
			<div class="card mb-g rounded-top">
					<div class="row no-gutters row-grid">
							<div class="col-12">
									<div class="d-flex flex-column align-items-center justify-content-center p-4">
											<img src="{{ getProfilePath($record->image,'profile')}}" alt="{{$record->name}}" class="rounded-circle shadow-2 img-thumbnail" >
											<h5 class="mb-0 fw-700 text-center mt-3">
													{{$record->name}}
													<small class="text-muted mb-0">{{$record->region}}</small>
											</h5>
											<div class="mt-4 text-center demo">
													<a href="tel:+996{{$record->phone}}" class="fs-xl" style="color:#3b5998">
															<i class="fal fa-phone"></i>
													</a>
													@php
															$whats_num = substr($record->whatsapp_phone, -9);
													@endphp
													<a href="https://api.whatsapp.com/send?phone=996{{ $whats_num }}" class="fs-xl" style="color: #075e54">
															<i class="fab fa-whatsapp"></i>
													</a>
													<a href="mailto:{{ $record->email }}" class="fs-xl">
															<i class="fal fa-envelope"></i>
													</a>												
											</div>
									</div>
							</div>
							<div class="col-6">
									<div class="text-center py-3">
											<h5 class="mb-0 fw-700">
													{{ date('j.m.Y', strtotime($record->created_at)) }}
													<small class="text-muted mb-0">Дата регистрации</small>
											</h5>
									</div>
							</div>
							<div class="col-6">
									<div class="text-center py-3">
											<h5 class="mb-0 fw-700">
													{{$record->points}}
													<small class="text-muted mb-0">Кредит-часы</small>
											</h5>
									</div>
							</div>
							{{-- <div class="col-12">
									<div class="p-3 text-center">
											<a href="javascript:void(0);" class="btn-link font-weight-bold">Follow</a> <span class="text-primary d-inline-block mx-3">●</span>
											<a href="javascript:void(0);" class="btn-link font-weight-bold">Message</a> <span class="text-primary d-inline-block mx-3">●</span>
											<a href="javascript:void(0);" class="btn-link font-weight-bold">Connect</a>
									</div>
							</div> --}}
					</div>
			</div>


	</div>
	<div class="col-lg-5 col-xl-5 order-lg-1 order-xl-1">
		<div class="card mb-2">
					<div class="card-body">
							<a href="{{URL_STUDENT_EXAM_ATTEMPTS.$record->slug}}" class="d-flex flex-row align-items-center">
									<div class="icon-stack display-3 flex-shrink-0">
											<i class="fal fa-circle icon-stack-3x opacity-100 color-primary-400"></i>
											<i class="fas fa-graduation-cap icon-stack-1x opacity-100 color-primary-500"></i>
									</div>
									<div class="ml-3">
											<strong>
													{{ getPhrase('История эксзаменов')}}
											</strong>
											<br>
											Вы можете посмотреть вашу историю экзаменов											
									</div>
							</a>
					</div>
			</div>
			<div class="card mb-2">
					<div class="card-body">
							<a href="{{'/analysis/lms-points/'.$record->slug}}" class="d-flex flex-row align-items-center">
									<div class="icon-stack display-3 flex-shrink-0">
											<i class="fal fa-circle icon-stack-3x opacity-100 color-success-400"></i>
											<i class="fas fa-chart-line icon-stack-1x opacity-100 color-success-500"></i>
									</div>
									<div class="ml-3">
											<strong>
													{{ getPhrase('Анализ видео')}}
											</strong>
											<br>
											Сделайте анализ по всем просмотренным видео урокам и вебинарам										
									</div>
							</a>
					</div>
			</div>
			<div class="card mb-2">
					<div class="card-body">
							<a href="{{URL_STUDENT_ANALYSIS_BY_EXAM.$record->slug}}" class="d-flex flex-row align-items-center">
									<div class="icon-stack display-3 flex-shrink-0">
											<i class="fal fa-circle icon-stack-3x opacity-100 color-warning-400"></i>
											<i class="fas fa-question icon-stack-1x opacity-100 color-warning-500"></i>
									</div>
									<div class="ml-3">
											<strong>
													{{ getPhrase('by_exam')}}
											</strong>
											<br>
											Сделайте анализ по всем опросникам и использаванным попыткам.											
									</div>
							</a>
					</div>
			</div>
			<div class="card mb-2">
					<div class="card-body">
							<a href="{{'/analysis/all-points/'.$record->slug}}" class="d-flex flex-row align-items-center">
									<div class="icon-stack display-3 flex-shrink-0">
											<i class="fal fa-circle icon-stack-3x opacity-100 color-warning-400"></i>
											<i class="fas fa-user-clock icon-stack-1x opacity-100 color-warning-500"></i>
									</div>
									<div class="ml-3">
											<strong>
													{{ getPhrase('Кредитные часы')}}
											</strong>
											<br>
											Ваши кредитные часы которые вы можете потратить, на обучение в будущем.											
									</div>
							</a>
					</div>
			</div>
	</div>
</div>

@if(checkRole(getUserGrade(7)))
<div class="card mb-g">	
	<div class="card-body">					
				<div class="frame-wrap p-0 border-0 m-0 table-responsive">

					<table class="table m-0 table-bordered table-sm table-striped datatable compact hover" cellspacing="0" width="100%">
								<thead>
										<tr>
												<th>{{ getPhrase('name')}}</th>
												<th>{{ getPhrase('phone')}}</th>
												<th>{{ getPhrase('image')}}</th>			 
												<th>{{ getPhrase('action')}}</th>
										</tr>
								</thead>

						</table>
				</div>
		</div>
</div>
@endif

@endsection

@php
		$url = URL_PARENT_CHILDREN_GETLIST_DETAILS.$user->slug;
@endphp

@section('footer_scripts')
@include('common.datatables', array('route'=>$url, 'route_as_url' => TRUE))
@stop

