const gulp = require('gulp');
const babel = require('gulp-babel');
const concat = require('gulp-concat');

const cleancss = require('clean-css'); //https://github.com/clean-css/clean-css#optimization-levels
const options = {
    level: {
        1: {
            removeWhitespace: true,
            specialComments:0
        }
    }
};

gulp.task('deps', ['deps.css', 'deps.js', 'deps.fonts']);

gulp.task('deps.css', () => {
    return gulp.src([
        'node_modules/@fortawesome/fontawesome-free/css/all.min.css',
        'node_modules/bootstrap/dist/css/bootstrap.min.css'
    ])
        .pipe(concat('deps.min.css'))
        .on('data', function(file) {
            const buferFile = new cleancss(options).minify(file.contents)
            return file.contents = Buffer.from(buferFile.styles)
        })
        .pipe(gulp.dest('public_html/assets/css'))
});

gulp.task('deps.fonts', () => {
    return gulp.src([
        'node_modules/@fortawesome/fontawesome-free/webfonts/*.*',
        'src/assets/sass/fonts/webfonts/*.*'
    ])
        .pipe(gulp.dest('public_html/assets/webfonts'))
});

gulp.task('deps.js', () => {
    return gulp.src([
        'node_modules/jquery/dist/jquery.min.js',
        'node_modules/popper.js/dist/umd/popper.min.js',
        'node_modules/bootstrap/dist/js/bootstrap.min.js'
    ])
        .pipe(concat('deps.min.js'))
        .pipe(babel({
            minified: true,
            comments: false
        }))
        .pipe(gulp.dest('public_html/assets/js'))
});