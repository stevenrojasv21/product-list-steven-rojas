product
.config(function ($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl: 'components/chooseLanguage/chooseLanguage.tpl.html'
            ,controller: 'ChooseLanguageCtrl'
            ,resolve: {
                LanguageService: 'LanguageService',
                languages: function(LanguageService){
                    // This line is updated to return the promise
                    //return LanguageService.query().$promise;
                }
            }
        })
        .otherwise({
                redirectTo: '/whatever'
        });
    }
)      
.controller("ChooseLanguageCtrl", ['$scope','$http', '$q', '$location', 'LanguageService', ChooseLanguageCtrl]);

function ChooseLanguageCtrl($scope, $http, $q, $location, LanguageService)
{
    $scope.languages = LanguageService.query().$promise;
    $scope.languages.then(function (data) {$scope.languages= data;});
    //Methods
    
    $scope.getCityWeather = function () {
        var data = LanguageService.get({city: $scope.select_city}).$promise;
        data.then(function(data) {
            $scope.information = data;
        });
    };
}
;