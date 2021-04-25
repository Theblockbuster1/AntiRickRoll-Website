<?php include'header.php'; ?>

<table width="100%" align="center" border="0" align="center" cellpadding="0" cellspacing="1" >
<tr>
<td><table width="100%" border="0" cellpadding="3" cellspacing="1" bordercolor="1" bgcolor="#FFFFFF">
<tr>
<td bgcolor="#FFFFFF">
<form name="form1" method="get" action="add">
<center>
<strong><?php echo POSTURL; ?></strong><br/>
<input name="url" type="text" maxlength="100" size="50" placeholder="https://www.youtube.com/watch?v=dQw4w9WgXcQ" onKeyPress="return charLimit(this)" onKeyUp="return characterCount(this)"> <strong><span id="charCount"> 100</span></strong> characters remaining

<input type="hidden" type="text"><br />
<br />
<img src="captcha.php" title="Please complete the captcha"/><br />
<input name="captcha" type="text" size="6" maxlength="4" title="Please complete the captcha">

<br />
<br />
<input type="submit" class="btn" style="cursor:pointer" value="<?php echo SUBMIT; ?>" />
<br /><br><p>Submit your Rick Roll URL</p>
<br />
</center>
</td>
</tr>
</table>
</td>
</tr>
</table>

<?php
include 'footer.php';
?>
