<?php defined('TACO') or die('Not allowed');

//------------------------------------------------------------------------------
// ROUTES
//------------------------------------------------------------------------------

// Routes can be added by referencing a controller function,
// or by simply supplying a function handler

//------------------------------------------------------------------------------

$routes = [
    '/' => 'controller_page_home',    
    '/page2' => 'controller_page_page2',
    'login' => 'controller_page_login',
    'admin' => 'controller_page_admin',
    'logout' => 'controller_page_logout',
];

//$routes['api/'] = 'controller_api_index';
$routes['api'] = function(){ json_output_success([ 'API'=>'Hi, friend' ]);  };
$routes['api/(:any)'] = function(){ json_output_success([ 'API'=>'Endpoint not found' ]);  };

// do this last, after checking all other routes
$routes['(:any)'] = 'controller_page_e404';

//------------------------------------------------------------------------------

// you can include more controller files here if you want to, eg controllers_page, controllers_api, controllers_admin, etc
include TACO_PATH.'controllers/page.php';
include TACO_PATH.'controllers/api.php';
include TACO_PATH.'controllers/admin.php';

//------------------------------------------------------------------------------
