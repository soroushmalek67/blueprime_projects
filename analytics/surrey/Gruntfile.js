module.exports = function(grunt) {

  'use strict';
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  // load all grunt tasks
  require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

  // Project configuration.
  grunt.initConfig({

    uglify: {
      options: {
        preserveComments: 'some'
      },
      dist: {
        files: {

        }
      }
  	},

    copy: {
      main: {
        files: [{
          expand: true, 
          cwd: 'bower_components/jquery/dist', 
          src: ['jquery.min.js', 'jquery.min.map'],
          dest: 'public/assets/js/vendor/'
        },{
          expand: true, 
          cwd: 'bower_components/lodash', 
          src: ['lodash.min.js'],
          dest: 'public/assets/js/vendor/'
        },{
          expand: true, 
          cwd: 'bower_components/bootstrap/dist/js', 
          src: ['bootstrap.min.js'],
          dest: 'public/assets/js/vendor/'
        },{
          expand: true, 
          cwd: 'bower_components/google-maps-utility-library-v3-infobubble/lib', 
          src: ['infobubble-compiled.js'],
          dest: 'public/assets/js/vendor/'
        },{
          expand: true, 
          cwd: 'bower_components/gmaps-markerclusterer-plus/src', 
          src: ['markerclusterer_packed.js'],
          dest: 'public/assets/js/vendor/'
        },{
          expand: true, 
          cwd: 'bower_components/select2', 
          src: ['select2.min.js'],
          dest: 'public/assets/js/vendor/'
        },{
          expand: true, 
          cwd: 'bower_components/d3', 
          src: ['d3.min.js'],
          dest: 'public/assets/js/vendor/'
        },{
          expand: true, 
          cwd: 'bower_components/DataTables/media/js', 
          src: ['jquery.dataTables.min.js'],
          dest: 'public/assets/js/vendor/'
        },{
          expand: true, 
          cwd: 'bower_components/bootstrap/dist/css', 
          src: ['bootstrap.min.css'],
          dest: 'public/assets/css/vendor/'
        },{
          expand: true, 
          cwd: 'bower_components/DataTables/media/css', 
          src: ['jquery.dataTables.min.css'],
          dest: 'public/assets/css/vendor/'
        },{
          expand: true, 
          cwd: 'bower_components/normalize-css', 
          src: ['normalize.css'],
          dest: 'public/assets/css/vendor/'
        },{
          expand: true, 
          cwd: 'bower_components/select2', 
          src: ['select2.css', 'select2-spinner.gif', 'select2.png'],
          dest: 'public/assets/css/vendor/'
        },{
          expand: true, 
          cwd: 'bower_components/bootstrap/fonts', 
          src: ['*.*'],
          dest: 'public/assets/css/fonts'
        },{
          expand: true, 
          cwd: 'bower_components/DataTables/media/images', 
          src: ['*.*'],
          dest: 'public/assets/css/images'
        }]
      }
    },

	  sass: {
	    dist: {
	      files: {

	      }
	    }
	  }
  });

  // Default task(s).
  grunt.registerTask('default', [
	  'uglify',
    'copy',
	  'sass',
  ]);

};