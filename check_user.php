<?php
    session_start();
    if (is_null($_SESSION['username']) && is_null($_SESSION['session_id'])){
        header('Location:/login');
    }
    if (isset($_SESSION['session_id'])){
        $location = $_SESSION['permission'];
        echo "<script>location.replace(\"/$location\");</script>";
    }
?>