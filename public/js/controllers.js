angular.module("siteServices", ["ngResource"]).
  factory('Site', function($resource) {
    
    return $resource("/dashboard/api/:action/:region",
      {action:'site', callback:'JSON_CALLBACK'});
    
  });

function RouteCtrl($scope, $rootScope, $routeParams, $location) {
	$scope.$on('$routeChangeSuccess', function (scope, next, current) {
		$scope.curPath = $location.path();
	});
}

RouteCtrl.$inject = ['$scope', '$rootScope', '$routeParams', '$location'];

function SiteListCtrl($scope, $rootScope, $location, Site) {	
	$scope.loaded = false;

	if ($location.path()) {
		$scope.site_selected = $location.path().slice(1);
	}
	
	$scope.refresh = function() {
		$scope.sites = Site.query({action: "site_list" }, function() { 
			$scope.loaded=true;
			$scope.switch();
			
		});
	}
		
	$scope.switch = function() {
		
		if ($scope.site_selected === undefined) return;
		
		for (i=0;i<$scope.sites.length;i++) 
		{
			if ($scope.sites[i].key.trim() == $scope.site_selected.trim())
			{
				$rootScope.$broadcast('siteSwitched', $scope.sites[i]);
				$location.path($scope.site_selected.trim());
				break;
			}
		}	
		
	}
	

	
	$scope.refresh();
}

function OperationCtrl($scope, $rootScope, Site) {
	$scope.$on('operationAdd', function(event, operation) {
		$scope.operations.push(operation);
	});
	$scope.operations = [];

	$scope.remove = function(operation_index) {
		$scope.operations.splice(operation_index-1,1);
	}
	$scope.removeAll = function() {
		$scope.operations = [];
	}
	
	$scope.execute = function() {
		var SiteLog = new Site();
		SiteLog.operations = $scope.operations;
		$scope.log_id = SiteLog.$save({'action':'execute'});
	}
}

function SiteDevCtrl($scope, $rootScope, Site) {
	$scope.$on('siteSwitched', function(event, site) {
		$scope.site = site;
	});
	$scope.refresh = function() { $scope.$digest(); }
	$scope.op = function(name, source) {
		var operation = { "site": $scope.site, "op": name, "source": source, "destination": "dev" }
		$rootScope.$broadcast('operationAdd', operation);
		return false;
	}
	
}

function SiteStagingCtrl($scope, $rootScope, Site) {
	$scope.$on('siteSwitched', function(event, site) {
		$scope.site = site;
	});
	var refresh = function() { $scope.$digest(); }
	
}

function SiteProdCtrl($scope, $rootScope, Site) {
	$scope.$on('siteSwitched', function(event, site) {
		$scope.site = site;
	});
	var refresh = function() { $scope.$digest(); }
	
}




var dashboardApp = angular.module('dashboard', ['siteServices', 'MessageHumanizer'])
.config(['$interpolateProvider', function ($interpolateProvider) {
    $interpolateProvider.startSymbol('<[');
    $interpolateProvider.endSymbol(']>');
}]);
/*.config(['$routeProvider',function($routeProvider) {

    $routeProvider.when('/status', {templateUrl:'tpl/site_status.html', controller:SiteStatusCtrl});
    $routeProvider.when('/code', {templateUrl:'tpl/site_code.html', controller:SiteCodeCtrl});
	$routeProvider.when('/database', {templateUrl:'tpl/site_database.html', controller:SiteDatabaseCtrl});
    $routeProvider.otherwise({redirectTo:'/status'});	
	
}]);
*/

/*
angular.module('DashboardDirectives', []).
	directive('modal', function() {
		var modal = {
			link: function(scope, element, attrs) {
				function modal() {
					var element = angular.element(
		
	}
);
*/
angular.module('MessageHumanizer', []).
	filter('t', function() {
		return function(message) {
			switch (message) {
				// regions
				case "dev":
					return "development";
				case "stage":
					return "staging";
				case "prod":
					return "production";
				// operations
				case "db-refresh":
					return "Refresh database";
				case "update":
					return "Update to latest code from repository";

			}
			return message;
		}
	}
);
