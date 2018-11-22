'use strict';

var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var args = require('yargs').argv;
// var request = require('request');
var change = require('gulp-change');
var rename = require("gulp-rename");

var paths = {
  input: {
    js: './source/js',
    sass: './source/style/sass',
    image: './source/image',
    macrosFile: './assets/css/macros.css'
  },
  output: {
    js: './assets/js',
    css: './assets/css',
    image: './assets/img',
    macrosFolder: '../../../include/tuning',
    macrosFileName: 'color.macros'
  }
};

gulp.task('default', ['sass', 'sass:watch', 'compilejs', 'compilejs:watch', 'compileimage', 'compileimage:watch', 'compilemacros', 'compilemacros:watch']);

gulp.task('sass', function() {

  var stream = gulp.src(paths.input.sass + '/**/*.scss');

  if (args.production) {

    gulp.src(paths.input.sass + '/**/*.scss')
      .pipe(sass().on('error', sass.logError))
      .pipe(gulp.dest(paths.output.css));

  } else {

    gulp.src(paths.input.sass + '/**/*.scss')
      .pipe(sourcemaps.init())
      .pipe(sass().on('error', sass.logError))
      .pipe(sourcemaps.write('./'))
      .pipe(gulp.dest(paths.output.css));
    
  }
});

gulp.task('sass:watch', function() {
  gulp.watch(paths.input.sass + '/**/*.scss', ['sass']);
});

function compileImageFiles(content) {
  return content;
}

gulp.task('compileimage', function() {
  return gulp.src(paths.input.image + '/**/*')
    .pipe(change(compileImageFiles))
    .pipe(gulp.dest(paths.output.image))
});

gulp.task('compileimage:watch', function() {
  gulp.watch(paths.input.image + '/**/*', ['compileimage']);
});

function compileJsFiles(content) {
  return content;
}

gulp.task('compilejs', function() {
  return gulp.src(paths.input.js + '/**/*.js')
    .pipe(change(compileJsFiles))
    .pipe(gulp.dest(paths.output.js))
});

gulp.task('compilejs:watch', function() {
  gulp.watch(paths.input.js + '/**/*.js', ['compilejs']);
});

function compileColorMacros(content) {
    var regexpMacros = /GOPRO_QQ(.*?)GOPRO_ZZ/ig,
        regexpColors = /color: (.*?);/ig,
        result,
        tmpVal,
        arMacroses = [],
        arColors = [],
        posStart = content.search(/label_description_start/igm),
        posFinish = content.search(/label_description_finish/igm),
        tmpContent = content.substring(posStart, posFinish),
        tmp;

    while (result = regexpMacros.exec(tmpContent)) {
      tmpVal = result[1];
      if (!arMacroses.includes(tmpVal)) {
        arMacroses.push(tmpVal);
      }
    }

    while (result = regexpColors.exec(tmpContent)) {
      tmpVal = result[1];
      if (!arColors.includes(tmpVal)) {
        arColors.push(tmpVal);
      }
    }

    if (arMacroses.length > 0 && arColors.length > 0 && arMacroses.length == arColors.length) {
      arColors.forEach(function(item, i, arr) {
        tmp = new RegExp(item, 'gi');
        content = content.replace(tmp, '#'+arMacroses[i]);
      });
    }

    return content;
}

gulp.task('compilemacros', function() {
  return gulp.src(paths.input.macrosFile)
    .pipe(change(compileColorMacros))
    .pipe(rename(paths.output.macrosFileName))
    .pipe(gulp.dest(paths.output.macrosFolder))
});

gulp.task('compilemacros:watch', function() {
  gulp.watch(paths.input.macrosFile, ['compilemacros']);
});
