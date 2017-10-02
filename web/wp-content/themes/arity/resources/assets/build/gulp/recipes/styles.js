var merge        = require('merge-stream'),
    fs           = require('fs'),
    path         = require('path'),
    autoprefixer = require('gulp-autoprefixer'),
    concat       = require('gulp-concat'),
    cssnano      = require('gulp-cssnano'),
    gulpif       = require('gulp-if'),
    notify       = require('gulp-notify'),
    sass         = require('gulp-sass'),
    sassGlob     = require('gulp-sass-glob'),
    sourcemaps   = require('gulp-sourcemaps'),
    rename       = require('gulp-rename'),
    util         = require('gulp-util');

// Compile SCSS to CSS
module.exports = function (gulp, production, browserSync) {
  'use strict';
  var config = gulp.config,
  paths = config.paths;
  gulp.task(
    'styles',
    'Compile and concat SCSS to CSS with sourcemaps and autoprefixer. Also runs styles:lint.',
    ['styles:lint'],
    function() {
      var merged = merge(),
          assets = config['assets'];

        assets.forEach(function(outputs) {

        outputs = Object.keys(outputs);
        outputs.forEach(function(output) {

          // Define files and add scripts path
          var inputs = assets[0][output].filter(
            function(file) {
              if(file.indexOf('.scss') === -1) {
                return false;
              }
              return true;
            }
          ).map(function(file) { return path.resolve(paths.assets + '/' + file); });

          // Check files exist
          inputs.forEach(function (file) {
            try {
              fs.accessSync(file);
            } catch (e) {
              util.log(util.colors.red('Warning! ' + file + ' does not exist.'));
            }
          });

          merged.add(
            gulp.src(inputs)
              .pipe(sourcemaps.init({loadMaps: true}))
              .pipe(sassGlob())
              .pipe(sass({outputStyle: 'nested'}))
              .pipe(autoprefixer({browsers: ['last 2 versions']}))
              .pipe(concat(output))
              .pipe(gulpif(production, cssnano({safe: true})))
              .pipe(rename({
                extname: '.css'
              }))
          );
        });
      });

      return merged
        .pipe(sourcemaps.write('.', {sourceRoot: paths.assets + '/styles'}))
        .pipe(gulp.dest(paths.dist + '/css'))
        .pipe(gulpif(!production, notify({
          "subtitle": "Task Complete",
          "message": "Styles task complete",
          "onLast": true
        })))
        .pipe(browserSync.stream({match: '**/*.css'}));
    }, {
      options: {
        'production': 'Minified without sourcemaps.'
      }
    }
  );
};
