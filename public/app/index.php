<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html ng-app="Product">
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="bower_components/bootstrap/dist/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="styles/myStyle.css"/>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#!/">Product's App</a>
                </div>               
            </div>
        </nav>
        <div id="main">
            <div ng-view>                
            </div>
        </div>
    </body>
    <script src="bower_components/angular/angular.min.js"></script>
    <script src="bower_components/angular-route/angular-route.min.js"></script>
    <script src="bower_components/angular-resource/angular-resource.min.js"></script>
    <script src="bower_components/angular-ui/build/angular-ui.min.js"></script>
    <script src="bower_components/angular-ui-router/release/angular-ui-router.min.js"></script>
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="components/app.js"></script>
    <script src="components/model.js"></script>
    <script src="components/chooseLanguage/chooseLanguage.js"></script>
    <!--<script src="../js/app.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/app.css"/>-->
</html>