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
                    <?php
                    // Retrieve parent categories for 'product'
                    $args = array(
                        'taxonomy'   => 'category', // Replace with your custom taxonomy if needed
                        'hide_empty' => false,
                        'parent'     => 0, // Only get parent categories
                        'object_type' => array('product'), // For custom post type 'product'
                    );

                    $product_categories = get_categories($args);

                    // Check if there are any parent categories
                    if (!empty($product_categories)) {
                        foreach ($product_categories as $category) {
                            // Link for the parent category
                            $category_link = get_category_link($category->term_id);
                            echo '<div class="dropdown-item">';
                            echo '<a style="text-align:start;" href="' . esc_url($category_link) . '">' . esc_html($category->name) . '</a>';

<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD


=======
>>>>>>> parent of db4aa75 (Fixing Product Page)
=======
>>>>>>> parent of db4aa75 (Fixing Product Page)
=======
                            

>>>>>>> parent of 0d41588 (fixing category navbar)
                            // Check for child categories
                            $child_args = array(
                                'taxonomy'   => 'category', // Replace if you use a custom taxonomy
                                'child_of'   => $category->term_id, // Get child categories of this parent
                                'hide_empty' => false,
                            );
                            $child_categories = get_categories($child_args);

                            // Display child categories if any
                            if (!empty($child_categories)) {
                                echo '<div class="dropdown-subcontent">';
                                foreach ($child_categories as $child) {
                                    $child_link = get_category_link($child->term_id);
                                    echo '<a style="text-align:start;" href="' . esc_url($child_link) . '">' . esc_html($child->name) . '</a>';
                                }
                                echo '</div>'; // Close child dropdown
                            }

                            echo '</div>'; // Close parent dropdown item
                        }
                    } else {
                        echo '<p>No categories found.</p>';
                    }
                    ?>
                </div>
            </div>





<<<<<<< HEAD

<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> parent of db4aa75 (Fixing Product Page)
=======
>>>>>>> parent of 0d41588 (fixing category navbar)
            
>>>>>>> parent of db4aa75 (Fixing Product Page)


            <a href="<?php echo site_url('/about'); ?>">About</a>
            <a href="<?php echo site_url('#contact-us'); ?>">Contact</a>
            <form action="<?php echo esc_url(home_url('/')); ?>" method="get" class="search-container">
                <input type="text" name="s" id="search-input" placeholder="Search..." onkeypress="submitOnEnter(event)" />
                <input type="submit" style="display: none;" />
            </form>
        </div>
    </nav>

    <div class="overlay" id="overlay" onclick="closeMenu()"></div>
    <script>
        function submitOnEnter(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                event.target.form.submit(); // Kirim form secara manual
            }
        }
    </script>