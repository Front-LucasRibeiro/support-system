const mix = require('laravel-mix');

mix
  .sass('resources/css/app.scss', 'public/css')
  .options({
    processCssUrls: false
  });

if (mix.inProduction()) {
  mix.version();
}


