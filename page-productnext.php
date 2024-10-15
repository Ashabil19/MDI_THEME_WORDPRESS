<?php get_header(); ?>

<section id="product-pages">
  <div class="product-pages-name">
    <h5><a href="<?php echo site_url('/'); ?>">Home</a></h5>
    <span>&#10095;</span>
    <h5>Product</h5>
  </div>

  <div class="container-product-pages">
    <div class="filter-container">

      <div class="filter-head">
        <h3>Filters</h3>
        <img
          src="<?php echo get_template_directory_uri(); ?>/assets/img/product-pages/filter-icon.svg"
          alt="Filter Icon"
          style="width: 12%" />
      </div>
      <div class="filter-content">

        <?php
        function display_child_categories($parent_id, $level = 1)
        {
          $child_categories = get_terms(array(
            'taxonomy' => 'category',
            'hide_empty' => false,
            'parent' => $parent_id,
          ));

          if (!empty($child_categories) && !is_wp_error($child_categories)) {
            foreach ($child_categories as $child) {
        ?>
              <div class="filter-item child-category">
                <a style="text-decoration:none; color:#292929;" href="?category_id=<?php echo $child->term_id; ?>">
                  <p><?php echo esc_html($child->name); ?></p>
                </a>
              </div>
            <?php
              display_child_categories($child->term_id, $level + 1);
            }
          }
        }

        $categories = get_terms(array(
          'taxonomy' => 'category',
          'hide_empty' => false,
          'parent' => 0,
        ));

        if (!empty($categories) && !is_wp_error($categories)) {
          foreach ($categories as $category) {
            ?>
            <div class="filter-item parent-category">
              <a style="text-decoration:none; color:#292929;" href="?category_id=<?php echo $category->term_id; ?>">
                <p><?php echo esc_html($category->name); ?></p>
              </a>
            </div>

        <?php
            display_child_categories($category->term_id);
          }
        } else {
          echo '<p>No categories found.</p>';
        }
        ?>
      </div>
    </div>

    <div class="product-container">
      <div class="product-content-container">
        <div class="product-card-container">
          <?php
          // Ambil parameter category_id dari URL
          $category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 0;
          $search_query = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';

          $args = array(
            'post_type' => 'product',
            'posts_per_page' => 6,
            'paged' => max(1, get_query_var('paged')),
          );

          // Jika category_id ada, tambahkan parameter tax_query
          if ($category_id) {
            $args['tax_query'] = array(
              array(
                'taxonomy' => 'category',
                'field'    => 'term_id',
                'terms'    => $category_id,
              ),
            );
          }
          if (!empty($search_query)) {
            $args['s'] = $search_query;
          }

          $query = new WP_Query($args);
          if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post(); ?>
              <div class="products-card">
                <a href="<?php echo home_url('/productdetail/?product_id=') . get_the_ID(); ?>" style="text-decoration: none; color: inherit;">
                  <div class="product-card-img">
                    <?php
                    $gambar = get_field('gambar_product');
                    if ($gambar) : ?>
                      <img src="<?php echo esc_url($gambar); ?>" alt="<?php the_field('judul_product'); ?>" style="width: 100%" />
                    <?php else : ?>
                      <img src="<?php echo get_template_directory_uri(); ?>/assets/img/product-pages/default-product.png" alt="<?php the_title(); ?>" style="width: 100%" />
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

          wp_reset_postdata();
          ?>
        </div>

      </div>
      <!-- Pagination Controls -->

      <div class="pagination">
        <div class="prev-pagination">
          <?php if (get_previous_posts_link()) : ?>
            <?php previous_posts_link('Previous'); ?>
          <?php else : ?>
            <span style="color:#292929; text-decoration:none;">Previous </span>
          <?php endif; ?>
        </div>
        <div class="number-pagination">
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

        <div class="next-pagination">
          <?php if (get_next_posts_link(null, $query->max_num_pages)) : ?>
            <?php next_posts_link('Next', $query->max_num_pages); ?>
          <?php else : ?>
            <span style="color:#292929; text-decoration:none;">Next</span>
          <?php endif; ?>
        </div>
      </div>

    </div>


  </div>
</section>


<?php get_footer(); ?>