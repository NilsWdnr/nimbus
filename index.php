<?php

namespace nimbus;

use nimbus\App;


//enable error reporting in the browser
function enable_error_reporting(): void
{
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
}

//load the composer autoloader
function init_autoloader(): void
{
  $autoloader_file = __DIR__ . '/vendor/autoload.php';
  if(!file_exists($autoloader_file)){
    echo 'Error: The Autoloader file could not be found.';
    die;
  }
  require $autoloader_file;
}

//start the application
function start_application(): void
{
  new App();
}

enable_error_reporting();
init_autoloader();
start_application();
