<?php

    session_start();
    $_SESSION["user_type"] = "" ;
    $_SESSION["user_id"] = "" ;
    unset($_SESSION["cart_products"]);
    session_destroy();
    echo "<script>window.location.pathname = 'mywork/OBook/login.php' ;</script>";
    exit;


?>