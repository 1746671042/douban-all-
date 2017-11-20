var app = angular.module("myApp", ["ui.router"]);
////配置路由
app.config(["$stateProvider", "$urlRouterProvider", function ($stateProvider, $urlRouterProvider) {
        $stateProvider.state("index1",
            {
                url: "/index.html",
                templateUrl: "./template/index1.html",
                controller: "indexController"
            })
            .state("details",     //即将上映
            {
            url: "/upcoming.html",
            templateUrl: "./template/upcoming.html",
            controller: "upComingController"
            })
            .state("show",      //上映中
            {
            url: "/show.html",
            templateUrl: "./template/show.html",
            controller: "showController"
            })
             .state("ranking",      //上映中
            {
            url: "/ranking.html",
            templateUrl: "./template/Ranking.html",
            controller: "rankingController"
            })
            .state("publish",      //发布电影
            {
            url: "/publish.html",
            templateUrl: "./template/publish.html",
            controller: "publishController"
            })
            .state("search",      //搜索电影
            {
            url: "/search.html/{search}",
            templateUrl: "./template/search.html",
            controller: "searchController"
            })
            .state("detail",      //电影详情
            {
            url: "/detail.html/{id}",
            templateUrl: "./template/detail.html",
            controller: "detailController"
//            controller: function($scope,$stateParams){
//                $scope.id=$stateParams.id;
//            }
            });
        $urlRouterProvider.otherwise("/index.html");
    }])



//app.controller("indexControler",["$scope","$http",function($scope,$http){
//        $scope.data = "",
//        $http({
//            method:"get",
//            url:"./php/imageList.php"
//        }).then(function(data){  
//            $scope.data = data.data;
//        })
//}]);
//自定义指令
//热门电影
app.directive("imageList", [function () {
        return {
            restrict: "EAC",
            templateUrl: "./template/imageList.html",
            replace: true,
            scope: {
                image: "@forImage",
                name: "@forName",
                year: "@forYear",
                typename: "@forTypename",
            },
            controller: function ($scope) {

            }
//          link:function(scope,iEle,iAttr){
//              
//          }
        };
    }]);



//即将上映
app.directive("upComing", [function () {
        return {
            restrict: "EAC",
            templateUrl: "./template/upcoming.html",
            replace: true,
            scope: {
                image: "@forImage",
                name: "@forName",
                year: "@forYear",
                typename: "@forTypename",
            },
            controller: function ($scope) {

            }
//          link:function(scope,iEle,iAttr){
//              
//          }
        };
    }]);



//上映中
app.directive("show", [function () {
        return {
            restrict: "EAC",
            templateUrl: "./template/show.html",
            replace: true,
            scope: {
                image: "@forImage",
                name: "@forName",
                year: "@forYear",
                typename: "@forTypename",
            },
            controller: function ($scope) {

            }
//          link:function(scope,iEle,iAttr){
//              
//          }
        };
    }]);


//影片排行榜
app.directive("ranking", [function () {
        return {
            restrict: "EAC",
            templateUrl: "./template/ranking.html",
            replace: true,
            scope: {
                image: "@forImage",
                name: "@forName",
                year: "@forYear",
                typename: "@forTypename",
            },
            controller: function ($scope) {

            }
        };
    }]);


//发布电影
app.directive("publish", [function () {
        return {
            restrict: "EAC",
            templateUrl: "./template/publish.html",
            replace: true,
            scope: {
                image: "@forImage",
                name: "@forName",
                year: "@forYear",
                typename: "@forTypename",
            },
            controller: function ($scope) {

            }
        };
    }]);
//搜索电影
app.directive("search", [function () {
        return {
            restrict: "EAC",
            templateUrl: "./template/search.html",
            replace: true,
            scope: {
                image: "@forImage",
                name: "@forName",
                year: "@forYear",
                typename: "@forTypename",
            },
            controller: function ($scope) {
            
            }
        };
    }]);


//影片详情
app.directive("detail", [function () {
        return {
            restrict: "EAC",
            templateUrl: "./template/detail.html",
            replace: true,
            scope: {
                image: "@forImage",
                name: "@forName",
                year: "@forYear",
                typename: "@forTypename",
            },
            controller: function ($scope) {

            }
        };
    }]);