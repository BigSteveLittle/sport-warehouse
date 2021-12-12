<?php
    if(isset($redirect) && $redirect == true) {
        header("Location:thank-you-contact-sports-warehouse.php");
    }
    if(isset($checkedOut) && $checkedOut == true) {
        header("Location:thank-you-checkout-sports-warehouse.php?orderId=$orderId");
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://kit.fontawesome.com/1ac9e13ece.js" crossorigin="anonymous"></script>
        <link rel=“stylesheet” href=“https://use.typekit.net/llx6kjr.css”>
        <link rel="stylesheet" href="css/styles.css">
        <!-- Slick CSS resources -->
        <link rel="stylesheet" type="text/css" href="3rd-party/slick-1.8.1/slick.css"/>
        <link rel="stylesheet" type="text/css" href="3rd-party/slick-1.8.1/slick-theme.css"/>
        <title><?= $title ?></title>
    </head>
    <body>
        <header id="page-header">
            <div class="full-width-bg">
                <div class="content-wrapper">
                    <div id="nav-bar">
                            <div class="shopping-links">
                                <a href="shopping-cart-sports-warehouse.php" class="login desktop-only"><i class="fas fa-lock"></i> Login </a>
                                <a href="shopping-cart-sports-warehouse.php"><i class="fas fa-shopping-cart"></i> View Cart </a>
                                <a class="item-count" href="shopping-cart-sports-warehouse.php">0 items</a>
                            </div>
                            <nav id="site-nav">
                                <input type="checkbox" id="expand-toggle" />
                                    <label for="expand-toggle" id="expand-btn" class="site-nav__menu-icon mobile-only"><i class="fas fa-bars site-nav__nav-icon"></i><span class="site-nav__nav-text">Menu</span></label>
                                <ul class="site-nav__menu">
                                    <li class="mobile-only"><a href="customer-login.html"><span class="lock"><i class="fas fa-lock"></i></span>Login</a></li>
                                    <li><a href="index.php"><span class="site-nav__deco mobile-only">&cir;</span>Home</a></li>
                                    <li><a href="about-sports-warehouse.php"><span class="site-nav__deco mobile-only">&cir;</span>About SW</a></li>
                                    <li><a href="contact-sports-warehouse.php"><span class="site-nav__deco mobile-only">&cir;</span>Contact Us</a></li>
                                    <li><a href="products-sports-warehouse.php"><span class="site-nav__deco mobile-only">&cir;</span>View Products</a></li>
                                </ul>
                            </nav>
                        </div>
                </div>
            </div>
                <div class="content-wrapper">
                        <div class="logo-search">
                            <a href="index.php" id="h1-logo">
                                <img src="images/sports-warehouse-logo.svg" alt="">
                                <h1 class="screen-read">Sports Warehouse</h1>
                            </a>
                            