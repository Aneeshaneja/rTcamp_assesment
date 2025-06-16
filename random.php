<title>rtCamp_randomXKCD - Hitik Saini</title>
<?php
require_once('xkcd.php');
$xkcd = new xkcd();

//getting a random comic
$comic = $xkcd->random();

//printing now
echo '<h1>'.$comic->safe_title.' - xkcd</h1>'; // title
echo "<img src=\"{$comic->img}\" title=\"{$comic->alt}\"/>"; //prints the image
echo '<h2>Transcript</h2><pre>'.$comic->transcript.'</pre>';
echo "<h2>Full version</h2><a href=\"{$comic->url}\">{$comic->url}</a>";
