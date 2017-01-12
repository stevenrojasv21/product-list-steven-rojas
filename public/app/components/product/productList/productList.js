product
.config(function ($routeProvider) {
    $routeProvider
        .when('/products', {
            templateUrl: 'components/product/productList/productList.tpl.html'            
            ,resolve: {
                $b: ["$q", "$translate", "ProductService",
                function ($q, $translate, ProductService) {
                    return $q.all({
                        products: ProductService.query({language: $translate.use()}).$promise
                    });
                }]
            }
            ,controller: 'ProductListCtrl'
        })
        .otherwise({
                //redirectTo: '/whatever'
        });
    }
)      
.controller("ProductListCtrl", ['$scope','$http', '$q', '$location', '$translate' ,'$b', 'ProductService', ProductListCtrl]);

function ProductListCtrl($scope, $http, $q, $location, $translate, $b, ProductService)
{
    angular.extend($scope, $b);
    
    $scope.getListProduct = function() {
        var promise = ProductService.query({language: $translate.use()}).$promise;
        promise.then(function(data) {$scope.products = data;});
    };
    
    $scope.editProduct = function(product_code) {
        $location.path('product/'+product_code);
    };
    
    $scope.deleteProduct = function(product) {
        $translate('deleteMessage').then(
            function (data) {
                if(confirm(data)) {
                    $scope.product = {};
                    $scope.product.id = product.product_code,
                    ProductService.delete($scope.product, 
                        function(data) {
                            $translate('successMessage').then( function (data) {
                                    alert(data); 
                                    $scope.getListProduct();
                                }                   
                            );

                        },
                        function(data) {
                            $translate('errorMessage').then( function (data) {
                                    alert(data);
                                }                   
                            );
                        }
                    );
                }
            }
        );
    }
}
;