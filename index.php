<?php

namespace nimbus;

use nimbus\App;

function enable_error_reporting(): void
{
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
}

function init_autoloader(): void
{
  require __DIR__ . '/vendor/autoload.php';
}

function start_application(): void
{
  new App();
}

enable_error_reporting();
init_autoloader();
start_application();
