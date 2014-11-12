<?php /* Smarty version Smarty-3.1.19, created on 2014-10-10 16:08:24
         compiled from "views/_header.html" */ ?>
<?php /*%%SmartyHeaderCode:1385740685437dec1579b05-16581789%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0ebf9236ec0a489e26740242f5408bb4aac532d2' => 
    array (
      0 => 'views/_header.html',
      1 => 1412950090,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1385740685437dec1579b05-16581789',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5437dec18a9106_80443462',
  'variables' => 
  array (
    'this' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5437dec18a9106_80443462')) {function content_5437dec18a9106_80443462($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
<head>
    <title><?php if (isset($_smarty_tpl->tpl_vars['this']->value->route->title)) {?><?php echo $_smarty_tpl->tpl_vars['this']->value->route->title;?>
 | <?php echo $_smarty_tpl->tpl_vars['this']->value->title;?>
<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['this']->value->title;?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['this']->value->dev_mode) {?> (DEV MODE)<?php }?></title>
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
    <link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['this']->value->url;?>
/favicon.ico">
    <link href="<?php echo $_smarty_tpl->tpl_vars['this']->value->url;?>
/assets/css/main.css" rel="stylesheet">
    <?php echo (($tmp = @$_smarty_tpl->tpl_vars['this']->value->route->css)===null||$tmp==='' ? '' : $tmp);?>

</head>
<body>

  
    <div id="sidebar">
      <?php echo $_smarty_tpl->getSubTemplate ('_sidebar.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    </div>
  
    <div id="mainarea">
<?php }} ?>
