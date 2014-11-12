<?php /* Smarty version Smarty-3.1.19, created on 2014-10-13 15:50:47
         compiled from "views/_footer.html" */ ?>
<?php /*%%SmartyHeaderCode:14265175495437dee9036990-58632286%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a7a903f49564ad7a98b42f85e9de2f9070b55269' => 
    array (
      0 => 'views/_footer.html',
      1 => 1413208246,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14265175495437dee9036990-58632286',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5437dee9065ff5_00885959',
  'variables' => 
  array (
    'this' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5437dee9065ff5_00885959')) {function content_5437dee9065ff5_00885959($_smarty_tpl) {?>
    </div> <!-- #mainarea -->
    
  
  
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['this']->value->url;?>
/assets/js/main.js"></script>
<?php echo (($tmp = @$_smarty_tpl->tpl_vars['this']->value->route->js)===null||$tmp==='' ? '' : $tmp);?>


<?php if (!$_smarty_tpl->tpl_vars['this']->value->dev_mode) {?><script>alert("Insert Google Analytics tracking, plz.");</script><?php }?>

</body>
</html>

<?php if ($_smarty_tpl->tpl_vars['this']->value->dev_mode) {?>
<!-- <?php echo print_r($_smarty_tpl->tpl_vars['this']->value);?>
 -->
<?php }?><?php }} ?>
