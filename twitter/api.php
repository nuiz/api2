<?php
require("../bootstrap.php");
$twitteroauth = new Abraham\TwitterOAuth\TwitterOAuth(
	'kcUhArVLnK6xzDpVJU85r7FJj',
	'dekH6UMluN2ZCCJ0v1q95w3DaIMeczsP1l3wAEjRwbn16G43aV',
	$_SESSION['access_token']['oauth_token'],
	$_SESSION['access_token']['oauth_token_secret']);

header("Content-Type: application/json");
if($_GET['action'] == 'followers'){
	$data = $twitteroauth->get("followers/list");
	echo json_encode($data);
}
else if($_GET['action'] == 'mentions'){
	$data = $twitteroauth->get("statuses/mentions_timeline");
	echo json_encode($data);
}
else if($_GET['action'] == 'retweets'){
	$data = $twitteroauth->get("statuses/retweets_of_me");
	echo json_encode($data);
}
else if($_GET['action'] == 'search'){
	$data = $twitteroauth->get("search/tweets", array("q"=> $_GET['q']));
	echo json_encode($data);
}
