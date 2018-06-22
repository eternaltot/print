<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'Print');

// Project repository
set('repository', 'https://github.com/eternaltot/print.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);


// Hosts

host('35.240.182.87')
    ->user('web')
    ->set('deploy_path', '/srv/www/print.com/shared');

// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

// before('deploy:symlink', 'artisan:migrate');
