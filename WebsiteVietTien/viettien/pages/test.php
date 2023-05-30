<?php 

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../vendor/phpmailer/phpmailer/src/Exception.php';
    require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require '../vendor/phpmailer/phpmailer/src/SMTP.php';

 

    
        //$data = 1;
        // $mail = new PHPMailer(true);
        // $mail->isSMTP();
        // $mail->Host = 'smtp.gmail.com';
        // $mail->SMTPAuth = true;
        // $mail->Username = 'vanvanvan1972001@gmail.com';
        // $mail->Password = 'dlvglztwuweyniic';
        // $mail->SMTPSecure = 'ssl';
        // $mail->Port = 587;

        $mail = new PHPMailer;
        $mail->isSMTP();                            // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';              // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                     // Enable SMTP authentication
        $mail->Username = 'vanvanvan1972001@gmail.com'; // your email id
        $mail->Password = 'dlvglztwuweyniic'; // your password
        $mail->SMTPSecure = 'tls';                  
        $mail->Port = 587;     //587 is used for Outgoing Mail (SMTP) Server.
        


        $mail->setFrom('vanvanvan1972001@gmail.com');
        $mail->addAddress('ntvan39a7@gmail.com');

        $mail->isHTML(true);
        $mail->Subject = "Change Password";
        $mail->Body = "test change password";

        $mail->send();

        echo "<script>swal('thanh cong')</script>"

?>

      
    
    

    

?>