let gulp = require('gulp'),
    sass = require('gulp-sass'),
    del = require('del'),
    minify = require('gulp-minify'),
    cleanCSS = require('gulp-clean-css'),
    concat = require('gulp-concat'),
    sourcemaps = require('gulp-sourcemaps'),
    browserify = require('browserify'),
    source = require('vinyl-source-stream');

/*
|------------------
| Admin Panel
|------------------
*/
// gulp.task('admin-minify', () => {
//     return gulp.src('resources/admin/js/*.js', {
//             allowEmpty: true
//         })
//         .pipe(sourcemaps.init())
//         .pipe(minify({
//             noSource: true,
//             ext: '.js',
//             suffix: ''
//         }))
//         .pipe(concat('main-mini.js'))
//         .pipe(sourcemaps.write())
//         .pipe(gulp.dest('public/admin/minified/js/'))
// });


// gulp.task('admin-build', () => {
//     return gulp.src(['resources/admin/css/**/*.css', 'resources/admin/sass/**/*.scss'])
//         .pipe(sourcemaps.init())
//         .pipe(sass().on('error', sass.logError))
//         .pipe(cleanCSS())
//         .pipe(concat('main-mini.css'))
//         .pipe(sourcemaps.write())
//         .pipe(gulp.dest('public/admin/minified/css/'));
// });


/*
|--------------
| User Panel
|-------------
*/

gulp.task('build', () => {
    return gulp.src(['resources/reseller/css/**/*.css', 'resources/reseller/sass/**/*.scss'])
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(cleanCSS())
        .pipe(concat('main.css'))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('public/dist/reseller/css'));
});

gulp.task('frontend-build', () => {
    return gulp.src(['resources/reseller/frontend/css/**/*.css', 'resources/reseller/frontend/sass/**/*.scss'])
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(cleanCSS())
        .pipe(concat('main.css'))
        .pipe(sourcemaps.write())
        .pipe(gulp.dest('public/dist/reseller/frontend/css'));
});

// gulp.task('minify', () => {
//     return gulp.src('resources/frontend/js/*.js', {
//             allowEmpty: true
//         })
//         .pipe(sourcemaps.init())
//         .pipe(minify({
//             noSource: true,
//             ext: '.js',
//             suffix: ''
//         }))
//         .pipe(concat('main.js'))
//         .pipe(sourcemaps.write())
//         .pipe(gulp.dest('public/front_end/js/'))
// });


/*gulp.task('clean', () => {
    return del([
        'css/style.css',
        'css/sidenav.css',
    ]);
});*/

gulp.task('cache-clean', () => {
    return del([
        'public/reseller/css/.sass-cache/',
    ]);
});


gulp.task('default', gulp.series(['build','frontend-build','cache-clean']));
//gulp.task('default', gulp.series(['build', 'minify', 'cache-clean','admin-minify','admin-build']));
// gulp.task('admin-watch', () => {
//     gulp.watch(['resources/admin/css/**/*.css', 'resources/admin/sass/**/*.scss'], (done) => {
//         gulp.series(['admin-build', 'cache-clean'])(done);
//     });
//     gulp.watch(['resources/admin/js/*.js', 'lib/*.mjs'], (done) => {
//         gulp.series(['admin-minify'])(done);
//     });
// });

gulp.task('watch', () => {
    gulp.watch(['resources/reseller/css/**/*.css', 'resources/reseller/sass/**/*.scss'], (done) => {
        gulp.series(['build', 'cache-clean'])(done);
    });
    // gulp.watch(['resources/frontend/js/*.js', 'lib/*.mjs'], (done) => {
    //     gulp.series(['minify'])(done);
    // });
});
gulp.task('front-watch', () => {
    gulp.watch(['resources/reseller/frontend/css/**/*.css', 'resources/reseller/frontend/sass/**/*.scss'], (done) => {
        gulp.series(['frontend-build', 'cache-clean'])(done);
    });
    // gulp.watch(['resources/frontend/js/*.js', 'lib/*.mjs'], (done) => {
    //     gulp.series(['minify'])(done);
    // });
});
