<?php
include 'iplog.php';
include 'header.php';
$sql = 'SELECT count(*) FROM links';
$resultat = mysqli_query($link, $sql) or die('Error SQL!<br />'.$sql.'<br />'.mysqli_error());
$nb_total = mysqli_fetch_array($resultat);

if (($nb_total = $nb_total[0]) == 0) {
echo '';
}
else {

if (!isset($_GET['next'])) $_GET['next'] = 0;
if (!isset($_GET['act'])) {
$act = '';
} else { 
$act = $_GET['act'];
}
	$nb_affichage_par_page = 20;
	switch($act)
{
	case 'Recent';
$sql='SELECT * FROM links ORDER BY id DESC LIMIT '.$_GET['next'].','.$nb_affichage_par_page;
break;
case 'popular';
$sql='SELECT * FROM links ORDER BY view DESC LIMIT '.$_GET['next'].','.$nb_affichage_par_page;
break;
default:
$sql='SELECT * FROM links ORDER BY id DESC LIMIT '.$_GET['next'].','.$nb_affichage_par_page;
}

$result=mysqli_query($link, $sql)or die('Error SQL!'.$sql.'<br>'.mysqli_error($link));
?>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" >
<?php
switch($act){
		case 'recent':
			$instyle1 = " style=\"background:#ffffff\"";
			break;
		case 'popular':
			$instyle2 = " style=\"background:#ffffff\"";
			break;
                case 'all':
			$instyle3 = " style=\"background:#ffffff\"";
			break;
		default:
			$instyle1 = " style=\"background:#ffffff\"";
	}
	?>
<div id="tabnav">
	<ul>
	<li><a href="recent" <?php if (!empty($instyle1)){ echo $instyle1;} ?>><?php echo RECENT; ?></a></li>
	<li><a href="popular" <?php if (!empty($instyle2)){ echo $instyle2;} ?>><?php echo POPULAR; ?></a></li>
	<li><a href="all" <?php if (!empty($instyle3)){ echo $instyle3;} ?>><?php echo ALL; ?></a></li>
	</ul>
<?php 
$query = "SELECT distinct count(id) FROM links";
$r = mysqli_query($link, $query);
$row = mysqli_fetch_row($r);
$Number = $row[0];
echo "Total: $Number URLs";	
?>
</div>

<?php
while($rows=mysqli_fetch_array($result)){
?>
<tr>
<td bgcolor="#FFFFFF">
<?php
if ($rows)
{

?>
<div class="post"><h2><img src="https://img.youtube.com/vi/<?php echo htmlspecialchars($rows['detail']); ?>/mqdefault.jpg" title="<?php echo htmlspecialchars($rows['detail']); ?>"/> <a href="<?php echo $rows['id']; ?>"><?php echo htmlspecialchars($rows['detail']); ?></a></h2><p class="byline"><small>
<?php echo POSTBY; ?> <?php echo ON; ?> <?php echo $rows['datetime']; ?> GMT</small></p></div><BR></td>
<td valign="top">
<table width="100%">
<tr>
<td width="50" height="50" align="center" valign="middle" style="font-weight: bold; border: 1px solid #000099; background-color: #eee; color :#FFFFFF">
<?php echo $rows['view']; ?><br />
<?php echo VIEWS; ?></td></tr>
<tr>
</tr></table>
</td>

<?php
}
else
{
?>

<?php
}
}
?>

<?php
}
?>
</table>

<table><tr><td align="center"><?php echo '<div class="pagination">
<span class="disabled"><</span>'.navigation($nb_total, $nb_affichage_par_page, $_GET['next'], 10).'</div>';?></td></tr></table>

<?php
include 'footer.php';
?>
