<?php
require("../bootstrap.php");
$twitteroauth = new Abraham\TwitterOAuth\TwitterOAuth(
	'kcUhArVLnK6xzDpVJU85r7FJj',
	'dekH6UMluN2ZCCJ0v1q95w3DaIMeczsP1l3wAEjRwbn16G43aV',
	$_SESSION['oauth_token'],
	$_SESSION['oauth_token_secret']);

$access_token = $twitteroauth->oauth("oauth/access_token", array("oauth_verifier" => $_GET["oauth_verifier"]));
if($access_token){
	$_SESSION['access_token'] = $access_token;
	var_dump($access_token);
}
else {
	session_destroy();
}
header("Location: index.php");