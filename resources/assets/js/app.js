var app = angular.module('App',
    ['ngRoute', 'angular-oauth2', 'app.controllers', 'app.services', 'app.filters']
);

angular.module('app.controllers', ['angular-oauth2', 'ngMessages']);
angular.module('app.filters', []);
angular.module('app.services', ['ngResource']);

app.provider('appConfig', ['$httpParamSerializerProvider', function ($httpParamSerializerProvider) {
    var config = {
        baseUrl: 'http://localhost:8000',
        project: {
            status: [
                {value: 0, label: 'Não iniciado'},
                {value: 1, label: 'Iniciado'},
                {value: 2, label: 'Concluído'}
            ]
        },
        utils: {
            transformResponse: function (data, headers) {
                if (headers()['content-type'] == 'application/json' ||
                    headers()['content-type'] == 'text/json') {
                    var dataJSON = JSON.parse(data);
                    if (dataJSON.hasOwnProperty('data')) {
                        dataJSON = dataJSON.data;
                    }
                    return dataJSON;
                }
                return data;
            },
            transformRequest: function (data) {
                if (angular.isObject(data)) {
                    return $httpParamSerializerProvider.$get()(data);
                }
                return data;
            }
        }
    };

    return {
        config: config,
        $get: function () {
            return config;
        }
    }
}]);

app.config(['$routeProvider', '$httpProvider', 'OAuthProvider', 'OAuthTokenProvider', 'appConfigProvider',
    function ($routeProvider, $httpProvider, OAuthProvider, OAuthTokenProvider, appConfigProvider) {
        $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
        $httpProvider.defaults.headers.put['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
        $httpProvider.defaults.transformResponse = appConfigProvider.config.utils.transformResponse;
        $httpProvider.defaults.transformRequest = appConfigProvider.config.utils.transformRequest;

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
            })
            /* ##### Project */
            .when('/projects', {
                templateUrl: 'build/views/project/list.html',
                controller: 'ProjectListController'
            })
            .when('/projects/new', {
                templateUrl: 'build/views/project/new.html',
                controller: 'ProjectNewController'
            })
            .when('/projects/:id/edit', {
                templateUrl: 'build/views/project/edit.html',
                controller: 'ProjectEditController'
            })
            .when('/projects/:id/remove', {
                templateUrl: 'build/views/project/remove.html',
                controller: 'ProjectRemoveController'
            })
            .when('/projects/:id', {
                templateUrl: 'build/views/project/view.html',
                controller: 'ProjectViewController'
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