var elixir = require('laravel-elixir');
elixir.config.sourcemaps = false;

elixir(function (mix) {
    mix.combine([
        'resources/assets/bower_components/jquery/dist/jquery.min.js',
        'resources/assets/bower_components/angular/angular.min.js',
        'resources/assets/bower_components/materialize/dist/js/materialize.min.js',
        'resources/assets/bower_components/angular-ui-router/release/angular-ui-router.min.js',
        'resources/assets/bower_components/angular-materialize/src/angular-materialize.js',
        'resources/assets/bower_components/angular-simple-logger/dist/angular-simple-logger.min.js',
        'resources/assets/bower_components/lodash/dist/lodash.js',
        'resources/assets/bower_components/angular-google-maps/dist/angular-google-maps.js'
    ], 'public/js/vendor.js');

    mix.combine([
        'resources/assets/bower_components/materialize/dist/css/materialize.min.css'
    ], 'public/css/vendor.css');

    mix.scripts(['resources/assets/js/**/*.js'], 'public/js/app.js');

    mix.sass('main.scss');

    mix.copy('resources/assets/bower_components/materialize/fonts/roboto', 'public/fonts/roboto');
    mix.copy('resources/assets/fonts/materialicons', 'public/fonts/materialicons');
});