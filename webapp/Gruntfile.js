module.exports = function(grunt){

    grunt.initConfig({
        pkg:grunt.file.readJSON('package.json'),
        concat: {
            options: {
                separator: ';',
            },
            libs: {
                src: [
                    'webapp/js/bower_components/jquery/dist/jquery.min.js',
                    'webapp/js/bower_components/bootstrap/dist/js/bootstrap.js',
                    'webapp/js/bower_components/angular/angular.min.js',
                    'webapp/js/bower_components/angular-sanitize/angular-sanitize.js',
                    'webapp/js/bower_components/angular-fancy-modal/dist/angular-fancy-modal.min.js',
                ],
                dest: 'webapp/js/production/libs.js',
            },
            webapp: {
                src: [
                    'webapp/js/courses/*.js',
                ],
                dest: 'webapp/js/production/webapp.js',
            },
        },
        uglify: {
            libs: {
                files: {
                    'webapp/js/production/libs.min.js': ['webapp/js/production/libs.js']
                }
            },
            webapp: {
                files: {
                    'webapp/js/production/webapp.min.js': ['webapp/js/production/webapp.js']
                }
            }
        },
        watch: {
            scripts: {
                files: ['webapp/js/courses/*.js'],
                tasks: ['concat:webapp'],
                options: {
                    spawn: false,
                },
            }


        },
    });

    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');


    grunt.registerTask('default',['concat','uglify','watch']);
}
