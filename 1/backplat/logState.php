<?php
header("Content-Type:text/xml;charset=utf-8");
session_start();
if(!isset($_POST['checklog']))
{
	echo "<error>查询失败</error>";
}
elseif($_POST['checklog']==0)
{
	if(!isset($_SESSION['log'])||$_SESSION['log']==false)
	{
		echo "<logState>0</logState>";
	}
	else 
	{
		$xml = "<xml>";
		$xml .= "<logState>1</logState>";
		$xml .= "<uname>".$_SESSION['uname']."</uname>";
		$xml .= "<email>".$_SESSION['email']."</email>";
		$xml .= "<sex>".$_SESSION['sex']."</sex>";
		$xml .= "<ID_card>".$_SESSION['ID_card']."</ID_card>";
		$xml .= "<pwd_question>".$_SESSION['pwd_question']."</pwd_question>";
		$xml .= "<pwd_answer>".$_SESSION['pwd_answer']."</pwd_answer>";
		$xml .= "<rname>".$_SESSION['rname']."</rname>";
		$xml .= "<phoneNum>".$_SESSION['phoneNum']."</phoneNum>";
		$xml .= "<address>".$_SESSION['address']."</address>";
		$xml .= "<postcode>".$_SESSION['postcode']."</postcode>";
		$xml .= "<rsdate>".$_SESSION['rsdate']."</rsdate>";
		$xml .= "</xml>";
		echo $xml;
	}
}
else 
{
	echo "<logState>0</logState>";
}
?>