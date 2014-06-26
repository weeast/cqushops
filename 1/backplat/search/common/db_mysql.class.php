<?php
/********************************************
*��ݿ������
*********************************************/
class DB_MySQL{
//==========================
var $Host = "127.0.0.1";			//��������ַ
var $Database = "ezbuying";		//��ݿ����
var $User = "root";					//�û���
var $Password = "52113344";				//�û�����
//==========================
var $Link_ID = 0;					//��ݿ�����	
var $Query_ID = 0;					//��ѯ���	
var $Row_Result = array();			//�����ɵ�����	
var $Field_Result = array();		//����ֶ�����ɵ�����
var $Affected_Rows;					//Ӱ�������
var $Rows;							//����м�¼����
var $Fields;						//������ֶθ���
var $Row_Position = 0;				//��¼ָ��λ������

//*******************************************************
	/*** ���캯�� */
	function __construct(){
		$this->connect();
	}

	/*** �������� */
	function __destruct(){
		mysql_close($this->Link_ID);
	}

	/*** ���ӷ�����,ѡ����ݿ� */
	function connect($Database = "",$Host = "",$User = "",$Password = ""){
		if ("" == $Database){
		  $Database = $this->Database;
		}
		if ("" == $Host){
		  $Host     = $this->Host;
		}
		if ("" == $User){
		  $User     = $this->User;
		}
		if ("" == $Password){
		  $Password = $this->Password;
		}
		
		if ( 0 == $this->Link_ID ) 
		{
			$this->Link_ID=@mysql_pconnect($Host, $User, $Password);
			if (!$this->Link_ID) 
			{
			$this->halt("������ݿ�����ʧ��!");
			}
			if (!mysql_select_db($this->Database,$this->Link_ID))
			{
			$this->halt("���ܴ�ָ������ݿ�:".$this->Database);
			}
		}
		return $this->Link_ID;
	}

	/*** �ͷ��ڴ� */
	function free(){
		if ( @mysql_free_result($this->Query_ID) )
		unset ($this->Row_Result);
		$this->Query_ID = 0;
	}

	/*** ִ�в�ѯ */
	function query($Query_String){
		/* �ͷ��ϴβ�ѯռ�õ��ڴ� */
		if ($this->Query_ID){
			$this->free();
		}
		if(0 == $this->Link_ID){
			$this->connect();
		}
		//���������ַ�
		@mysql_query("set names GBK",$this->Link_ID);
		$this->Query_ID = @mysql_query($Query_String,$this->Link_ID);
		if (!$this->Query_ID){
		$this->halt("SQL��ѯ������: ".$Query_String);
		}
		return $this->Query_ID;
	}
	
	/*** �����ָ��ָ��ָ���� */
	function seek($pos){
		if(@mysql_data_seek($this->Query_ID, $pos)){
			$this->Row_Position = $pos;
			return true;
		}
		else{
			$this->halt("��λ��������!");			//�����Զ��庯��
			return false;
		}

	}

	/*** ���ؽ���¼��ɵ����� */
	function get_rows_array(){
		$this->get_rows();
		for($i=0;$i<$this->Rows;$i++){
			if(!mysql_data_seek($this->Query_ID,$i)){
				$this->halt("mysql_data_seek��ѯ������");		//�����Զ��庯��
			}
			$this->Row_Result[$i] = mysql_fetch_array($this->Query_ID);
		}
		return $this->Row_Result;
	}

	/*** ���ؽ���ֶ���ɵ����� */
	function get_fields_array(){
		$this->get_fields();
		for($i=0;$i<$this->Fields;$i++){
			$obj = mysql_fetch_field($this->Query_ID,$i);
			$this->Field_Result[$i] = $obj->name;
		}
		return $this->Field_Result;
	}

	/*** ����Ӱ���¼�� */
	function get_affected_rows(){
		$this->Affected_Rows = mysql_affected_rows($this->Link_ID);
		return $this->Affected_Rows;
	}

	/*** ���ؽ���м�¼���� */
	function get_rows(){
		$this->Rows = mysql_num_rows($this->Query_ID); 
		return $this->Rows;
	}

	/*** ���ؽ�����ֶθ��� */
	function get_fields(){
		$this->Fields = mysql_num_fields($this->Query_ID);
		return $this->Fields;
	}

	/*** ִ��SQL��䲢�����ɲ�ѯ����е�һ�м�¼��ɵ����� */
	function fetch_one_array($sql){
		$this->query($sql);
		return mysql_fetch_array($this->Query_ID);
	}

	/*** ��ӡ������Ϣ */
	function halt($msg){
		$this->Error=mysql_error();
		printf("<BR><b>��ݿⷢ�����:</b> %s<br>\n", $msg);
		printf("<b>MySQL ���ش�����Ϣ:</b> %s <br>\n",	$this->Error);
	}
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=GBK">
