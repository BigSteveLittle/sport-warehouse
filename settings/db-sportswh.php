<?php
    // This file contains the project database settings. It will detect if the application is running locally or remotely and set the correct database credentials for the situation. This file will need to be referenced in all files that connect to the application database.

    // Check if the application is running locally.
    if($_SERVER["SERVER_NAME"] == "localhost" || $_SERVER["SERVER_ADDR"] == "127.0.0.1") {
        // If localhost use localhost credentials.
        $dsn = "mysql:host=localhost;dbname=sportswh;charset=utf8";
        $username = "root";
        $password = "root";
    }
    elseif($_SERVER["SERVER_NAME"] == "ftp.bigstevelittle.com" || $_SERVER["SERVER_ADDR"] == "110.232.143.22") {
        // If website is running on the remote server use bigstevelittle.com credentials.
        $dsn = "mysql:host=localhost;dbname=bigsteve_sportswh;charset=utf8";
        $username = "bigsteve_little";
        $password = "b5m5x\$ELJ#\$h";
    }
    else {
        // If website is running on the Hornsby TAFE server use the TAFE credentials.
        $dsn = "mysql:host=localhost;dbname=hornsbytafetest_magenta09;charset=utf8";
        $username = "hornsbytafetest_magenta09";
        $password = "criticism(53)";
    }
?>