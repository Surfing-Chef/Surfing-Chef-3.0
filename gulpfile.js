var gulp = require('gulp'),
    sass = require('gulp-sass'),
    browserSync = require('browser-sync').create();
    php = require ('gulp-connect-php'),
    uglify = require('gulp-uglify'),
    autoprefixer = require('gulp-autoprefixer'),
    sourcemaps  = require('gulp-sourcemaps'),
    concat = require('gulp-concat'),
    del = require('del'),
    rename = require('gulp-rename'),
    babel = require('gulp-babel'),
    compressimages = require('compress-images');
    imgSrc = 'src/img/**/*.{jpg,JPG,jpeg,JPEG,png,svg,gif}';
    imgBld = 'build/img/';

function handleError (error) {
    console.log(error.toString())
    this.emit('end')
};

// PRODUCTION
gulp.task('php', function() {
    php.server({ base: 'src', port: 8010, keepalive: true});
});

gulp.task('browserSync',['php'], function() {
    browserSync.init({
        proxy: '127.0.0.1:8010',
        port: 8080,
        open: true,
        notify: false
    });
});

gulp.task('sass', function(){
    return gulp.src('src/sass/**/*.scss')
    .pipe(sass()) // Converts Sass to CSS with gulp-sass
    .on('error', handleError) //Show details on any errors
    .pipe(gulp.dest('src/css'))
    .pipe(browserSync.reload({
        stream: true
      }));
});

gulp.task('watch',['browserSync','sass'], function(){
    gulp.watch('src/sass/**/*.scss', ['sass']);
    gulp.watch('src/*.php', browserSync.reload); 
    gulp.watch('src/js/**/*.js', browserSync.reload);
});

// DEPLOYMENT

// delete previous production build
gulp.task('prod:cleanfolder', function(){
    return del([
      '_build/**/*'
    ]);
  });

  // compress images
gulp.task('prod:imgMin', ['prod:cleanfolder'], function(){

    compressimages(imgSrc, imgBld, {compress_force: false, statistic: true, autoupdate: true}, false,
        {jpg: {engine: 'mozjpeg', command: ['-quality', '60']}},
        {png: {engine: 'pngquant', command: ['--quality=20-50']}},
        {svg: {engine: 'svgo', command: '--multipass'}},
        {gif: {engine: 'gifsicle', command: ['--colors', '64', '--use-col=web']}}, function(){
    });
});

// minify css for build
gulp.task('prod:sass', ['prod:cleanfolder'], function() {
  gulp.src('src/sass/styles.scss')
  .pipe(sass({outputStyle: 'compressed'}))
  .pipe(gulp.dest('_build/css/'));
});

// uglify and mangle js
gulp.task('prod:scripts', ['prod:sass'], function(){
    gulp.src([
              'src/js/**/*.js'
            ])
    .pipe(concat('scripts.js'))
    .pipe(uglify())
    .pipe(gulp.dest('_build/js'));
  
    // gulp.src([
    //           'src/js/**/*/'
    //         ])
    // .pipe(gulp.dest('build/js'));
  });

  // copy development files not requiring processing
gulp.task('prod:copy', ['prod:imgMin'], function(){
    return gulp.src([
                    './src/**/*/',
                    '!./src/css/*/',
                    '!./src/img/*/',
                    '!./src/js/*/'
                  ])
    .pipe(gulp.dest('./_build'));
  });

  // delete previous production build
gulp.task('prod:tidy', ['prod:copy'], function(){
    return del([
      '_build/sass',
      '_build/**/*{bu*,BU*}',
      '_build/**/*jquery*'
    ]);
  });
  
  // main build task
  gulp.task('build', ['prod:cleanfolder', 'prod:imgMin', 'prod:sass', 'prod:scripts', 'prod:copy', 'prod:tidy']);
  