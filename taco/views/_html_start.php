<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Taco PHP</title>
	<meta name="robots" content="noindex">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimal-ui, viewport-fit=cover, maximum-scale=1.0, user-scalable=0">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600&display=swap" rel="stylesheet"> 

    <link rel="stylesheet" href="<?=base_url()?>assets/css/main.css?<?=filemtime('assets/css/main.css')?>">
    <?php if( is_production() ): ?>
		<?php // Analytics, tracking, scripts, etc  ?>    
    <?php endif; ?>
</head>
<body class="<?=body_cls_str()?>">

<div class="header">
    <div class="corset">
		<div class="menu">
			<a class="<?=(is_route_path(''))?'current':'';?>" href="<?=base_url()?>">Home</a>
			<a class="<?=(is_route_param(0,'page2'))?'current':'';?>" href="<?=base_url()?>page2">Page 2</a>
			<?php if(!is_logged_in()): ?>
				<a class="<?=(is_route_path('login'))?'current':'';?>" href="<?=base_url()?>login">Login</a>
			<?php endif; ?>
			<?php if(is_logged_in()): ?>
				<a class="<?=(is_route_path('admin'))?'current':'';?>" href="<?=base_url()?>admin">Admin</a>
				<a class="" href="<?=base_url()?>logout">Log out</a>
			<?php endif; ?>
		</div>
	</div>
</div>


