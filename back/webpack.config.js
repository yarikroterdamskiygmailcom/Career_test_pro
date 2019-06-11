var path = require('path')
var webpack = require('webpack')
var HtmlWebpackPlugin = require('html-webpack-plugin')
// var PrerenderSpaPlugin = require('prerender-spa-plugin')
const UglifyJsPlugin = require('uglifyjs-webpack-plugin')

module.exports = {
    entry: {
        vue: ['./resources/js/app.js'],
    },
    output: {
        path: path.resolve(__dirname, './public/js'),
        publicPath: '/public/js',
        filename: 'app'
    },
    module: {
        rules: [
            {
                test: /\.less$/,
                use: [
                    'vue-style-loader',
                    'less-loader'
                ],
            },
            {
                test: /\.css$/,
                use: [
                    'vue-style-loader',
                    'css-loader'
                ],
            },
            {
                test: /\.scss$/,
                use: [
                    'vue-style-loader',
                    'css-loader',
                    'sass-loader'
                ],
            },
            {
                test: /\.sass$/,
                use: [
                    'vue-style-loader',
                    'css-loader',
                    'sass-loader?indentedSyntax'
                ],
            },
            {
                test: /\.vue$/,
                loader: 'vue-loader',
                options: {
                    loaders: {
                        // Since sass-loader (weirdly) has SCSS as its default parse mode, we map
                        // the "scss" and "sass" values for the lang attribute to the right configs here.
                        // other preprocessors should work out of the box, no loader config like this necessary.
                        'scss': [
                            'vue-style-loader',
                            'css-loader',
                            'sass-loader'
                        ],
                        'less': [
                            'vue-style-loader',
                            'css-loader',
                            'less-loader'

                        ],
                        'sass': [
                            'vue-style-loader',
                            'css-loader',
                            'sass-loader?indentedSyntax'
                        ]
                    }
                    // other vue-loader options go here
                }
            },
            {
                test: /\.js$/,
                loader: 'babel-loader',
                exclude: /node_modules/
            },
            {
                test: /\.(png|jpg|gif|svg)$/,
                loader: 'file-loader',
                options: {
                    name: '[name].[ext]?[hash]'
                }
            },
            {
                test: /\.(png|woff|woff2|eot|ttf|svg)$/,
                loader: 'url-loader',
                options: {
                    limit: 8192
                }
            }
        ]
    },
    resolve: {
        alias: {
            'vue$': 'vue/dist/vue.esm.js'
        },
        extensions: ['*', '.js', '.vue', '.json']
    },
    devServer: {
        historyApiFallback: true,
        noInfo: true,
        overlay: true
    },
    performance: {
        hints: false
    },
    devtool: '#eval-source-map'
}

if (process.env.NODE_ENV === 'production') {
    module.exports.devtool = '#source-map'
    // http://vue-loader.vuejs.org/en/workflow/production.html
    module.exports.plugins = (module.exports.plugins || []).concat([
        new webpack.DefinePlugin({
            'process.env': {
                NODE_ENV: '"production"'
            }
        }),

        // new HtmlWebpackPlugin({
        //   template: 'index.html',
        //   filename: path.resolve(__dirname, 'dist/index.html')
        // }),

        // new PrerenderSpaPlugin(
        //   path.resolve(__dirname, './dist/'),
        //   ['/', '/login', '/users', '/news'],
        //   {
        //     postProcessHtml: function(context) {
        //       var titles = {
        //         '/': 'My home page',
        //         '/login': 'Login page',
        //         '/users': 'User search',
        //         '/news': 'News',
        //       }
        //       return context.html.replace(
        //         /<title>[^<]*<\/title>/i,
        //         '<title>' + titles[context.route] + '</title>'
        //       )
        //     }
        //   }
        // ),
        new UglifyJsPlugin({
            uglifyOptions: {
                ecma: 8
            }
        }),

        // new webpack.optimize.UglifyJsPlugin({
        //   sourceMap: true,
        //   compress: {
        //     warnings: false
        //   }
        // }),
        new webpack.LoaderOptionsPlugin({
            minimize: true
        })
    ])
}
