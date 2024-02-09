<?php

namespace nimbus;

use nimbus\App;

$allowedDomain = 'http://localhost:3000';
header('Access-Control-Allow-Origin: ' . $allowedDomain);
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Max-Age: 86400');

//handle preflight requests (OPTIONS method)
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('HTTP/1.1 200 OK');
    exit();
}



//enable error reporting in the browser
function enable_error_reporting(): void
{
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
}

//load the composer autoloader
function init_autoloader(): void
{
  $autoloader_file = __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
  if(!file_exists($autoloader_file)){
    echo 'Error: The Autoloader file could not be found.';
    die;
  }
  require $autoloader_file;
}

//load the config
function load_config(): void
{
  $config_file = __DIR__ . DIRECTORY_SEPARATOR . 'config.php';
  if(!file_exists($config_file)){
    echo 'Error: The config file could not be found.';
    die;
  }
  require $config_file;
}

//start the application
function start_application(): void
{
  new App();
}

enable_error_reporting();
init_autoloader();
load_config();
start_application();
