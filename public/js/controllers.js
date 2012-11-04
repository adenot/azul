angular.module("siteServices", ["ngResource"]).
  factory('Site', function($resource) {
    return $resource("/dashboard/api/:action",
      {action:'site', callback:'JSON_CALLBACK'});
  }).
  factory('SiteLog', function($resource) {
    return $resource("/dashboard/api/log/:id/:offset",
      {id:'@id', offset:'@offset', callback:'JSON_CALLBACK'});
    
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

function OperationCtrl($scope, $rootScope, $timeout, Site, SiteLog) {
	$scope.$on('operationAdd', function(event, operation) {
		$scope.operations = [];
		$scope.operations.push(operation);
	});
	$scope.operations = [];
	$scope.latest_operations = [];

	$scope.remove_latest = function(latest_index) {
		$scope.latest_operations.splice(latest_index-1,1);
	}
	$scope.cancel = function() {
		$scope.operations = [];
	}
	
	$scope.log_id = "";
	
	$scope.execute = function() {
		var siteOp = new Site();
		siteOp.operation = $scope.operations[0];
		siteOp.$save({'action':'execute'}, function(result) {
			$scope.log_id = result.log_id;
			$scope.log_content = "";
			$scope.logTimer = $timeout($scope.readLog, 1000);
			$scope.latest_operations.push({'log_id': $scope.log_id});
		});
		
		
	}
	
	$scope.readLog = function() {
		if ($scope.log === undefined) {
			$scope.log = { 'offset': 0 };
		}

		$scope.log = SiteLog.get({'id': $scope.log_id, 'offset': $scope.log.offset }, function() {
			console.log($scope.log);
			$scope.log_content += $scope.log.content;
			if ($scope.log.offset >= 0) { 
				$scope.logTimer = $timeout($scope.readLog, 1000);	
			}
		});
	}
	
	$scope.showLog = function(log_id) {
		console.log("showlog: "+log_id);
		$scope.log_id = log_id;
		$scope.log_content = "";
		$scope.logTimer = $timeout($scope.readLog, 1000);
	}
	
	$scope.stopLog = function() {
		$timeout.cancel($scope.logTimer);
		$scope.operations = [];
		
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
