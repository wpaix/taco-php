<?php /* Smarty version Smarty-3.1.19, created on 2014-10-06 14:28:20
         compiled from "views/index_sidebar.html" */ ?>
<?php /*%%SmartyHeaderCode:1754354618542b3669e6b5d6-89086534%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'eb9a3bf9a06344cb21e1c4facbad4413ba291df0' => 
    array (
      0 => 'views/index_sidebar.html',
      1 => 1412598499,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1754354618542b3669e6b5d6-89086534',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_542b3669ebf189_78382719',
  'variables' => 
  array (
    'this' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_542b3669ebf189_78382719')) {function content_542b3669ebf189_78382719($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/dkudvikl/public_html/demo/PROJECTBASE/mvc_paix/classes/smarty/plugins/modifier.capitalize.php';
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
 $_from = $_smarty_tpl->tpl_vars['this']->value->router->input; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
?>
      <?php echo $_smarty_tpl->tpl_vars['item']->value;?>
, 
    <?php } ?>
  </p>
  
  
  <p>
    <b>Controller:</b><br />
    <?php echo $_smarty_tpl->tpl_vars['this']->value->controller->name;?>

  </p>
    
  <p>
    <b>View:</b><br />
    <?php echo $_smarty_tpl->tpl_vars['this']->value->view->name;?>

  </p>
  
  
  <p>
    <b><?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['this']->value->view->name);?>
 CSS asset:</b><br />
    <?php if ($_smarty_tpl->tpl_vars['this']->value->view->css) {?>Yes<?php } else { ?>No<?php }?>
  </p>
  
  <p>
    <b><?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['this']->value->view->name);?>
 JS asset:</b><br />
    <?php if ($_smarty_tpl->tpl_vars['this']->value->view->js) {?>Yes<?php } else { ?>No<?php }?>
  </p>
  
</div><?php }} ?>
