module.exports = function( grunt ) {
    'use strict';
    var pkgInfo = grunt.file.readJSON('package.json');
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        makepot: {
            target: {
                options: {
                    domainPath: '/',
                    potFilename: 'languages/travel-trail.pot',
                    potHeaders: {
                        poedit: true,
                        'x-poedit-keywordslist': true
                    },
                    type: 'wp-theme',
                    updateTimestamp: true
                }
            }
        },
        addtextdomain: {
            options: {
                updateDomains: true,  // List of text domains to replace.
            },
            target: {
                files: {
                    src: [
                        '*.php',
                        '**/*.php',
                        '!node_modules/**',
                    ]
                }
            }
        },
        copy: {
            main: {
                options: {
                    mode: true
                },
                src: [
                    '**',
                    '!node_modules/**',
                    '!Gruntfile.js',
                    '!package.json',
                    '!.gitignore',
                    '!package-lock.json',
                    '!yarn.lock'
                ],
                dest: 'travel-trail/'
            }
        },
        compress: {
            main: {
                options: {
                    archive: 'travel-trail_' + pkgInfo.version + '.zip',
                    mode: 'zip'
                },
                files: [
                    {
                        src: [
                            './travel-trail/**'
                        ]
                    }
                ]
            }
        },
        clean: {
            main: ["travel-trail"],
            zip: ["*.zip"]
        },
        bumpup: {
            options: {
                updateProps: {
                    pkg: 'package.json'
                }
            },
            file: 'package.json'
        },
        replace: {
            theme_main: {
                src: ['style.css','readme.txt' ],
                overwrite: true,
                replacements: [
                    {
                        from: /Version: \bv?(?:0|[1-9]\d*)\.(?:0|[1-9]\d*)\.(?:0|[1-9]\d*)(?:-[\da-z-A-Z-]+(?:\.[\da-z-A-Z-]+)*)?(?:\+[\da-z-A-Z-]+(?:\.[\da-z-A-Z-]+)*)?\b/g,
                        to: 'Version: <%= pkg.version %>'
                    },
                    {
                        from: /Stable tag: \bv?(?:0|[1-9]\d*)\.(?:0|[1-9]\d*)\.(?:0|[1-9]\d*)(?:-[\da-z-A-Z-]+(?:\.[\da-z-A-Z-]+)*)?(?:\+[\da-z-A-Z-]+(?:\.[\da-z-A-Z-]+)*)?\b/g,
                        to: 'Stable tag: <%= pkg.version %>'
                    }
                ]
            },
        },
        
    });
    // Load NPM tasks to be used here
    grunt.loadNpmTasks( 'grunt-contrib-copy' );
    grunt.loadNpmTasks( 'grunt-contrib-compress' );
    grunt.loadNpmTasks( 'grunt-contrib-clean' );
    grunt.loadNpmTasks( 'grunt-contrib-cssmin' );
    grunt.loadNpmTasks( 'grunt-wp-i18n' );
    grunt.loadNpmTasks( 'grunt-bumpup' );
    grunt.loadNpmTasks( 'grunt-text-replace' );

    // To release new version just runt 2 commands below
    // Re create everything: grunt release --ver=<version_number>
    // Zip file installable: grunt zipfile
    grunt.registerTask('zipfile', ['clean:zip', 'copy:main', 'compress:main', 'clean:main']);
    grunt.registerTask('release', function (ver) {
        var newVersion = grunt.option('ver');
        if (newVersion) {
            // Replace new version
            newVersion = newVersion ? newVersion : 'patch';
            grunt.task.run('bumpup:' + newVersion);
            grunt.task.run('replace');
            // i18n
            grunt.task.run(['addtextdomain', 'makepot']);
        }
    });
    grunt.registerTask('default', ['addtextdomain', 'makepot']);
};