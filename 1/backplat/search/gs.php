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
	$q1=gl($q1);			//��ȡ����ȫ���Ĺؼ��ʣ���Ҫʹ�÷ִʼ���,���˱�����
	$q2=gl($q2);			//��ȡ�����Ĺؼ��ʣ�����Ҫ�ִ�

	$q3=gl($q3);			//��ȡ����һ���ؼ��ʣ���Ҫʹ�÷ִʼ���,���˱�����
	$q04=gl1($q4);			//���˱�����
}
$time_start = getmicrotime();	//��ʼ��ʱ
$sp = new SplitWord();	//��������
$q1=$sp->SplitRMM($q1);	//�Ե�һ���������зִ�
$q01=dunhao($q1);
$sp3 = new SplitWord();	//��������
$q3=$sp3->SplitRMM($q3);	//�Ե������������зִ�
$q03= dunhao($q3);		//ȥ������ġ���������
$sp->Clear();
?>
<?php
	require_once("./common/db_mysql.class.php");		//��������Դ�ļ�
	$DB = new DB_MySQL;									//��������
	
	/* ********** ����һ������(����ȫ���Ĺؼ���)ת��������************ */
	if($q1!=""){
		$q1 = explode("��",$q01);						//Ӧ��explode()�������ַ���ת��������
		//�ϲ���ѯ�����
		for($i=0;$i<count($q1);$i++){
			$sql0.=" title like '%".trim($q1[$i])."%'"." or";	
		}
		$sql0=substr($sql0,0,-2);						//ȥ�����һ����or��	

		for($j=0;$j<count($q1);$j++){
			$sql1.=" content like '%".trim($q1[$j])."%'"." and";	
		}
		$sql1=substr($sql1,0,-3);						//ȥ�����һ����and��	
		$sql11="((".$sql0.")"."or"."(".$sql1."))";		//��õ�һ�����ı��ʽ
	}else{
		$sql1="";
	}
	/* ************************************************************** */

	/* ********** ���ڶ�������(���������Ĺؼ���)ת��������*********** */
	//$sql22����ֵ����Ҫ�ִʣ�ֻ��Ҫ���˱�����,���$sql2=$gl($q2)
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

	/* ********** ������������(����ȫ���Ĺؼ���)ת��������************ */
	if($q3!=""){
		$q3 = explode("��",$q03);						//Ӧ��explode()�������ַ���ת��������
		//�ϲ���ѯ�����
		for($m=0;$m<count($q3);$m++){
			$sql2.=" title like '%".trim($q3[$m])."%'"." or";	
		}
		for($n=0;$n<count($q3);$n++){
			$sql3.=" content like '%".trim($q3[$n])."%'"." or";	
		}
		$sql3=substr($sql3,0,-2);							//ȥ�����һ����or��	
		if($q1=="" && $q2==""){
			$sql33="(".$sql2.$sql3.")";						//��õ����������ı��ʽ
		}else{
			$sql33="and (".$sql2.$sql3.")";					//��õ����������ı��ʽ
		}

	}else{
		$sql33="";
	}
	/* ************************************************************** */
	
	/* ********** �����ĸ�����(����������Ĺؼ���)ת��������************ */
	if($q4!=""){
		$q4 = explode(" ",$q04);							//Ӧ��explode()�������ַ������տո���ת��������
		//�ϲ���ѯ�����
		for($k=0;$k<count($q4);$k++){
			$sql4.=" title not like '%".trim($q4[$k])."%'"." and";	
		}
		$sql4=substr($sql4,0,-3);							//ȥ�����һ����and��	

		for($z=0;$z<count($q4);$z++){
			$sql5.=" content not like '%".trim($q4[$z])."%'"." and";	
		}
		$sql5=substr($sql5,0,-3);							//ȥ�����һ����and��	
		if($q1=="" && $q2=="" && $q3==""){
			$sql44=" ((".$sql4.")"."and"."(".$sql5."))";		//��õ��ĸ������ı��ʽ
		}else{
			$sql44="and ((".$sql4.")"."and"."(".$sql5."))";		//��õ��ĸ������ı��ʽ
		}
	}else{
		$sql44="";
	}
	/* ************************************************************** */	
	
	$sql="select * from goods where".$sql11.$sql22.$sql33.$sql44." order by id desc";
	$DB->query($sql);

	$time_end = getmicrotime();			//������ʱ	
	$t0 = $time_end - $time_start;		//��¼ʵ�ָ߼�������ʱ���
	
	if($_GET){
		//�õ�Ҫ��ȡ��ҳ��
		$page_num = $_GET['page_num']? $_GET['page_num']: 1;
	}
	else{
		//�״ν���ʱ,ҳ��Ϊ1
		$page_num = 1;
	}
	//�õ��ܼ�¼��
	$DB->query($sql);
	$row_count_sum = $DB->get_rows();
	$row_count_sum;
	//ÿҳ��¼��,����ʹ��Ĭ��ֵ����ֱ��ָ��ֵ
	$row_per_page = 3;
	//��ҳ��
	$page_count = ceil($row_count_sum/$row_per_page);
	//�ж��Ƿ�Ϊ��һҳ�������һҳ
	$is_first = (1 == $page_num) ? 1 : 0;
	$is_last = ($page_num == $page_count) ? 1 : 0;
	//��ѯ��ʼ��λ��
	$start_row = ($page_num-1) * $row_per_page;
	//ΪSQL������limit�Ӿ�
	$sql .= " limit $start_row,$row_per_page";
	//ִ�в�ѯ
	$DB->query($sql);
	$res = $DB->get_rows_array();
	//���������
	$rows_count=count($res);
	?>



<?php
		for($m=0;$m<$rows_count;$m++){
			$id=$res[$m]['id'];				//ID��
			$title=$res[$m]['title'];		//����
			$content = $res[$m]['content'];	//����
		?>





<?php
		  	//����һ������ֵ�������
		 	for($n=0;$n<count($q1);$n++){
				$title= str_ireplace(trim($q1[$n]),"<font color='#FF7801'>".trim($q1[$n])."</font>",$title);
			}
		  	//���ڶ�������ֵ�������
		   $title= str_ireplace(trim($q2),"<font color='#FF7801'>".trim($q2)."</font>",$title);
		  	//������������ֵ�������
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
		  	//����һ������ֵ�������
			for($w=0;$w<count($q1);$w++){
				$content= str_ireplace(trim($q1[$w]),"<span color='#FF7801'>".trim($q1[$w])."</span>",$content);
			}
			
		  	//���ڶ�������ֵ�������
			$content= str_ireplace(trim($q2),"<span color='#FF7801'>".trim($q2)."</span>",$content);
		  
		  	//������������ֵ�������
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
		/* ����ѯ�Ĺؼ��ִ洢����ʱ����*/
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
          <th align="center" bgcolor="#E5ECF9"><!--  ��ҳ��ʾ�������� -->
            &nbsp;&nbsp; [��ҳ���]</th>
        </tr>
        <tr height='26px'>
          <td align="center" bgcolor="#E5ECF9">
		  <?php
			if(!$is_first){
			?>
            <a href="./gs.php?page_num=1&q1=<?php echo $q01;?>&q2=<?php echo $q2;?>&q3=<?php echo $q03;?>&q4=<?php echo $q04;?>">��һҳ</a> <a href="./gs.php?page_num=<?php echo ($page_num-1);?>&q1=<?php echo $q01;?>&q2=<?php echo $q2;?>&q3=<?php echo $q03;?>&q4=<?php echo $q04;?>">��һҳ</a>
            <?php
			}
			else{
			?>
            ��һҳ&nbsp;&nbsp;��һҳ
            <?php
			}
			if(!$is_last){
			?>
            <a href="./gs.php?page_num=<?php echo ($page_num+1);?>&q1=<?php echo $q01;?>&q2=<?php echo $q2;?>&q3=<?php echo $q03;?>&q4=<?php echo $q04;?>">��һҳ</a> <a href="./gs.php?page_num=<?php echo $page_count;?>&q1=<?php echo $q01;?>&q2=<?php echo $q2;?>&q3=<?php echo $q03;?>&q4=<?php echo $q04;?>">���һҳ</a>
            <?php
			}
			else
			{
			?>
            ��һҳ&nbsp;&nbsp;���һҳ
            <?php
			}
			?>
		  </td>
        </tr>
      </table>
		<?php
		}else{
		 $z_null="&nbsp;&nbsp;&nbsp;&nbsp;";
		 if($row_count_sum==0){echo  $z_null."��Ǹ��û�м�������ص���ҳ��Ϣ";
		 echo "<br><br><br>";
		 echo  $z_null."������HL ��������<br>";
		 echo  $z_null."�� �鿴����������Ƿ�����<br>";
		 echo  $z_null."�� ȥ�����ܲ���Ҫ���ִʣ��磺 '��'��'��'��'��' ��<br>";
		}
		}
		?>