<?php
require_once('twitteroauth/twitteroauth.php');
global $total;
$total = 0;

/* Config */
$ck = ''; //CONSUMER_KEY
$cs = ''; //CONSUMER_SECRET
$ot = ''; //OAUTH_TOKEN
$ots = ''; ////OAUTH_TOKEN_SECRET
$tweet = '#jokowi'; //Tweet

function countTweet($ckey, $csec, $otkn, $otks, $query){
    global $total;
    $connection = new TwitterOAuth($ckey, $csec, $otkn, $otks);
    $get = $connection->get('https://api.twitter.com/1.1/search/tweets.json'.$query);
    $total += count($get['statuses']);
    if(isset($get['search_metadata']['next_results'])){
        countTweet($ckey, $csec, $otkn, $otks, $get['search_metadata']['next_results']);
    }
    return $total;
}

echo "Total tweet of (".$tweet.") : ".countTweet($ck, $cs, $ot, $ots, '?q='.urlencode($tweet).'&count=100&since_id=100');
?>
