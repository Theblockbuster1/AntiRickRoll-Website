<?php
$ipaddress = $_SERVER['REMOTE_ADDR'];
$date = date('d|m|Y H:i');
$browser = $_SERVER['HTTP_USER_AGENT'];

$file = 'iplog.txt';

$fp = fopen($file, 'a');

fwrite($fp, $ipaddress.' - ['.$date.'] '.$browser."\r\n");

fclose($fp);
?>
