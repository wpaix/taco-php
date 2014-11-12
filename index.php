<?
  
  $config =               array(
    'dev_mode'            => true,    // Is the project under development or ready to deploy? Helps you remember Google Analytics, and similar deploy tasks.
    'url'                 => 'www.dk-udvikler.dk/demo/PROJECTBASE/mvc_paix',    // Absolute URL of the project.  NO trailing / and NO http:// or https://, plz.
    'title'               => 'Project',   // The title. Used for dynamic html titles.
    'system_title'        => 'project',   // Lowercase, letter/number version of the project title. For the computer to eat.
    'version'             => 0.1,   // Not really used? But nice to have.
    'tpl_engine'          => 'smarty',
  );
  
    
  $config['routes'] = array( // url/route => 'controller' - :NUM: :STR: :NUMSTR:/:STRNUM: wildcards for numbers and/or string characters [a-z-_]. * wildcard for anything following. The corresponding object determines controller, baseview, subview in that order. Goes from top to botton and stops on any match, so ordering is important.
    ''                                  =>  'home',
    'products'                          =>  'products',
    'product/:NUM:'                     =>  'product',
    'yolo'                              =>  'yolo',
  );
  
  
  $config['paths'] =      array(   // Where to look for stuff?
    'classes'             => 'classes/*.class.php',
    'controllers'         => 'controllers/*.php',
    'views'               => 'views/*.html',
    'json'                => 'json/*.json',
    'css'                 => 'assets/css/_*.css',
    'js'                  => 'assets/js/_*.js'
  );
  
  
  $config['database'] =   array(   // Are we gonna hook up to a MySQL Database?
    'host'                => '',
    'username'            => '',
    'password'            => '',
    'database'            => '',
    'table_prefix'        => ''
  );
  
  
  ///////////////////////////////////////////////////
  
  // let's rock 'n' roll
  require_once('classes/PaixApp.class.php');
  $app = new PaixApp($config);
  
  
  