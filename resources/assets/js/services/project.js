angular.module('app.services')
    .service('Project', ['$resource', '$filter', '$httpParamSerializer', 'appConfig',
        function ($resource, $filter, $httpParamSerializer, appConfig) {
            function transformData(data) {
                if (angular.isObject(data) && data.hasOwnProperty('due_date')) {
                    var newData = angular.copy(data);
                    newData.due_date = $filter('date')(data.due_date, 'yyyy-MM-dd');
                    return appConfig.utils.transformRequest(newData);
                }
                return data;
            }

            return $resource(appConfig.baseUrl + '/project/:id', {id: '@id'}, {
                save: {
                    method: 'POST',
                    transformRequest: transformData
                },
                get: {
                    method: 'GET',
                    transformResponse: function (data, headers) {
                        var dataTrans = appConfig.utils.transformResponse(data, headers);
                        if (angular.isObject(dataTrans) && dataTrans.hasOwnProperty('due_date')) {
                            var arrayDate = dataTrans.due_date.split('-'),
                                month = parseInt(arrayDate[1]) - 1;
                            dataTrans.due_date = new Date(arrayDate[0], month, arrayDate[2]);
                        }
                        return dataTrans;
                    }
                },
                update: {
                    method: 'PUT',
                    transformRequest: transformData
                }
            });
        }]);