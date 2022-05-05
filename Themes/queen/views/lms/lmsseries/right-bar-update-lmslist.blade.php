<div class="card mb-g">
	<div class="card-header bg-white d-flex align-items-center">
			<h4 class="m-0">
				{{getPhrase('saved_items')}}
				<span ng-if="savedSeries.length>0" class="text-success">@{{ savedSeries.length }}</span>
				<span ng-if="savedSeries.length==0" class="text-success" ng-if="is_have_section==1">{{getPhrase('no_data_available')}}</span>

			</h4>
		</div>
	<div class="card-body">
		<div class="frame-wrap p-0 border-0 m-0 table-responsive">
			{!! Form::open(array('url' => URL_LMS_SERIES_UPDATE_SERIES.$record->slug, 'method' => 'POST')) !!}
			<input type="hidden" name="saved_series" value="@{{savedSeries}}">
			<div class="ng_if" ng-if="savedSeries!=''">
				<table class="table table-bordered table-striped w-100 datatable" cellspacing="0" >
				<thead>
					<tr>
						
						<th>{{getPhrase('title')}}</th>
						<th>{{getPhrase('type')}}</th>
						<th>{{getPhrase('code')}}</th>	
						<th></th>

					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="i in savedSeries track by $index">
						<td>@{{ savedSeries[$index].title}}</td>
						<td title="@{{ savedSeries[$index].content_type}}">@{{ savedSeries[$index].content_type  }}</td>
						<td>@{{ savedSeries[$index].code}}</td>
						<td><button ng-click="removeItem(i)" class="btn btn-danger shadow-0 ml-auto waves-effect waves-themed">Удалить</button></td>
					</tr>
				</tbody>
			</table>
			</div>

			<div class="buttons">
				<button class="btn btn-lg btn-primary button">{{getPhrase('update')}}</button>
			</div>
			{!! Form::close() !!}
		</div>
	</div>
</div> 
	 


	 
	 
