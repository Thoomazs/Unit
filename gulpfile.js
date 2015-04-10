var elixir = require( 'laravel-elixir' );

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */
var assets = 'resources/assets/';
var bower = 'resources/assets/vendor/';
var paths = {
    'jquery'      : bower + 'jquery/dist/',
    'bootstrap'   : bower + 'bootstrap/dist/',
    'fontawesome' : bower + 'fontawesome/',
    'tinymce'     : bower + 'tinymce/'
}

elixir( function( mix ) {
    mix.sass( ["app.scss", "admin.scss"], 'public/css/' )
        .copy( paths.fontawesome + 'fonts/**', 'public/fonts' )
        .styles( [
            paths.bootstrap + "css/bootstrap.min.css",
            paths.fontawesome + "css/font-awesome.min.css"
        ], 'public/css/vendor.css', './' )
        .scripts( [
            paths.jquery + "jquery.min.js",
            paths.bootstrap + "js/bootstrap.min.js",
            assets + "js/jquery.yaar.min.js",
            paths.tinymce + "jquery.tinymce.min.js"
        ], 'public/js/vendor.js', './' )
        .copy( paths.tinymce, 'public/tinymce' )
        .scripts( [
            assets + "js/helpers.js",
            assets + "js/form.js",
        ], 'public/js/app.js', './' )
        .scripts( [
            assets + "js/helpers.js",
            assets + "js/form.js",
        ], 'public/js/admin.js', './' )
        .version( ["css/app.css", "js/app.js", "css/admin.css", "js/admin.js"] )
} );