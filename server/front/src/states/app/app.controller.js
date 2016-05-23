var socket = require('socket.io-client')('http://localhost:3000');

/** @ngInject */
module.exports = function ($scope){

    var vm = this;

    vm.displayMore = [];
    vm.queries = [];
    vm.logs = [];

    socket.on('laravel-debugger:new-query', function(msg){
        console.log(msg);
        $scope.$apply(function(){
            vm.queries.unshift(msg);
        });
    });

    socket.on('laravel-debugger:new-log', function(msg){
        console.log(msg);
        $scope.$apply(function(){
            vm.logs.unshift(msg)
        });
    });

    vm.getLogAlertClass = function (level) {

        var classes = {
            error: 'alert-danger',
            info: 'alert-info',
            debug: 'alert-info',
            warning: 'alert-warning'
        };

        return classes[level];
    };

    vm.getLogLabelClass = function (level) {

        var classes = {
            error: 'label-danger',
            info: 'label-info',
            debug: 'label-primary',
            warning: 'label-warning'
        };

        return classes[level];
    };
};