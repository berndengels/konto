const mix = require('laravel-mix');
mix.autoload({
		'jquery': ['jQuery', '$'],
	})
    .setPublicPath('public')
    .js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps()
	.webpackConfig(require('./webpack.config'))
	.vue({version: 3})
;
