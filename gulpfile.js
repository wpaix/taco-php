
//------------------------------------------------

var dotenv 			= require('dotenv').config(),
	gulp            = require('gulp'),
	babel 			= require('gulp-babel'),
	autoprefixer    = require('gulp-autoprefixer'),
	sass            = require('gulp-sass'),
	plumber         = require('gulp-plumber'),
	uglify          = require('gulp-uglify'),
    include         = require('gulp-include'),
	minifycss       = require('gulp-minify-css'),
	gutil 		    = require('gulp-util'),
	ftp 			= require('vinyl-ftp'),
	concat 			= require('gulp-concat'),
	rename          = require('gulp-rename');

//------------------------------------------------

// scss/css

gulp.task('process-scss', function(){

	return gulp.src('./src/scss/main.scss')
	.pipe(plumber())
	.pipe(sass())
	.pipe(autoprefixer('last 4 versions'))
	.pipe(minifycss())
	.pipe(rename('./public/assets/css/main.css'))
	.pipe( gulp.dest('./') );
})


//------------------------------------------------

//JS minify and concat

gulp.task('process-js', function(){

	return gulp.src([
		//'node_modules/babel-polyfill/dist/polyfill.js',
		//'./src/js/**/*.js'
		'./src/js/main.js'
	])
    .pipe(include())
	.pipe(concat('all.js'))
	.pipe(babel({ presets: ['@babel/preset-env'] }))
	.pipe(uglify())
	.pipe(rename('./public/assets/js/all.min.js'))
	.pipe( gulp.dest('./') );

})

//------------------------------------------------

gulp.task('deploy-public', function(){
    let files = [
        'public/assets/css/main.css',
        'public/assets/js/all.min.js',
    ]
    let conn = ftp.create({ host: process.env.DEPLOY_FTP_HOST, user: process.env.DEPLOY_FTP_USER, password: process.env.DEPLOY_FTP_PASSWORD, parallel: 6, log: gutil.log, secure: true, })
    return gulp.src( files, { base:'public', buffer: false, }).pipe( conn.dest('/public_html/') )
})

gulp.task('deploy-app', function(){
    let files = [
		'taco/**/*.*',        
		//'taco/controllers/*.*',        
		//'taco/views/*.*',        
		//'taco/*.*',        
    ]
    let conn = ftp.create({ host: process.env.DEPLOY_FTP_HOST, user: process.env.DEPLOY_FTP_USER, password: process.env.DEPLOY_FTP_PASSWORD, parallel: 6, log: gutil.log, secure: true, })
    return gulp.src( files, { base:'.', buffer: false, }).pipe( conn.dest('/public_html/') )
})

gulp.task('deploy', gulp.series([ 'deploy-public', 'deploy-app' ]));

//------------------------------------------------

gulp.task('default', gulp.series( function(){
	gulp.watch('./src/scss/**/*.scss', gulp.parallel('process-scss') )
	gulp.watch('./src/js/**/*.js', gulp.parallel('process-js') )
}))

//------------------------------------------------
