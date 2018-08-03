module.exports = function(grunt) {

  grunt.initConfig({

    sass: {
      dev: {
        options: {
          style: 'expanded'
        },
        files: {
          'css/style.css': 'scss/styles.scss'
        }
      },
      build: {
        options: {
          style: 'compressed'
        },
        files: {
          'css/style.css': 'scss/styles.scss'
        }
      }
    },



    postcss: {
      options: {
        map: true, // inline sourcemaps

        // or
        map: {
          inline: true, // save all sourcemaps as separate files...
          annotation: 'css/' // ...to the specified directory
        },

        processors: [
          require('pixrem')(), // add fallbacks for rem units
          require('autoprefixer')({browsers: 'last 2 versions'}), // add vendor prefixes
          require('cssnano')() // minify the result
        ]
      },
      dist: {
        src: 'css/main.min.css'
      }
    },



    watch: {
      options: {
        livereload: true
      },
      build: {
        files: ['**/*'],
        tasks: ['sass']
      },
    }

  });

  grunt.loadNpmTasks('grunt-postcss');
  grunt.loadNpmTasks('grunt-contrib-sass'); // https://github.com/gruntjs/grunt-contrib-sass


  grunt.loadNpmTasks('grunt-contrib-connect'); // https://github.com/gruntjs/grunt-contrib-connect
  grunt.loadNpmTasks('grunt-contrib-watch'); // https://github.com/gruntjs/grunt-contrib-watch


  grunt.registerTask('build', ['sass:build',  , 'postcss']);

  grunt.registerTask('dev', ['sass:dev', 'watch']);


};
