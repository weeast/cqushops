<?php
//RMM�ִ��㷨
class SplitWord{
	var $TagDic = Array();
	var $RankDic = Array();
	var $SourceStr = '';
	var $ResultStr = '';
	var $SplitChar = ' '; //�ָ���
	var $SplitLen = 4;	 //�����ʳ���
	var $MaxLen = 7; 	//�ʵ���������֣��������ֵΪ�ֽ�������������
	var $MinLen = 3;  //��С�����֣��������ֵΪ�ֽ�������������

  function SplitWord(){
  	$this->__construct();
  }
  
  function __construct(){  	  	
  	//�߼��ִʣ�Ԥ������ʵ�����ִʸ��ٶ�
  	$dicfile = dirname(__FILE__)."/ppldic.csv"; 
  	$fp = fopen($dicfile,'r');			//��ȡ�ʿ��еĴ�
  	while($line = fgets($fp,256)){
  		  $ws = explode(' ',$line);		//�Դʿ��еĴʽ��в��
  		  $this->TagDic[$ws[0]] = $ws[1];
  		  $this->RankDic[strlen($ws[0])][$ws[0]] = $ws[2];
  	}
  	fclose($fp);		//�رմʿ��ļ�
  }
  
  //������Դ
 function Clear(){
  	@fclose($this->QuickDic);
  }
  
  //����Դ�ַ���
  function SetSource($str){
  	$this->SourceStr = $this->UpdateStr($str);
  	$this->ResultStr = "";
  }
  
  //����ַ����Ƿ񲻴�������
  function NotGBK($str)
  {
    if($str=="") return "";
  	if( ord($str[0])>0x80 ) return false;
  	else return true;
  }

  //RMM�ִ��㷨
  function SplitRMM($str=""){
  	if($str!="") $this->SetSource($str);
  	if($this->SourceStr=="") return "";
  	$this->SourceStr = $this->UpdateStr($this->SourceStr);
  	$spwords = explode(" ",$this->SourceStr);
  	$spLen = count($spwords);
  	$spc = $this->SplitChar;
  	for($i=($spLen-1);$i>=0;$i--){
  		if($spwords[$i]=="") continue;
  		if($this->NotGBK($spwords[$i])){
  			if(ereg("[^0-9\.\+\-]",$spwords[$i]))
  			{ $this->ResultStr = $spwords[$i].$spc.$this->ResultStr; }
  			else
  			{
  				$nextword = "";
  				@$nextword = substr($this->ResultStr,0,strpos($this->ResultStr,""));
  			}
  		}
  		else
  		{
  		  $c = $spwords[$i][0].$spwords[$i][1];
  		  $n = hexdec(bin2hex($c));
  		  	if(strlen($spwords[$i]) <= $this->SplitLen)
  		  	{
  		  	}
  		  	else
  		  	{ 
  		  		$this->ResultStr = $this->RunRMM($spwords[$i]).$spc.$this->ResultStr;
  		  	}
  	  }
  	}
  	return $this->ResultStr;
  }
  //��ȫ�����ַ�����������ƥ�䷽ʽ�ֽ�
  function RunRMM($str){
  	$spc = $this->SplitChar;
  	$spLen = strlen($str);
  	$rsStr = "";
  	$okWord = "";
  	$tmpWord = "";
  	$WordArray = Array();
  	//�����ֵ�ƥ��
  	for($i=($spLen-1);$i>=0;){
  		//��i�ﵽ��С���ܴʵ�ʱ��
  		if($i<=$this->MinLen){
  			if($i==1){
  			  $WordArray[] = substr($str,0,2);
  		  }else
  			{
  			   $w = substr($str,0,$this->MinLen+1);
  			   if($this->IsWord($w)){
  			   	$WordArray[] = $w;                                                                                  
  			   }else{
  				   $WordArray[] = substr($str,2,2);
  				   $WordArray[] = substr($str,0,2);
  			   }
  		  }
  			$i =-1; break;
  		}
  		//��������С������ʱ�����
  		if($i>=$this->MaxLen) $maxPos = $this->MaxLen;
  		else $maxPos = $i;
  		$isMatch = false;
  		for($j=$maxPos;$j>=0;$j=$j-2){
  			 $w = substr($str,$i-$j,$j+1);
  			 if($this->IsWord($w)){
  			 	$WordArray[] = $w;
  			 	$i = $i-$j-1;
  			 	$isMatch = true;
  			 	break;
  			 }
  		}
  	}
  	$rsStr = $this->otherword($WordArray);
  	return $rsStr;
  }
  
function otherword($WordArray){
  	$wlen = count($WordArray)-1;						//���������Ԫ�ظ���
  	$rsStr = "";										//��ʼ������
  	$spc = $this->SplitChar;
  	for($i=$wlen;$i>=0;$i--)
  	{
			$rsStr .= $spc.$WordArray[$i]."��";			//������Ϊ�ٺŽ��в��
  	}
  	//���ر��ηִʽ��
		$rsStr = preg_replace("/^".$spc."/","��",$rsStr);
  	return $rsStr;
  }
  
  //�жϴʵ����Ƿ����ĳ����
  function IsWord($okWord){
  	$slen = strlen($okWord);
  	if($slen > $this->MaxLen) return false;
  	else return isset($this->RankDic[$slen][$okWord]);
  }
  
  //�����ַ������Ա����ţ���Ӣ�Ļ��ŵȳ�������
  function UpdateStr($str){
  	$spc = $this->SplitChar;
    $slen = strlen($str);
    if($slen==0) return '';
    $okstr = '';
    $prechar = 0; // 0-�հ� 1-Ӣ�� 2-���� 3-����
    for($i=0;$i<$slen;$i++){
      if(ord($str[$i]) < 0x81){
        //Ӣ�ĵĿհ׷���
        if(ord($str[$i]) < 33){
          if($prechar!=0&&$str[$i]!="\r"&&$str[$i]!="\n") $okstr .= $spc;
          $prechar=0;
          continue; 
        }else if(ereg("[^0-9a-zA-Z@\.%#:/\\&_-]",$str[$i])){
          if($prechar==0){	$okstr .= $str[$i]; $prechar=3;}
          else{ $okstr .= $spc.$str[$i]; $prechar=3;}
        }else{
        	if($prechar==2||$prechar==3)
        	{ $okstr .= $spc.$str[$i]; $prechar=1;}
        	else
        	{ 
        	  if(ereg("@#%:",$str[$i])){ $okstr .= $str[$i]; $prechar=3; }
        	  else { $okstr .= $str[$i]; $prechar=1; }
        	}
        }
      }
      else{
        //�����һ���ַ�Ϊ�����ĺͷǿո����һ���ո�
        if($prechar!=0 && $prechar!=2) $okstr .= $spc;
        //��������ַ�
        if(isset($str[$i+1])){
          $c = $str[$i].$str[$i+1];
          
          $n = hexdec(bin2hex($c));
          if($n<0xA13F && $n > 0xAA40){
            	if($prechar!=0) $okstr .= $spc.$c;
            	else $okstr .= $c;
            	$prechar = 3; 
            }
          else{
            $okstr .= $c;
            $prechar = 2;
          }
          $i++;
        }
      }
    }
    return $okstr;
  }
}
?>
