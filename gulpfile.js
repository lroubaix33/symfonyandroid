var gulp = require('gulp');

gulp.task('generate-service-worker', function(callback) {
    var path = require('path');
    var swPrecache = require('sw-precache');
    var rootDir = 'public';

    var rootTemplates = 'templates';

    swPrecache.write(path.join(rootDir, 'sw.js'), {
    staticFileGlobs: [rootDir + '/**/*.{js,html,css,png,jpg,gif}',
                      rootTemplates + '/**/*.{html,twig}'],
    stripPrefix: rootDir
    }, callback);
});