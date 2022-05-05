@extends('layouts.admin.adminlayout')
@section('custom_div')
@stop
@section('content')
@include('layouts.partials.breadcrumbs')
@include('layouts.partials.subheader')



<div class="ng_container" ng-app="academia">
	<div class="ng_controller" ng-controller="prepareQuestions">
		@include('errors.errors')
		@php
		$settings = ($record) ? $settings : '';
		$button_name = getPhrase('create');
		@endphp
		<div class="row" ng-init="initAngData({{$settings}});">
			<div class="col-xl-12">

				<div id="panel-1" class="panel">
					<div class="panel-hdr">
						<h2>
							{{$title}}
						</h2>
					</div>
					<div class="panel-container show">
						<div class="panel-content row">
							<fieldset class="form-group col-md-6">
								{{ Form::label('subject', getphrase('subjects')) }}
								<span class="text-red">*</span>
								{{Form::select('subject', $subjects, null, ['class'=>'form-control select2', 'ng-model' => 'subject_id',
								'placeholder' => getPhrase('select'), 'ng-change'=>'subjectChanged(subject_id)' ])}}
							</fieldset>

							<fieldset class="form-group col-md-6">
								{{ Form::label('difficulty', getphrase('difficulty')) }}
								<select ng-model="difficulty" class="form-control">
									<option value="">{{getPhrase('select')}}</option>
									<option value="easy">{{getPhrase('easy')}}</option>
									<option value="medium">{{getPhrase('medium')}}</option>
									<option value="hard">{{getPhrase('hard')}}</option>
								</select>
							</fieldset>

							<fieldset class="form-group col-md-6">
								{{ Form::label('question_type', getphrase('question_type')) }}
								<select ng-model="question_type" class="form-control">
									<option selected="selected" value="">{{getPhrase('select')}}</option>
									<option value="radio">{{getPhrase('single_answer')}}</option>
									<option value="checkbox">{{getPhrase('multi_answer')}}</option>
									<option value="blanks">{{getPhrase('fill_in_the_blanks')}}</option>
									<option value="match">{{getPhrase('match_the_following')}}</option>
									<option value="para">{{getPhrase('paragraph')}}</option>
									<option value="video">{{getPhrase('video')}}</option>
								</select>
							</fieldset>

							<!-- <fieldset class="form-group col-md-6">

								{{ Form::label('show_in_front_end', getphrase('show_in_front_end')) }}

								<select ng-model="show_in_front_end" class="form-control" >

									<option selected="selected" value="">{{getPhrase('select')}}</option>

									<option value="1">{{getPhrase('yes')}}</option>

									<option value="0">{{getPhrase('no')}}</option>


									

								</select>

								</fieldset> -->



							<!-- <fieldset class="form-group col-md-6">

								{{ Form::label('searchTerm', getphrase('search_term')) }}
								{{ Form::text('searchTerm', $value = null , $attributes = array('class'=>'form-control',
						'placeholder' => getPhrase('enter_search_term'),
						'ng-model'=>'searchTerm')) }}

								</fieldset> -->


							<fieldset class="form-group col-md-6">
								{{ Form::label('question_model', getPhrase('search')) }}
								{{ Form::text('question_model', $value = null , $attributes = array('class'=>'form-control', 
						'placeholder' => getPhrase('enter_search_term'),
						'ng-model'=>'question_model')) }}
							</fieldset>

							{{-- 
								CODES USED WITH EXAM TYPE
								NSNT==> NO SECTION NO TIMER 
								SNT==> SECTION WITH NO TIMER 
								ST==> SECTION WITH TIMER 
							--}}

							@if($record->exam_type!='NSNT')
							<fieldset class="form-group col-md-6">
								{{ Form::label('section_name', 'Section Name') }}
								{{ Form::text('section_name', $value = null , $attributes = array('class'=>'form-control', 
						       'placeholder' => 'Section name',
						        'ng-model'=>'section_name')) }}
							</fieldset>
							@endif


							@if($record->exam_type != 'NSNT' && $record->exam_type != 'SNT')
							<fieldset class="form-group col-md-6">
								{{ Form::label('section_time', 'Section Time In Minutes') }}
								{{ Form::text('section_time', $value = null , $attributes = array('class'=>'form-control',
									'placeholder' => 'Section Time',
									'ng-model'=>'section_time')) }}
							</fieldset>
							@endif
						</div>
					</div>
				</div>

			</div>			

			<div class="col-xl-12">
				<div class="card mb-g">
					<div class="card-header bg-white d-flex align-items-center">
							<h4 class="m-0">
								Всего вопросов <span class="text-success">@{{ subjectQuestions.length }}</span>
							</h4>
						</div>
					<div class="card-body">
						<div class="frame-wrap p-0 border-0 m-0 table-responsive" ng-if="subjectQuestions!=''">
							
							<table class="table table-bordered table-striped w-100 datatable" cellspacing="0" width="100%">
								<thead>
									<tr>
										
										<th>{{getPhrase('subject')}}</th>
										<th>{{getPhrase('question')}}</th>
										<th>{{getPhrase('difficulty')}}</th>
										<th>{{getPhrase('type')}}</th>
										<th>{{getPhrase('marks')}}</th>
										<th>{{getPhrase('action')}}</th>

									</tr>
								</thead>
								<tbody>
									<tr	ng-repeat="question in subjectQuestions | filter: { difficulty_level:difficulty, question_type:question_type, show_in_front_end:show_in_front_end , topic_id:topic, sub_topic_id:sub_topic } | filter: question_model track by $index ">
										<td>@{{subject.subject_title}}</td>
										<td title="@{{subjectQuestions[$index].question}}" ng-bind-html="trustAsHtml(question.question)"></td>
										<td>@{{question.difficulty_level | uppercase}}</td>
										<td>@{{question.question_type | uppercase}}</td>
										<td>@{{question.marks}}</td>
										<td><button ng-click="addQuestion(question, subject);" class="btn btn-success shadow-0 ml-auto waves-effect waves-themed">{{getPhrase('add')}}</button></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-12">
				@include('exams.quiz.questions-selection-block')
			</div>
		</div>
	</div>
</div>


@stop

@section('footer_scripts')
@include('exams.quiz.scripts.js-scripts', ['quiz_record' => $record])
@include('common.alertify')
@stop
@section('custom_div_end')
@stop