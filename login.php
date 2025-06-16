<?php
ob_start();
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
    session_start();
    include "database.php";
    $msg="";
    if(isset($_POST['sub'])){
        $email=$_POST['email'];
        $pass=$_POST['pass'];
        $qry="Select  * from rtcamp where email='$email'";
        $res=mysqli_query($conn,$qry);
        $row=mysqli_fetch_array($res);
        $count=mysqli_num_rows($res);
        $confirm=$row['id'];
        if($count!=0){

            if($pass===$row['password']){
                if($row['status']==1){
                    $_SESSION['login']=TRUE;
                    $_SESSION['email']=$email;
                    header('location:verified.php');
                }
                else{
                    $msg="You have not verified your account yet,<br> Please verify your emailid
                    <form method='post' class='here'>
                        <input type='submit' name='here' value='Here'>
                    </form>
                    ";
                    $_SESSION['email']=$email;
                }
            }
            else{
                $msg="Password is incorrect";
            }
        }
        else{
            $msg="Please register before login";
        }

    }
    if(isset($_POST['here'])){

        require 'PHPMailer/Exception.php';
        require 'PHPMailer/PHPMailer.php';
        require 'PHPMailer/SMTP.php';
        $email=$_SESSION['email'];
        $qry="Select * from rtcamp where email='$email'";
        $res=mysqli_query($conn,$qry);
        $row=mysqli_fetch_array($res);
        $confirm=$row['id'];
                $mail = new PHPMailer(true);
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'demooo404@gmail.com';
                    $mail->Password   = 'DEMo1234';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port       = 587;
                    $mail->setFrom('sainihitik@gmail.com', 'hitik');
                    $mail->addAddress($email);     //Add a recipient

                    $mail->isHTML(true);
                    $mail->Subject = 'Account Verification ';
                    $mail->Body    = 'Hi, '.$email.'<br>';
                    $mail->Body    .= 'Click on the below link to verify your account.<br> ';
                    $mail->Body    .= 'https://rtcamphitik.000webhostapp.com/confirm.php?id='. $confirm . "\r\n";
                    if($mail->send()){
                        $msg="An email verification link to $email <br> Please check your inbox and verify.";
                    }else{echo "Message not sent. Mailer Error: {$mail->ErrorInfo}";}
            }
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <div>
        <h1>Login(Verfired user email)</h1>
        <form method="post">
        <div >
            <input placeholder="Email" type="email" name="email" required>
            <input placeholder="Password" type="password" name="pass" required>
        </div>
            <input type="submit" name="sub" value="Sign-In">
        </form>
        <br>
        <?php
            echo '<h3 style="color:blue;">'.$msg.'</h3>';
        ?>
    </div>
    <h3>Didn't verified yet? <a href="index.php">Register</a></h3>
</body>
</html>
