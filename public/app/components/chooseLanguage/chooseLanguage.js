product
.config(function ($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl: 'components/chooseLanguage/chooseLanguage.tpl.html'            
            ,resolve: {
                $b: ["$q", "LanguageService",
                function ($q, LanguageService) {
                    return $q.all({
                        languages: LanguageService.query().$promise
                    });
                }]
        }
            ,controller: 'ChooseLanguageCtrl'
        })
        .otherwise({
                redirectTo: '/whatever'
        });
    }
)      
.controller("ChooseLanguageCtrl", ['$scope','$http', '$q', '$location', '$b', 'LanguageService', ChooseLanguageCtrl]);

function ChooseLanguageCtrl($scope, $http, $q, $location, $b, LanguageService)
{
    angular.extend($scope, $b);
    //$scope.languages = LanguageService.query().$promise;
    //$scope.languages.then(function (data) {$scope.languages= data;});
    //Methods
    
    $scope.getCityWeather = function () {
        var data = LanguageService.get({city: $scope.select_city}).$promise;
        data.then(function(data) {
            $scope.information = data;
        });
    };
}
;