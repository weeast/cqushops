<?php
session_start();
header("Content-Type:text/xml;charset=utf-8");
if(!isset($_POST['logOut']))
	echo "<logOut>0</logOut>";
elseif($_POST['logOut']==1)
{
	$_SESSION['log']=false;
	$_SESSION['uname']=null;
	echo "<logOut>1</logOut>";
}
?>