

<script language="javascript">
function check(){
	if(myform.keyword.value==""){
		alert("请输入查询关键字！");myform.keyword.focus();return false;
	}
	if((myform.keyword.value.length)>50){
		alert("请输入关键字过长，请简化在50个字符内！");myform.keyword.focus();return false;
	}
}
</script>

<title>HL 二搜索</title>
              <form name="myform" method="post" action="search.php" target="_self">
                <div id="search-text">
                    <input id="s" autofocus="true" name="keyword" type="text" size="45" onMouseOver="this.focus()" onFocus="this.select()" class="txt"/>
                </div>
                <input id="searchButton" name="submit" type="image" src="../../front/homepage/img/content/搜索.png" alt="Search" class="btn" onClick="return check();" />
                </form>