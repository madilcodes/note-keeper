<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Start session
session_start();

// Include database connection file
include_once('.././curdyt/con.php');
// include '.././curdyt/con.php';


// Send OTP to email Form post
if (isset($_POST['email'])) {
   
    $email = $con->real_escape_string($_POST['email']);
    $otp = mt_rand(1111, 9999);

    $query = $con->prepare("SELECT * FROM users WHERE email = ?");
    $query->bind_param("s", $email);
    $query->execute();

    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $con->query("UPDATE users SET otp = '$otp' WHERE email = '$email'");
        sendMail($email, $otp);
        $_SESSION['EMAIL'] = $email;
        echo "yes";
    } else {
        echo "no";
    }
}

// Create function for send email
function sendMail($to, $msg)
{
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/SMTP.php';

    $mail = new PHPMailer;

    $mail->SMTPDebug = 3;                               // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'coffeeandmoreresturant@gmail.com';                 // SMTP username
    $mail->Password = 'eyqbjmsmiadzrhto';                // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to
    $mail->setFrom('coffeeandmoreresturant@gmail.com', 'OTP Verification');
    $mail->addAddress($to);         // Add a recipient

    // Add this line if you want to attach a file
    // $mail->addAttachment('path/to/your/file');

    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    $mail->Subject = 'OTP Verification';
    $mail->Body = 'Your verification OTP Code is <b>' . $msg . '</b>';

    if ($mail->send()) {
        return true;
    } else {
        return false;
    }
}

?>
