<?php
//检查用户名及密码
function login_check($name,$pwd){
	global $default_user_name,$default_user_pwd;
	if($default_user_name == $name && $default_user_pwd == $pwd)
		return true;
	else
		return false;
}
//提示指定信息并跳转到指定页面
function warn($info,$url = ""){
	?>
	<script language="JavaScript">
	alert("<?=$info;?>");
	if("<?=$url;?>" != ""){
		window.location.href = "<?=$url;?>";
	}
	else history.back();
	</script>
    <?
	exit();
}

function redirect_once($url){
	echo "<meta http-equiv='refresh' content='0;url=$url'>";
}

function redirect($info,$url){
	echo $info;
	echo "<meta http-equiv='refresh' content='2;url=$url'>";
}
?>