<?php
include 'EpiCurl.php';
include 'EpiOAuth.php';
include 'EpiTwitter.php';
include 'secret.php';




//echo "{$_COOKIE['oauth_token']}\n";
//echo "{$_COOKIE['oauth_token_secret']}\n";

$twitterObj = new EpiTwitter($consumer_key, $consumer_secret, $_COOKIE['oauth_token'], $_COOKIE['oauth_token_secret']);

//$twitterInfo= $twitterObj->post_statusesUpdate("testing");
//$post_tweet = "Heres the test";  
// update the status  
//$update_status = $twitterObj->post_statusesUpdate(array('status' => $post_tweet));  
// get the ID of the tweet just sent  
//$tweet_id = $update_status->response['id'];  



$twitterInfo= $twitterObj->get_statusesFriends();
echo "<h1>Your friends are</h1><ul>";
foreach($twitterInfo as $friend) {
  echo "<li><img src=\"{$friend->profile_image_url}\" hspace=\"4\">{$friend->screen_name}</li>";
}
echo "</ul>";



$twitterInfo= $twitterObj->get_statusesFollowers();
echo "<h1>Your followers are</h1><ul>";
foreach($twitterInfo as $friend) {
  echo "<li>{$friend->screen_name}</li>";
}
echo "</ul>";


//get_statusesFollowers

?>
