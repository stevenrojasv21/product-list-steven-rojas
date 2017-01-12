product
.config(function ($routeProvider) {
    $routeProvider
        .when('/', {
            templateUrl: 'components/language/chooseLanguage/chooseLanguage.tpl.html'            
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
                //redirectTo: '/whatever'
        });
    }
)      
.controller("ChooseLanguageCtrl", ['$scope','$http', '$q', '$location', '$translate' ,'$b', 'LanguageService', ChooseLanguageCtrl]);

function ChooseLanguageCtrl($scope, $http, $q, $location, $translate, $b, LanguageService)
{
    angular.extend($scope, $b);
    //$scope.languages = LanguageService.query().$promise;
    //$scope.languages.then(function (data) {$scope.languages= data;});
    //Methods
    $scope.select_language = $translate.use();
    
    $scope.changeLanguage = function () {
        var language = $scope.select_language;
        $translate.use(language);
    };
}
;