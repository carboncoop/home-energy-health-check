
const { mix } = require('laravel-mix');

mix
    .js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.sass', 'public/css', {
        indentedSyntax: true
    })
    .options({ processCssUrls: false });


if (mix.config.inProduction) {
    mix.version();
}
