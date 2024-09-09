<?php
// Include Composer's autoload
require_once __DIR__ . '/vendor/autoload.php'; // Sesuaikan path sesuai dengan lokasi autoload.php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Akses ke database global
global $wpdb;

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
                // $mail->setFrom('ashabilsyauqi@gmail.com', 'Contact Form'); // Tetapkan email kamu sendiri sebagai pengirim
                $mail->setFrom($email, $first_name . ' ' . $last_name); // Tetapkan email kamu sendiri sebagai pengirim

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
                echo '<p>Email notification has been sent.</p>';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }


            // Redirect setelah submit berhasil
            wp_redirect(home_url('/#contact-us')); // Ganti URL sesuai kebutuhan
            exit;
        } else {
            echo '<p>There was an error saving your message. Please try again.</p>';
        }
        
    } else {
        echo '<p>Please fill in all required fields.</p>';
    }
}




// Enqueuing
function load_css()
{

    // wp_register_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', [], 1, 'all');
    // wp_enqueue_style('bootstrap');

    wp_register_style('main', get_template_directory_uri() . '/css/main.css', [], 1, 'all');
    wp_enqueue_style('main');

}
add_action('wp_enqueue_scripts', 'load_css');

function load_js()
{
    wp_enqueue_script('jquery');

    wp_register_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', ['jquery'], 1, true);
    wp_enqueue_script('bootstrap');
}
add_action('wp_enqueue_scripts', 'load_js');


// Nav Menus
register_nav_menus( array(
    'top-menu' => __( 'Top Menu', 'theme' ),
    'footer-menu' => __( 'Footer Menu', 'theme' ),
) );

// Theme Support
add_theme_support('menus');
add_theme_support( 'post-thumbnails' );

// Image Sizes
add_image_size('small', 600, 600, false);




