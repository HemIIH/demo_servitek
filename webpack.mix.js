let webpack = require('webpack');
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

mix.webpackConfig({
    plugins: [
        new webpack.ContextReplacementPlugin(/moment[\\/]locale$/, /^\.\/(de)$/)
    ]
});


mix.js('resources/assets/js/app.js', 'public/js')
    .copy('node_modules/admin-lte/dist/js/app.min.js', 'public/js/adminlte.js')
    .copy('node_modules/admin-lte/bootstrap/js/bootstrap.min.js', 'public/js/bootstrap.js')
    .copy('node_modules/bootstrap-datepicker/js/locales/bootstrap-datepicker.de.js', 'public/js/bootstrap-datepicker.de.js')
    .combine([
        'public/js/app.js',
        'public/js/bootstrap-datepicker.de.js',
        'public/js/adminlte.js'
    ], 'public/js/all.js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .less('node_modules/admin-lte/build/less/AdminLTE.less', 'public/css/')
    .less('node_modules/admin-lte/build/less/skins/skin-purple.less', 'public/css/')
    .copy('node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css', 'public/css/datepicker.css')
    .copy('node_modules/sweetalert2/dist/sweetalert2.min.css', 'public/css/sweetalert.css')
    .combine([
        'public/css/app.css',
        'public/css/AdminLTE.css',
        'public/css/skin-purple.css',
        'public/css/datepicker.css',
        'public/css/sweetalert.css'
    ], 'public/css/all.css');

mix.js('resources/assets/js/client.js', 'public/js')
    .copy('node_modules/admin-lte/dist/js/app.min.js', 'public/js/adminlte.js')
    .copy('node_modules/admin-lte/bootstrap/js/bootstrap.min.js', 'public/js/bootstrap.js')
    .copy('node_modules/bootstrap-datepicker/js/locales/bootstrap-datepicker.de.js', 'public/js/bootstrap-datepicker.de.js')
    .combine([
        'public/js/client.js',
        'public/js/bootstrap-datepicker.de.js',
        'public/js/adminlte.js'
    ], 'public/js/client.js');

mix.js('resources/assets/js/employee.js', 'public/js')
    .copy('node_modules/admin-lte/dist/js/app.min.js', 'public/js/adminlte.js')
    .copy('node_modules/admin-lte/bootstrap/js/bootstrap.min.js', 'public/js/bootstrap.js')
    .copy('node_modules/bootstrap-datepicker/js/locales/bootstrap-datepicker.de.js', 'public/js/bootstrap-datepicker.de.js')
    .combine([
        'public/js/employee.js',
        'public/js/bootstrap-datepicker.de.js',
        'public/js/adminlte.js'
    ], 'public/js/employee.js');

mix.options({ processCssUrls: false });
