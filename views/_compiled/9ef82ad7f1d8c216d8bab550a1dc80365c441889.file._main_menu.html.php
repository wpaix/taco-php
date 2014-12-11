<?php /* Smarty version Smarty-3.1.19, created on 2014-09-30 13:36:11
         compiled from "views/_main_menu.html" */ ?>
<?php /*%%SmartyHeaderCode:15638130675429cb5bbf2557-48855810%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9ef82ad7f1d8c216d8bab550a1dc80365c441889' => 
    array (
      0 => 'views/_main_menu.html',
      1 => 1412076969,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15638130675429cb5bbf2557-48855810',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5429cb5bc64191_73991577',
  'variables' => 
  array (
    'this' => 0,
    'item' => 0,
    'p' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5429cb5bc64191_73991577')) {function content_5429cb5bc64191_73991577($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/dkudvikl/public_html/demo/PROJECTBASE/mvc_paix/classes/smarty/plugins/modifier.capitalize.php';
?>

<p>
  <a href="<?php echo $_smarty_tpl->tpl_vars['this']->value->url;?>
/">Home</a>
</p>

<p>
  <a href="<?php echo $_smarty_tpl->tpl_vars['this']->value->url;?>
/users">Users</a>
</p>

<p>
  <a href="<?php echo $_smarty_tpl->tpl_vars['this']->value->url;?>
/info">Info</a>
</p>

<p>
  <a href="<?php echo $_smarty_tpl->tpl_vars['this']->value->url;?>
/somethingnotthere">Broken link</a>
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
    <?php echo $_smarty_tpl->tpl_vars['this']->value->router->controller;?>

  </p>
  
  <p>
    <b>Controller action:</b><br />
    <?php if (isset($_smarty_tpl->tpl_vars['this']->value->router->action)) {?>
    
      <?php if (isset($_smarty_tpl->tpl_vars['this']->value->router->parameters)) {?>
        <?php echo $_smarty_tpl->tpl_vars['this']->value->router->action;?>
( <?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['this']->value->router->parameters; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['p']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['p']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->_loop = true;
 $_smarty_tpl->tpl_vars['p']->iteration++;
 $_smarty_tpl->tpl_vars['p']->last = $_smarty_tpl->tpl_vars['p']->iteration === $_smarty_tpl->tpl_vars['p']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['last'] = $_smarty_tpl->tpl_vars['p']->last;
?><?php echo $_smarty_tpl->tpl_vars['p']->value;?>
<?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['foo']['last']) {?>, <?php }?> <?php } ?> );
      <?php } else { ?>
        <?php echo $_smarty_tpl->tpl_vars['this']->value->router->action;?>
();
      <?php }?>
        
    <?php } else { ?>
      -
    <?php }?>
  </p>
  
  <p>
    <b>View:</b><br />
    <?php echo $_smarty_tpl->tpl_vars['this']->value->controller->view;?>

  </p>
  
  
  <p>
    <b><?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['this']->value->controller->view);?>
 CSS asset:</b><br />
    <?php if ($_smarty_tpl->tpl_vars['this']->value->view->css) {?>Yes<?php } else { ?>No<?php }?>
  </p>
  
  <p>
    <b><?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['this']->value->controller->view);?>
 JS asset:</b><br />
    <?php if ($_smarty_tpl->tpl_vars['this']->value->view->js) {?>Yes<?php } else { ?>No<?php }?>
  </p>
  
</div><?php }} ?>
