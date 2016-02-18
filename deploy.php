<?php

require 'recipe/laravel.php';

// migrate
task('database:migrate', function() {
    run('php {{release_path}}/' . 'artisan migrate');
})->desc('Migrate database');

// deploy
task('deploy', [
    'deploy:prepare',
    'deploy:release',
    'deploy:update_code',
    'deploy:vendors',
    'deploy:shared',
    'deploy:symlink',
])->desc('Deploy your project');
after('deploy', 'success');

// 接続サーバー
server('stg', 'wrbss.me', 20022)
    ->user('deploy_user')
    ->identityFile()
    ->env('deploy_path', '/opt/apps/lumen-wercker');

set('repository', 'git@github.com:wrbss/lumen-wercker.git');
