<?php get_header(); ?>

    <section id="product-pages">
      <div class="product-pages-name">
      <h5><a href="<?php echo site_url('/'); ?>">Home</a></h5>
      <span>&#10095;</span>
        <h5>Product</h5>
      </div>

      <div class="container-product-pages">
        <!-- <div class="filter-container">
          <div class="filter-head">
            <h3>Filters</h3>
            <img
              src="<?php echo get_template_directory_uri(); ?>/assets/img/product-pages/filter-icon.svg"
              alt=""
              style="width: 12%"
            />
          </div>
          <div class="filter-content">
            <div class="filter-item">
              <p>Vehicle Mirror</p>
              <span>&#10095;</span>
            </div>
            <div class="filter-item">
              <p>Liquid Inspections</p>
              <span>&#10095;</span>
            </div>
            <div class="filter-item">
              <p>Explosives & Narcotics Detection</p>
              <span>&#10095;</span>
            </div>
            <div class="filter-item">
              <p>Vehicle Mirror</p>
              <span>&#10095;</span>
            </div>
            <div class="filter-item">
              <p>Vehicle Mirror</p>
              <span>&#10095;</span>
            </div>
          </div>
          <div class="filter-footer">
            <button>Apply Filter</button>
          </div>
        </div> -->

        <div class="product-container">
            <div class="product-content-container">
                <h2>Vehicle Mirror</h2>
                <div class="product-card-container">
                    <?php
                    // Query untuk mengambil data dari post type 'product'
                    $args = array(
                        'post_type' => 'product',
                        'posts_per_page' => 6,// Mengambil semua produk, bisa disesuaikan.]
                        'paged' => get_query_var('paged') ? get_query_var('paged') : 1,  
                    );

                    $query = new WP_Query($args);
                    if ($query->have_posts()) :
                        while ($query->have_posts()) : $query->the_post(); ?>
                            <div class="products-card">
                                <div class="product-card-img">
                                    <?php 
                                    // Mengambil gambar produk dari ACF
                                    $gambar = get_field('gambar_product');
                                    if ($gambar) : ?>
                                        <img src="<?php echo esc_url($gambar); ?>" alt="<?php the_field('judul_product'); ?>" style="width: 100%" />
                                    <?php endif; ?>
                                </div>
                                <div class="product-card-content">
                                    <h4><?php the_title() ?></h4>
                                    <button>Details & Order</button>
                                </div>
                            </div>
                        <?php endwhile;
                    else :
                        echo '<p>No products found.</p>';
                    endif;

                    // Reset post data
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
            <!-- Pagination Controls -->
            <div class="pagination">
              <div class="prev-pagination">
                  <?php previous_posts_link('Previous'); ?>
              </div>
            <div class="next-pagination">
                <?php next_posts_link('Next', $query->max_num_pages); ?>
            </div>
        </div>
        
        </div>
    </section>
    

    <?php get_footer(); ?>
