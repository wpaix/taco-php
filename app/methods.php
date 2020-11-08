<?php
//----------------------------------------------------------------------
// PROJECT METHODS
//----------------------------------------------------------------------

function get_client_projects( $client_slug ){
	global $config;
	$projects = [];
	$fn = app_root().'../'.$config['db_json_folder'].'/'.$client_slug.'/project--*.json';
	$files = glob($fn);
	foreach($files as $f) {
		$json = file_get_contents($f);
		$project = json_decode($json);
		$projects[] = $project;
	}
	return $projects;
}

function get_all_clients(){
	global $config;
	$clients = [];
	$fn = app_root().'../'.$config['db_json_folder'].'/*/client--*.json';
	$files = glob($fn);
	foreach( $files as $f ){
		$json = file_get_contents($f);
		$client = json_decode($json);
		$clients[] = $client;
	}
	return $clients;
}

function get_client( $client_slug ){
	global $config;
	$fn = app_root().'../'.$config['db_json_folder'].'/'.$client_slug.'/client--'.$client_slug.'.json';
	if( !is_file($fn) ) return;
	$json = file_get_contents($fn);
	$client = json_decode($json);
	return $client;
}

function get_project( $client_slug, $project_slug ){
	global $config;
	$fn = app_root().'../'.$config['db_json_folder'].'/'.$client_slug.'/project--'.$project_slug.'.json';
	if( !is_file($fn) ) return;
	$json = file_get_contents($fn);
	$project = json_decode($json);
	return $project;
}

function get_timelogs_hours_total($timelogs){
	$total = 0;
	foreach( $timelogs as $t ) {
		$total += 1; // DUMMY
	}
	return $total;
}

function get_project_hour_rate($project, $client) {
	if( isset($project->hour_rate) ) return $project->hour_rate;
	return $client->hour_rate;
}

function get_project_color($project, $client) {
	if( isset($project->color) ) return $project->color;
	return $client->color;
}

function get_timelogs_dkk_total($project, $client){
	$hr = get_project_hour_rate($project, $client);
	$hrs = get_timelogs_hours_total($project->timelogs);
	return $hr * $hrs;
}

function prevent_public_access(){
	if( !verify_password() ) go_to('/login');
}

function go_to($where){
	header('location: '.$where);
	die();
}

function verify_password( $password = NULL ){
	if( !$password ) $password = $_COOKIE['xk23gj4'];
	if( $password === 'milkmoney' ) return true; // milk master
	if( get_client_by_password($password) ) return true;
	return false;
}

function get_client_by_password( $password = NULL ){
	if( !$password ) $password = $_COOKIE['xk23gj4'];
	if( $password === 'milkmoney' ) return 'milk';
	$clients = get_all_clients();
	foreach( $clients as $c ) if($c->xk23gj4 === $password) return $c;
}

function logged_in_as_name(){
	$u = get_client_by_password();
	if( $u === 'milk' ) return 'Milk';
	return $u->name;
}

function slugify( $str ) {
	$str = str_replace(array('æ','ø','å'), array('ae','oe','aa'),$str);
	$str = preg_replace("/[^ \w]+/", "", $str);
	$str = strtolower($str);
	$str = str_replace(' ','-',$str);
	return $str;
}

function save_client($client){
	global $config;
	objectify($client);	
	$f = app_root().'../'.$config['db_json_folder'];
	if( !is_dir($f) ) mkdir($f);
	$dir = $f.'/'.$client->slug;
	if( !is_dir($dir) ) mkdir($dir);

	$json = json_encode($client);
	$fn = $f.'/'.$client->slug.'/client--'.$client->slug.'.json';
	file_put_contents($fn,$json);
	return true;
}

function save_project($project){
	global $config;
	objectify($project);
	$project->timelogs = [];
	$f = app_root().'../'.$config['db_json_folder'];
	$json = json_encode($project);
	$fn = $f.'/'.$project->client_slug.'/project--'.$project->slug.'.json';
	file_put_contents($fn,$json);
	return true;
}

function adx(){
	return 'style="animation-delay:'.rand(0,1500).'ms;"';
}

//----------------------------------------------------------------------
// APP METHODS
//----------------------------------------------------------------------

function get_route_path(){ $p = trim( $_SERVER['REQUEST_URI'], '/' ); $p = explode('?',$p)[0]; return $p; }
function get_route_params(){ return explode('/',get_route_path()); }
function get_route_param( $slot = 0 ){ $p = get_route_params(); if(isset($p[$slot])) return $p[$slot]; }
function router_init($ur = '/', $routes) {    
	foreach( $routes as $r => $c ) { 
		$r = str_replace( ['(:num)','(:str)','(:any)','*'], ['[0-9]+','[a-z-_]+','[0-9a-z-_]+','.+'], $r );
		$match = preg_match( '~^'.$r.'$~', $ur );			
		if( $match && is_string($c) && is_file(module_path($c)) ) return require module_path($c);
		if( $match && is_callable($c) ) return $c();
	}
	require module_path($routes['error_404']);
}

function objectify( &$d ){ if( !is_object($d) ) $d = (Object) $d; }
function dd($input){ echo '<pre>';print_r($input); die(); }

function app_root(){
	global $config;
	if( isset($config['root_path']) ) return $config['root_path'];
	return '';
}

function module_path($namepath){ return app_root().$namepath.'.php'; } // use like so: require module_path('something)
function view($viewpath){ return module_path($viewpath); } // syntactic sugar used to load: require view('something)
function controller($controllerpath){ return module_path($controllerpath); } // syntactic sugar used to load: require controller('something)

function baseurl($subpath = ''){
	if( isset($_ENV['BASEURL']) ) return $_ENV['BASEURL'];
	global $config; return $config['baseurl'].$subpath;
}

function input( $type = 'any' ) {
	if( $type == 'get' ) return (object) $_GET;
	if( $type == 'post' ) return (object) $_POST;
	if( $type == 'any' ) {
		$input = $_GET;
		if( empty($input) ) $input = $_POST;
		return (object) $input;
	}
}

function output( $http_code = 200, $data = NULL ){
	http_response_code($http_code);
	header('Content-Type: application/json');
	header('Access-Control-Allow-Origin: *');	
	header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, OPTIONS');	
	if( !empty($data) ) echo json_encode((object)[ 'data' => $data ]);
	die();
}

// requires composer loaded with package envms/fluentpdo as well as env_vars below loaded and defined
function db(){	
	// save the db object somwehre global so it is not built on every call
	return new \Envms\FluentPDO\Query($db_pdo);
}

function pdo(){
	$DB_HOST = getenv('DB_HOST'); // or config file
	$DB_NAME = getenv('DB_NAME');
	$DB_USER = getenv('DB_USER');
	$DB_PASSWORD = getenv('DB_PASSWORD');
	if( empty($DB_HOST) || empty($DB_NAME) || empty($DB_USER) || empty($DB_PASSWORD) ) return;
	// save the pdo object somwehre global so it is not built on every call
	$pdo = new PDO('mysql:host='.$DB_HOST.';dbname='.$DB_NAME, $DB_USER, $DB_PASSWORD);
	return $pdo;
}

function app_init(){
	global $config;
	if( !empty($load_composer) ) require_once $load_composer;
	if( !empty($load_env_vars) ) { $dotenv = Dotenv\Dotenv::createImmutable(__DIR__,$load_env_vars); $dotenv->load(); }
	if( $config['show_errors'] ) { ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL); }
	else { ini_set('display_errors', 0); ini_set('display_startup_errors', 0); error_reporting(0); }
	router_init(get_route_path(), $config['routes']);
}

//----------------------------------------------------------------------