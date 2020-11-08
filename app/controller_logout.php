<?php

if (isset($_COOKIE['xk23gj4'])) {
    unset($_COOKIE['xk23gj4']); 
    setcookie('xk23gj4', null, -1, '/');     
}

go_to('/login');