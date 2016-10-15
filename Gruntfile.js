module.exports = function(grunt){

    grunt.initConfig({
        pkg:grunt.file.readJSON('package.json'),
        watch:{
            options:{
              livereload:true
            },
            phps:{
              files:['**/*.php'],
            },
            css:{
              files:["webapp/css/*.css"]

            }
        }

    });

    grunt.loadNpmTasks('grunt-reload');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-reload');


    grunt.registerTask('default',['watch']);
}
