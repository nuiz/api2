<?php
require("../bootstrap.php");
$twitteroauth = new Abraham\TwitterOAuth\TwitterOAuth('kcUhArVLnK6xzDpVJU85r7FJj', 'dekH6UMluN2ZCCJ0v1q95w3DaIMeczsP1l3wAEjRwbn16G43aV');
$request_token = $twitteroauth->oauth("oauth/request_token",
	array('oauth_callback'=> 'http://api1.papangping.com/twitter/oauthcallback.php'));

$_SESSION['oauth_token'] = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
 
// If everything goes well..
if($request_token['oauth_token']){
    // Let's generate the URL and redirect
    $url = $twitteroauth->url("oauth/authorize", array("oauth_token"=> $request_token['oauth_token']));
    header('Location: '. $url);
} else {
    // It's a bad idea to kill the script, but we've got to know when there's an error.
    die('Something wrong happened.');
}