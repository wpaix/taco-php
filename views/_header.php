<!DOCTYPE html>
<html lang="en">
<head>
    <title><? if(isset($this->route->title)) { echo $this->route->title.' | '.$this->title; } else { echo $this->title; } ?><? if( $this->dev_mode ) { echo ' (DEV MODE)'; } ?></title>
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="-1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">    
    <meta name="apple-mobile-web-app-title" content="First Edition">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="HandheldFriendly" content="True">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="cleartype" content="on">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />		
    <link rel="shortcut icon" href="<?= $this->url ?>/favicon.ico">
    <link href="<?= $this->url ?>/assets/css/main.css" rel="stylesheet">
    <?php if(!empty($this->route->css_libraries)) { echo $this->route->css_libraries; } ?>
    <? if(file_exists('assets/css/view/'.$this->route->view.'.css')) { echo '<link href="'.$this->url.'/assets/css/view/'.$this->route->view.'.css" rel="stylesheet">'; } ?>
    
</head>
<body>

  
    <div id="sidebar">
      <? include '_sidebar.php' ?>
    </div>
  
    <div id="mainarea">
