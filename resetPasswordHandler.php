<?php
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

include_once 'pdo.php';

$response = array("status" => "", "emailError" => "", "generalError" => "");

function sanitizingData($data)
{
    return htmlspecialchars(strip_tags($data)); // Removes all PHP and HTML tags via strip_tags()
    //                                               //Converts all special characters to their HTML-entity equivalents via tmlspecialchars()
};

if (($_POST['action']) == "update password") {
    $email = $_POST['userEmail'];
    $password = password_hash($_POST["newPassword"], PASSWORD_DEFAULT);

    try {
        $sql = "UPDATE student SET Password_ ='$password' WHERE Email = '$email'";
        $connection->query($sql);

        $response['status'] = 'success';
        print_r(json_encode($response));
    } catch (PDOException $err) {
        $response['status'] = 'failed';
        $response['generalError'] = $sql . "<br>" . $err->getMessage();
        print_r(json_encode($response));
    }

}

if (($_POST['action']) == "send reset password") {
    $email = sanitizingData($_POST['forgot-email']);

    $sql = "SELECT * FROM student WHERE Email = '$email'";
    $emailCheck = $connection->query($sql);

    //store fetch data into array
    $data = $emailCheck->fetch();

    if (!$data) {
        $response['status'] = 'failed';
        $response['emailError'] = 'The email address that you\'ve  entered  <span style="color:yellow">doesn\'t match any account.</span> Please try again and do a double check.';
        print_r(json_encode($response));
    } else {
        // Load Composer's autoloader
        require 'library/vendor/autoload.php';

        $mail = new PHPMailer(true);
        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output
            $mail->isSMTP(); // Send using SMTP
            $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = 'carsnoreply@gmail.com'; // SMTP username
            $mail->Password = 'Angah131'; // SMTP password dmkhjjfrjedfhizu
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465; // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('carsnoreply@gmail.com', 'CARS');
            $mail->addAddress($email, 'reset password'); // Add a recipient

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'Password Reset';
            $mail->Body = '
        <div style="background: rgb(255, 255, 255); padding: 10px; width: 60%; height: 68%;">
            <h1 style="text-align: center; padding: 0px 20px 0px 30px; margin: 0px;">Forgot your password?</h1>
            <p style="text-align: center; padding: 0px 20px 20px 30px; margin: 10px auto; text-decoration: none;">
            That\'s okay, it happens!. If you\'ve lost your password or wish to reset it, <br>
            tap the button below to get started and reset your account password. <br>
            If you didn\'t request a new password, you can safely delete this email. <br>
            </p>

<<<<<<< HEAD
            <form method="POST" action="http://localhost/Weeb Project/carsgit/index.php">
=======
            <form method="POST" action="http://localhost/carsgit-1/index.php">
>>>>>>> f785c214a0de78e20277d4da891e381de273795a
                <input type="hidden" name="action" value="reset password" >
                <input type="hidden" name="email" value="' . sanitizingData($email) . '" >
                <input type="hidden" name="Activation_Hash" value="' . $data['Activation_Hash'] . '" >
                <button
                    type="submit"
                    style="
                        display: block;
                        text-align: center;
                        color: white;
                        background: rgb(13, 216, 13);
                        border-radius: 9px 9px 9px 9px;
                        width: 50%;
                        margin: auto;
                        height: 50px;
                        font-size: 20px;
                        font-weight: bold;
                        margin-bottom: 20px;
                        border: none;
                    "
                >
                    Reset Your Password
                </button>
            </form>
        </div>
        ';

            $mail->send();
            $response['status'] = 'success';
        } catch (Exception $e) {
            $response['status'] = 'failed';
            $response['emailError'] = 'Message could not be sent. Mailer Error:' . $mail->ErrorInfo;
            print_r(json_encode($response));

        }
        print_r(json_encode($response));
    }

}
