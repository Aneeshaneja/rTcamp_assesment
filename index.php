<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
    include "database.php";
    $msg="";
    if(isset($_POST['sub'])){
        $email=$_POST['email'];
        $pass=$_POST['pass'];
        $confirm=md5(uniqid(rand()));
        $qry="Select  * from rtcamp where email='$email'";
        $res=mysqli_query($conn,$qry);
        $count=mysqli_num_rows($res);
        if($count==0){

            $qry1="Insert into rtcamp (id,email,password,status,subscribe) values ('$confirm','$email','$pass',0,0)";
            $res1=mysqli_query($conn,$qry1);

            if($res1){

                require 'PHPMailer/Exception.php';
                require 'PHPMailer/PHPMailer.php';
                require 'PHPMailer/SMTP.php';

                //Instantiation and passing `true` enables exceptions
                $mail = new PHPMailer(true);

                    //Server settings
                    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'demooo404@gmail.com';
                    $mail->Password   = 'DEMo1234';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port       = 587;

                    //Recipients
                    $mail->setFrom('sainihitik@gmail.com', 'Hitik Saini');
                    $mail->addAddress($email);     //Add a recipient

                    //Content
                    $mail->isHTML(true);
                    $mail->Subject = 'Email Verification for XKCD Comics';
                    $mail->Body    = 'Hi, '.$email.'<br>';
                    $mail->Body    .= 'Tap on the link below to verify your email.<br> ';
                    $mail->Body    .= 'https://rtcamphitik.000webhostapp.com/confirm.php?id='. $confirm . "\r\n";

                    if($mail->send()){
                        $msg="An email verification link to $email <br> Please check your inbox and verify.";
                    }else{echo "Message not sent. Mailer Error: {$mail->ErrorInfo}";}
            }
        }
        else{
            $msg="The email id is already in our Database.";
            }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>rtCamp_randomXKCD - Hitik Saini</title>
</head>
<body>
    <div>
        <h1>XKCD Comics</h1>
        <p>You will receive an email after submitting.</p>
        <form method="post">
        <div >
            <input placeholder="Email" type="email" name="email" required>
            <input placeholder="Password" type="password" name="pass" required>
        </div>
        <br>
        <input type="submit" name="sub" value="Submit">
        </form>
        <br>
        <?php
        echo '<h3 style="color:blue;">'.$msg.'</h3>';
        ?>
    </div>
    <div>
      <h3>if you have done this thing before: <a href="login.php">Login</a></h3>
    </div>
</body>
</html>
