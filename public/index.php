<?php 

//----------------------------------------------------------------------
// CONFIG: APP
//----------------------------------------------------------------------

$load_composer = FALSE; // Want to autoload composer? FALSE if no, else path to composer, eg. 'vendor/autoload.php'
$load_env_vars = FALSE; // Want to load env vars? FALSE if no, or else path to env file, eg. '.env'. (composer package required: vlucas/phpdotenv)

$config = [
	'root_path' => '../app/',				// will typically be 'app/' or '../app/'
	'load_composer' => FALSE,				// Want to autoload composer? FALSE if no, else path to composer, eg. 'vendor/autoload.php'
	'load_env_vars' => FALSE,				// Want to load env vars? FALSE if no, or else path to env file, eg. '.env'
	'routes' => [],
	'baseurl' => 'http://localhost:8000', 	// if present, env var BASEURL will override
	'show_errors' => TRUE,
];

//----------------------------------------------------------------------
// CUSTOM CONFIG: PROJECT (prefixed if conflicting)
//----------------------------------------------------------------------

$config['db_json_folder'] = 'db_json';

//----------------------------------------------------------------------
// ROUTES (placed here or require app/routes.php if you want them there)
//----------------------------------------------------------------------

$config['routes']['error_404'] = 'page_error404';

$config['routes']['login'] = 'page_login';
$config['routes']['logout'] = 'controller_logout';

$config['routes'][''] = 'page_home';

$config['routes']['api/(:any)'] = 'api';

$config['routes']['(:any)'] = 'page_client';
$config['routes']['(:any)/(:any)'] = 'page_project';


//----------------------------------------------------------------------
// INIT
//----------------------------------------------------------------------

// rock and/or roll
require $config['root_path'].'methods.php';
app_init();
