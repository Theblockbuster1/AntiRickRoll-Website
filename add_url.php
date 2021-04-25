<?php

session_start();
if(isset($_GET["captcha"])&&$_GET["captcha"]!=""&&$_SESSION["code"]==$_GET["captcha"])
{
echo "";
//Do you stuff
}
else
{
die("Captcha incorrectly completed!");
}
?>
<?php
include 'header.php';

$ytfound=addslashes(preg_match("/(?:https?:)?(?:\/\/)?(?:[0-9A-Z-]+\.)?(?:youtu\.be\/|youtube(?:-nocookie)?\.com\S*?[^\w\s-])([\w-]{11})(?=[^\w-]|$)(?![?=&+%\w.-]*(?:['\"][^<>]*>|<\/a>))[?=&+%\w.-]*/i", $_GET['url'], $ytlink));
$datetime=date("d/m/y G:i:s"); 

if($ytfound)
{
	$detail=$ytlink[1];
}
else
{
	$detail=addslashes($_GET['url']);
}

if(empty($detail))
    {
    echo '<font color="red">'.EMPTYFIELD.'</font><br /><br />';
    }
	else    
    {
$sql="INSERT INTO links( detail, datetime)VALUES('$detail', '$datetime')";

$dupe = mysqli_query($link, "SELECT * FROM links WHERE detail='$detail'") or die (mysqli_error($link));
$num_rows = mysqli_num_rows($dupe);
if ($num_rows > 0) {
echo '<font color="red">ERROR! URL was already submitted!</font><br /><br />';
echo "<a href=\"search?key=".$detail."\">View URL</a>";
}
else
{

$result=mysqli_query($link, $sql);
$id = mysqli_insert_id($link); 
if($result){
echo "".URLADD."<br />";
echo "<br />".THANX."";
echo "<br />";
echo "<br />";
echo "<a href='".$id."'>".SEEYOURURL."</a>";

}

}

} 
?>

<?php
include 'footer.php';
?>
