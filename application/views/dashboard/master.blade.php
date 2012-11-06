<!DOCTYPE html>
<html lang="en" ng-app="dashboard">
  @include('plugins.header')
  <style>
  [ng\:cloak], [ng-cloak], .ng-cloak {
    display: none;
  }
</style>
  <body ng-controller="RouteCtrl">
	<div class="navbar navbar-fixed-top navbar-inverse">
	  <div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="brand" href="#">Azul</a>
			<div class="nav-collapse collapse">
				<ul class="nav">
					<li><a href="/dashboard">Console</a></li>
				</ul>

					<form class="navbar-search pull-right" ng-controller="SiteListCtrl">
						<select name="site" ng-change="switch()" ng-model="site_selected" ng-options="site.key as site.name for site in sites">
							<option value="">-- select site--</option>
						</select>
					</form>

			</div><!--/.nav-collapse -->

		</div>
	  </div>
	</div>
    <div class="container">
        <div class="row">

		</div>
		<div class="row">@include('plugins.status')</div>
		<div ng-controller="OperationCtrl">
			<div class="" ng-show="latest_operations.length">
				<div class="alert alert-success" ng-repeat="latest_operation in latest_operations">
					<button type="button" class="close" ng-click="removeLatest($index+1)">x</button>
					<a href="#logModal" role="button" data-toggle="modal" ng-click="showLog(latest_operation.log_id)"><[latest_operation.log_id]></a>
				</div>
			</div>
			<div id="logModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
					<h3 id="myModalLabel"><[log_id]></h3>
				</div>
				<div class="modal-body">
					<pre><[log_content]></pre>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true" ng-click="stopLog()">Close</button>
				</div>
			</div>
			<div class="well" ng-show="operations.length">
				<div class="alert alert-block" ng-repeat="operation in operations">
					<!--<button type="button" class="close" ng-click="remove($index+1)">x</button>-->
					<[operation.site.name]>: <[operation.op | t]>, source is <strong><[operation.source | t]></strong>, destination is <strong><[operation.destination | t]></strong>
					
				</div>
				<div class="row-fluid">
					<div class="span2">
						<button class="btn btn-block btn-primary" ng-click="cancel()">Cancel</button>
					</div>
					<div class="span10">
						<a class="btn btn-block btn-warning" href="#logModal" role="button" data-toggle="modal" ng-click="execute()">Execute Operation</a>
					</div>
				</div>
			</div>
		</div>

			@section('content')
			@yield_section

        @include('plugins.footer')
    </div> <!-- /container -->

    {{ Asset::scripts() }}
    <script src="js/lib/angular/angular.js"></script>
    <script src="js/lib/angular/angular-resource.js"></script>
    <script src="js/controllers.js"></script>
  </body>
</html>