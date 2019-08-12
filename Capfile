set :deploy_config_path, 'config/deploy.rb'
set :stage_config_path, 'config/deploy'
require 'capistrano/setup'
require 'capistrano/deploy'
require 'capistrano/symfony'
require 'capistrano/file-permissions'
#require 'capistrano/cachetool'
#require 'capistrano/yarn'
Dir.glob('config/capistrano/tasks/*.rake').each { |r| import r }