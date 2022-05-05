@extends('layouts.examlayout')



@section('header_scripts')



@stop



@section('content')



<div id="page-wrapper">



			<div class="container-fluid">



				<!-- Page Heading -->



				<div class="row">



					<div class="col-lg-12">



						<ol class="breadcrumb">







							<li class="active"> {{$title}} </li>



						</ol>



					</div>



				</div>



				<!-- /.row -->



				<div class="panel panel-custom">



					<div class="panel-heading">



						<h1>{{getPhrase('result_for'). ' '.$title}}</h1></div>



					<div class="panel-body">



							<div class="profile-details text-center">



							<div class="profile-img"><img src="{{ getProfilePath($user->image,'profile')}}" alt=""></div>



							<div class="aouther-school">



								<h2>{{ $user->name}}</h2>



								<p><span>{{$user->email}}</span></p>







							</div>







						</div>



					

 



						<div class="panel-body">

							<div class="row">

								<div class="col-sm-4">

									<ul class="library-statistic">



							<li class="total-books">



								{{getPhrase('score') }} <span>{{$record->marks_obtained}} / {{$record->total_marks}}</span>



							</li>



							<li class="total-journals">



								{{getPhrase('percentage')}} <span><?php echo sprintf('%0.2f', $record->percentage); ?></span>



							</li>



							<li class="digital-items">



							<?php $grade_system = getSettings('general')->gradeSystem; ?>

								
								@if($record->exam_status == 'pass')

								{{ getPhrase('result')}} <span>{{  getPhrase('pass') }}</span>
								
								@else 

								{{ getPhrase('result')}} <span>{{  getPhrase('fail') }}</span>	

								@endif


							</li>



						</ul>

								</div>




							</div>



						



				 





					<br/>

					 

					

					 

					</div>







					<div class="row">



						<div class="col-lg-12 text-center">


							<a onClick="setLocalItem('{{URL_RESULTS_VIEW_ANSWERS.$quiz->slug.'/'.$record->slug}}')" href="javascript:void(0);" class="btn t btn-primary">{{ getPhrase('view_key') }}</a>


						</div>

						<div class="col-lg-12 text-center" style="margin-top: 10px">

							<a href="/dashboard" class="btn t btn-primary">На главную</a>

						</div>



					</div>	



					</div>







				</div>



			</div>



			<!-- /.container-fluid -->



		</div>



		<!-- /#page-wrapper -->



	</div>



	<!-- /#wrapper -->



	 



@stop







@section('footer_scripts')



   <script src="{{JS}}chart-vue.js"></script>



<script>

function setLocalItem(url) {

	localStorage.setItem('redirect_url',url);

	window.close();

}

</script>



@stop