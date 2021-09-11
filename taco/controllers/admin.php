<?php defined('TACO') or die('Not allowed');

//------------------------------------------------------------------------------

function controller_page_login() {

    $logged_in = is_logged_in();
    if( $logged_in ) redirect('admin');

    $admin_username = getenv('ADMIN_USERNAME'); // this is the only username used. no database or anything unneeded.
    $admin_password = getenv('ADMIN_PASSWORD'); // this is the only password used. no database or anything unneeded.

    if( empty($admin_username) || empty($admin_password) ) die('Error - no admin permissions defined');

    $valid_attempt = ( isset($_POST['u92728']) && isset($_POST['p92729']) && $_POST['u92728'] === $admin_username && $_POST['p92729'] === $admin_password );

    $save_login_days = 60;
    
    if( $valid_attempt ) {
      setcookie('x98727', 'u927360', (time()+60*60*24*$save_login_days), '/', $_SERVER['HTTP_HOST'], FALSE);
      redirect('admin');
    }

    add_body_cls(['admin-screen','login-screen']);
    load_view('login', [ 'admin_username'=>$admin_username, ]);
}

//--------------------------------------------------------------------

function controller_page_admin() {

    $logged_in = is_logged_in();
    if( !$logged_in ) redirect('login');

    add_body_cls(['admin-screen']);
    load_view('admin', []);
}

//--------------------------------------------------------------------

function controller_page_logout() {
    setcookie('x98727', 'deleted', (time()-3600), '/', $_SERVER['HTTP_HOST'], FALSE);
    redirect('login');
}

//------------------------------------------------------------------------------