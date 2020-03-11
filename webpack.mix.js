const path = require('path');
const glob = require('glob-all');
const mix = require('laravel-mix');
const PurgecssPlugin = require('purgecss-webpack-plugin');


mix
    .js('resources/assets/js/vue/entry-client.js', 'public/js/vue')
    .js('resources/assets/js/vue/entry-server.js', 'public/js/vue')
    // .react('resources/assets/js/react/entry-client.js', 'public/js/react')
    // .react('resources/assets/js/react/entry-server.js', 'public/js/react')

    .js('resources/js/vendor/bootstrap.js', 'public/js/vendor/')
	.js([
		'resources/js/vendor/before.js',
	], 'public/js/vendor/before.js')

    .postCss('resources/assets/css/app.css', 'public/css/app.css')

    .webpackConfig(() => {
        const config = {};

        config.resolve = {
            // alias: {
            //     vue$: 'vue/dist/vue.runtime.common.js',
            // },
            alias: {
                vue$: 'vue/dist/vue.runtime.js',
              }
        };

        if (mix.inProduction()) {
            config.plugins = [
                new PurgecssPlugin({
                    paths: glob.sync([
                        path.join(__dirname, 'app/**/*.php'),
                        path.join(__dirname, 'resources/views/**/*.blade.php'),
                        path.join(__dirname, 'resources/assets/js/**/*.vue'),
                        path.join(__dirname, 'resources/assets/js/**/*.js'),
                    ]),
                    extractors: [
                        {
                            extractor: class {
                                static extract(content) {
                                    return content.match(/[A-z0-9-:\/]+/g) || [];
                                }
                            },
                            extensions: ['html', 'js', 'php', 'vue'],
                        },
                    ],
                }),
                
               
            ];
        }

        return config;
    });
