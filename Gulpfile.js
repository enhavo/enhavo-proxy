'use strict';

var gulp = require('gulp');

gulp.task("docker:build", shell.task([
  'docker build -t xqweb/enhavo-proxy .'
]));