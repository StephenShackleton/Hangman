set :application, "Hangman"
set :domain,      "shackleton-hangmantest.rhcloud.com"
set :deploy_to,   "/"
set :user,        "555778624382ecd8770000c5"
set :password, "Joburg2509"
set :scm_passphrase, "Joburg2509"
set :app_path,    "app"

set :repository,  "file:///Users/Ste/Hangman"
set :deploy_via,  :copy
set :scm,         :git
# Or: `accurev`, `bzr`, `cvs`, `darcs`, `subversion`, `mercurial`, `perforce`, or `none`

set :model_manager, "doctrine"
# Or: `propel`

role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain, :primary => true       # This may be the same as your `Web` server

set  :shared_files, ["app/config/parameters.yml"]
set  :shared_children, [app_path + "/logs" + web_path + "/uploads"]

set  :use_composer, true
set  :update_vendors, true
set  :keep_releases,  3

# Be more verbose by uncommenting the following line
# logger.level = Logger::MAX_LEVEL

task :upload_parameters do
  origin_file = "app/config/parameters.yml"
  destination_file = latest_release + "/app/config/parameters.yml" # Notice the
  latest_release

  try_sudo "mkdir -p #{File.dirname(destination_file)}"
  top.upload(origin_file, destination_file)
end

before "deploy:share_childs", "upload_parameters"