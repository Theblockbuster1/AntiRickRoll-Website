<?php include 'header.php';?>
<table width="100%">
	<tr>
		<td><b><u><?php echo URLIST; ?></u></b></td>
	</tr>
	<tr>
		<table width="100%">
<?php 

function clean_url($rows){
	return str_replace(array('http://','https://'),'',$rows);
}

$act = $_GET['act'];
$id = $_GET['id'];

switch($act)
	{
	case 'delete';
$del='DELETE FROM links WHERE id='.$id.'';
$res=mysqli_query($link, $del)or die('Error SQL !'.$del.'<br>'.mysqli_error($link));
break;
}
$sql = 'SELECT * FROM links ORDER BY id DESC';
// $sql = 'SELECT * FROM links';
$result=mysqli_query($link, $sql);

while ($url=mysqli_fetch_array($result)){
echo '<tr>  
<td><a href="http://'.htmlspecialchars(clean_url($url['detail'])).'" target="_blank">'.$url['detail'].'</a> - &nbsp;<a href="links.php?act=delete&id='.$url['id'].'"><font color="red">'.DELETE.'</font></a></td>
      </tr>';
}
?>
</table>
<a name="bottom">
