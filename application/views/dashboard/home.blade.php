@layout('dashboard.master')

@section('title')

@endsection

@section('content')

<div class="row-fluid">
	<div class="tabbable tabs-left">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#development" data-toggle="tab">Development</a></li>
			<li><a href="#staging" data-toggle="tab">Staging</a></li>
			<li><a href="#production" data-toggle="tab">Production</a></li>
		</ul>
		<div class="tab-content">
		
			<div class="tab-pane active" id="development" ng-controller="SiteDevCtrl">


				<h3>Development</h3>


				<div class="row-fluid">
					
						<div class="span8">
							<a class="btn pull-right" href="#" ng-click="refresh()"><i class="icon-refresh"></i></a>
							<button class="btn" ng-click="op('update', site.region.dev.repo)">Update from Repo <i class="icon-download-alt"></i></button>
							
							
							
						</div>
						<div class="span4">
							<div class="well">
								<h5>Information</h5>
								<ul class="nav nav-pills"><li class="active span12"><a href="<[site.region.dev.url]>"><[site.region.dev.url]></a></li></ul>
								<div class="input-prepend">
									<span class="add-on span2"><[site.region.dev.repo_type]></span>
									<input type="text" class="span10" value="<[site.region.dev.repo]>">
								</div>

								<h5>Database</h5>
								<div class="row-fluid">
									<span class="span6">Refresh from</span>
									<div class="span6">
										<button class="btn btn-block" ng-click="op('db-refresh', 'stage')">Staging</button>
										<button class="btn btn-block" ng-click="op('db-refresh', 'prod')">Production</button>
									</div>
								</div>								
							</div>
						</div>
					</div>

				
				
			</div>

			<div class="tab-pane " id="staging" ng-controller="SiteStagingCtrl">

						<div class="span10"><h3>Staging</h3></div>
						<div class="span2"><a class="btn btn-small pull-right" href="#" ng-click="refresh()"><i class="icon-refresh"></i></a></div>

						<a href="<[site.region.staging.url]>"><[site.region.staging.url]></a>

			</div>

			<div class="tab-pane" id="production" ng-controller="SiteProdCtrl">

						<div class="span10"><h3>Production</h3></div>
						<div class="span2"><a class="btn btn-small pull-right" href="#" ng-click="refresh()"><i class="icon-refresh"></i></a></div>

						<a href="<[site.region.prod.url]>"><[site.region.prod.url]></a>

			</div>
		</div>
	</div>
</div>
@endsection