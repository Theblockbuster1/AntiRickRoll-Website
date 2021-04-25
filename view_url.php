<?php
//include 'header.php';

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

$queryString = strtolower($_SERVER['QUERY_STRING']); 
if (strstr($queryString,"<") OR strstr($queryString,">") OR strstr($queryString,"(") OR strstr($queryString,")") OR 
strstr($queryString,"..") OR 
//strstr($queryString,"%") OR 
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
<?php
function clean_url($rows){
	//return str_replace(array('http://','https://','www.'),'',$rows);
	if (substr($rows, 0, 4) === 'http')
	{
		return str_replace(array('http://','https://'),'',$rows);
	}
	else
	{
		return 'youtu.be/'.$rows;
	}
}

$id=$_GET['id'];
$sql="SELECT * FROM links WHERE id='$id'";
$result=mysqli_query($link, $sql);
$rows=mysqli_fetch_array($result);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" type="image/x-icon" href="./images/addurl.ico">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo htmlspecialchars(clean_url($rows['detail'])); ?> | <?php echo SLOGAN; ?></title>
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
						<input type="text" id="s" name="key" maxlength="100" placeholder="website name here" value="" title="Search" />
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

<table width="100%"border="0" align="center" cellpadding="0" cellspacing="1" >
<tr>
<td><table width="100%" border="0" cellpadding="3" cellspacing="1" bordercolor="1" bgcolor="#FFFFFF">
<tr>
<td bgcolor="#FFFFFF">
<div class="post"><h2><a href="http://<?php echo htmlspecialchars(clean_url($rows['detail'])); ?>" target="_blank"><img src="https://img.youtube.com/vi/<?php echo htmlspecialchars($rows['detail']); ?>/mqdefault.jpg" title="<?php echo htmlspecialchars($rows['detail']); ?>"/><br /><?php echo htmlspecialchars($rows['detail']); ?></a></h2><p class="byline"><small>
<?php echo CATEGORY ?> Internet | <?php echo "".POSTBY." ".ON." ".$rows['datetime']."" ?> (Greenwich Mean Time)</small>
<?php echo "".VIEWS.": ".$rows['view']."" ?> 

<?php
echo '<br /><a href="http://tools.eti.pw/whois.php?domain='.htmlspecialchars($rows['detail']).'" target="_blank">View Whois Information</a>';
echo '<br /><a href="http://seo.eti.pw/analyser.php?site='.htmlspecialchars(clean_url($rows['detail'])).'" target="_blank"> View SEO Report</a>';
echo '<br /><a href="http://seo.eti.pw/google-pagerank-checker.php?url='.htmlspecialchars($rows['detail']).'" target="_blank"> View Google Pagerank</a>';
echo '<br /><a href="http://seo.eti.pw/google-backlinks-count.php?url='.htmlspecialchars($rows['detail']).'" target="_blank"> View Google Backlinks</a>';
echo '<br /><a href="https://www.google.com/transparencyreport/safebrowsing/diagnostic/index.html#url='.htmlspecialchars($rows['detail']).'" target="_blank"> View Google Safe Browsing Site Status</a>';
echo '<br /><a href="http://seo.eti.pw/alexa-rank-checker.php?url='.htmlspecialchars($rows['detail']).'" target="_blank"> View Alexa Rank</a>';
echo '<br /><a href="http://seo.eti.pw/social-popularity-checker.php?url='.htmlspecialchars($rows['detail']).'&submit=Check" target="_blank"> View Social popularity</a>';
echo '<br /><a href="http://whatcms.ga/search.php?key='.htmlspecialchars(clean_url($rows['detail'])).'" target="_blank"> View What CMS is</a>';
echo '<br /><a href="http://builtwith.com/'.htmlspecialchars(clean_url($rows['detail'])).'" target="_blank"> View What Tech is</a>';
echo '<br /><a href="http://www.copyscape.com/?q='.htmlspecialchars($rows['detail']).'" target="_blank"> View Plagiarism</a>';
echo '<br /><a href="http://www.spamhaus.org/query/domain/'.htmlspecialchars($rows['detail']).'" target="_blank" title="Check if this domain is listed in DBL">View Blacklist status DBL</a>';
?>
<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-508888f258587131"></script>
<!-- AddThis Button END -->	
<a href="remove"><img src="images/flag.png" title="Remove your URL from our directory"></a>
</p></div><br>

<?php
// $sql3="SELECT view FROM links WHERE id='$id'";
// $result3=mysqli_query($link, $sql3);
// $rows=mysqli_fetch_array($result3);
// $view=$rows['view'];

// if(empty($view)){
// $view=1;
// $sql4="INSERT INTO links(view) VALUES('$view') WHERE id='$id'";
// $result4=mysqli_query($link, $sql4);
// }

// $addview=$view+1;
// $sql5="update links set view='$addview' WHERE id='$id'";
// $result5=mysqli_query($link, $sql5);
?>
</td>
</tr>
</table>
</td>
</tr>
</table>

<?php
include 'footer.php';
?>
