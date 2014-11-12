<?php /* Smarty version Smarty-3.1.19, created on 2014-10-13 16:48:29
         compiled from "views/products.html" */ ?>
<?php /*%%SmartyHeaderCode:6567824845437ea25c3a498-20202614%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'db6740dfbfc4cdc739be32dfbb65aa9be2e328c7' => 
    array (
      0 => 'views/products.html',
      1 => 1413211704,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6567824845437ea25c3a498-20202614',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5437ea25c68aa8_21991429',
  'variables' => 
  array (
    'this' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5437ea25c68aa8_21991429')) {function content_5437ea25c68aa8_21991429($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('_header.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<h1>Products</h1>

<p><a href="<?php echo $_smarty_tpl->tpl_vars['this']->value->url;?>
/product/135">Product #135</a></p>
<p><a href="<?php echo $_smarty_tpl->tpl_vars['this']->value->url;?>
/product/547">Product #547</a></p>
<p><a href="<?php echo $_smarty_tpl->tpl_vars['this']->value->url;?>
/product/762">Product #762</a></p>

<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero mollitia necessitatibus officiis molestiae recusandae placeat molestias itaque architecto ipsa amet distinctio nihil aliquam autem veniam maiores minus quisquam vel facilis.</p>

<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi id molestias dolor aliquid neque impedit at quam aliquam! Neque illo laborum soluta ratione consectetur atque assumenda veritatis facere. Dolores ratione. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit consequatur eaque dicta fugit officiis assumenda optio necessitatibus ipsum modi delectus repudiandae neque sequi laborum dolores aperiam deleniti illo explicabo voluptatem.</p>

<?php echo $_smarty_tpl->getSubTemplate ('_footer.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
<?php }} ?>
