<?php /* Smarty version Smarty-3.1.19, created on 2014-10-10 16:25:18
         compiled from "views/product.html" */ ?>
<?php /*%%SmartyHeaderCode:2231310055437eb8d232338-89876414%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '01eb1f3f41bfa3630ebbc106675506c0995ed4bd' => 
    array (
      0 => 'views/product.html',
      1 => 1412951118,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2231310055437eb8d232338-89876414',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5437eb8d265139_09904043',
  'variables' => 
  array (
    'this' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5437eb8d265139_09904043')) {function content_5437eb8d265139_09904043($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('_header.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<h1>Product <?php echo $_smarty_tpl->tpl_vars['this']->value->route->input[1];?>
</h1>

<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero mollitia necessitatibus officiis molestiae recusandae placeat molestias itaque architecto ipsa amet distinctio nihil aliquam autem veniam maiores minus quisquam vel facilis.</p>

<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi id molestias dolor aliquid neque impedit at quam aliquam! Neque illo laborum soluta ratione consectetur atque assumenda veritatis facere. Dolores ratione. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit consequatur eaque dicta fugit officiis assumenda optio necessitatibus ipsum modi delectus repudiandae neque sequi laborum dolores aperiam deleniti illo explicabo voluptatem.</p>

<?php echo $_smarty_tpl->getSubTemplate ('_footer.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
