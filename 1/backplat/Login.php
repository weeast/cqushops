<?php
/**
 $_POST时  直接返回带错误文本的xml格式数据。
 			其中  0 : 注册成功
 				 1 ： email格式不正确
 				 2 ：电话号码格式不正确。
 				 3 ：身份证格式不正确。
 				 4 ：密码格式不正确。
 				 5 : 未能接收数据
 				 6 ：注册失败!请稍后再试。
 $_GET时	   返回带错误标号的xml格式数据。
 			其中  0 ：无错误。
 				 1 : 为空。
 				 2 ：格式不正确。
 				 3 ：数据库中已存在。
 				 4 ：可选填。
 				 5 : 未能接收数据
 */
require_once('./functions/conn.php');
require_once('./functions/checkLogin.php');
session_start();
/*function check_all_unique($array,$array2)
 {
for($i=0;i<count($array);$i++)
{
reset($array);
$result=check_unique(key($array), current($array));
if($result!="")
	echo $array2["$result"];
next($array);
}
echo "已经存在。";
}*/
$xml = con();
header("Content-Type:text/xml;charset=utf-8");
//echo "<root>dd</root>";
//exit(1);
if($xml != '')
{
	echo $xml;
	exit(1);
}
if(!isset($_POST)&&!isset($_GET))
{
	$xml = "<error>5</error>";
	echo $xml;
	exit(1);
}
elseif(isset($_GET)&&$_GET['action']=="check"&&$_POST['action']!="register") //$_GET
{
	$currentValue = current($_GET);
	//	$xml = "<error>恭喜</error>";
	//	static $upwd_get = "";
	switch(key($_GET))
	{
		case "uname":
			{
				if($currentValue == '')
					$xml = "<error>1</error>";
				elseif(!check_al_num("$currentValue"))
				$xml = "<error>2</error>";
				elseif(check_unique("uname", "\"$currentValue\"")!="")
				$xml = "<error>3</error>";
				else
					$xml = "<error>0</error>";
				break;
			}
		case "upwd":
			{
				if($currentValue == '')
					$xml = "<error>1</error>";
				elseif(!check_al_num("$currentValue"))
				$xml = "<error>2</error>";
				else
				{
					$xml = "<error>0</error>";
					//				$upwd_get = $currentValue;
					//				$_SESSION[]
				}
				break;
			}
		case "phoneNum":
			{
				if($currentValue == '')
					$xml = "<error>1</error>";
				elseif(!check_phoneNum("$currentValue"))
				$xml = "<error>2</error>";
				elseif(check_unique("phoneNum", "\"$currentValue\"")!="")
				$xml = "<error>3</error>";
				else
					$xml = "<error>0</error>";
				break;
			}
		case "ID_card":
			{
				if($currentValue == '')
					$xml = "<error>1</error>";
				elseif(!check_num($currentValue))
				$xml = "<error>2</error>";
				else
					$xml = "<error>0</error>";
				break;
			}
		case "rname":
			{
				if($currentValue == '')
					$xml = "<error>1</error>";
				else
					$xml = "<error>0</error>";
				break;
			}
		case "email":
			{
				if($currentValue == '')
					$xml = "<error>1</error>";
				elseif(!check_email($currentValue))
				$xml = "<error>2</error>";
				else
					$xml = "<error>0</error>";
				break;
			}
		default:
			echo "<error>0</error>";
			exit(1);
	}
	echo $xml;
	exit(1);
}
else//if (isset($_POST)&&$_POST['action']=="submit") !isset($_GET)
{
/*	if ($_POST['uname']==''||$_POST["upwd"]==''||$_POST["phoneNum"]==''||$_POST["ID_card"]==''||$POST['rname'])
	{
		$xml = "<errorText>请填写必要选项。</errorText>";
		echo $xml;
		exit(1);
	}
	elseif ($_POST['upwd']!=$_POST['esupwd'])
	{
		$xml = "<errorText>两次密码输入不相符。</errorText>";
		echo $xml;
		exit(1);
	}*/
//	else
//	{
		//$row = $_POST; 
		/*for($i=0;$i<11;$i++)
		{
		echo "$row[$i]";
		}*/
		/*list($uname,$upwd,$pwd_question,$pwd_answer,$rname,$address,$sex,
				$postcode,$phoneNum,$email,$ID_card)=$row;*/
		//list($uname,$upwd,$rname,$sex,$ID_card,$phoneNum,$email)=each($_POST);
		$upwd=$_POST['upwd'];
		$uname=$_POST['uname'];
		$rname=$_POST['rname'];
		$sex=$_POST['sex'];
		$ID_card=$_POST['ID_card'];
		$phoneNum=$_POST['phoneNum'];
		$email=$_POST['email'];
		$pwd_question=$_POST['pwd_question'];
		$pwd_answer=$_POST['pwd_answer'];
		$address=$_POST['address'];
		$postcode=$_POST['postcode'];
		/*$pwd_question=$POST['pwd_question'];
		$pwd_answer=$POST['pwd_answer'];
		$address=$POST['address'];*/
		if(check_al_num($upwd))
		{
			if(check_num($ID_card))
			{
				if(check_phoneNum($phoneNum))
				{
				if(check_email($email))
				{
					$value = array('uname'=>"$uname",'email'=>"$email",'ID_card'=>"$ID_card");
					$name = array('uname'=>"用户名",'email'=>"email",'ID_card'=>"身份证");
					$xml = check_all_unique($value, $name);
				}
				else
					$xml = "<error>1</error>";
				}
				else
					$xml = "<error>2</error>";
			}
			else
				$xml = "<error>3</error>";
		}
		else 
			$xml = "<error>4</error>";
		if($xml != '')
		{
			echo $xml;
			exit(1);
		}
		else
		{
			$date = date('Y-m-d');
			$rows = "insert into users set uname=\"$uname\",email=\"$email\",ID_card=\"$ID_card\",upwd=\"$upwd\",pwd_question=\"$pwd_question\",pwd_answer=\"$pwd_answer\",sex=\"$sex\",rname=\"$rname\",phoneNum=\"$phoneNum\",address=\"$address\",postcode=\"$postcode\",rsdate=\"$date\"";
		//	echo $rows;
		//	$qq1 = mysql_query("set names utf8");
			$qq = mysql_query($rows);
		//	echo "$qq";
			if(!$qq)
				$xml = "<error>6</error>";
			else
			{
				$xml = "<error>0</error>";
				$_SESSION['uname']=$uname;
				$_SESSION['log']=true;
			}
			echo $xml;
		//	echo "<sex>$sex</sex>";
		}
//	}
}

?>
