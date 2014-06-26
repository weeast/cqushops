<?php
require("splitword.php");
require("common/function.php");
if($_GET){
	$q1=gl($_GET[q1]);
	$q2=gl($_GET[q2]);
	$q3=gl($_GET[q3]);
	$q04=gl1($_GET[q4]);
}
if($_GET[g_submit]!=""){
	$q1=gl($q1);			//获取包含全部的关键词，需要使用分词技术,过滤标点符号
	$q2=gl($q2);			//获取完整的关键词，不需要分词

	$q3=gl($q3);			//获取任意一个关键词，需要使用分词技术,过滤标点符号
	$q04=gl1($q4);			//过滤标点符号
}
$time_start = getmicrotime();	//开始计时
$sp = new SplitWord();	//创建对象
$q1=$sp->SplitRMM($q1);	//对第一个条件进行分词
$q01=dunhao($q1);
$sp3 = new SplitWord();	//创建对象
$q3=$sp3->SplitRMM($q3);	//对第三个条件进行分词
$q03= dunhao($q3);		//去掉后面的“、”符号
$sp->Clear();
?>
<?php
	require_once("./common/db_mysql.class.php");		//调用数据源文件
	$DB = new DB_MySQL;									//创建对象
	
	/* ********** 将第一个条件(包含全部的关键词)转换成数组************ */
	if($q1!=""){
		$q1 = explode("、",$q01);						//应用explode()函数将字符串转换成数组
		//合并查询结果集
		for($i=0;$i<count($q1);$i++){
			$sql0.=" title like '%".trim($q1[$i])."%'"." or";	
		}
		$sql0=substr($sql0,0,-2);						//去掉最后一个“or”	

		for($j=0;$j<count($q1);$j++){
			$sql1.=" content like '%".trim($q1[$j])."%'"." and";	
		}
		$sql1=substr($sql1,0,-3);						//去掉最后一个“and”	
		$sql11="((".$sql0.")"."or"."(".$sql1."))";		//获得第一条件的表达式
	}else{
		$sql1="";
	}
	/* ************************************************************** */

	/* ********** 将第二个条件(包含完整的关键词)转换成数组*********** */
	//$sql22变量值不需要分词，只需要过滤标点符号,因此$sql2=$gl($q2)
	if($q2!=""){
		if($q1==""){
			$sql22="("."title like '%".$q2."%' or content like '%".$q2."%'".")";
		}else{
			$sql22="and ("."title like '%".$q2."%' or content like '%".$q2."%'".")";
		}
	}else{
		$sql22="";
	}
	/* ************************************************************** */

	/* ********** 将第三个条件(包含全部的关键词)转换成数组************ */
	if($q3!=""){
		$q3 = explode("、",$q03);						//应用explode()函数将字符串转换成数组
		//合并查询结果集
		for($m=0;$m<count($q3);$m++){
			$sql2.=" title like '%".trim($q3[$m])."%'"." or";	
		}
		for($n=0;$n<count($q3);$n++){
			$sql3.=" content like '%".trim($q3[$n])."%'"." or";	
		}
		$sql3=substr($sql3,0,-2);							//去掉最后一个“or”	
		if($q1=="" && $q2==""){
			$sql33="(".$sql2.$sql3.")";						//获得第三个条件的表达式
		}else{
			$sql33="and (".$sql2.$sql3.")";					//获得第三个条件的表达式
		}

	}else{
		$sql33="";
	}
	/* ************************************************************** */
	
	/* ********** 将第四个条件(不包含任意的关键词)转换成数组************ */
	if($q4!=""){
		$q4 = explode(" ",$q04);							//应用explode()函数将字符串按照空格来转换成数组
		//合并查询结果集
		for($k=0;$k<count($q4);$k++){
			$sql4.=" title not like '%".trim($q4[$k])."%'"." and";	
		}
		$sql4=substr($sql4,0,-3);							//去掉最后一个“and”	

		for($z=0;$z<count($q4);$z++){
			$sql5.=" content not like '%".trim($q4[$z])."%'"." and";	
		}
		$sql5=substr($sql5,0,-3);							//去掉最后一个“and”	
		if($q1=="" && $q2=="" && $q3==""){
			$sql44=" ((".$sql4.")"."and"."(".$sql5."))";		//获得第四个条件的表达式
		}else{
			$sql44="and ((".$sql4.")"."and"."(".$sql5."))";		//获得第四个条件的表达式
		}
	}else{
		$sql44="";
	}
	/* ************************************************************** */	
	
	$sql="select * from goods where".$sql11.$sql22.$sql33.$sql44." order by id desc";
	$DB->query($sql);

	$time_end = getmicrotime();			//结束计时	
	$t0 = $time_end - $time_start;		//记录实现高级搜索的时间差
	
	if($_GET){
		//得到要提取的页码
		$page_num = $_GET['page_num']? $_GET['page_num']: 1;
	}
	else{
		//首次进入时,页码为1
		$page_num = 1;
	}
	//得到总记录数
	$DB->query($sql);
	$row_count_sum = $DB->get_rows();
	$row_count_sum;
	//每页记录数,可以使用默认值或者直接指定值
	$row_per_page = 3;
	//总页数
	$page_count = ceil($row_count_sum/$row_per_page);
	//判断是否为第一页或者最后一页
	$is_first = (1 == $page_num) ? 1 : 0;
	$is_last = ($page_num == $page_count) ? 1 : 0;
	//查询起始行位置
	$start_row = ($page_num-1) * $row_per_page;
	//为SQL语句添加limit子句
	$sql .= " limit $start_row,$row_per_page";
	//执行查询
	$DB->query($sql);
	$res = $DB->get_rows_array();
	//结果集行数
	$rows_count=count($res);
	?>



<?php
		for($m=0;$m<$rows_count;$m++){
			$id=$res[$m]['id'];				//ID号
			$title=$res[$m]['title'];		//标题
			$content = $res[$m]['content'];	//内容
		?>





<?php
		  	//给第一组条件值标题描红
		 	for($n=0;$n<count($q1);$n++){
				$title= str_ireplace(trim($q1[$n]),"<font color='#FF7801'>".trim($q1[$n])."</font>",$title);
			}
		  	//给第二组条件值标题描红
		   $title= str_ireplace(trim($q2),"<font color='#FF7801'>".trim($q2)."</font>",$title);
		  	//给第三组条件值标题描红
			for($v=0;$v<count($q3);$v++){
				 $title= str_ireplace(trim($q3[$v]),"<font color='#FF7801'>".trim($q3[$v])."</font>",$title);
			}
		   echo chinesesubstr($title,0,80);
		   if(strlen($title)>80){ echo "...";}
		  ?>
		  </a></td>
        </tr>
        <tr >
          <td >&nbsp;&nbsp;&nbsp;&nbsp;
            <?php
		  	//给第一组条件值内容描红
			for($w=0;$w<count($q1);$w++){
				$content= str_ireplace(trim($q1[$w]),"<span color='#FF7801'>".trim($q1[$w])."</span>",$content);
			}
			
		  	//给第二组条件值内容描红
			$content= str_ireplace(trim($q2),"<span color='#FF7801'>".trim($q2)."</span>",$content);
		  
		  	//给第三组条件值内容描红
			for($l=0;$l<count($q3);$l++){
				 $content= str_ireplace(trim($q3[$l]),"<span color='#FF7801'>".trim($q3[$l])."</span>",$content);
			}
			echo chinesesubstr($content,0,600);	  
			  if(strlen($content)>600){echo "...";} ?>
          </td>
        </tr>
      </table>
      <p>
        <?php
		$key0.=$id.'@';
		}
		$key00=$key0;
		 if($row_count_sum>0){
		/* 将查询的关键字存储在临时表中*/
		$ins="update goods_temp set k_id='".$key00."'";
		$DB->query($ins);
		}
		/* *************************  */
	  ?></p>
      <table width="100%" border="0">
        <tr>
          <td height="30">&nbsp;</td>
        </tr>
      </table>
	  <?php 
	  if($row_count_sum>0){
	  ?>
      <table width="850" border="0" cellpadding="2" cellspacing="1" bgcolor="#99CCCC" style="margin-left:15px; margin-right:15px">
        <tr height='26px' align="right">
          <th align="center" bgcolor="#E5ECF9"><!--  分页显示控制链接 -->
            &nbsp;&nbsp; [分页浏览]</th>
        </tr>
        <tr height='26px'>
          <td align="center" bgcolor="#E5ECF9">
		  <?php
			if(!$is_first){
			?>
            <a href="./gs.php?page_num=1&q1=<?php echo $q01;?>&q2=<?php echo $q2;?>&q3=<?php echo $q03;?>&q4=<?php echo $q04;?>">第一页</a> <a href="./gs.php?page_num=<?php echo ($page_num-1);?>&q1=<?php echo $q01;?>&q2=<?php echo $q2;?>&q3=<?php echo $q03;?>&q4=<?php echo $q04;?>">上一页</a>
            <?php
			}
			else{
			?>
            第一页&nbsp;&nbsp;上一页
            <?php
			}
			if(!$is_last){
			?>
            <a href="./gs.php?page_num=<?php echo ($page_num+1);?>&q1=<?php echo $q01;?>&q2=<?php echo $q2;?>&q3=<?php echo $q03;?>&q4=<?php echo $q04;?>">下一页</a> <a href="./gs.php?page_num=<?php echo $page_count;?>&q1=<?php echo $q01;?>&q2=<?php echo $q2;?>&q3=<?php echo $q03;?>&q4=<?php echo $q04;?>">最后一页</a>
            <?php
			}
			else
			{
			?>
            下一页&nbsp;&nbsp;最后一页
            <?php
			}
			?>
		  </td>
        </tr>
      </table>
		<?php
		}else{
		 $z_null="&nbsp;&nbsp;&nbsp;&nbsp;";
		 if($row_count_sum==0){echo  $z_null."抱歉，没有检索到相关的网页信息";
		 echo "<br><br><br>";
		 echo  $z_null."开发者HL 建议您：<br>";
		 echo  $z_null."· 查看输入的文字是否有误<br>";
		 echo  $z_null."· 去掉可能不必要的字词，如： '的'、'呢'、'吗' 等<br>";
		}
		}
		?>