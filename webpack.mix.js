const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

// Bootstrap select
mix.copy('vendor/snapappointments/bootstrap-select/dist/css/bootstrap-select.min.css', 'public/css/bootstrap-select');

mix.copy('vendor/snapappointments/bootstrap-select/dist/js/bootstrap-select.min.js', 'public/js/bootstrap-select');

// Custom CSS
mix.sass('resources/sass/custom.scss', 'public/css');
mix.sass('resources/sass/welcome.scss', 'public/css');
