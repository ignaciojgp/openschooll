module.exports = function(grunt){

    grunt.initConfig({
        pkg:grunt.file.readJSON('package.json'),
        reload: {
            port: 80,
            proxy: {
                host: 'localhost',
            }
        },
        watch:{
            files:['*.php','index.html', 'style.less'],
            tasks:'default reload'
        }
    });

    grunt.loadNpmTasks('grunt-reload');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-reload');


    grunt.registerTask('default',['watch']);
}
