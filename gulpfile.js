var gulp = require('gulp');
var watch = require('gulp-watch');
var cleanCSS = require('gulp-clean-css');
var uglify = require('gulp-uglify-es').default;
var rename = require('gulp-rename');
var concat = require('gulp-concat');
var merge = require('merge-stream');
var scss = require('gulp-sass');

gulp.task('default', ['watch']);

gulp.task('build-css', function(){
  //Create an unminified version
  var full = gulp.src([
    'src/scss/main.scss'
  ])
  . pipe(scss())
  . pipe(concat('*.css'))
  . pipe(gulp.dest('dist/css'));

  //Create a minified version
  var min = gulp.src([
    'src/scss/main.scss'
  ])
  . pipe(scss())
  . pipe(cleanCSS())
  . pipe(concat('*.min.css'))
  . pipe(gulp.dest('dist/css'));

  

  return merge(full, min);
});

gulp.task('watch', function(){
  gulp.watch('.//src/scss/*.scss', ['build-css']);
});

gulp.task('build-resume', function(){
  //Create an unminified version
  var full = gulp.src([
    'src/scss/resume.scss'
  ])
  . pipe(scss())
  . pipe(concat('*.css'))
  . pipe(gulp.dest('dist/css'));

  //Create a minified version
  var min = gulp.src([
    'src/scss/resume.scss'
  ])
  . pipe(scss())
  . pipe(cleanCSS())
  . pipe(concat('resume.min.css'))
  . pipe(gulp.dest('dist/css'));

  return merge(full, min);
});

gulp.task('minify-css', () => {
  // Folder with files to minify
  return gulp.src('src/scss/*.scss')
  //The method pipe() allow you to chain multiple tasks together 
  //I execute the task to minify the files
 .pipe(cleanCSS())
 //I define the destination of the minified files with the method dest
 .pipe(gulp.dest('dist'));
});

// Task to minify css using package cleanCSs
gulp.task('minify-css', () => {
  // Folder with files to minify
  return gulp.src('styles/*.scss')
  //The method pipe() allow you to chain multiple tasks together 
  //I execute the task to minify the files
 .pipe(cleanCSS())
 //I define the destination of the minified files with the method dest
 .pipe(gulp.dest('dist'));
});