<?php get_header(); ?>




<section id="hero" style="height:100vh;">
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
    <div class="btn-section">
        <button class="buy-now">Buy Now</button>
    </div>



    <!-- List mau diisi dengan apa ?? -->


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

    <a href="<?php echo site_url('/productnext'); ?>">
        <button class="product-btn">View All</button>
    </a>

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
<section id="contact-us" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
    <h1 class="contact-us-title" style="text-align: center;">Contact Us</h1>
    <div class="form-content-container">
        <?php
        require_once __DIR__ . '/vendor/autoload.php'; // Sesuaikan path sesuai dengan lokasi autoload.php

        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;

        // Akses ke database global
        global $wpdb;
        // Flag untuk mengetahui apakah form berhasil dikirim
        $form_submitted = false;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // Ambil dan sanitasi data dari form
            $first_name = sanitize_text_field($_POST['first_name']);
            $last_name = sanitize_text_field($_POST['last_name']);
            $email = sanitize_email($_POST['email']);
            $phone_number = sanitize_text_field($_POST['phone_number']);
            $message = sanitize_textarea_field($_POST['message']);

            // Validasi bahwa field wajib diisi
            if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($phone_number) && !empty($message)) {

                // Simpan data ke dalam tabel custom
                $wpdb->insert(
                    'contact_form_submissions', // Nama tabel database
                    array(
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        'email' => $email,
                        'phone_number' => $phone_number,
                        'message' => $message,
                        'submission_date' => current_time('mysql'),
                    )
                );

                if ($wpdb->insert_id) {
                    // Email telah disimpan di database, sekarang kirim email notifikasi
                    $mail = new PHPMailer(true);
                    try {
                        // Set PHPMailer untuk menggunakan SMTP
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com'; // Ganti dengan SMTP host kamu
                        $mail->SMTPAuth = true;
                        $mail->Username = 'ashabilsyauqi@gmail.com'; // Ganti dengan username email SMTP kamu
                        $mail->Password = 'fbfrolfhozvqoayj'; // Ganti dengan password atau App password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port = 587;

                        // Set pengirim email
                        $mail->setFrom($email, $first_name . ' ' . $last_name); // Tetapkan email pengguna sebagai pengirim

                        // Tambahkan Reply-To dari pengguna yang submit form
                        $mail->addReplyTo($email, $first_name . ' ' . $last_name); // Alamat email pengguna yang mengisi form

                        // Set penerima email (admin)
                        $mail->addAddress('ashabilsyauqi@gmail.com', 'Ashabil Syauqi'); // Email tujuan (admin)

                        // Set isi email
                        $mail->isHTML(true); // Email menggunakan format HTML
                        $mail->Subject = 'New Contact Form Submission';
                        $mail->Body    = "<strong>Name:</strong> $first_name $last_name <br>
                                        <strong>Email:</strong> $email <br>
                                        <strong>Phone:</strong> $phone_number <br>
                                        <strong>Message:</strong> <br> $message";

                        // Kirim email
                        $mail->send();
                        $form_submitted = true; // Ubah flag menjadi true setelah email berhasil dikirim
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                } else {
                    echo '<p>There was an error saving your message. Please try again.</p>';
                }
            } else {
                echo '<p>Please fill in all required fields.</p>';
            }
        }
        ?>

        <?php if ($form_submitted) : ?>
            <!-- Tampilkan pesan sukses -->
            <!-- <p style="text-align: center; color: green;">Your message has been successfully sent!</p> -->
            <script>
                alert('Form Submitted')
            </script>
        <?php endif; ?>

        <!-- Tampilkan form selalu -->
        <form action="" method="post" class="contact-us-form" onsubmit="return validateForm();">
            <div class="form-head">
                <h3>How can we help</h3>
            </div>
            <div class="name-input">
                <div class="first-name">
                    <label for="firstName">First Name</label>
                    <input type="text" name="first_name" id="firstName" placeholder="First Name" required>
                </div>
                <div class="last-name">
                    <label for="lastName">Last Name</label>
                    <input type="text" name="last_name" id="lastName" placeholder="Last Name" required>
                </div>
            </div>
            <div class="email-input">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Email" required>
            </div>
            <div class="number">
                <label for="phone_number">Phone Number</label>
                <input type="number" name="phone_number" id="phone_number" placeholder="Number" required>
            </div>
            <div class="message">
                <label for="message">Message</label>
                <textarea name="message" id="message" placeholder="Your message" required></textarea>
            </div>
            <button type="submit" class="submit">Submit</button>
        </form>
    </div>

    <script>
        function validateForm() {
            var firstName = document.getElementById('firstName').value;
            var lastName = document.getElementById('lastName').value;
            var email = document.getElementById('email').value;
            var phone = document.getElementById('phone_number').value;
            var message = document.getElementById('message').value;

            if (firstName == "" || lastName == "" || email == "" || phone == "" || message == "") {
                alert("Please fill in all required fields.");
                return false;
            }
            return true;
        }
    </script>

</section>
<?php get_footer(); ?>