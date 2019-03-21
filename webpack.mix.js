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

mix.styles([
        'resources/assets/css/bootstrap.css',
        'resources/assets/css/animate.css',
        'resources/assets/css/jconfirm.css',
        'resources/assets/css/style.css'
        ], 'public/styles.css')
        .scripts([
            'resources/assets/js/jquery.js',
            'resources/assets/js/jquery.validate.js',
            'resources/assets/js/wow.js',
            'resources/assets/js/bootstrap.js',
            'resources/assets/js/bootstrap-bundle.js',
            'resources/assets/js/waypoints.js',
            'resources/assets/js/jconfirm.js',
            'resources/assets/js/script.js'
        ], 'public/scripts.js');