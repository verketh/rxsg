<?php
session_start();
include("./Config/Config.php");
if(!$isUP) die("�ܱ�Ǹ,�޸����빦���ѹر�.");
if($_POST){
	//�ύ
	include_once("./Class/function_common.php");	
	$illegal=illegalsubmit();
	if(!$illegal) die("��ֹ�Ƿ��ύ");
	$POST=Addslashess($_POST);
	//��֤��
	if($isPin){
		if($POST['Pin']!=$_SESSION['Pin']) die("<script>alert('��֤�����,����������');history.back();</script>");	 
	}
	include_once("./Class/mysql_new_class.php");	
	$connobj=new mysql_class($SQLhost,$SQLuser,$SQLPWD,$DATABASE);
	//�˺��Ƿ����
	$sql="select passport,password from sys_user where passport='$POST[_user_name]'";
	$arr=$connobj->queryrow($sql);	
	if(!$arr)
	{
		die("<script>alert('�˺Ų�����,�޸�����ʧ��');history.back();</script>");
	}
	if($POST['oldpasswd']!=$arr['password']){
		die("<script>alert('���������,�޸�����ʧ��');history.back();</script>");
	}else{	
		$sql="update sys_user set password='$POST[newpasswd]' where passport='$arr[passport]'";
		$connobj->querysql($sql);
		die("<script>alert('�޸�����ɹ�,���μ����������');window.close();</script>");
	}	
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml"><HEAD id=Head1><TITLE>�޸�����</TITLE>
<META http-equiv=Content-Type content="text/html; charset=gb2312">
<LINK 
href="images/user_basic2.0.css" 
type=text/css rel=stylesheet><LINK 
href="images/user_zhgl2.0.css" 
type=text/css rel=stylesheet>
<STYLE>.tl {
	COLOR: #000; TEXT-DECORATION: none
}
.tlon {
	COLOR: red; TEXT-DECORATION: underline
}
</STYLE>
<META content="MSHTML 6.00.6000.21228" name=GENERATOR></HEAD>
<BODY>
<FORM id="form1" name="form1" onSubmit="return frmCheck()" action="" method="post">
<DIV class=ctn>
<DIV class=top_1>
<DIV id=mian>
  <DIV class=ctn_right>
<DIV class=wel></DIV>
<DIV class=fm-item><LABEL class=fm-label><SPAN 
class=required>*</SPAN>��Ϸ�˺ţ�</LABEL> <INPUT class="i-text f_l" id="_user_name" name="_user_name"> 
<DIV class=fm-explain id=_user_name_info>����дע��ʱ����д����Ϸ�˺�.</DIV>
</DIV>
<DIV class=fm-item><LABEL class=fm-label><SPAN 
class=required>*</SPAN>�� �� �룺</LABEL> <INPUT class="i-text f_l" id="oldpasswd" 
type="password" name="oldpasswd"> 
<DIV class=fm-explain id=_user_passwd_info>����д����ʹ�õ�����.</DIV></DIV>
<DIV class=fm-item><LABEL class=fm-label><SPAN 
class=required>*</SPAN>�� �� �룺</LABEL> <INPUT class="i-text f_l" id="newpasswd" 
type="password" name="newpasswd"> 
<DIV class=fm-explain id=_user_passwd_info>4-16λ����ĸ���ִ�Сд�������÷��š�.��</DIV></DIV>
<?php if($isPin){ ?>
<DIV class="fm-item "><LABEL class="fm-label  f_l" for=check_code><SPAN 
class=required>*</SPAN>��֤�룺</LABEL> <INPUT class="i-text i-text-authcode  f_l" 
id=Pin alt=������ͼ�е�4λ���֡� maxLength=4 name=Pin><img src="Pin.php" style="cursor:pointer" onClick="this.src='Pin.php?'+Math.random()" /><span>������?�����֤��ˢ��</SPAN> 
<DIV class=fm-explain id=_rand_code_info>������ͼƬ����֤���������ִ�Сд��</DIV></DIV>
<DIV class=kg></DIV>
<?php } ?>
<DIV class=fm-item>
 <INPUT id="submitbutton" style="CURSOR: hand" type="image" 
src="images/sm_btn_xyb2.gif" 
name="_doreg"> 
</DIV><BR><BR></DIV></DIV>


</DIV>

</FORM>
</BODY></HTML>
<script language="JavaScript" type="text/javascript"> 
function $(obj)
{
	if(typeof obj == 'string') return document.getElementById(obj);
	else if(typeof obj == 'object') return obj;
	else return false;
}
function frmCheck()
{
	var un=$("_user_name").value;
	var re=/^[0-9a-zA-Z]{4,16}$/; //ֻ�������ֺ���ĸ������	   
	if(un.search(re)==-1)
	{
		alert("�˺����������ֺ���ĸ���ַ�����4��ʮ����");
		$("_user_name").focus();		
		return false;
	}
	var uold=$("oldpasswd").value;
	if(uold.length<4 || uold.length>16)
	{
		  alert("�����������4-16λ֮��");	
		  $("oldpasswd").focus();
		  return false; 		  
	}
	if(uold.indexOf(".")>=0)
	{
		  alert("�����벻�ܺ� . ");	
		  $("oldpasswd").focus();	
		  return false; 		  	
	}
	var unew=$("newpasswd").value;
	if(unew.length<4 || unew.length>16)
	{
		  alert("�����������4-16λ֮��");	
		  $("newpasswd").focus();
		  return false; 		  
	}
	if(unew.indexOf(".")>=0)
	{
		  alert("�����벻�ܺ� . ");	
		  $("newpasswd").focus();	
		  return false; 		  	
	}
	//$("form1").submit();						 
	//return true;
}
</script>