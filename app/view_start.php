<html lang="da">
<head>

    <title>Taco PHP</title>
    <meta charset="utf-8">
    
    <meta name="format-detection" content="telephone=no" />
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height, target-densitydpi=device-dpi" />
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta http-equiv="cleartype" content="on">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    

	<link rel="stylesheet" href="<?=baseurl()?>/main.css" type="text/css" media="all" />

</head>
<body>
	
<div id="app">

    <div id="header">

        <div class="headerlogoicon">
            <?php include 'img/milk_carton.svg';?>
        </div>

        <div class="headerlogo">
            Taco PHP
        </div>

        <div class="headermenu">            
            <a href="/">Opgaver</a>        
        </div>

        <?php if( isset($logged_in_as) ): ?>
        <div class="user-zone">
            <span class="nolink">Hej, <?=logged_in_as_name()?></span>
            <a href="/logout" class="logoutbtn">Log ud</a>
        </div>
        <?php endif; ?>

    </div>

    
