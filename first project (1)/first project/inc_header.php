<?php
    session_cache_limiter('nocache');
    session_cache_expire(30);
    session_start();
    if($page_id!=2 && !isset($_SESSION['id'])){
        header("location:login.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="common.css">
        <?php 
        //  available on all pages exept home page & login page
        if($page_id!=1 && $page_id!=2) echo '<link rel="stylesheet" href="menu.css">';
        ?>