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
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 8,
            'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
        );

        $query = new WP_Query($args);
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post(); ?>
                <a style='color:#292929; text-decoration:none;' href="<?php the_permalink(); ?>" class="card-link">
                    <div class="card">
                        <div class="card-header">
                            <?php if (has_post_thumbnail()) : ?>
                                <img src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>" />
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/article-pages/article-img.png" alt="gambar_artikel" />
                            <?php endif; ?>
                        </div>

                        <div class="card-body">
                            <span class="tag">Artikel</span>
                            <h4 class="card-title">
                                <?php
                                // Mengambil judul post
                                $title = get_the_title();

                                // Memisahkan judul menjadi array berdasarkan spasi
                                $words = explode(' ', $title);

                                // Mengambil dua kata pertama
                                $short_title = implode(' ', array_slice($words, 0, 2));

                                // Menentukan apakah judul memiliki lebih dari dua kata
                                $has_more_words = count($words) > 2;

                                // Menampilkan judul dengan tanda ellipsis jika lebih dari dua kata
                                echo esc_html($short_title . ($has_more_words ? '...' : ''));
                                ?>
                            </h4>
                            <p style='text-align:left;' class="card-text">
                                <?php
                                // Mengambil excerpt dari post dan memotongnya menjadi 8 kata
                                $excerpt = wp_trim_words(get_the_excerpt(), 8, '...');

                                // Memastikan tag <p> hanya muncul jika excerpt ada
                                if (!empty($excerpt)) {
                                    echo esc_html($excerpt);
                                }
                                ?>
                            </p>


                            <div class="user">
                                <!-- <img src="https://yt3.ggpht.com/a/AGF-l7-0J1G0Ue0mcZMw-99kMeVuBmRxiPjyvIYONg=s900-c-k-c0xffffffff-no-rj-mo" alt="user" /> -->
                                <div class="user-info">
                                    <h5 style='text-align:left;'><?php the_author(); ?></h5>
                                    <small><?php echo get_the_date(); ?></small>
                                </div>
                            </div>
                        </div>


                    </div>
                </a>
        <?php endwhile;
        else :
            echo '<p>No articles found.</p>';
        endif;

        // Reset post data
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