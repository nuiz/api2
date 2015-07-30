<?php
require("../bootstrap.php");
if(empty($_SESSION['access_token'])){
	header("Location: oauth.php");
	exit();
}
$twitteroauth = new Abraham\TwitterOAuth\TwitterOAuth(
	'kcUhArVLnK6xzDpVJU85r7FJj',
	'dekH6UMluN2ZCCJ0v1q95w3DaIMeczsP1l3wAEjRwbn16G43aV',
	$_SESSION['access_token']['oauth_token'],
	$_SESSION['access_token']['oauth_token_secret']);
?>
<html>
<head>
	<meta charset="utf-8">
	<script type="text/javascript" src="public/jquery/jquery-1.11.3.min.js"></script>
</head>
<body>
<div>
name: <strong><?php echo $_SESSION['access_token']['screen_name'];?></strong>
<div>
<div>
	<a class="getApi-btn" href="api.php?action=followers">followers</a>
	<a class="getApi-btn" href="api.php?action=mentions">mentions</a>
	<a class="getApi-btn" href="api.php?action=retweets">retweets</a>
	<div>
		<input id="keyword-search">
		<a class="getApi-btn search-api" href="api.php?action=search">search</a>
	</div>
	<div>
		<pre id="displayJson"></pre>
	</div>
</div>
<script type="text/javascript">
$(function(){
	function objToJsonString(obj){
		return JSON.stringify(obj, null, '\t');
	};

	var $displayJson = $('#displayJson');
	var $keywordSearch = $('#keyword-search');
	$('.getApi-btn').click(function(e){
		e.preventDefault();
		$displayJson.text('loading...');
		var url = $(this).attr("href");
		if($(this).hasClass('search-api')){
			url += '&q='+$keywordSearch.val();
		}
		$.get(url, function(data){
			if(typeof data.error != "undefined"){
				alert("Token expired");
				window.location.href = "oauth.php";
			}
			$displayJson.text(objToJsonString(data));
		}, 'json');
	});
});
</script>
</body>
</html>