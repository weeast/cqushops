

<script language="javascript">
function check(){
	if(myform.keyword.value==""){
		alert("�������ѯ�ؼ��֣�");myform.keyword.focus();return false;
	}
	if((myform.keyword.value.length)>50){
		alert("������ؼ��ֹ����������50���ַ��ڣ�");myform.keyword.focus();return false;
	}
}
</script>

<title>HL ������</title>
              <form name="myform" method="post" action="search.php" target="_self">
                <div id="search-text">
                    <input id="s" autofocus="true" name="keyword" type="text" size="45" onMouseOver="this.focus()" onFocus="this.select()" class="txt"/>
                </div>
                <input id="searchButton" name="submit" type="image" src="../../front/homepage/img/content/����.png" alt="Search" class="btn" onClick="return check();" />
                </form>