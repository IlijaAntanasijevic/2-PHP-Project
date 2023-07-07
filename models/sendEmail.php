<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require '../vendor/autoload.php';
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $name = $_POST["name"];
        $email = $_POST["email"];
        $subject = $_POST["subject"];
        $message = $_POST["message"];

        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            echo "Server Error";
            http_response_code(500);
        }

        //ktssrqvbetjcmvdj
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ilija0125@gmail.com';
        $mail->Password = 'ktssrqvbetjcmvdj';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;



        $mail->setFrom($email, $name); // User email / name
        $mail->addAddress('ilija0125@gmail.com', 'Ilija Antanasijevic');
        $mail->Subject = $subject;
        $mail->Body = $message . "\n" . $email;

        if (!$mail->send()) {
            echo 'Error: ' . $mail->ErrorInfo;
        } else {
            http_response_code(200);
        }
    }
