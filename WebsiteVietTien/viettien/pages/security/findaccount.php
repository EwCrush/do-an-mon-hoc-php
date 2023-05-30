<?php 

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../../vendor/phpmailer/phpmailer/src/Exception.php';
    require '../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require '../../vendor/phpmailer/phpmailer/src/SMTP.php';


    include("../../admin/config/config.php");

    if(isset($_POST['username'])){
        $username = $_POST['username'];
    }

    if(isset($_POST['email'])){
        $email = $_POST['email'];
    }

    if(isset($_POST['key'])){
        $key = $_POST['key'];
    }
    

    //$query = "INSERT INTO nguoidung (TenNguoiDung, Email, TaiKhoan, MatKhau) VALUES ('$fullname', '$email', '$username', '$password')";
    $query = "Select * from nguoidung where TaiKhoan = '$username' and Email = '$email'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $tonghang = $stmt->rowCount();
    if($tonghang>0){
        //$data = 1;
        $mail = new PHPMailer;
        $mail->isSMTP();                            // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';              // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                     // Enable SMTP authentication
        $mail->Username = 'vanvanvan1972001@gmail.com'; // your email id
        $mail->Password = 'dlvglztwuweyniic'; // your password
        $mail->SMTPSecure = 'tls';                  
        $mail->Port = 587;     //587 is used for Outgoing Mail (SMTP) Server.

        $mail->setFrom('vanvanvan1972001@gmail.com');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = "Change your password";
        $mail->Body = '<div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
        <div style="margin:50px auto;width:70%;padding:20px 0">
          <div style="border-bottom:1px solid #eee">
            <a href="" style="font-size:1.4em;color: #ee4d2d;text-decoration:none;font-weight:600">Việt Tiến</a>
          </div>
          <p style="font-size:1.1em">Xin chào,</p>
          <p>Đây là mã OTP để đặt lại mật khẩu của bạn, vui lòng giữ bí mật và không tiết lộ mã OTP này cho bên thứ 3.</p>
          <h2 style="background: #ee4d2d;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;">'.$key.'</h2>
          <p style="font-size:0.9em;">Trân trọng,<br/>Đội ngũ Viettien EStore</p>
          <hr style="border:none;border-top:1px solid #eee" />
          <div style="float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
            <p>Tổng Công Ty Cổ Phần May Việt Tiến</p>
            <p>7 Lê Minh Xuân, P.7, Q.Tân Bình, Tp.HCM, Việt Nam</p>
          </div>
        </div>
      </div>';

        $mail->send();

        $data = 1;
        

    }
    else{
        $data = 0;
    }

    echo json_encode($data);

?>