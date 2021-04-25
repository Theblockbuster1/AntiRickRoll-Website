<?php
session_start();
if (!isset($_SESSION['login'])) {
	header ('Location: index.php');
	exit();
}
include '../inc/config.php';
include'../inc/lang/lang_'.LANG.'.php'; 
?>

<html>
<head>
<title>ADMINISTRATION</title>
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

</head>

<body>

<script type="text/javascript">
$('html, body').animate({
   scrollTop: $('footer').offset().top
   //scrollTop: $('#your-id').offset().top
   //scrollTop: $('.your-class').offset().top
}, 'slow');
</script>

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
<table width="100%">
	<tr>
		<td align="center">
		<a href="links.php"><?php echo ALLURL; ?></a> | <a href="../iplog.txt" target="_blank">View IP Log</a> | <a href="../delete-iplog.php" target="_blank">Delete IP Log</a> | <a href="../log.html" target="_blank">View "IP Attack" Log</a> | <a href="../delete-log.php" target="_blank">Delete "IP Attack" Log</a> | <a href="../" target="_blank">View Website</a> | <a href="disconnect.php"><?php echo LOGOUT; ?></a>
		</td>
	</tr>
</table>
<a href="#bottom" style="float: right;" title="On bottom">&darr;</a>
<br />
