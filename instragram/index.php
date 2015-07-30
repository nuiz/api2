<?php
require("../bootstrap.php");
$instagram = new MetzWeb\Instagram\Instagram(array(
    'apiKey'      => '2edda6ebe18d4422b609c93bda5744f9',
    'apiSecret'   => '5c23e7f88dcf4c45827fb59692665e02',
    'apiCallback' => 'http://api1.papangping.com/instragram'
));

if(empty($_SESSION['instragram']) && empty($_GET['code'])){
	header("Location: ".$instagram->getLoginUrl());
	exit();
}

if(!empty($_GET['code'])){
	$code = $_GET['code'];
	$data = $instagram->getOAuthToken($code);
	$_SESSION['instragram'] = $data;
	header("Location: index.php");
	exit();
}
?>
<html>
<head>
	<meta charset="utf-8">
	<script type="text/javascript" src="public/jquery/jquery-1.11.3.min.js"></script>
</head>
<body>
<div>
<img src="<?php echo $_SESSION['instragram']->user->profile_picture;?>"> <strong><?php echo $_SESSION['instragram']->user->username;?></strong>
<div>
<div>
	<!-- <a class="getApi-btn" href="api.php?action=engagement">engagement</a> -->
	<a class="getApi-btn" href="api.php?action=feed">feed</a>
	<a class="getApi-btn" href="api.php?action=followers">followers</a>
	<a class="getApi-btn" href="api.php?action=recent_media">recent media</a>
	<div>
		lat: <input id="lat-search">
		lng: <input id="lng-search">
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
	var $lat = $('#lat-search');
	var $lng = $('#lng-search');
	$('.getApi-btn').click(function(e){
		e.preventDefault();
		$displayJson.text('loading...');
		var url = $(this).attr("href");
		if($(this).hasClass('search-api')){
			url += '&lat='+$lat.val()+'&lng='+$lng.val();
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