@layout('dashboard.master')

@section('title')

@endsection

@section('content')

<div class="row-fluid">
	<ul class="thumbnails">
		<li class="bs-region span4" ng-controller="SiteDevCtrl">
			<div class="thumbnail">
				<div class="caption">
					
					<div class="clearfix">
					<div class="span10"><h3>Development</h3></div>
					<div class="span2"><a class="btn btn-small pull-right" href="#" ng-click="refresh()"><i class="icon-refresh"></i></a></div>
					</div>
					<h5>Information</h5>
					<div class="well">
						<ul class="nav nav-pills"><li class="active span12"><a href="<[site.region.dev.url]>"><[site.region.dev.url]></a></li></ul>
						<div class="input-prepend">
							<span class="add-on"><[site.region.dev.repo_type]></span>
							<input type="text" class="span10" value="<[site.region.dev.repo]>">
						</div>
					</div>
					
					<h5>Operations</h5>
					<form class="">
						<div class="btn-group">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">Database<span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="javascript:void(0)" ng-click="op('db-refresh', 'stage')">Refresh from Staging</a></li>
								<li><a href="javascript:void(0)" ng-click="op('db-refresh', 'prod')">Refresh from Production</a></li>
							</ul>
						</div>
						
						
						<button class="btn btn-block">View Diff <i class="icon-random"></i></button>
						<button class="btn btn-block" ng-click="op('update', '<[site.region.dev.repo]>')">Update from Repo <i class="icon-download-alt"></i></button>
					
				</div>
			</div>
		</li>

		<li class="bs-region span4" ng-controller="SiteStagingCtrl">
			<div class="thumbnail">
				<div class="caption">
					<div class="span10"><h3>Staging</h3></div>
					<div class="span2"><a class="btn btn-small pull-right" href="#" ng-click="refresh()"><i class="icon-refresh"></i></a></div>

					<a href="<[site.region.staging.url]>"><[site.region.staging.url]></a>
				</div>
			</div>
		</li>

		<li class="bs-region span4" ng-controller="SiteProdCtrl">
			<div class="thumbnail">
				<div class="caption">
					<div class="span10"><h3>Production</h3></div>
					<div class="span2"><a class="btn btn-small pull-right" href="#" ng-click="refresh()"><i class="icon-refresh"></i></a></div>

					<a href="<[site.region.prod.url]>"><[site.region.prod.url]></a>
				</div>
			</div>
		</li>
	</ul>
</div>
@endsection