<?php
require("./user.php");
require("./common/function.php");

@session_start();
if($_POST){
$user_name = trim($_POST['user_name']);
$user_pwd = trim($_POST['user_pwd']);
if(login_check($user_name,$user_pwd)){

$_SESSION['user_name']=$user_name;
$url = './manage.php';
redirect_once($url);
}
else{
warn("用户名或者密码错误,请重新输入","./login.php");
}
}
else{
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE>管理员登录</TITLE>
<meta http-equiv="Content-Type" content="text/html;charset=gb2312">

</HEAD>
<BODY>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<table width="520" height='360' border="0" align="center"
	cellpadding="0" cellspacing="0" bgcolor="#ccddee"
	background="./images/login.PNG">
	<tr class='toptitle1'>
		<td width='47' height="157">&nbsp;</td>

		<td colspan=2>&nbsp;</td>
	</tr>
	<tr height='10px'>
		<td colspan=3></td>
	</tr>
	<form name='login' method='post' action='../manage/login.php'>
	<tr height='34px'>
		<td height="30"></td>
		<td width='52' height="30">用户名：</td>
		<td width="421" height="30"><input type='text' id='user_name'
			name='user_name' size=25></td>
	</tr>
	<tr height='34px'>
		<td height="30"></td>
		<td height="30">密&nbsp;&nbsp;码：</td>
		<td height="30"><input type='password' name='user_pwd' size=25></td>
	</tr>
	<tr height='34px'>
		<td height="30"></td>
		<td height="30"></td>
		<td height="30">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input name="submit" type='submit' class="btn1" id="submit"
			style="line-height: 18px; height: 20px" value=' 执行 '></td>
	</tr>
	</form>
	<tr></tr>
</table>

</BODY>
</HTML>
<?php
}
?>
