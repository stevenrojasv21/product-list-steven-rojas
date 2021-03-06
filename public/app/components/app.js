// Cambios de URL para direccionar las peticiones correctamente.
var root = document.location.href.split('/app/#!/')[0]; //replace("/app/#!/","");

var product = angular.module('Product', ['ngRoute', "ngResource", 'pascalprecht.translate', 'ngCookies'])
.constant("ROOT", root+"/api/")
.constant("APP_NAME", "Product App");

product.config(['$translateProvider', function ($translateProvider) {
  $translateProvider.translations('en', translationsEN);
  $translateProvider.translations('fr', translationsFR);
 
  $translateProvider.preferredLanguage('en');
  $translateProvider.fallbackLanguage('en');
  $translateProvider.useCookieStorage();
}]);