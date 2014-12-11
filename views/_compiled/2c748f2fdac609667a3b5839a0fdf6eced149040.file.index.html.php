<?php /* Smarty version Smarty-3.1.19, created on 2014-10-01 01:14:50
         compiled from "views/index.html" */ ?>
<?php /*%%SmartyHeaderCode:2034069665542b307023b222-65563234%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2c748f2fdac609667a3b5839a0fdf6eced149040' => 
    array (
      0 => 'views/index.html',
      1 => 1412118886,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2034069665542b307023b222-65563234',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_542b3070296101_46761908',
  'variables' => 
  array (
    'this' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_542b3070296101_46761908')) {function content_542b3070296101_46761908($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
<head>
    <title><?php if (isset($_smarty_tpl->tpl_vars['this']->value->controller->title)) {?><?php echo $_smarty_tpl->tpl_vars['this']->value->controller->title;?>
 | <?php echo $_smarty_tpl->tpl_vars['this']->value->config->title;?>
<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['this']->value->config->title;?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['this']->value->config->dev_mode) {?> (DEV MODE)<?php }?></title>
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
    <?php echo $_smarty_tpl->tpl_vars['this']->value->view->css;?>

</head>
<body>

  
    <div id="sidebar">
      <?php echo $_smarty_tpl->getSubTemplate ('index_sidebar.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    </div>
  
    <div id="mainarea">
      <?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['this']->value->view->filename, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    </div>  
    
  
  
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['this']->value->config->url;?>
/assets/js/main.js"></script>
<?php echo $_smarty_tpl->tpl_vars['this']->value->view->js;?>


<?php if (!$_smarty_tpl->tpl_vars['this']->value->config->dev_mode) {?><script>alert("Insert Google Analytics tracking, plz.");</script><?php }?>

</body>
</html>

<?php if ($_smarty_tpl->tpl_vars['this']->value->config->dev_mode) {?>
<!-- <?php echo print_r($_smarty_tpl->tpl_vars['this']->value);?>
 -->
<?php }?><?php }} ?>
