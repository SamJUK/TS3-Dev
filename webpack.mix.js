let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js');
mix.sass('resources/assets/sass/app.scss', 'public/css');
mix.less('resources/assets/less/app.less', 'public/css/ts3dev.css');

mix.combine([
    'node_modules/moment/min/moment.min.js',
    'resources/assets/js/vendor/bootstrap-datetimepicker.min.js'
], 'public/js/vendor.js');

mix.combine([
    'resources/assets/js/alerts.js'
], 'public/js/ts3dev.js');

mix.combine([
    'resources/assets/css/bootstrap-datetimepicker.min.css'
], 'public/css/vendor.css');
