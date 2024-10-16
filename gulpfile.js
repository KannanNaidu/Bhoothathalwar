const gulp = require('gulp');
// Load all gulp plugins
const plg = require('gulp-load-plugins');
// Load args parser for production
const argv = require('yargs').argv;

var paths = {
    scripts: {
        src: [
            'node_modules/alpinejs/dist/cdn.min.js',
            'assets/scripts/app.js'
        ],
        dest: 'js'
    }
};

//Theme name
var theme = {
    site: {
        name: 'Bhoothathalwar'
    },
    js: {
        filename: 'bhoothathalwar.js'
    }
};


function scripts() {
    return gulp
        .src(paths.scripts.src)
        // get filename from theme
        .pipe(plg.concat(theme.js.filename))
        // if production minify using gulp-uglify plugin
        .pipe(plg.if(argv.production, plg.uglify()
            .on('error', e => { console.log(e); })
        ))
        // If production use gulp-rename to add the suffix
        .pipe(plg.if(argv.production, plg.rename({suffix: '.min'})))
        // send file to dest
        .pipe(gulp.dest(paths.scripts.dest));
}

// Watch Files For Changes
gulp.task('watch', function() {
    gulp.watch('assets/scripts/**/*.js', gulp.parallel(scripts));
});

// Default Task
gulp.task('default', gulp.series(['watch']));


// gulp build --production to minify
gulp.task(
    'build',
    gulp.series(gulp.parallel(scripts))
);