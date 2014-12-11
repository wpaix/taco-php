<?php /* Smarty version Smarty-3.1.19, created on 2014-09-30 18:51:51
         compiled from "views/main.html" */ ?>
<?php /*%%SmartyHeaderCode:12111845825429cb5bb83045-74307118%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4f82db8a3317e130a7f697c79e63b0bc6343f34c' => 
    array (
      0 => 'views/main.html',
      1 => 1412080386,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12111845825429cb5bb83045-74307118',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5429cb5bbed047_71613515',
  'variables' => 
  array (
    'this' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5429cb5bbed047_71613515')) {function content_5429cb5bbed047_71613515($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo (($tmp = @$_smarty_tpl->tpl_vars['this']->value->page_title)===null||$tmp==='' ? $_smarty_tpl->tpl_vars['this']->value->project_title : $tmp);?>
 <?php if ($_smarty_tpl->tpl_vars['this']->value->development) {?>(DEV)<?php }?></title>
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
      <?php echo $_smarty_tpl->getSubTemplate ('_main_menu.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    </div>
  
    <div id="mainarea">
      <?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['this']->value->view->path, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    </div>  
    
  
  
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['this']->value->url;?>
/assets/js/main.js"></script>
<?php echo $_smarty_tpl->tpl_vars['this']->value->view->js;?>


<?php if (!$_smarty_tpl->tpl_vars['this']->value->development) {?><script>alert("Insert Google Analytics tracking, plz.");</script><?php }?>

</body>
</html>

<?php if ($_smarty_tpl->tpl_vars['this']->value->development) {?>
<!-- <?php echo print_r($_smarty_tpl->tpl_vars['this']->value);?>
 -->
<?php }?><?php }} ?>
