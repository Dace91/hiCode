/**
 * @Author: Antoine07
 * @description: gulp for Laravel5
 */
var gulp = require('gulp');

var $ = require('gulp-load-plugins')();

var bowerDir = './resources/assets/vendor';

var path = {
    'resources': {
        'scss': './resources/assets/scss',
        'vendor': './resources/vendor',
        'icons': './resources/assets/icons',
        'tools': './resources/assets/scss/tools'
    },
    'public': {
        'css': './public/assets/css',
        'js': './public/assets/js',
        'vendor': './public/assets/dist',
        'images': './public/assets/images'
    }
};

gulp.task('sass', function () {
    return gulp.src(path.resources.scss + '/app.scss')
        .pipe($.sass(
            {
                onError: console.error.bind(console, 'SASS error')
            }
        ))
        .pipe($.minifyCss())
        .pipe($.autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }))
        .pipe($.rename({suffix: '.min'}))
        .pipe(gulp.dest(path.public.css))
        .pipe($.size());
});

gulp.task('cssplain', function () {
    return gulp.src(path.resources.scss + '/app.scss')
        .pipe($.sass(
            {
                onError: console.error.bind(console, 'SASS error')
            }
        ))
        .pipe($.autoprefixer({
            browsers: ['last 2 versions'],
            cascade: true
        }))
        .pipe(gulp.dest(path.public.css))
});


gulp.task('sprite', function () {
    var sprite = gulp.src(path.resources.icons + '/*.png')
        .pipe($.spritesmith({
            imgName: "sprite.png",
            cssName: "_sprite.scss",
            cssTemplate: path.resources.tools + '/_sprite.scss.mustache'
        }));

    sprite.img.pipe(gulp.dest(path.public.images));
    sprite.css.pipe(gulp.dest(path.resources.tools))
});

gulp.task('watch', function () {
    gulp.watch(path.resources.scss + '/**/*.scss', ['sass', 'cssplain']);
});

gulp.task('default', ['watch']);


// todo


//gulp.task('js', function(){
// return gulp.src([
//  path.assets.vendor+'jquery/dist/jquery.min.js',
//  path.resources.js+'app.js'
// ])
//     .pipe($.concat('app.min.js'))
//     .pipe($.uglify())
//     .pipe(gulp.dest(path.assets.js));
//});