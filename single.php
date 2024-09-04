<?php
/* Template Name: Article Detail */

get_header();
?>

<section id="detail-article">
    <div class="detail-article-pages-name">
        <h5><a style='color:black; text-decoration:none;' href="<?php echo home_url(); ?>">Home</a></h5>
        <span>&#10095;</span>
        <h5><a style='color:black; text-decoration:none;' href="<?php echo site_url('/article'); ?>">Article</a></h5>
        <span>&#10095;</span>
        <h5>Detail Article</h5>
    </div>

        <?php
        // Memeriksa apakah ada postingan yang ditemukan
        if (have_posts()) :
            // Memulai loop untuk menampilkan setiap postingan yang ditemukan
            while (have_posts()) : the_post(); ?>
                
                <article>
                    <!-- Membuat div untuk bagian header artikel -->
                    <div class="head-article">
                        <div class="badges">Artikel</div>
                        <h1><?php the_title(); ?></h1>
                        <div class="article-date"><span><?php echo get_the_date(); ?></span></div>
                    </div>

                    <!-- Membuat div untuk menampung gambar utama artikel -->
                    <div class="article-content-img">
                        <?php if (has_post_thumbnail()) : ?>
                            <!-- Jika artikel memiliki featured image, tampilkan gambar tersebut -->
                            <img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>" />
                        <?php else : ?>
                            <!-- Jika artikel tidak memiliki featured image, tampilkan gambar default -->
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/detail-article/detail-artilce-img.png" alt="Default Image" />
                        <?php endif; ?>
                    </div>

                    <!-- Membuat div untuk menampung isi atau konten dari artikel -->
                    <div class="article-paragraph">
                        <?php the_content(); ?>
                    </div>
                </article>

            <!-- Mengakhiri loop -->
            <?php endwhile;

        // Jika tidak ada postingan yang ditemukan, tampilkan pesan ini
        else :
            echo '<p>No content found</p>';
        endif;
        ?>


    <h2 class="related-product-title">Product Terkait</h2>
    <div class="related-product">
    <?php


    // Query for related products (assuming you have a custom post type 'product')
    $related_products = new WP_Query(array(
        'post_type' => 'product',
        'posts_per_page' => 3,
        // Add taxonomy filter or meta query if needed to get truly related products
    ));

    if ($related_products->have_posts()) :
        while ($related_products->have_posts()) : $related_products->the_post();
            $product_image = get_field('gambar_product');
            
            // Jika tidak ada gambar di custom field, fallback ke featured image
            if (!$product_image) {
                $product_image = get_the_post_thumbnail_url(get_the_ID(), 'medium');
            }
            
            // Mengambil judul dan link produk
            $product_title = get_the_title();
            $product_link = get_permalink();
    ?>
            <a style='color:#292929; text-decoration:none; ' href="<?php echo esc_url($product_link); ?>" class="product-card">
                <div class="product-card-img">
                    <img src="<?php echo esc_url($product_image); ?>" alt="<?php echo esc_attr($product_title); ?>" />
                </div>
                <div class="product-card-title">
                    <h3><?php echo esc_html($product_title); ?></h3>
                </div>
            </a>
    <?php
        endwhile;
        wp_reset_postdata(); // Reset the global post object so that the rest of the page works correctly.
    else :
        echo '<p>No related products found</p>';
    endif;
    ?>




</div>


</section>

<?php get_footer(); ?>
