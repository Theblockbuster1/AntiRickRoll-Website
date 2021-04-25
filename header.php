<?php 
require('ban-ip.php');
if(isset($_COOKIE['lang']) && $_REQUEST['lang'] == '') {  			
	$lang = $_COOKIE['lang'];
	$test=1;
	}
elseif (isset($_REQUEST['lang']) && $_REQUEST['lang'] != '') {    
	$lang = $_REQUEST['lang'];
	set_cookie($lang);
	$test=2;
	}
else {			
	$lang = substr($HTTP_SERVER_VARS['HTTP_ACCEPT_LANGUAGE'],0,2);
	set_cookie($lang);
	$test=3;
}


function set_cookie($lang) {

$expire = 365*24*3600;

if (setcookie("lang", $lang, time() + $expire) != TRUE)
{
     echo '';
}
}

include('inc/lang/lang_en.php');

include 'inc/config.php';
require_once'functions.php';
include'inc/lang/lang_'.LANG.'.php'; 
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<?php
$queryString = strtolower($_SERVER['QUERY_STRING']); 
if (strstr($queryString,"<") OR strstr($queryString,">") OR strstr($queryString,"(") OR strstr($queryString,")") OR 
strstr($queryString,"..") OR 
// strstr($queryString,"/") OR //this block urls with symbol /  ... if you want have clean urls without slashes, then uncomment this shit :)
// strstr($queryString,"%") OR 
strstr($queryString,"*") OR 
strstr($queryString,"+") OR 
strstr($queryString,"!") OR 
strstr($queryString,"@")) { 
$loc = $_SERVER['PHP_SELF']; 
$ip = $_SERVER['REMOTE_ADDR']; 
$date = date ("d-m-Y @ h:i:s"); 
$lfh = "log.html"; 
$log = fopen ( $lfh,"a+" ); 
fputs ($log, "Date: $date | Attack IP: $ip | Attack of: $loc?=$queryString\n<br>"); 
fclose($log); 
echo "<font color=red>Please don't abuse >:(</font>"; 
exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" type="image/x-icon" href="./images/addurl.ico">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="etibot" content="he will find your website:)" />
<title><?php echo SITENAME; ?> | <?php echo SLOGAN; ?></title>
<meta name="description" content="Add URL - Add your Website">
<meta name="keywords" content="add website, add url, add link, submit website, submit url, url submitter, url submit, url directory, url submit free, free web submission, free directory submission, link directory, website directory, web directory, добави линк, добави сайт, добави link, добави url, добави уебсайт, сео, сео директория, сео оптимизация, добавяне на сайт в търсачки, регистриране в търсачки, уеб директория">
<META NAME="AUTHOR" CONTENT="ETI Dev.">
<meta name="language" content="en">
<META NAME="COPYRIGHT" CONTENT="ETI.bl.ee">
<meta name="robots" content="index, follow">
<meta name="revisit-after" content="2 days">
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
<style type="text/css">
#arrowUp {
  position: fixed;
  height: auto;
  width: auto;
  right: 10px;
  bottom: 10px;
  font-size: 32px;
}
#arrowUp a {
  text-decoration: none;
  color: #176FA9;
  font-weight: bold;
  font-family: serif;
}
#arrowUp a:hover {
  color: #000000;
}
</style>

<script type="text/javascript">
var maxLength=63;
function charLimit(el) {
    if (el.value.length > maxLength) return false;
    return true;
}
function characterCount(el) {
    var charCount = document.getElementById('charCount');
    if (el.value.length > maxLength) el.value = el.value.substring(0,maxLength);
    if (charCount) charCount.innerHTML = maxLength - el.value.length;
    return true;
}
</script>

<script src="https://cdn.jsdelivr.net/npm/darkreader@4.9.27/darkreader.min.js"></script>
<script>
  DarkReader.auto();
</script>

</head>

<body>

<script type="text/javascript">
var appended = false, bookmark = document.createElement("div");
bookmark.id = "arrowUp";
bookmark.innerHTML = "<a href=\"#\" title=\"On Top\">&uarr;<\/a>";
 
onscroll = function() {
  var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
  if (scrollTop > 500) {
    if (!appended) {
      document.body.appendChild(bookmark);
      appended = true;
    }
  } else {
    if (appended) {
      document.body.removeChild(bookmark);
      appended = false;
    }
  }
};
</script>

<div id="header">
	<div id="logo">
		<h1><a href="./"><?php echo SITENAME; ?></a></h1>
		<p><?php echo SLOGAN; ?></p>
	</div>

	<div id="menu">
		<ul>
			<li class="first"><a href="./"><?php echo HOME; ?></a></li>
			<li><a href="add-url"><?php echo POSTURL; ?></a></li>
                                <li id="search">
					<form method="get" action="search">
						<fieldset>
						<input type="text" id="s" name="key" maxlength="63" placeholder="website name here" value="" title="Without http:// Don't enter special characters (like slashes) and other symbols!" />
						<input type="submit" id="x" class="btn" value="<?php echo SEARCH; ?>" />
						</fieldset>
					</form>
				</li>
		</ul>
	</div>

</div>

<div id="page">
<div id="content">
<br />
