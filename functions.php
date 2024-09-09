<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

global $wpdb;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil dan sanitasi data dari form
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    $email = sanitize_email($_POST['email']);
    $phone_number = sanitize_text_field($_POST['phone_number']);
    $message = sanitize_textarea_field($_POST['message']);

    // Validasi bahwa field wajib diisi
    if (!empty($first_name) && !empty($email) && !empty($phone_number) && !empty($message)) {
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

        echo "<script>alert('Form submitted')</script>";

        // Jika penyimpanan berhasil
        // if ($wpdb->insert_id) {
        //     echo '<p>Thank you for your message!</p>';
        
        //     // Kirim email notifikasi menggunakan PHPMailer
        //     $mail = new PHPMailer(true);
        
        //     try {
        //         // Set mailer untuk menggunakan SMTP
        //         $mail->isSMTP();
        //         $mail->Host = 'smtp.gmail.com'; // Ganti dengan host SMTP
        //         $mail->SMTPAuth = true;
        //         $mail->Username = 'ashabilsyauqi@gmail.com'; // Ganti dengan email SMTP
        //         $mail->Password = 'fbfrolfhozvqoayj'; // Ganti dengan password email
        //         $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        //         $mail->Port = 587;
        
        //         // Debugging untuk mendapatkan log lebih detail
        //         $mail->SMTPDebug = 2; 
        //         $mail->Debugoutput = 'html';
        
        //         // Set recipient dan sender
        //         $mail->setFrom($email, $first_name . ' ' . $last_name);
        //         $mail->addAddress('ashabilsyauqi@gmail.com', 'ASHABIL'); // Ganti dengan penerima email
        
        //         // Set isi email
        //         $mail->isHTML(true);
        //         $mail->Subject = 'New Contact Form Submission';
        //         $mail->Body = "<strong>Name:</strong> $first_name $last_name <br>
        //                        <strong>Email:</strong> $email <br>
        //                        <strong>Phone:</strong> $phone_number <br>
        //                        <strong>Message:</strong> <br> $message";
        
        //         // Kirim email
        //         if ($mail->send()) {
        //             echo '<p>Email notification has been sent.</p>';
        //         } else {
        //             echo '<p>There was an error sending the email: ' . $mail->ErrorInfo . '</p>';
        //         }
        
        //     } catch (Exception $e) {
        //         echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        //     }
        // } else {
        //     echo '<p>There was an error saving your message. Please try again.</p>';
        // }
        
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




