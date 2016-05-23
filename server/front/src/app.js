var angular = require('angular');

//angular dependences
require('angular-ui-router');
require('angular-ui-bootstrap');
require('angular-highlightjs');
require('angular-animate');

// styles
require('bootstrap/less/bootstrap.less');
require('./app.less');
require('highlight.js/styles/default.css');

var app = angular.module('myApp', [

    /*
     * Dependences
     */
    'ui.router', // state routing
    'ui.bootstrap', // no jquery bootstrap components
    'hljs',
    'ngAnimate',

    /*
     * App modules
     */
    // States (main state requires child states and so on)
    require('./states/main.module.js').name
]);

//global config
require('./config').load(app);