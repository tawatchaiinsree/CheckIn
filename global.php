<?php
    session_start();
    if (is_null($_SESSION['username']) && is_null($_SESSION['session_id'])){
        header('Location:/login');
    }
    $path = explode("/", getcwd());
    $path = end($path);
?>