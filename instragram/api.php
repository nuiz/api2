<?php
require("../bootstrap.php");
class MyInstragram extends MetzWeb\Instagram\Instagram {
	public function makeCall($function, $auth = false, $params = null, $method = 'GET'){
		return $this->_makeCall($function, $auth = false, $params = null, $method = 'GET');
	}
}
$instragram = new MyInstragram(array(
    'apiKey'      => '2edda6ebe18d4422b609c93bda5744f9',
    'apiSecret'   => '5c23e7f88dcf4c45827fb59692665e02',
    'apiCallback' => 'http://api1.papangping.com/instragram'
));
$instragram->setAccessToken($_SESSION['instragram']);

header("Content-Type: application/json");
if($_GET['action'] == 'engagement'){
	$data = $instragram->getUserFeed(20);
	echo json_encode($data);
}
else if($_GET['action'] == 'feed'){
	$data = $instragram->getUserFeed(20);
	echo json_encode($data);
}
else if($_GET['action'] == 'followers'){
	$data = $instragram->getUserFollower(20);
	echo json_encode($data);
}
else if($_GET['action'] == 'recent_media'){
	$data = $instragram->getUserMedia(20);
	echo json_encode($data);
}
else if($_GET['action'] == 'search'){
	$data = $instragram->searchMedia($_GET['lat'], $_GET['lng']);
	echo json_encode($data);
}
