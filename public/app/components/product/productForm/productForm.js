product
.config(function ($routeProvider) {
    $routeProvider
        .when('/product/:id?', {
            templateUrl: 'components/product/productForm/productForm.tpl.html'            
            ,resolve: {
                $b: ["$q", "$route", "$translate", "ProductService",
                function ($q, $route, $translate, ProductService) {
                    var productPromise = {};
                    if ($route.current.params.id) {
                        $route.current.params.language = $translate.use();
                        productPromise = ProductService.get($route.current.params).$promise;
                    }
                    return $q.all({
                        product: productPromise
                    });
                }]
            }
            ,controller: 'ProductFormCtrl'
        })
        .otherwise({
                //redirectTo: '/whatever'
        });
    }
)      
.controller("ProductFormCtrl", ['$scope', '$routeParams', '$http', '$q', '$location', '$translate' ,'$b', 'ProductService', ProductFormCtrl]);

function ProductFormCtrl($scope, $routeParams, $http, $q, $location, $translate, $b, ProductService)
{
    angular.extend($scope, $b);
    //$scope.product = ProductService.get($routeParams).$promise;
    //$scope.product.then(function (data) {$scope.product = data;});
    //Methods
    //$scope.select_language = $translate.use();
    
    $scope.save = function () {
        
        var product = $scope.product;
        var productSave = new ProductService(product);
        $scope.product.language = $translate.use();
        
        if (product._id) {
            $scope.product.id = $scope.product.product_code;
            ProductService.update($scope.product,
                    function (data) {
                        $translate('successMessage').then(function (data) {
                            alert(data);
                            //document.getElementById("formProduct").reset();
                        }
                        );

                    },
                    function (data) {
                        $translate('errorMessage').then(function (data) {
                            alert(data);
                        }
                        );
                    }
            );
        } else {
            ProductService.save($scope.product,
                    function (data) {
                        $translate('successMessage').then(function (data) {
                            alert(data);
                            document.getElementById("formProduct").reset();
                        }
                        );

                    },
                    function (data) {
                        $translate('errorMessage').then(function (data) {
                            alert(data);
                        }
                        );
                    }
            );
        }
        
//        $scope.product.product_code = $scope.productCode;
//        $scope.product.title = $scope.title;
//        $scope.product.description = $scope.description;
//        $scope.product.language = $translate.use();
        
        
    };
    
    $scope.changeLanguage = function () {
        var language = $scope.select_language;
        $translate.use(language);
    };
}
;