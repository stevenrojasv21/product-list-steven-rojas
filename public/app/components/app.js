// Cambios de URL para direccionar las peticiones correctamente.
var root = document.location.href.replace("/app/#!/","");

var product = angular.module('Product', ['ngRoute', "ngResource", 'pascalprecht.translate', 'ngCookies'])
.constant("ROOT", root+"/api/")
.constant("APP_NAME", "Product App");

product.config(['$translateProvider', function ($translateProvider) {
  $translateProvider.translations('en', translationsEN);
 
  $translateProvider.translations('de', translationsDE);
 
  $translateProvider.preferredLanguage('en');
  $translateProvider.fallbackLanguage('en');
  $translateProvider.useCookieStorage();
}]);