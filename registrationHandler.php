<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

//include db connection
include_once 'pdo.php';

// prevent Cross-site Scripting (XSS)
function sanitizingData($data)
{ // Removes all PHP and HTML tags via strip_tags()
    //Converts all special characters to their HTML-entity equivalents via tmlspecialchars()
    return htmlspecialchars(strip_tags($data));
};

if ($_POST["action"] == 'checkMatricNumber') {
    $matricNumber = sanitizingData($_POST["Matric_Number"]);
    $sql = "SELECT * FROM siswaum WHERE Matric_Number = '$matricNumber'";
    $results = $connection->query($sql);

    if ($results->fetch()) {
        echo "exist";
    } else {
        echo "null";
    }
}

if ($_POST["action"] == 'checkEmail') {
    $email = sanitizingData($_POST["email"]);
    $sql = "SELECT * FROM student WHERE Email = '$email'";
    $results = $connection->query($sql);

    if ($results->fetch()) {
        echo "taken";
    } else {
        echo "unique";
    }
}

if ($_POST["action"] == 'register') {

    // Load Composer's autoloader
    require 'library/vendor/autoload.php';
    try {
        $sql = "INSERT INTO student (Full_Name, Matric_Number, Email, Password_, Activation_Hash, Verified, College_ID, Faculty)
        VALUES (:fullName, :matricNumber, :email, :password, :Activation_Hash, :verifiyStatus, :college, :faculty)";
        $stmt = $connection->prepare($sql);

        $stmt->bindParam(":fullName", $fullName);
        $stmt->bindParam(":matricNumber", $matricNumber);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":Activation_Hash", $Activation_Hash);
        $stmt->bindParam(":verifiyStatus", $verifiyStatus);
        $stmt->bindParam(":college", $college);
        $stmt->bindParam(":faculty", $faculty);

        $fullName = sanitizingData($_POST["full-name"]);
        $matricNumber = sanitizingData($_POST["matric-number"]);
        $email = sanitizingData($_POST["email"]);
        $password = sanitizingData(password_hash($_POST["password"], PASSWORD_DEFAULT));
        $college = sanitizingData($_POST["college"]);
        $faculty = sanitizingData($_POST["faculty"]);
        $Activation_Hash = sha1(rand(0, 1000));
        $verifiyStatus = 0;

        $stmt->execute();

    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    // Instantiation and passing `true` enables exceptions
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
        $mail->addAddress($email, 'email verification'); // Add a recipient

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'Signup | Verifications';
        $mail->Body = '
        <div style="background: rgb(255, 253, 253); padding: 10px; width: 60%; height: 68%;">
            <h1 style="text-align: center; padding: 0px 20px 0px 30px; margin: 0px;">Hi,  ' . $fullName . '</h1>
            <p style="text-align: left; padding: 0px 20px 20px 30px; margin: 10px auto; text-decoration: none;">
                Your account has been successfully created, you can login with the following credentials:- <br /><br />

                <strong style="padding-right: 30px;">Email</strong>: ' . sanitizingData($email) . ' <br />
                <strong>Password </strong>: ' . sanitizingData($_POST["password"]) . '<br /><br />

                You are almost ready to start using College Activity Registration System. Simply click the big greenish button
                below to verify your email address.
            </p>

            <form method="POST" action="http://localhost/carsgit/index.php">
                <input type="hidden" name="action" value="verifying" >
                <input type="hidden" name="email" value="' . sanitizingData($email) . '" >
                <input type="hidden" name="Activation_Hash" value="' . $Activation_Hash . '" >
                <button
                    type="submit"
                    style="
                        display: block;
                        text-align: center;
                        color: white;
                        background: rgb(13, 216, 13);
                        border-radius: 9px 9px 9px 9px;
                        width: 90%;
                        margin: auto;
                        height: 50px;
                        font-size: 20px;
                        font-weight: bold;
                        margin-bottom: 20px;
                        border: none;
                    "
                >
                    Verify Email Address
                </button>
            </form>
        </div>
        ';

        $mail->send();
        echo 'Successful';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

// header("Location:index.php?action=registrationComplete");
// exit;

//  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//     if (isset($_GET['action'])) {
//         $action = $_GET['action'];
//         if ($action == "incomplete_fields") {
//             echo "<p style=\"color:red\">Incomplete field(s)!</p>";
//         } else {
//             echo "Error";
//         }
//     }
// }

// echo "Successfully inserted the data";
// header("Location: index.html");
// exit;
