<?php /* Smarty version Smarty-3.1.19, created on 2014-10-10 16:25:45
         compiled from "views/_sidebar.html" */ ?>
<?php /*%%SmartyHeaderCode:11197705515437dee8d4b534-55793069%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '23c069adc6825c0e352676d60749c2a347aa40ec' => 
    array (
      0 => 'views/_sidebar.html',
      1 => 1412951144,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11197705515437dee8d4b534-55793069',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5437dee9032f01_37063770',
  'variables' => 
  array (
    'this' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5437dee9032f01_37063770')) {function content_5437dee9032f01_37063770($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/dkudvikl/public_html/demo/PROJECTBASE/mvc_paix/classes/smarty/plugins/modifier.capitalize.php';
?>

<p>
  <a href="<?php echo $_smarty_tpl->tpl_vars['this']->value->url;?>
/">Hello</a>
</p>

<p>
  <a href="<?php echo $_smarty_tpl->tpl_vars['this']->value->url;?>
/products">Products</a>
</p>

<p>
  <a href="<?php echo $_smarty_tpl->tpl_vars['this']->value->url;?>
/brokenlink">Broken link</a>
</p>


<div id="console">
  
  <p>
    <b>Router input:</b><br />
    <?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['this']->value->route->input; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
      <?php echo $_smarty_tpl->tpl_vars['item']->value;?>
, 
    <?php } ?>
  </p>
  
  
  <p>
    <b>Controller:</b><br />
    <?php echo $_smarty_tpl->tpl_vars['this']->value->route->controller;?>

  </p>
    
  <p>
    <b>View:</b><br />
    <?php echo $_smarty_tpl->tpl_vars['this']->value->route->view;?>

  </p>
  
  
  <p>
    <b><?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['this']->value->route->view);?>
 CSS asset:</b><br />
    <?php if (isset($_smarty_tpl->tpl_vars['this']->value->route->css)) {?>Yes<?php } else { ?>No<?php }?>
  </p>
  
  <p>
    <b><?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['this']->value->route->view);?>
 JS asset:</b><br />
    <?php if (isset($_smarty_tpl->tpl_vars['this']->value->route->js)) {?>Yes<?php } else { ?>No<?php }?>
  </p>
  
</div><?php }} ?>
