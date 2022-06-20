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
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps()
    .scripts("node_modules/jquery/dist/jquery.js", "public/js/jquery.js")
    .scripts("node_modules/bootstrap/dist/js/bootstrap.bundle.js", "public/js/bootstrap.js")
    .scripts("node_modules/@fortawesome/fontawesome-free/js/all.js", "public/js/fontawesome.js")
    .css("node_modules/bootstrap/dist/css/bootstrap.css", "public/css/bootstrap.css")
    .css("node_modules/bootstrap-icons/font/bootstrap-icons.css", "public/css/bootstrap-icons.css")
    .css("node_modules/@fortawesome/fontawesome-free/css/all.css", "public/css/fontawesome.css");
