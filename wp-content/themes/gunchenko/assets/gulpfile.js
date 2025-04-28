
const {src, dest, watch} = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const concat = require('gulp-concat');
const uglify = require('gulp-uglify-es').default;
const autoprefixer = require('gulp-autoprefixer');
/*const browserSync = require('browser-sync').create();*/

/*import dartSass from 'sass';
import gulpSass from 'gulp-sass';
const sass = gulpSass(dartSass);*/

/*function browsersync(){
  browserSync.init({
    server:{
      baseDir: ''
    }
  })
}*/
function scripts(){
  return src([//файли які потрібно об'єднати та зжати
    'js/bootstrap.js',
    'js/jquery.lazy.js',
    'js/js.js'//завжди останній, важлива послідовність
  ])
    .pipe(concat('main.min.js'))//ім'я згенерованого файлу
    .pipe(uglify())
    .pipe(dest('js/'))//шлях до зберігання
}

function styles(){
  return src('css/style.scss')//шлях до файлу який потрібно конвертувати
    .pipe(sass({outputStyle: 'compressed'}))
    .pipe(concat('style.min.css'))//Нова назва конвртованого та зжатого файлу
    .pipe(autoprefixer({//Автоматечне проставлення префіксів для кросбраузерності
      overrideBrowserslist: ['last 5 version'],
      grid: true
    }))
    .pipe(dest('css/'))//шлях куди зберігаємо файл
    /*.pipe(browserSync.stream())*/
}

function watching(){
  watch(['css/**/*.scss'], styles);
  watch(['js/js.js'], scripts);
}

exports.styles = styles;
exports.scripts = scripts;
exports.watching = watching;