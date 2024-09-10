<?php
require_once __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

global $wpdb;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    $email = sanitize_email($_POST['email']);
    $phone_number = sanitize_text_field($_POST['phone_number']);
    $message = sanitize_textarea_field($_POST['message']);

    if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($phone_number) && !empty($message)) {
        
        $wpdb->insert(
            'contact_form_submissions', 
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
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; 
                $mail->SMTPAuth = true;
                $mail->Username = 'ashabilsyauqi@gmail.com'; 
                $mail->Password = 'fbfrolfhozvqoayj'; 
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

          
                $mail->setFrom($email, $first_name . ' ' . $last_name); 

                $mail->addReplyTo($email, $first_name . ' ' . $last_name); 

                $mail->addAddress('ashabil@taharica.com', 'Ashabil Syauqi'); 

                $mail->isHTML(true); 
                $mail->Subject = 'New Contact Form Submission';
                $mail->Body    = "<strong>Name:</strong> $first_name $last_name <br>
                                <strong>Email:</strong> $email <br>
                                <strong>Phone:</strong> $phone_number <br>
                                <strong>Message:</strong> <br> $message";

                $mail->send();
                echo '<p>Email notification has been sent.</p>';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }


            wp_redirect(home_url('/#contact-us')); 
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
    wp_register_style('main', get_template_directory_uri() . '/css/main.css', [], 1, 'all');
    wp_enqueue_style('main');

}
add_action('wp_enqueue_scripts', 'load_css');




register_nav_menus( array(
    'top-menu' => __( 'Top Menu', 'theme' ),
    'footer-menu' => __( 'Footer Menu', 'theme' ),
) );

add_theme_support('menus');
add_theme_support( 'post-thumbnails' );

add_image_size('small', 600, 600, false);




