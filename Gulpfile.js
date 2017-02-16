var gulp 	= require('gulp');
var sass 	= require('gulp-sass');
var prefix 	= require('gulp-autoprefixer');
var sourcemaps 	= require('gulp-sourcemaps');
var cssmin = require('gulp-cssmin');
var rename = require('gulp-rename');

gulp.task('styles', function() {
	gulp.src(['sass/**/*.sass', 'sass/**/*.scss'])
	.pipe(sourcemaps.init())
	.pipe(sass().on('error', sass.logError))
	.pipe(prefix({
        browsers: ['last 2 versions', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'],
        cascade: false
    }))
  //.pipe(cssmin())
  // .pipe(rename({suffix: '.min'}))
	.pipe(sourcemaps.write('.'))
	.pipe(gulp.dest('./css/'))
});


gulp.task('default', ['styles'], function() {
	gulp.watch(['sass/**/*.sass', 'sass/**/*.scss'],['styles']);
});
