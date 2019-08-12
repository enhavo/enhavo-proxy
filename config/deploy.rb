# config valid only for current version of Capistrano
lock '3.4.1'

set :application, 'enhavo-proxy'
set :repo_url, 'git@github.com:enhavo/enhavo-proxy.git'
set :deploy_to, '/var/www'
set :composer_install_flags, ''
set :linked_dirs, fetch(:linked_dirs, []).push('var/media').push('var/sessions')
set :keep_releases, 5
set :file_permissions_chmod_mode, "0775"
set :file_permissions_paths, ["var/cache", "var/log", "var", "var/sessions"]
set :file_permissions_groups, ["www-data"]
set :use_sudo, false
set :branch, ENV['BRANCH'] if ENV['BRANCH']

SSHKit.config.command_map[:php] = "php"
SSHKit.config.command_map[:composer] = "php #{shared_path.join("composer.phar")}"
SSHKit.config.command_map[:cachetool] = "php #{shared_path.join("cachetool.phar")}"

namespace :deploy do
  after :starting, 'composer:install_executable'
end

namespace :deploy do
  task :migrate do
    on roles(:db) do
      symfony_console('doctrine:migrations:migrate', '--no-interaction')
    end
  end
  task :routes do
    on roles(:db) do
      execute "cd '#{release_path}'; php bin/console fos:js-routing:dump --format=json --target=public/js/fos_js_routes.json"
    end
  end
  task :webpack do
    on roles(:db) do
      execute "cd '#{release_path}'; yarn encore prod"
    end
  end
end

after 'deploy:updated', 'symfony:assets:install'
after "deploy:updated", "deploy:webpack"
after "deploy:updated", "deploy:routes"
before "deploy:publishing", "deploy:migrate"