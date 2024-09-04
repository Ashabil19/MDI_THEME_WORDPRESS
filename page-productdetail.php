<?php get_header(); ?>

<?php
// Ambil parameter product_id dari URL
$product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;

// Cek jika product_id valid
if ($product_id > 0) {
    // Ambil post dengan ID yang sesuai
    $post = get_post($product_id);

    if ($post && $post->post_type == 'product') {
        setup_postdata($post);
        ?>

        <section id="product-detail">
          <div class="product-detail-page-name">
            <h5><a href="<?php echo home_url(); ?>">Home</a></h5>
            <span>&#10095;</span>
            <h5><a href="<?php echo site_url('/productnext'); ?>">Product</a></h5>
            <span>&#10095;</span>
            <h5><?php the_title(); ?></h5>
          </div>

          <div class="product-detail-container">
            <div class="product-detail-img">
              <?php
              // Mengambil nilai custom field 'gambar_product'
              $gambar_product = get_field('gambar_product', $product_id);
              if ($gambar_product): ?>
                <img src="<?php echo esc_url($gambar_product); ?>" alt="<?php the_title(); ?>" style="object-fit: cover" />
              <?php else: ?>
                <p>Gambar tidak tersedia.</p>
              <?php endif; ?>
            </div>
            <div class="product-desc-container">
              <h1 class="title"><?php the_title(); ?></h1>
              <div class="product-desc-btn">
                <button class="count-btn">
                  <span>-</span>
                  <span>1</span>
                  <span>+</span>
                </button>
                <button class="btn-penawaran">
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/img/detail-product/wa-penawaran-icon.svg" alt="" style="width: 14%" />
                  <span>Minta Penawaran</span>
                </button>
              </div>
              <div class="desc">
                <?php
                // Mengambil nilai custom field 'deskripsi_product'
                $deskripsi_product = get_field('deskripsi_product', $product_id);
                if ($deskripsi_product):
                  echo $deskripsi_product;
                else:
                  echo '<p>Deskripsi tidak tersedia.</p>';
                endif;
                ?>
              </div>
            </div>
          </div>

          <div class="product-detail-tabs">
            <div class="tab">
              <button id="defaultOpen" class="tablinks" onclick="openDesc(event, 'fitur')">Fitur</button>
              <button class="tablinks" onclick="openDesc(event, 'spesifikasi')">Spesifikasi</button>
            </div>

            <div id="fitur" class="tabcontent">
              <!-- <?php
              // Mengambil konten post sebagai fitur
              echo apply_filters('the_content', $post->post_content);
              ?> -->

                <?php
                    // Mengambil nilai custom field 'deskripsi_product'
                    $deskripsi_product = get_field('deskripsi_product', $product_id);
                    if ($deskripsi_product):
                    echo $deskripsi_product;
                    else:
                    echo '<p>Deskripsi tidak tersedia.</p>';
                    endif;
                ?>
            </div>

            <div id="spesifikasi" class="tabcontent">
              <?php
              // Mengambil nilai custom field 'spesifikasi_product'
              $spesifikasi_product = get_field('spesifikasi_product', $product_id);
              if ($spesifikasi_product):
                echo $spesifikasi_product;
              else:
                echo '<p>Spesifikasi tidak tersedia.</p>';
              endif;
              ?>
            </div>
          </div>
        </section>

        <script>
          function openDesc(evt, descName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
              tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
              tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(descName).style.display = "block";
            evt.currentTarget.className += " active";
          }

          // Membuka tab pertama secara default
          document.getElementById("defaultOpen").click();
        </script>

        <?php
        wp_reset_postdata();
    } else {
        echo '<p>Produk tidak ditemukan.</p>';
    }
} else {
    echo '<p>ID produk tidak valid.</p>';
}
?>

<?php get_footer(); ?>
