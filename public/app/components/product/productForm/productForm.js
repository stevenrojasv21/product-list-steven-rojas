product
.config(function ($routeProvider) {
    $routeProvider
        .when('/product', {
            templateUrl: 'components/product/productForm/productForm.tpl.html'            
            ,resolve: {
                $b: ["$q", "LanguageService",
                function ($q, LanguageService) {
                    return $q.all({
                        languages: LanguageService.query().$promise
                    });
                }]
            }
            ,controller: 'ProductFormCtrl'
        })
        .otherwise({
                redirectTo: '/whatever'
        });
    }
)      
.controller("ProductFormCtrl", ['$scope','$http', '$q', '$location', '$translate' ,'$b', 'ProductService', ProductFormCtrl]);

function ProductFormCtrl($scope, $http, $q, $location, $translate, $b, ProductService)
{
    //angular.extend($scope, $b);
    //$scope.languages = LanguageService.query().$promise;
    //$scope.languages.then(function (data) {$scope.languages= data;});
    //Methods
    //$scope.select_language = $translate.use();
    
    $scope.save = function () {
        $scope.product = new ProductService();
        $scope.product.product_code = $scope.productCode;
        $scope.product.title = $scope.title;
        $scope.product.description = $scope.description;
        $scope.product.language = $translate.use();
        ProductService.save($scope.product, function(data) {
            console.log(data);
        });
        
    };
    
    $scope.changeLanguage = function () {
        var language = $scope.select_language;
        $translate.use(language);
    };
}
;