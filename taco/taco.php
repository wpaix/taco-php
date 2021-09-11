<?php defined('TACO_PATH') or die('Not allowed');

//------------------------------------------------------------------------------
// MVC NANO FRAMEWORK - version 3.0 - this file should not be changed ideally
//------------------------------------------------------------------------------

define('TACO', TRUE);
defined('ROUTES_PATH') or define('ROUTES_PATH', '../app/routes.php');
defined('ROUTES_PATH') or define('ROUTES_PATH', '../app/routes.php');
defined('HELPERS_PATH') or define('HELPERS_PATH', '../app/helpers.php');
defined('VIEWS_PATH') or define('VIEWS_PATH', '../app/views/');

require_once(ROUTES_PATH);

function env_name() { return getenv('ENV_NAME'); }
function is_env($env) { return env_name() === $env; }
function is_production() { return is_env('production'); }
function is_development() { return is_env('development'); }

//------------------------------------------------------------------------------

function get_route_path(){ $p = trim( $_SERVER['REQUEST_URI'], '/' ); $p = explode('?',$p)[0]; return $p; }
function get_route_params(){ return explode('/',get_route_path()); }
function get_route_param( $slot = 0 ){ $p = get_route_params(); if(isset($p[$slot])) return $p[$slot]; }

function is_route_path($path){ return $path == get_route_path(); }
function is_route_param($slot,$param){ return $param == get_route_param($slot); }

function router_init() {
    global $url_route, $routes;
    foreach( $routes as $r => $c ) { 
        if( $r == '/' ) $r = '';
        $r = ltrim($r,'/');
		$r = str_replace( ['(:num)','(:str)','(:any)','*'], ['[0-9]+','[a-z-_]+','[0-9a-z-_]+','.+'], $r );
		$match = preg_match( '~^'.$r.'$~', $url_route );			
		if( $match ) return load_controller($c);
	}
    load_controller('controller_page_e404');
}

function base_url(){ return getenv('BASE_URL'); }
function base_url_live(){ return getenv('BASE_URL_LIVE'); }
function base_url_cms(){ return getenv('BASE_URL_CMS'); }

function base_url_tld() {
    $tld = base_url();
    $tld = explode('.', $tld);
    $tld = str_replace('/','',$tld);
    return end($tld);
}

function base_url_media(){
    if(is_development()) return base_url_live().'media/';
    if(is_production()) return base_url().'media/';

    if(is_development()) return base_url_live().'mediafile.php?f=';			
    if(is_production()) return base_url().'mediafile.php?f=';
}

function objectify( &$d ){ if( !is_object($d) ) $d = (Object) $d; }
function dd($input){ echo '<pre>';print_r($input); die(); }

function input( $type = 'any' ) {
	if( $type == 'get' ) return (object) $_GET;
	if( $type == 'post' ) return (object) $_POST;
	if( $type == 'any' ) {
		$input = $_GET;
		if( empty($input) ) $input = $_POST;
		return (object) $input;
	}
}

//------------------------------------------------------------------------------

function json_output( $http_code = 200, $data = NULL ){
    http_response_code($http_code);
    header('Content-Type: application/json; charset=utf-8');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Origin: *');	
    header('Access-Control-Max-Age: 3628800');
    header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, OPTIONS, DELETE');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");    
    if( !empty($data) ) echo json_encode($data, JSON_NUMERIC_CHECK);    
	die();
}

function json_output_success( $data = NULL ) {
    $payload = [ 'status' => 'success' ];
    if( !empty($data) ) $payload['data'] = $data;
    json_output(200, $payload);
}

function json_output_error($http_code = 400, $error = 'unknown', $data = NULL) {    
    $payload = [ 'status' => 'error', 'error'=>$error ];
    if( !empty($data) ) $payload['data'] = $data;
    json_output($http_code, $payload);
}

//------------------------------------------------------------------------------


// name is either a method by that name or a file by that name
function load_controller($name){
    if( is_callable($name) ) return call_user_func($name);
    $filename = ''.$name.'.php';
    if( is_file($filename) ) return require $filename;
    die('Controller not found: '.$name);
}

function view_exist($path){
	return is_file(view_path($path));
}

function view_path($path){
    $path = rtrim($path,'.php');
    return VIEWS_PATH.$path.'.php';
}

function load_view($tpl,$data = []){
    if( !empty($data) ) extract($data);
    require view_path($tpl);
}

function load_blade_view($tpl,$data = []){
    if( !isset($GLOBALS['blade']) ) $GLOBALS['blade'] = new Jenssegers\Blade\Blade(VIEWS_PATH, VIEWS_PATH.'cache');        
    $html = $GLOBALS['blade']->render($tpl, $data);
    echo $html;
}

//------------------------------------------------------------------------------

// usage: getenv('VAR_NAME');
function load_env_file( $filepath = '.env' ){
    if( !is_file($filepath) ) die('Error - cannot load env file');
    $lines = file($filepath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue; // ignore comments
        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);
        $value = trim($value,'"');
        if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
            putenv(sprintf('%s=%s', $name, $value));
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
        }
    }
}

//------------------------------------------------------------------------------
// HELPER FUNCTIONS
//------------------------------------------------------------------------------

function slugify( $str ) {
	$str = str_replace(array('æ','ø','å'), array('ae','oe','aa'),$str);
	$str = preg_replace("/[^ \w]+/", "", $str);
	$str = strtolower($str);
	$str = str_replace(' ','-',$str);
	return $str;
}

//------------------------------------------------------------------------------

function is_https() {
    if( !empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ) return TRUE;
    if( isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' ) return TRUE;
    if( !empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off' ) return TRUE;
    return FALSE;
} 

//------------------------------------------------------------------------------

// used to secure HTTPS for live API endpoint calls
function require_https(){
	//if( !is_production() ) return;
	if( is_production() && !is_https() ) json_output(400, [ 'error'=>'Secure HTTPS connection required.' ]);	
}

//------------------------------------------------------------------------------

// this is an extremely simple login setup.
// There is only one user, and we are actually only checking the password
// if you want a bigger authentication setup you can extend this to your needs :)

function is_logged_in(){
    return ( !empty($_COOKIE['x98727']) && $_COOKIE['x98727'] == 'u927360' );
}


//------------------------------------------------------------------------------

function get_access_token(){ return 'token_4ghj5k2jg3'; } // this token is used to validate secured api calls. is granted on login

function require_access_token(){
	//if( !is_production() ) return;
	$input = input();
	if( empty($input->access_token) || $input->access_token !== get_access_token() ) json_output(400, [ 'error'=>'Valid access token required.' ]);	
}

function validate_access_token_cookie(){
	$valid = ( isset($_COOKIE['access_token']) && $_COOKIE['access_token'] === get_access_token() );
	return $valid;
}

function needs($needs){
	foreach ( $needs as $need ) {
		if( $need === 'https' ) require_https();
		if( $need === 'access_token' ) require_access_token();
	}
}

function require_https_and_access_token(){
	require_https();
	require_access_token();
}

//------------------------------------------------------------------------------

// will redirect and stop execution, can accept a full URL or just the part after base_url()/
function redirect($to) {
    if( strpos($to,'http') === -1 ) $to = base_url().$to;
    header('location: '.base_url().$to);
    die();
}

//------------------------------------------------------------------------------

function db(){    
    if( isset($GLOBALS['db']) ) return $GLOBALS['db'];
    $db = new \Buki\Pdox([ 'driver'=>'mysql','host'=>getenv('DB_HOST'),'database'=>getenv('DB_DATABASE'),'username'=>getenv('DB_USER'),'password'=>getenv('DB_PASS'), 'charset'=>'utf8', 'collation'=>'utf8_general_ci', 'prefix'=>(getenv('DB_PREFIX')||'') ]);
    $GLOBALS['db'] = $db;
    return $db;
}

//------------------------------------------------------------------------------

function app_init( $config = [] ){
    global $cms_content, $url_route;
    $config = (object) $config;
    $GLOBALS['url_route'] = $url_route;    
    if(is_file(HELPERS_PATH)) require_once(HELPERS_PATH);
    load_env_file(ENV_PATH);
    $url_route = get_route_path();
    router_init();    
}

//------------------------------------------------------------------------------
