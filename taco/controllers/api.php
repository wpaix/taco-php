<?php defined('TACO') or die('Not allowed');

//------------------------------------------------------------------------------
    
function controller_api_index() {
    json_output(200, [
        'message' => 'API saying hello world! =)',
    ]);
}

//------------------------------------------------------------------------------
