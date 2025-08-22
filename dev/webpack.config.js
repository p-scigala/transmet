require('dotenv').config({ path: './.env' });

const path = require('path');
const FileManagerPlugin = require('filemanager-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

module.exports = {
  entry: './src/main.js',
  output: {
    filename: '[name].js',
    path: path.resolve(__dirname, 'dist'),
  },
  cache: {
    type: 'filesystem',
  },
  watchOptions: {
    ignored: /node_modules/,
  },

  plugins: [
    new FileManagerPlugin({
      events: {
        onEnd: {
          copy: [
            {
              source: './dist/',
              destination: '../assets/js',
              options: { overwrite: true },
            },
          ],
        },
      },
    }),

    new BrowserSyncPlugin(
      {
        host: process.env.HOST,
        port: process.env.PORT,
        proxy: process.env.SITE_TO_WATCH, // 👈 points to WP
        files: [
          '../**/*.php',
          '../assets/css/*.css',
          '../**/*.js',
        ],
        open: true, // auto-open browser
        notify: false, // remove BS notification popup
      },
      { reload: true }
    ),
  ],

  module: {
    rules: [
      {
        test: /\.(js|jsx)$/i,
        exclude: /node_modules/,
        loader: 'babel-loader',
        options: {
          presets: ['@babel/preset-env'],
        },
      },
    ],
  },

  externals: {
    jquery: 'jQuery',
  },
};