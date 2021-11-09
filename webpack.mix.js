const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

 mix.sass('node_modules/bootstrap-icons/font/bootstrap-icons.scss', 'public/css/bootstrap/')
 .version()
 .sourceMaps();


mix
    .js('resources/js/editar.js', 'public/js/editar.js')
    .version();

mix
    .js('resources/js/home.js', 'public/js/home.js');

mix
    .js('resources/js/upload.js', 'public/js/upload.js')
    .version();

mix
    .js('resources/js/usuariosprincipal.js', 'public/js/usuariosprincipal.js')
    .version();

mix
    .js('node_modules/bootstrap/dist/js/bootstrap.bundle.js', 'public/js/bootstrap/bootstrap.js')
    .version()
    .sourceMaps();


mix
    .styles([
        'node_modules/bootstrap/dist/css/bootstrap.css',
        'resources/css/styles.css'
        ], 'public/css/bootstrap/bootstrap.css')
        .version()
        .sourceMaps();


