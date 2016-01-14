var elixir = require('laravel-elixir'),
    liveReload = require('gulp-livereload'),
    clean = require('rimraf'),
    gulp = require('gulp');

var config = {
    assetsPath: './resources/assets',
    buildPath: './public/build'
};

// Bower
config.bowerPath = config.assetsPath + '/../bower_components';

// JS
config.buildPathJs = config.buildPath + '/js';
config.buildVendorPathJs = config.buildPathJs + '/vendor';
config.vendorPathJs = [
    config.bowerPath + '/jquery/dist/jquery.min.js',
    config.bowerPath + '/bootstrap/dist/js/bootstrap.min.js',
    config.bowerPath + '/angular/angular.min.js',
    config.bowerPath + '/angular-route/angular-route.min.js',
    config.bowerPath + '/angular-resource/angular-resource.min.js',
    config.bowerPath + '/angular-animate/angular-animate.min.js',
    config.bowerPath + '/angular-messages/angular-messages.min.js',
    config.bowerPath + '/angular-bootstrap/ui-bootstrap.min.js',
    config.bowerPath + '/angular-strap/dist/modules/navbar.min.js',
    config.bowerPath + '/angular-cookies/angular-cookies.min.js',
    config.bowerPath + '/query-string/query-string.js',
    config.bowerPath + '/angular-oauth2/dist/angular-oauth2.min.js'
];

// CSS
config.buildPathCss = config.buildPath + '/css';
config.buildVendorPathCss = config.buildPathCss + '/vendor';
config.vendorPathCss = [
    config.bowerPath + '/bootstrap/dist/css/bootstrap.min.css'
];

// HTML
config.buildPathHtml = config.buildPath + '/views';

// Copy HTML
gulp.task('copy-html', function(){
    gulp.src([
            config.assetsPath + '/js/views/**/*.html'
        ])
        .pipe(gulp.dest(config.buildPathHtml))
        .pipe(liveReload());
});

// Copy CSS
gulp.task('copy-css', function () {
    gulp.src([
            config.assetsPath + '/css/**/*.css'
        ])
        .pipe(gulp.dest(config.buildPathCss))
        .pipe(liveReload());

    gulp.src(config.vendorPathCss)
        .pipe(gulp.dest(config.buildVendorPathCss))
        .pipe(liveReload());
});

// Copy JS
gulp.task('copy-js', function () {
    gulp.src([
            config.assetsPath + '/js/**/*.js'
        ])
        .pipe(gulp.dest(config.buildPathJs))
        .pipe(liveReload());

    gulp.src(config.vendorPathJs)
        .pipe(gulp.dest(config.buildVendorPathJs))
        .pipe(liveReload());
});

// Clear folder
gulp.task('clear-build-folder', function () {
    clean.sync(config.buildPath);
});

// *** Default
gulp.task('default', ['clear-build-folder'], function () {
    gulp.start('copy-html');
    elixir(function (mix) {
        mix.styles(
            config.vendorPathCss.concat([
                config.assetsPath + '/css/**/*.css'
            ]),
            'public/css/all.min.css',
            config.assetsPath
        );

        mix.scripts(
            config.vendorPathCss.concat([
                config.assetsPath + '/js/**/*.js'
            ]),
            'public/js/all.min.js',
            config.assetsPath
        );

        mix.version(['js/all.min.js', 'css/all.min.css']);
    });
});

// *** Watch Dev
gulp.task('watch-dev', ['clear-build-folder'], function () {
    liveReload.listen();
    gulp.start('copy-css', 'copy-js', 'copy-html');
    gulp.watch(config.assetsPath + '/**', ['copy-css', 'copy-js', 'copy-html']);
});
