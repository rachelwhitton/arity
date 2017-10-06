var util      = require('gulp-util');

module.exports = function (gulp, browserSync) {
  'use strict';

  var config = gulp.config,
    paths  = config.paths,
    settings = config.settings;

  gulp.task(
    'watch',
    'Watch SCSS, JS, and SVG files. Uses browserSync via proxy.',
    function() {
      browserSync.init(settings.browserSync);

      util.log('Watching source files for changes... Press ' + util.colors.cyan('CTRL + C') + ' to stop.');

      gulp.watch(paths.assets + '/styles/**/*.scss', ['styles']).on('change', function(file) {
        util.log('SCSS file changed: ' + file.path + '');
      });

      gulp.watch(paths.assets + '/svgs/**/*.svg', ['svgs']).on('change', function(file) {
        util.log('SVG file changed: ' + file.path + '');
      });

      gulp.watch(paths.assets + '/images/*.*', ['images']).on('change', function(file) {
        util.log('Image file changed: ' + file.path + '');
      });

      gulp.watch(paths.assets + '/scripts/**/*.js', ['scripts']).on('change', function(file) {
        util.log('JS file changed: ' + file.path + '');
      });
    }
  );
};
