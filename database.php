<?php
define("DB_SERVER", "localhost");
define("DB_USER", "id16861366_root");
define("DB_PASSWORD", "^b\q3OXz^xDOkHj3");
define("DB_DATABASE", "id16861366_rtcamp");

  $conn = mysqli_connect(DB_SERVER , DB_USER, DB_PASSWORD, DB_DATABASE);
    if(!$conn){
        die("Unable to connect the server").mysqli_error($conn);
    }
?>

<!-- CREATE TABLE `rtcamp` (
  `id` varchar(70) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `status` int(11) NOT NULL,
  `subscribe` int(11) NOT NULL
) -->
<!--
^b\q3OXz^xDOkHj3 -->
