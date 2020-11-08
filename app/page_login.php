<?php

if( !empty($_POST) && isset($_POST['xk23gj4']) ) {
    $password = $_POST['xk23gj4'];
    
    $valid = verify_password( $password );

    if( !$valid ) {
        go_to('/login');
    }
    if( $valid ) {
        $cookie_domain = str_replace( ['http://','https://'], '', $config['baseurl'] );
        setcookie('xk23gj4', $password, time()+(30*(60*60*24)), '/', $cookie_domain, TRUE);        
        if( $password === 'milkmoney' ) $url = '/';
        if( get_client_by_password($password) ) $url = '/';
        go_to($url);        
    }    
}

?>

<?php require view('view_start'); ?>

<form action="/login" method="post">
<div class="password">
    <input name="xk23gj4" type="password" placeholder="Password">
    <input type="submit" class="btn" value="Fortsæt" />
</div>
</form>

<?php require view('view_end'); ?>
