<?


// TEUX DEUX


class PaixApp {
  
/****************/
  
  public function __construct($config) {

    $this->loadConfig($config);
    $this->loadGlobalController();

    $this->loadClasses();
    
    $this->checkHTTPS();
    $this->setErrorLogging();
    $this->initDatabase();
    $this->importJSONData();
    
    $this->getRouteInput();    
    
    $this->getController();
    
    $this->getView();
    $this->setViewAssets();
    $this->buildHTML();

  }
  
/****************/

  private function loadConfig($config) {
    foreach ( $config as $key => $val ) $this->{$key} = $val;
  }
  
/****************/

  // load in all the classes needed
  private function loadClasses() {
    foreach (glob($this->paths['classes']) as $classfile) require_once($classfile);  
    $this->runGlobalControllerEvent('_classesLoaded');
  }  

/****************/

  // requires the global controller file and fires its _before function
  private function loadGlobalController() {
    $controller_path = str_replace('*', '_global', $this->paths['controllers']);
    if( is_file($controller_path) ) require_once($controller_path);    
    $this->runGlobalControllerEvent('_init');
  }

/****************/

  private function runGlobalControllerEvent($event) {
    if( function_exists($event) ) call_user_func_array($event, array($this));
  }

/****************/

  // find out the base dir name of the project
  // getting the URL input that's feeding the router
  private function getRouteInput() {
    
    $this->route = new stdClass;
    
    $basedir = explode('/', $this->url);
    $basedir = end($basedir);
  
    if( $_SERVER['REQUEST_URI'] == '/' ) {
      $this->route->input = array();
      $this->route->input_raw = '';
    } else {
      $input = explode($basedir, $_SERVER['REQUEST_URI']);
      $input = end($input);
      
      $this->route->input_raw = trim($input,'/'); 
      
      $input = explode('/', $input);
      array_shift($input);
      $input = array_filter($input);
      
      $this->route->input = $input; 
    }
        
  }

/****************/
  
  private function checkHTTPS() {
    $url = $this->url;
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
        $this->url         = 'https://'.$url;
        $this->url_http    = 'http://'.$url;
    } else {
      $this->url           = 'http://'.$url;
      $this->url_https     = 'https://'.$url;
    }
  }
  

/****************/

  private function setErrorLogging() {

    if( $this->dev_mode ) {
      error_reporting(E_ALL);
      ini_set('display_errors','On');
    } else {
      error_reporting(0);
      ini_set('display_errors','Off');
      ini_set('log_errors', 'On');
      ini_set("error_log", "errors.log");
    }
  }
  
/****************/
  
  private function initDatabase() {
    if( empty($this->database['host']) ) {
      unset($this->database); //cleanup
      return;
    }
    
    global $db;
    $db = new MysqliDb($this->database['host'], $this->database['username'], $this->database['password'], $this->database['database']);
    if( $this->database['table_prefix'] ) {
      $db->setPrefix($this->database['table_prefix']);
    }
    unset($this->database); //cleanup
    $this->runGlobalControllerEvent('_databaseInitialised');
  }
  
/****************/
  
  private function importJSONData() {
    $json_files = glob($this->paths['json']);
    if( !empty($json_files) ) {
      foreach ( $json_files as $json_file) $json_data[basename($json_file,'.json')] = json_decode(file_get_contents($json_file));
      if(isset($json_data)) $this->json = $json_data;
      $this->runGlobalControllerEvent('_jsonLoaded');
    }    
    unset($this->paths['json']); //cleanup
  }

/****************/
  
  private function getController() {
    
    $this->runGlobalControllerEvent('_beforeController');
    
    $this->route->title = $this->route->view = $this->route->controller = '404';
    
    foreach( $this->routes as $route => $controller ) {  // for each controller route
        
        $route = str_replace( ':NUM:',     '[0-9]+',       $route  );
        $route = str_replace( ':STR:',     '[a-z-_]+',     $route  );
        $route = str_replace( ':NUMSTR:',  '[0-9a-z-_]+',  $route  );
        $route = str_replace( ':STRNUM:',  '[0-9a-z-_]+',  $route  );
        $route = str_replace( '*',         '.+',           $route  );
        
        if( preg_match( '~^'.$route.'$~', $this->route->input_raw ) ) {
          $this->route->title = $this->route->view = $this->route->controller = $controller;
          break;
        }
      
    } // for each controller route
    
    unset($this->routes); // cleanup
    
    
    $controllerfile = str_replace('*', $this->route->controller, $this->paths['controllers']);
    $viewfile = str_replace('*', $this->route->view, $this->paths['views']);    
    
    if( !is_file($controllerfile) ) {
      
      $this->route->title = $this->route->view = $this->route->controller = '404';
      $controllerfile = str_replace('*', $this->route->controller, $this->paths['controllers']);
      $viewfile = str_replace('*', $this->route->view, $this->paths['views']);    
      
    }
    
    require_once($controllerfile);
    
    $this->runGlobalControllerEvent('_afterController');
        
  }
  
/****************/
  
  private function getView() {
    
    $viewfile = str_replace('*', $this->route->view, $this->paths['views']);    
    
    if( !is_file($viewfile) ) {
      $this->route->view = 404;
    } else {
      
    }

  }

/****************/

  private function setViewAssets() {
    
    $css_path = str_replace('*', $this->route->view, $this->paths['css']);
    $js_path = str_replace('*', $this->route->view, $this->paths['js']);
    
    if( is_file($css_path) ) $this->route->css = '<link href="'.$this->url.'/'.$css_path.'" rel="stylesheet">';
    if( is_file($js_path) ) $this->route->js = '<script type="text/javascript" src="'.$this->url.'/'.$js_path.'"></script>';
        
  }
  
/****************/

  private function buildHTML() {
    
    $this->runGlobalControllerEvent('_beforeRender');
    
    $viewfile = str_replace('*', $this->route->view, $this->paths['views']);
    
    //clean central object before printing
    unset($this->paths);
    unset($this->database);
    unset($this->routes);
    if( isset($this->json) ){
      $json = $this->json; unset($this->json); $this->json = $json; // moving json underneath route :) Visual nicification.  
    }  
    
    // tpl engine setting
    $tpl_engine = 'php'; if( isset($this->tpl_engine) ) { $tpl_engine = $this->tpl_engine; unset($this->tpl_engine); }
    
    // tpl rending
    if( $tpl_engine == 'smarty' ) { // smarty templating
      global $templating_engine;
      $templating_engine = new Smarty();
      $templating_engine->setTemplateDir('views')->setCompileDir('views/_compiled')->assign('this', $this);
      $templating_engine->display( $viewfile );
    } else { // php templating
      require_once($viewfile);
    }
    $this->runGlobalControllerEvent('_afterRender');
  }

/****************/
  
}

