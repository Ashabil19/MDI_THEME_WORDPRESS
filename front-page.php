<?php get_header(); ?>




<section id="hero" style="height:100vh;">


    <!-- 
    <div class="carousel">
        <div class="carousel-slides">
            <div class="slide active">
                <p>Explore the world of treasures with Metal Detectors Indonesia. Where innovation meets reliability.</p>
            </div>
            <div class="slide">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Animi magni quibusdam nobis blanditiis corrupti provident! Veritatis recusandae voluptate velit culpa repudiandae obcaecati dolore corrupti, dolorum magni tempora? Quidem, ut enim?</div>
            <div class="slide">Slide 3</div>
            <div class="slide">Slide 4</div>
        </div>
        <button class="prev" onclick="prevSlide()">&#10094;</button>
        <button class="next" onclick="nextSlide()">&#10095;</button>
    </div> -->

    <!-- ================================================================================== -->
    <!-- ================================================================================== -->
    <!-- ================================================================================== -->
    <!-- ================================================================================== -->
    <!-- ================================================================================== -->
    <!-- ================================================================================== -->
    <!-- ================================================================================== -->
    <!-- ================================================================================== -->

    <div class="carousel">
        <div class="carousel-slides">
            <?php
            // Query custom post 'slider-homepage'
            $args = array(
                'post_type' => 'slider-homepage',
                'posts_per_page' => -1, // Fetch all posts
            );
            $slider_query = new WP_Query($args);

            // Check if the query returns any posts
            if ($slider_query->have_posts()) :
                while ($slider_query->have_posts()) : $slider_query->the_post();
                    // Get the slider image URL
                    $slider_image = get_field('slider_image');
                    if ($slider_image) : ?>
                        <div class="slide">
                            <img class="slide-img" src="<?php echo esc_url($slider_image); ?>" alt="<?php the_title(); ?>">
                            <p><?php the_content(); ?></p>
                        </div>
                <?php endif;
                endwhile;
                wp_reset_postdata();
            else : ?>
                <div class="slide">No slides available</div>
            <?php endif; ?>
        </div>
        <button class="prev" onclick="prevSlide()">&#10094;</button>
        <button class="next" onclick="nextSlide()">&#10095;</button>
    </div>



    <!-- ================================================================================== -->
    <!-- ================================================================================== -->
    <!-- ================================================================================== -->
    <!-- ================================================================================== -->
    <!-- ================================================================================== -->
    <!-- ================================================================================== -->
    <!-- ================================================================================== -->
    <!-- ================================================================================== -->




    <div class="btn-section">
        <button class="buy-now">Buy Now</button>
    </div>

    <div class="page-section">
        <a href="#" class="btn-pages">List 1</a>
        <a href="#" class="btn-pages">List 2</a>
        <a href="#" class="btn-pages">List 3</a>
    </div>
</section>

<section class="separator"></section>


<section id="product" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
    <h1 style="text-align: center;">Our Product</h1>
    <div class="product-home">
        <?php
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 4
        );

        // The Query
        $query = new WP_Query($args);

        // The Loop
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post(); ?>
                <div class="card" style='box-shadow:none;'>
                    <?php
                    $gambar = get_field('gambar_product');
                    if ($gambar): ?>
                        <img src="<?php echo esc_url($gambar); ?>" alt="<?php the_title(); ?>" style="width: 200px; height:300px;" />
                    <?php endif; ?>
                    <div class="card-txt">
                        <h1 class="title"><?php the_title(); ?></h1>
                    </div>
                </div>
        <?php endwhile;
        endif;
        wp_reset_postdata();
        ?>
    </div>

    <button class="product-btn">View All</button>

</section>




<section id="news-article" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
    <h1 style="font-size: 48px; margin-top:200px;">News Article</h1>
    <div class="container-news-article">
        <!-- slider Attachment -->
        <div class="news-img"></div>



        <div class="slider">
            <div class="slider-nav-new">
                <span class="prev" id="left">&lt;</span>
                <span class="next" id="right">&gt;</span>
            </div>
            <div class="card-container">
                <?php
                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => -1,
                );

                // The Query
                $query = new WP_Query($args);

                // The Loop
                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post(); ?>
                        <div class="card">
                            <?php if (has_post_thumbnail()) : ?>
                                <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" class="img-top">
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/default-article.jpg" alt="default image" class="img-top">
                            <?php endif; ?>
                            <div class="card-txt">
                                <h1 class="title"><?php the_title(); ?></h1>
                                <p style='text-align:left; ' class="card-text">
                                    <?php
                                    $excerpt = wp_trim_words(get_the_excerpt(), 8, '...');
                                    if (!empty($excerpt)) {
                                        echo esc_html($excerpt);
                                    }
                                    ?>
                                </p>
                                <div class="author">
                                    <span style="font-size:12px;">Posted by</span>
                                    <!-- <div class="author-avatar">
                                        <?php echo get_avatar(get_the_author_meta('ID'), 32); ?>
                                    </div> -->
                                    <span style="font-size:12px;"><?php the_author(); ?></span>
                                </div>
                            </div>
                        </div>
                <?php endwhile;
                endif;

                // Reset Post Data
                wp_reset_postdata();
                ?>
            </div>
        </div>



    </div>
</section>








<section id="contact-us" data-aos="fade-up"
    data-aos-anchor-placement="top-bottom">

    <h1 class="contact-us-title" style="text-align: center;">Contact Us</h1>
    <div class="form-content-container">
        <form action="" class="contact-us-form">
            <div class="form-head">
                <h3>How can we help</h3>
            </div>
            <div class="name-input">
                <div class="first-name">
                    <label for="fisrtName">First Name</label>
                    <input type="text" name="firstName" id="firstName" placeholder="First Name">
                </div>
                <div class="last-name">
                    <label for="lastName">Last Name</label>
                    <input type="text" id="lastName" id="lastName" name="lastName" placeholder="Last Name">
                </div>
            </div>
            <div class="email-input">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Email">
            </div>
            <div class="number">
                <label for="number">Phone Number</label>
                <input type="number" id="number" name="number" placeholder="Number">
            </div>
            <div class="message">
                <label for="message">Message</label>
                <textarea name="message" id="message"></textarea>
            </div>
            <button type="submit" class="submit">Submit</button>
        </form>
        <div class="contact-us-content">
            <div class="contact-us-content head">
                <h3>Hubungi Kami</h3>
            </div>
            <div class="contact-us-icon">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/footer-icon/address-icon.svg" alt="">
                <a href="">Jl. Radin Inten II No. 62 Duren Sawit - Jakarta 13440</a>
            </div>
            <div class="contact-us-icon">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/footer-icon/wa-icon.png" alt="">
                <a href="">0812 8006 9024</a>
            </div>
            <div class="contact-us-icon">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/footer-icon/fax-icon.png" alt="">
                <a href="">(021) 8690 6777</a>
            </div>
            <div class="contact-us-icon">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/footer-icon/mail-icon.svg" alt="">
                <a href="">sales@metaldetectorindonesia.com</a>
            </div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.2247646531337!2d106.92011787475069!3d-6.234074893754143!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698d5136fb5c4f%3A0xf3d086329e513d9c!2sPT%20TAHARICA!5e0!3m2!1sen!2sid!4v1724816005163!5m2!1sen!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

    </div>
</section>
<?php get_footer(); ?>