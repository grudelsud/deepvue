<?php
include 'EpiCurl.php';
include 'EpiOAuth.php';
include 'EpiTwitter.php';
include 'secret.php';

$twitterObj = new EpiTwitter($consumer_key, $consumer_secret);
//$twitterObj->getAuthenticationUrl();

echo '<a href="' . $twitterObj->getAuthenticationUrl() . '">Authorize with Twitter</a>';



?>

