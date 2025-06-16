<?php
    include "database.php";
    $code=$_GET['id'];
    $id=mysqli_real_escape_string($conn,$code);
    mysqli_query($conn,"update rtcamp set status='1' where id='$id'");
    echo"<b>Your email is verified now! </b><br>";
?>
<a href="login.php">Login in now</a>
