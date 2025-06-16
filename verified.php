<?php
require_once('xkcd.php');
$xkcd = new xkcd();
error_reporting(0);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
include "database.php";
session_start();
if(!isset($_SESSION['login'])){
    header('location:login.php');
}

echo "Congratulations! You are all set for the comic universe. A random comic is shown below, if you want this in your inbox hit the button below.";
$email=$_SESSION['email'];
$qry="Select * from rtcamp where email='$email'";
$res=mysqli_query($conn,$qry);
$row=mysqli_fetch_array($res);
//getting a random comic
$comic = $xkcd->random();

//printing now
echo '<h1>'.$comic->safe_title.' - xkcd</h1>'; // title
echo "<img src=\"{$comic->img}\" title=\"{$comic->alt}\"/>"; //prints the image
echo '<h2>Transcript</h2><pre>'.$comic->transcript.'</pre>';
echo "<h2>Full version</h2><a href=\"{$comic->url}\">{$comic->url}</a>";
?>
<br>
<p>Click on the below button to receive mail from XKCD.(only once)</p>
<form method="post">
    <input type="submit" value="subscribe" name="sub"><br>
</form><br>
<a href="logout.php">Log Out</a><br>

<?php
    $c=0;
    if(isset($_POST['sub'])){
        require 'PHPMailer/Exception.php';
        require 'PHPMailer/PHPMailer.php';
        require 'PHPMailer/SMTP.php';

        mysqli_query($conn,"update rtcamp set subscribe='1' where email='$email'");
        while($row['subscribe']==1){

        $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = '-----@gmail.com';
            $mail->Password   = '----';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            //Recipients
            $mail->setFrom('sainihitik@gmail.com', 'Hitik Saini');
            $mail->addAddress($email);

            //Attachments
            $mail->addStringAttachment(file_get_contents($comic->img),'xkcd.png');

            $mail->isHTML(true);
            $mail->Subject = 'XKCD Comics';
            $mail->Body    .= '<h1>'.$comic->safe_title.' - xkcd</h1>'; // title
            $mail->Body    .= "<img src=\"{$comic->img}\" title=\"{$comic->alt}\"/>"; //prints the image
            $mail->Body    .= '<h2>Transcript</h2><pre>'.$comic->transcript.'</pre>';
            $mail->Body    .= "<h2>Full version</h2><a href=\"{$comic->url}\">{$comic->url}</a>";
            $mail->Body    .= '<a href=https://rtcamphitik.000webhostapp.com/unsubscribe.php?email='.$email.'>Click here to Unsubscribe.</a>'. "\r\n";

            if($mail->send()){
                if($c==0){
                    echo "XKCD sent to $email. ";
                    $c=1;
                }
                sleep(10);
            }
            else{
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }

}

?>
