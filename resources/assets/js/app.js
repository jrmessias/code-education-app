var app = angular.module('App', ['ngRoute', 'angular-oauth2', 'app.controllers', 'app.services']);

angular.module('app.controllers', ['angular-oauth2', 'ngMessages']);
angular.module('app.services', ['ngResource']);

app.provider('appConfig', function () {
    var config = {
        baseUrl: 'http://localhost:8000'
    };

    return {
        config: config,
        $get: function () {
            return config;
        }
    }
});

app.config(['$routeProvider', 'OAuthProvider', 'OAuthTokenProvider', 'appConfigProvider',
    function ($routeProvider, OAuthProvider, OAuthTokenProvider, appConfigProvider) {
        $routeProvider
            .when('/login', {
                templateUrl: 'build/views/login.html',
                controller: 'LoginController'
            })
            .when('/home', {
                templateUrl: 'build/views/home.html',
                controller: 'HomeController'
            })
            /* ##### Clients */
            .when('/clients', {
                templateUrl: 'build/views/client/list.html',
                controller: 'ClientListController'
            })
            .when('/clients/new', {
                templateUrl: 'build/views/client/new.html',
                controller: 'ClientNewController'
            })
            .when('/clients/:id/edit', {
                templateUrl: 'build/views/client/edit.html',
                controller: 'ClientEditController'
            })
            .when('/clients/:id/remove', {
                templateUrl: 'build/views/client/remove.html',
                controller: 'ClientRemoveController'
            })
            /* ##### Project Notes */
            /* ##### Clients */
            .when('/project/:id/notes', {
                templateUrl: 'build/views/projectNote/list.html',
                controller: 'ProjectNoteListController'
            })
            .when('/project/:id/notes/new', {
                templateUrl: 'build/views/projectNote/new.html',
                controller: 'ProjectNoteNewController'
            })
            .when('/project/:id/notes/:idNote/edit', {
                templateUrl: 'build/views/projectNote/edit.html',
                controller: 'ProjectNoteEditController'
            })
            .when('/project/:id/notes/:idNote/remove', {
                templateUrl: 'build/views/projectNote/remove.html',
                controller: 'ProjectNoteRemoveController'
            })
            .when('/project/:id/notes/:idNote', {
                templateUrl: 'build/views/projectNote/view.html',
                controller: 'ProjectNoteViewController'
            });

        OAuthProvider.configure({
            baseUrl: appConfigProvider.config.baseUrl,
            grantPath: 'oauth/access_token',
            clientId: '06742e6b9c7bffb59ed8f4ae4940df4f',
            clientSecret: 'secret'
        });

        OAuthTokenProvider.configure({
            name: 'token',
            options: {
                secure: false
            }
        });

    }]);

app.run(['$rootScope', '$window', 'OAuth', function ($rootScope, $window, OAuth) {
    $rootScope.$on('oauth:error', function (event, rejection) {
        // Ignore `invalid_grant` error - should be catched on `LoginController`.
        if ('invalid_grant' === rejection.data.error) {
            return;
        }

        // Refresh token when a `invalid_token` error occurs.
        if ('invalid_token' === rejection.data.error) {
            return OAuth.getRefreshToken();
        }

        // Redirect to `/login` with the `error_reason`.
        return $window.location.href = '#/login?error_reason=' + rejection.data.error;
    })
}]);