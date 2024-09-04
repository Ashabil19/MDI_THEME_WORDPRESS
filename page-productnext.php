<?php get_header(); ?>

    <section id="product-pages">
      <div class="product-pages-name">
      <h5><a href="<?php echo site_url('/'); ?>">Home</a></h5>
      <span>&#10095;</span>
        <h5>Product</h5>
      </div>



      <!-- Targeting area filter blm di develop secara backend -->
      <div class="container-product-pages">
        <div class="filter-container">
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
        </div>

        <div class="product-container">
            <div class="product-content-container">
                <h2>Vehicle Mirror</h2>
                <div class="product-card-container">
                    <?php
                    // Query untuk mengambil data dari post type 'product'
                    $args = array(
                        'post_type' => 'product',
                        'posts_per_page' => 6 // Mengambil 6 produk, bisa disesuaikan
                    );

                    $query = new WP_Query($args);
                    if ($query->have_posts()) :
                        while ($query->have_posts()) : $query->the_post(); ?>
                            <div class="products-card">
                                <a href="<?php echo esc_url( home_url( '/productdetail/?product_id=' . get_the_ID() ) ); ?>" style="width:100%; color:#292929; text-decoration:none; font-size:24px;" class="product-card-link">
                                    <div class="product-card-img">
                                    <?php
                                    $gambar = get_field('gambar_product');
                                    if ($gambar): ?>
                                        <img src="<?php echo esc_url($gambar); ?>" alt="<?php the_title(); ?>" style="width: 100%" />
                                    <?php endif; ?>
                                    </div>
                                    <div class="product-card-content">
                                    <h4><?php the_title(); ?></h4>
                                    <button>Details & Order</button>
                                    </div>
                                </a>
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
            <!-- <div class="pagination">
                <div class="prev-pagination">
                    <?php previous_posts_link('Previous'); ?>
                </div>
                <div class="next-pagination">
                    <?php next_posts_link('Next', $query->max_num_pages); ?>
                </div>
            </div> -->


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
                        <span style="color:#292929; text-decoration:none;" >Next</span>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/product-pages/next-pag-icon.svg" alt="" />
                    <?php endif; ?>
                </div>
            </div>



        </div>

        
        </div>
    </section>
    

    <?php get_footer(); ?>
