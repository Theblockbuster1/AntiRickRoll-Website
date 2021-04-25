<?php

require_once'functions.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-Type: application/json");

$ytfound=addslashes(preg_match("/(?:https?:)?(?:\/\/)?(?:[0-9A-Z-]+\.)?(?:youtu\.be\/|youtube(?:-nocookie)?\.com\S*?[^\w\s-])([\w-]{11})(?=[^\w-]|$)(?![?=&+%\w.-]*(?:['\"][^<>]*>|<\/a>))[?=&+%\w.-]*/i", $_GET['url'], $ytlink));
$datetime=date("d/m/y G:i:s"); 

if ($ytfound) {
	$url=$ytlink[1];
} else {
	$url=htmlspecialchars($_GET['url']);
}

$regex = [
	"/(https?:\/\/)?(www\.)?latlmes\.com\/.*?\/.*?-1/iA",
	"/(https?:\/\/)?(www\.)?thisworldthesedays\.com.*/iA",
	"/(https?:\/\/)?(www\.)?tomorrowtides\.com.*/iA",
	"/(https?:\/\/)?(www\.)?theraleighregister\.com.*/iA",
	"/(https?:\/\/)?(www\.)?sanfransentinel\.com.*/iA"
];
$i = 0;
while (!$roll) {
	if (!$regex[$i]) break;
    if (preg_match($regex[$i], $_GET['url'])) {
		$roll = true;
	}
	$i++;
}

if (!$roll) {
	$sql="SELECT count(*) FROM links WHERE detail='$url'";
	$resultat = mysqli_query($link, $sql) or die('Error SQL!<br />'.$sql.'<br />'.mysqli_error($link));
	$rows = mysqli_fetch_array($resultat);
	
	if(($rows = $rows[0]) == 0) {
		$roll = false;
	} else {
		$roll = true;
	}
}

if (!$roll) {
    $response = array(
        'status' => false,
		'url' => $url,
        'message' => 'URL is not in Rick Roll database'
    );
}
else {
    $response = array(
        'status' => true,
		'url' => $url,
        'message' => 'URL seems to be a Rick Roll'
    );
}

echo json_encode($response);

if ($_GET['extension']) {
	$sql3="SELECT view FROM links WHERE detail='$url'";
	$result3=mysqli_query($link, $sql3);
	$rows=mysqli_fetch_array($result3);
	$view=$rows['view'];

	if(empty($view)){
		$view=0;
		$sql4="INSERT INTO links(view) VALUES('$view') WHERE detail='$url'";
		$result4=mysqli_query($link, $sql4);
	}

	$addview=$view+1;
	$sql5="update links set view='$addview' WHERE detail='$url'";
	$result5=mysqli_query($link, $sql5);
}

?>