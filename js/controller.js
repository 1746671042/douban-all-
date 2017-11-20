
//热门
app.controller("indexController", ["$scope", "$http", "$rootScope", function ($scope, $http, $rootScope) {
        $scope.page = 1;
        $scope.data = "";
        $scope.countpage = 1;
        //设置一些初始值
        $scope.last = false;
        $scope.next = false;
        //分页的函数，num为传入当前页数
        $scope.getPage = function (num) {
            //改变当前页数
            $scope.page = num;

            //判断分页的开始值和结束值
            if ($scope.countpage > 5) {
                var start = num - 2;
                var end = num + 2;
                if (start < 1) {
                    start = 1;
                    end = 5;
                }
                if (end > $scope.countpage) {
                    end = $scope.countpage;
                    start = $scope.countpage - 4;
                }
            } else {
                var start = 1;
                var end = $scope.countpage;
            }
            //组装页数的函数
            $scope.pageArr = new Array();
            for (i = start; i <= end; i++) {
                $scope.pageArr.push(i);
            }
            //上一页，下一页的显示
            $scope.last = true;
            $scope.next = true;
            if ($scope.page == 1) {
                $scope.last = false;
            }
            if ($scope.page == $scope.countpage) {
                $scope.next = false;
            }
        }
        //请求数据的参数
        $scope.getData = function (num) {
            $scope.page = num;
            $http({
                method: "get",
                url: "./php/imageList.php",
                params: {page: $scope.page}
            }).then(function (data) {
                $scope.data = data.data.list;
                $scope.countpage = data.data.countpage;
                $scope.getPage(num);

            });

        }
        $scope.getData(1);
        $rootScope.log = "热门电影";
    }]);



//未上映
app.controller("upComingController", ["$scope", "$http", "$rootScope", function ($scope, $http, $rootScope) {
        $scope.data = "",
                $http({
                    method: "get",
                    url: "./php/upcoming.php"
                }).then(function (data) {
            $scope.data = data.data;
            $rootScope.log = "即将上映";
        })
    }]);

//上映中
app.controller("showController", ["$scope", "$http", "$rootScope", function ($scope, $http, $rootScope) {
        $scope.data = "",
                $http({
                    method: "get",
                    url: "./php/show.php"
                }).then(function (data) {
            $scope.data = data.data;
            $rootScope.log = "上映中电影";
        })
    }]);


//影片排行榜
app.controller("rankingController", ["$scope", "$http", "$rootScope", function ($scope, $http, $rootScope) {
        $scope.data = "",
                $http({
                    method: "get",
                    url: "./php/ranking.php"
                }).then(function (data) {
            $scope.data = data.data;
            $rootScope.log = "影片排行榜";
        })
    }]);
//影片搜索

app.controller("searchController", ["$scope", "$http", "$rootScope","$stateParams", function ($scope, $http, $rootScope,$stateParams) {
        var search =$stateParams.search;
//        var search=$scope.search;
        $scope.data = "",
                $http({
                    method: "get",
                    url: "./php/search.php",
                    params:{search:search}
                }).then(function (data) {
            $scope.data = data.data;
            $rootScope.log = "搜索结果";
        })
    }]);
//影片详情
app.controller("detailController", ["$scope", "$http", "$rootScope","$stateParams", function ($scope, $http, $rootScope,$stateParams) {
        var id =$stateParams.id;
//        alert(id)
        $scope.data = "",
                $http({
                    method: "get",
                    url: "./php/detail.php",
                    params:{id:id}
                }).then(function (data) {
            $scope.data = data.data;
            $rootScope.log = "影片详情";
        })
    }]);