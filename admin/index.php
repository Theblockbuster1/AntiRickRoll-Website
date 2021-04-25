<?php
include '../inc/config.php';
include'../inc/lang/lang_'.LANG.'.php'; 

if (isset($_POST['connection'])== 'Connection') {
	if ((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['pass']) && !empty($_POST['pass']))) {

		$sql = 'SELECT count(*) FROM admin WHERE login="'.mysqli_escape_string($link, $_POST['login']).'" AND pass_md5="'.md5(mysqli_escape_string($link, $_POST['pass'])).'"';
		$req = mysqli_query($link, $sql) or die('Error SQL !<br />'.$sql.'<br />'.mysqli_error());
		$data = mysqli_fetch_array($req);

		mysqli_free_result($req);
		mysqli_close($link);

		if ($data[0] == 1) {
			session_start();
			$_SESSION['login'] = $_POST['login'];
			header('Location: admin.php');
			exit();
		}
		
		elseif ($data[0] == 0) {
			$erreur = 'farewell';
		}

		else {
			$erreur = 'Problem in DB';
		}
	}
	else {
		$erreur = 'farewell >:(';
	}
}
?>
<html>
<head>
<title>.::Admin Zone::.</title>
</head>

<body>
<table width="100%">
	<tr>
		<td align="center">
<b><?php echo ADMIN; ?></b>
		</td>
	</tr>
</table>	
<br />
<table width="50%" align="center">
<form action="index.php" method="post">
	<tr>
		<td><?php echo NICKNAME; ?></td><td><input type="text" name="login" value="<?php if (isset($_POST['login'])) echo htmlentities(trim($_POST['login'])); ?>"></td>
	</tr>
	<tr>
		<td><?php echo PASS; ?></td><td><input type="password" name="pass" value="<?php if (isset($_POST['pass'])) echo htmlentities(trim($_POST['pass'])); ?>"></td>
	</tr>
</table>
<table width="100%">	
	<tr>
		<td align="center"><input type="submit" name="connection" value="<?php echo SUBMIT; ?>"></td>
	</tr>
</form>
</table>
<br />
<center>
<?php
if (isset($erreur)) echo '<br /><br />',$erreur;
?>
</center>
<?php
include 'footer.php';
?>
</body>
</html>
