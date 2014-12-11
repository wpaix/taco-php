<?  // Global functions, loaded regardless of route/controller


/**********************/

  function _init($this) { // app event hookup
    session_start();
    date_default_timezone_set('Europe/Copenhagen');
    setlocale(LC_TIME, 'da_DK'); 
    
  }

/**********************/

  function _classesLoaded($this) { // app event hookup

  }

/**********************/  
  
  function _databaseInitialised($this) { // app event hookup

  }
  
/**********************/  
  
  function _jsonLoaded($this) { // app event hookup

  }


/**********************/  
  
  function _beforeController($this) { // app event hookup
    
  }
  
/**********************/
  
  function _afterController($this) { // app event hookup
    
  }
  
/**********************/


  function _beforeRender($this) { // app event hookup
    
  }
  
/**********************/
  
  function _afterRender($this) { // app event hookup
    
  }
  
/**********************/