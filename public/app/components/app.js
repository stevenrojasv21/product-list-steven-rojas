// Cambios de URL para direccionar las peticiones correctamente.
var root = document.location.href.replace("/app/#!/","");

var product = angular.module('Product', ['ngRoute', "ngResource", "ui.router"])
.constant("ROOT", root+"/api/")
.constant("APP_NAME", "Product App");