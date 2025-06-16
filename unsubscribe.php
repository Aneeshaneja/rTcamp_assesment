<?php
include "database.php";
    $code=$_GET['email'];
    $email=mysqli_real_escape_string($conn,$code);
    mysqli_query($conn,"update rtcamp set subscribe='0' where email='$email'");
    echo"<b>You have successfully unsubscribed the email from XKCD Comics, after few minutes you won't receive emails</b>";
?>
