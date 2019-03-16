const path = require('path');
settings = require('./settings');

const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');
const OptimizeCssAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

module.exports = {
  entry: ['@babel/polyfill', settings.themeLocation + "src/js/scripts.js"],
  output: {
    path: path.resolve(__dirname, settings.themeLocation),
    filename: 'dist/scripts-bundled.js'
  },
  mode: 'development',
  devtool: 'source-map',
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node-modules/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/env']
          }
        }
      },
      {
        test: /\.s?css$/,
        use: [MiniCssExtractPlugin.loader, 'css-loader', 'postcss-loader', 'sass-loader']
      }
    ]
  },
  plugins: [
    new MiniCssExtractPlugin({ filename: '../' + settings.themeName + '/dist/styles.css' }),
    new BrowserSyncPlugin({
      files: '**/*.php',
      injectChanges: true,
      proxy: settings.urlFlywheel
    })
  ],
  optimization: {
    minimizer: [
      new UglifyJsPlugin(),
      new OptimizeCssAssetsPlugin()
    ]
  }
};
