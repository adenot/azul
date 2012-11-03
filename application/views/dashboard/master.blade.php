<!DOCTYPE html>
<html lang="en" ng-app="dashboard">
  @include('plugins.header')
  <style>
  [ng\:cloak], [ng-cloak], .ng-cloak {
    display: none;
  }
</style>
  <body ng-controller="RouteCtrl">
    @include('plugins.nav')
    <div class="container">
        <div class="row">
			<div class="span4 offset8" ng-controller="SiteListCtrl">
				<form class="form-inline pull-right">
					<select name="site" ng-model="site_selected" ng-options="site.key as site.name for site in sites">
						<option value="">-- select site--</option>
					</select>
					<button type="submit" class="btn" ng-click="switch()">Switch Site</button>
				</form>
			</div>
		</div>
		<div class="row">@include('plugins.status')</div>
		<div class="well" ng-show="operations.length" ng-controller="OperationCtrl">
			<div id="logModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
					<h3 id="myModalLabel"><[logtitle]></h3>
				</div>
				<div class="modal-body">
					<p><[log]></p>
				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
				</div>
			</div>
		
			<div class="alert alert-block" ng-repeat="operation in operations">
				<button type="button" class="close" ng-click="remove($index+1)">x</button>
				<[operation.site.name]>: <[operation.op | t]>, source is <strong><[operation.source | t]></strong>, destination is <strong><[operation.destination | t]></strong>
				
			</div>
			<div class="row-fluid">
			<div class="span2">
				<button class="btn btn-block btn-primary" ng-click="removeAll()">Cancel All</button>
			</div>
			<div class="span10">
				<a class="btn btn-block btn-warning" href="#logModal" role="button" data-toggle="modal" ng-click="execute()">Execute Operations</a>
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