var gulp = require('gulp');
var dest = require('gulp-dest');
var rename = require('gulp-rename');
var less = require('gulp-less');
var path = require('path');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
var merge = require('merge-stream');
var spritesmith = require('gulp.spritesmith');
var sass = require('gulp-sass');
var stripCssComments = require('gulp-strip-css-comments');
var cssbeautify = require('gulp-cssbeautify');
var watch = require('gulp-watch');
var argv = require('yargs').argv;
var insert = require('gulp-insert');

gulp.task('default', function () {
  // Code for the default task
});

// Watch for changes in scss files and recompiles them.
gulp.task('watch', function () {
	// TODO: ensure that argv.site set.
	var site = argv.site;
  gulp.watch('./custom/' + site + '/sass/site/**/*.scss', ['sass']);
});

/**
 * Add more site names to preprocess them too.
 *
 * @type {string[]}
 */

gulp.task('sass', function () {
	// TODO: ensure that argv.site set.
	var site = argv.site;
	return gulp.src(['./custom/' + site + '/sass/style.scss'])
		.pipe(insert.transform(function(contents, file) {
			return '$sitename: ' + site + ';' + contents;
		}))
		.pipe(sourcemaps.init())
		.pipe(sass().on('error', sass.logError))
		.pipe(autoprefixer({
			browsers: ['last 2 versions']
		}))
		.pipe(stripCssComments())
		.pipe(cssbeautify())
		.pipe(rename('style-' + site + '.css'))
		.pipe(sourcemaps.write())
		.pipe(gulp.dest('./css'));
});
