<?php
session_start();

require_once "./lib/validation.php";
require "vendor/autoload.php";
require "./lib/category.php";
require "./lib/single_news.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$validation = new validation;
$success = "";
$error = "";

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->Host = 'smtp.gmail.com';
$mail->Username = 'muhammaddali1994@gmail.com';
$mail->Password = 'lqjzfsrebondpnpi';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

if ($_SERVER["REQUEST_METHOD"] === 'POST' && isset($_POST['submit'])) {

    $name = $validation->name("name");
    // if ($name == NULL) {
    //     echo "null";
    //     die;
    // }
    $email = $validation->email("email");
    $subject = $validation->subject("subject");
    $message = $validation->message("message");
    $errors = $validation->errors;
    $error = implode($errors);

    $mail->setFrom('muhammaddali1994@gmail.com');
    $mail->addAddress($email, $name);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;


    if (empty($error)) {
        if ($mail->send()) {
            $success = 'Email sent successfully';
        } else {
            $error = 'Email not sent';
        }
    }
}
// if (!empty($error)) {
//     echo "<div>";
//     echo "<h3>";
//     echo $error;
//     echo "</h3>";
//     echo "</div>";
// } else if ($success) {
//     echo "<div>";
//     echo "<h3>";
//     echo $success;
//     echo "</h3>";
//     echo "</div>";
// }

include "./header.php";
?>
<!-- Contact Start -->
<?php if (isset($_SESSION['email'])) { ?>
    <div class="container-fluid mt-5 pt-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <?php print_r($error);
                    if (!empty($error)) { ?>
                        <div class="alert alert-primary text-center" role="alert">
                            <?php echo $error; ?>
                        </div>
                    <?php } else if ($success) { ?>
                        <div class="alert alert-secondary text-center" role="alert">
                            <?php echo $success ?>
                        <?php  } ?>
                        <div class="section-title mb-0">
                            <h4 class="m-0 text-uppercase font-weight-bold">Contact Us For Any Queries</h4>
                        </div>
                        <div class="bg-white border border-top-0 p-4 mb-3">
                            <div class="mb-4">
                                <h6 class="text-uppercase font-weight-bold">Contact Info</h6>
                                <!-- <p class="mb-4">The contact form is currently inactive. Get a functional and working contact form with Ajax & PHP in a few minutes. Just copy and paste the files, add a little code and you're done. <a href="https://htmlcodex.com/contact-form">Download Now</a>.</p> -->
                                <div class="mb-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fa fa-map-marker-alt text-primary mr-2"></i>
                                        <h6 class="font-weight-bold mb-0">Our Office</h6>
                                    </div>
                                    <p class="m-0">123 Street, New York, USA</p>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fa fa-envelope-open text-primary mr-2"></i>
                                        <h6 class="font-weight-bold mb-0">Email Us</h6>
                                    </div>
                                    <p class="m-0">info@example.com</p>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="fa fa-phone-alt text-primary mr-2"></i>
                                        <h6 class="font-weight-bold mb-0">Call Us</h6>
                                    </div>
                                    <p class="m-0">+012 345 6789</p>
                                </div>
                            </div>
                            <h6 class="text-uppercase font-weight-bold mb-3">Contact Us</h6>
                            <form method="POST" action="./contact.php">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control p-4" placeholder="Your Name" required="required" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control p-4" placeholder="Your Email" required="required" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="subject" class="form-control p-4" placeholder="Subject" required="required" />
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" name="message" rows="4" placeholder="Message" required="required"></textarea>
                                </div>
                                <div>
                                    <button name="submit" class="btn btn-primary font-weight-semi-bold px-4" style="height: 50px;" type="submit">Send Message</button>
                                </div>
                            </form>
                        </div>
                        </div>
                    <?php } else { ?>
                        <div class="container-fluid mt-5 pt-3">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="alert alert-primary text-center" role="alert" style="font-size: 30px;">You should sign in first</div>
                                    </div>
                                <?php } ?>

                                <?php
                                include "./footer.php";
                                ?>