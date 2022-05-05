@extends('layouts.examlayout')
@section('header_scripts')

@stop
@section('content')


<div id="page-wrapper" ng-model="academia" ng-controller="instructions">
			<div class="container-fluid">
				<!-- Page Heading -->
				<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
							
							<li>{{ $title }}</li>
						</ol>
					</div>
				</div>
				<!-- /.row -->
	<div class="panel panel-custom col-lg-12" >
					<div class="panel-heading">
						<h1>{{getPhrase('Instructions')}}
							<span class="pull-right text-italic">{{getPhrase('please_read_the_instructions_carefully')}}
							</span>
						</h1>

					</div>
					<div class="panel-body instruction no-arrow">

						<div class="row">
							<div class="col-md-12">

								<h2	style="margin-bottom: 15px !important;">{{getPhrase('exam_name')}}:   {{$record->title}} </h2>

								@if($attempts->attempts <= 3)
									<h2 style="color: #8B0000;margin-bottom: 10px">Осталось попыток {{$attempts->attempts}} </h2>
								@else
									<h2 style="color: green;margin-bottom: 10px !important;">Осталось попыток {{$attempts->attempts}} </h2>
								@endif
								
								@if($instruction_data=='')	
								<h4 style="font-size: 14px">{{getPhrase('general_instructions')}}:</h4>
								@else
								<h4 style="font-size: 14px">{{$instruction_title}}:</h4>
								@endif
								@if($instruction_data=='')			
								<ol>
									<li>Total of {{$record->dueration}} minutes duration will be given to attempt all the questions.</li>
									<li>The clock has been set at the server and the countdown timer at the top right corner of your screen will display the time remaining for you to complete the exam. When the clock runs out the exam ends by default - you are not required to end or submit your exam.</li>
									<li>The question palette at the right of screen shows one of the following statuses of each of the questions numbered:</li>
								</ol>
								@else 
								{!! $instruction_data !!}
								@endif

								<ul class="guide" style="margin-top: 15px !important;">
									<li>
										<span class="answer"><i class="mdi mdi-check"></i></span> Отвеченные вопросы
									</li>
									<li>
										<span class="notanswer"><i class="mdi mdi-close"></i></span> Неотвеченные вопросы
									</li>
									<li>
										<span class="marked"><i class="mdi mdi-eye"></i></span> Маркированные вопросы
									</li>
									<li>
										<span class="notvisited"><i class="mdi mdi-eye-off"></i></span> Пропущенные вопросы
									</li>
								</ul>

							</div>

						</div>


						<hr>
						<?php
						$paid_type =  false;
						if($record->is_paid && !isItemPurchased($record->id, 'exam'))	
						$paid_type = true;
						?>
						<div class="form-group row">
						{!! Form::open(array('url' => 'exams/student/start-exam/'.$record->slug, 'method' => 'POST')) !!}
							<div class="col-md-12">
							@if(!$paid_type)	
								<input type="checkbox" name="option" id="free" checked="" ng-model="agreeTerms">
								<label for="free" > <span class="fa-stack checkbox-button"> <i class="mdi mdi-check active"></i> </span> Ознакомлен с инструкцией </label>
								
								<br><span class="text-danger" ng-show="!agreeTerms">{{ getPhrase('please_accept_terms_and_conditions')}}</span> 

								@endif
								<div class="text-center">
									@if($paid_type)	
									<a href="{{URL_PAYMENTS_CHECKOUT.'exam/'.$record->slug}}" class="btn button btn-lg btn-success"><i class="icon-credit-card"></i> {{getPhrase('buy_now')}}</a>	
									@else

									<button ng-if="agreeTerms" class="btn button btn-lg btn-success">{{getPhrase('start_exam')}}</button>
									@endif
								</div>

							</div>
					{!! Form::close() !!}

						</div>


					</div>
				</div>
			</div>

		</div>
@endsection
 

@section('footer_scripts')
  <script src="{{JS}}angular.js"></script>
  <script>
 var app = angular.module('academia', []);
app.controller('instructions', function($scope, $http) {
	
});
</script>

@stop
