const { mix } = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');
mix.js('resources/assets/js/bootstrap.js', 'public/js');
mix.js('resources/assets/js/chair-click.js', 'public/js');
mix.js('resources/assets/js/chair-move.js', 'public/js');
mix.js('resources/assets/js/change-image.js', 'public/js');
mix.js('resources/assets/js/jquery.min.js', 'public/js');
if (mix.config.inProduction) {
    mix.version();
}
