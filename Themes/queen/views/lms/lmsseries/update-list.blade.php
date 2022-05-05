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
		$lmssettings = getSettings('lms');
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
								{{ Form::label('lms_categories', getphrase('select_subject')) }}
								{{Form::select('lms_categories', $categories, null, ['class'=>'form-control', 'ng-model' => 'category_id', 'placeholder' => 'Select', 'ng-change'=>'categoryChanged(category_id)' ])}}
							</fieldset>

							<fieldset class="form-group col-md-6">
								{{ Form::label('file_type', getphrase('file_type')) }}
								{{ Form::select('file_type', $lmssettings->content_types, null, ['class'=>'form-control', 'ng-model' => 'content_type', 'placeholder' => getPhrase('Select')  ])}}
							</fieldset>

						</div>
					</div>
				</div>

			</div>			

			<div class="col-xl-12">
				<div class="card mb-g">
					<div class="card-header bg-white d-flex align-items-center">
							<h4 class="m-0" ng-if="categoryItems.length>0">
								{{getPhrase('total_items')}}Всего вопросов <span class="text-success">@{{ categoryItems.length}}</span>
							</h4>
						</div>
					<div class="card-body">
						<div class="frame-wrap p-0 border-0 m-0 table-responsive" ng-if="examSeries!=''">
							
							<table class="table table-bordered table-striped w-100 datatable" cellspacing="0" width="100%">
								<thead>
									<tr>
										
										<th>{{getPhrase('title')}}</th>
										<th>{{getPhrase('code')}}</th>
										<th>{{getPhrase('type')}}</th>
										<th>{{getPhrase('action')}}</th>

									</tr>
								</thead>
								<tbody>
									<tr	ng-repeat="item in categoryItems | filter : {content_type: content_type} | filter:search_term  track by $index">
										<td title="@{{item.title}}">@{{item.title}}</td>
										<td>@{{item.code}}</td>
										<td>@{{item.content_type}}</td>
										<td><button ng-click="addToBag(item);" class="btn btn-success shadow-0 ml-auto waves-effect waves-themed">{{getPhrase('add')}}</button></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-12">
				@include('lms.lmsseries.right-bar-update-lmslist')
			</div>
		</div>
	</div>
</div>

@stop
@section('footer_scripts')
@include('lms.lmsseries.scripts.js-scripts')
@stop
@section('custom_div_end')
@stop