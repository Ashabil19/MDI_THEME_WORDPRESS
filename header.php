<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/main.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/product-page.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/article-page.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/detail-article.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/product-detail.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/about-us.css">

    <!-- AOS CDN CODE LINK -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">



    <script src="<?php echo get_template_directory_uri(); ?>/js/scripts.js" defer></script>
    <script src="<?php echo get_template_directory_uri(); ?>/js/product-page.js"></script>
    <title>Metal Detector Indonesia</title>
</head>
<body>

    <nav class="navbar">
        <div class="logo">
            <img width="250px" class="img-logo" src="<?php echo get_template_directory_uri(); ?>/assets/img/MDI.png" alt="logo">
        </div>

        <div class="hamburger" onclick="toggleMenu()">
            ☰
        </div>

        <div class="nav-links" id="nav-links">
            <a href="<?php echo site_url('/'); ?>">Home</a>
            <a href="<?php echo site_url('/article'); ?>">Article</a>
            <div class="dropdown">
                <a href="<?php echo site_url('/productnext'); ?>" class="dropbtn">Product<div class="dropdown-icon"></div></a>
                <div class="dropdown-content">
                    <a href="<?php echo site_url('/product1'); ?>">Product 1</a>
                    <a href="<?php echo site_url('/product2'); ?>">Product 2</a>
                    <a href="<?php echo site_url('/product3'); ?>">Product 3</a>
                </div>
            </div>
            <a href="<?php echo site_url('/about'); ?>">About</a>
            <a href="<?php echo site_url('#contact-us'); ?>">Contact</a>

            <form action="<?php echo home_url('/'); ?>" method="get" class="search-container">
                <input type="text" name="s" id="search-input" placeholder="Search..." onkeyup="showSuggestions(this.value)">
                <div class="suggestions" id="suggestions"></div>
            </form>
        </div>
    </nav>

    <div class="overlay" id="overlay" onclick="closeMenu()"></div>