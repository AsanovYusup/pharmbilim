	
<div class="card mb-g">
	<div class="card-header bg-white d-flex align-items-center">
			<h4 class="m-0">
				{{getPhrase('saved_questions')}}
				<span class="text-success">@{{savedQuestions.length}}</span>
				<span class="text-success" ng-if="is_have_section==1">Всего секций (@{{keys.length}})</span>
			</h4>
		</div>
	<div class="card-body">
		<div class="frame-wrap p-0 border-0 m-0 table-responsive">
			{!! Form::open(array('url' => URL_QUIZ_UPDATE_QUESTIONS.$record->slug, 'method' => 'POST')) !!}
			<input ng-if="is_have_section==0" type="hidden" name="saved_questions" value="@{{savedQuestions}}">
			<input ng-if="is_have_section==1" type="hidden" name="saved_questions" value="@{{final_questions}}">
			<table class="table table-bordered table-striped w-100 datatable" cellspacing="0" ng-if="is_have_section==0">
				<thead>
					<tr>
						
						<th>{{getPhrase('subject')}}</th>
						<th>{{getPhrase('question')}}</th>
						<th>{{getPhrase('marks')}}</th>
						<th></th>

					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="i in savedQuestions track by $index">
						
						<td>@{{ savedQuestions[$index].subject_title}}</td>

						<td title="@{{ savedQuestions[$index].question}}">@{{ savedQuestions[$index].question  }}</td>
						<td>@{{ savedQuestions[$index].marks}}</td>
						<td><button ng-click="removeQuestion(i)" style="cursor: pointer;"	class="btn btn-danger shadow-0 ml-auto waves-effect waves-themed">Удалить</button></td>

					</tr>
				</tbody>
			</table>

			<div ng-if="is_have_section==1">
				<ul class="list-unstyled">
					<li ng-repeat="key in keys">

						<span class="text-primary"><input type="text" name="add_section_names[]"	value="@{{ savedQuestions[key].section_name}}">
							<span ng-if="type_exam == 'ST' "><strong><input type="text" name="add_section_times[]"	value="@{{savedQuestions[key].section_time}}">( mins )</strong></span>
						</span>

						<table class="table table-bordered table-striped w-100 datatable">

							<thead>
								<tr>
									<th>{{getPhrase('subject')}}</th>
									<th>{{getPhrase('question')}}</th>
									<th>{{getPhrase('marks')}}</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<tr ng-repeat="j in savedQuestions[key].questions">
									<td>@{{j.subject_title}}</td>
									<td title="@{{ j.question}}" ng-bind-html="trustAsHtml(j.question )"></td>
									<td>@{{j.marks}}</td>
									<td ng-if="is_have_section==0"><a ng-click="removeQuestion(j)" style="cursor: pointer;"
											class="btn-outline btn-close text-red"><i class="fa fa-close"></i></a></td>
									<td ng-if="is_have_section==1"><a ng-click="removeQuestionWithKey(j, key)" style="cursor: pointer;"
											class="btn-outline btn-close text-red"><i class="fa fa-close"></i></a></td>
								</tr>
							</tbody>
						</table>
					</li>
				</ul>
			</div>
			<div class="buttons">
				<button class="btn btn-lg btn-primary button">{{getPhrase('update')}}</button>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
