<?php

define('TACO_PATH', '../taco/');
define('ENV_PATH', '../.env');
define('COMPOSER_PATH', '../');
define('VIEWS_PATH', '../taco/views/');
define('ROUTES_PATH', '../taco/routes.php');
define('HELPERS_PATH', '../taco/helpers.php');

require(COMPOSER_PATH.'vendor/autoload.php');
require(TACO_PATH.'taco.php');
app_init();