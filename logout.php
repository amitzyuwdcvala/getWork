<?php

    session_start();

    if (isset($_SESSION["user"]) && $_SESSION["user"]){
        unset($_SESSION["user"]);
        header("location: index.php");
        exit();
    }else{
        header("location: index.php");
        exit();
    }

?>