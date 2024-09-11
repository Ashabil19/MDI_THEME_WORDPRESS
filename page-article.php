<?php
/*
Template Name: Articles Page
*/
get_header(); ?>

<div class="article-pages-name">
    <h5><a style='color:black; text-decoration:none;' href="<?php echo home_url(); ?>">Home</a></h5>
    <span>&#10095;</span>

    <?php if (is_category() || is_single()) : ?>
        <h5><a style='color:black; text-decoration:none;' href="<?php echo get_permalink(get_option('page_for_posts')); ?>">Articles</a></h5>
        <span>&#10095;</span>
    <?php endif; ?>

    <?php if (is_single()) : ?>
        <h5><?php the_title(); ?></h5>
    <?php elseif (is_category()) : ?>
        <h5><?php single_cat_title(); ?></h5>
    <?php elseif (is_page()) : ?>
        <h5><?php the_title(); ?></h5>
    <?php endif; ?>
</div>
<section id="article">



    <div class="article-head">
        <div class="article-head-sosmed">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/article-pages/facebook.svg" alt="" />
            <img src="<?php echo get_template_directory_uri(); ?>/assets/article-pages/instagram.svg" alt="" />
            <img src="<?php echo get_template_directory_uri(); ?>/assets/article-pages/twitter.svg" alt="" />
        </div>
        <div class="article-head-title">
            <h1 style="text-align: center">Our Article</h1>
        </div>
        <div class="article-head-right">
            <h5>Learn About Us</h5>
        </div>
    </div>

    <div class="article-content-container">
        <?php
        // Menentukan query untuk menampilkan 8 artikel per halaman
        $args = array(
            'post_type' => 'post', // Hanya menampilkan tipe post standar
            'posts_per_page' => 6, // Menampilkan 8 post per halaman
            'paged' => get_query_var('paged') ? get_query_var('paged') : 1, // Mendukung pagination
        );

        // Menjalankan query untuk mendapatkan post
        $query = new WP_Query($args);

        // Jika ada artikel yang ditemukan
        if ($query->have_posts()) :
            // Loop untuk setiap artikel yang ditemukan
            while ($query->have_posts()) : $query->the_post(); ?>

                <!-- Link ke artikel -->
                <a href="<?php the_permalink(); ?>" class="card-link" style="color:#292929; text-decoration:none;">
                    <div class="card">
                        <!-- Bagian gambar artikel -->
                        <div class="card-header">
                            <?php if (has_post_thumbnail()) : ?>
                                <!-- Menampilkan gambar unggulan post -->
                                <img src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>" />
                            <?php else : ?>
                                <!-- Menampilkan gambar default jika tidak ada gambar unggulan -->
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/article-pages/article-img.png" alt="gambar_artikel" />
                            <?php endif; ?>
                        </div>

                        <!-- Bagian konten artikel -->
                        <div class="card-body">
                            <!-- Menampilkan judul artikel -->
                            <h4 class="card-title">
                                <?php
                                // Mengambil judul dan menampilkan dua kata pertama
                                $title = wp_trim_words(get_the_title(), 2, '...');
                                echo esc_html($title);
                                ?>
                            </h4>

                            <!-- Menampilkan excerpt (ringkasan) artikel, maksimal 8 kata -->
                            <p class="card-text">
                                <?php
                                $excerpt = wp_trim_words(get_the_excerpt(), 8, '...');
                                echo esc_html($excerpt);
                                ?>
                            </p>

                            <!-- Informasi penulis dan tanggal artikel -->
                            <div class="user-info">
                                <h5><?php the_author(); ?></h5>
                                <small><?php echo get_the_date(); ?></small>
                            </div>
                        </div>
                    </div>
                </a>

        <?php endwhile; // Mengakhiri loop
        else :
            echo '<p>No articles found.</p>'; // Pesan jika tidak ada artikel ditemukan
        endif;

        // Reset query
        wp_reset_postdata();
        ?>
    </div>




    <div class="paggination">
        <div class="prev-paggination">
            <?php if (get_previous_posts_link()) : ?>
                <?php previous_posts_link('<img src="' . get_template_directory_uri() . '/assets/img/product-pages/prev-pag-icon.svg" alt="" /> <span class="previous-link">Previous</span>'); ?>
            <?php else : ?>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/product-pages/prev-pag-icon.svg" alt="" />
                <span style="color:#292929; text-decoration:none;">Previous</span>
            <?php endif; ?>
        </div>
        <div class="number-paggination">
            <?php
            $total_pages = $query->max_num_pages;
            $current_page = max(1, get_query_var('paged'));

            for ($i = 1; $i <= $total_pages; $i++) {
                $class = $i == $current_page ? 'active' : '';

                if ($i == $current_page) {
                    echo "<span style='color:white; text-decoration:none;' class=\"$class\">$i</span>";
                } else {
                    $page_link = get_pagenum_link($i);
                    echo "<a style='color:#292929; text-decoration:none;' href=\"$page_link\" class='num-pag'>$i</a>";
                }
            }
            ?>
        </div>

        <div class="next-paggination">
            <?php if (get_next_posts_link(null, $query->max_num_pages)) : ?>
                <?php next_posts_link('<span style="color:#292929; text-decoration:none;" >Next</span> <img src="' . get_template_directory_uri() . '/assets/img/product-pages/next-pag-icon.svg" alt="" />', $query->max_num_pages); ?>
            <?php else : ?>
                <span style="color:#292929; text-decoration:none;">Next</span>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/product-pages/next-pag-icon.svg" alt="" />
            <?php endif; ?>
        </div>


    </div>
</section>


<?php get_footer(); ?>