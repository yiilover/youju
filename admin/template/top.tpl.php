
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk"/>
<title>ͷ��</title>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link rel="stylesheet" type="text/css" href="admin/template/css/top.css" />
<script type="text/javascript" src="images/js/jquery.min.js"></script>
<script language="javascript" type="text/javascript" charset="utf-8" src="admin/template/js/topmenu.js"></script>
<script language="javascript" type="text/javascript">

var displayBar=true;
function switchBar(obj)
{
	if (document.all) //IE
	{
		if (displayBar)
		{
			parent.frame.cols="0,*";
			displayBar=false;
			obj.value="�ر���߲˵�";
		}
		else{
			parent.frame.cols="210,*";
			displayBar=true;
			obj.value="����߲˵�";
		}
	}
	else //Firefox 
	{  
		if (displayBar)
		{
			self.top.document.getElementById('frame').cols="0,*";
			displayBar=false;
			obj.value="����߲˵�";
		}
		else{
			self.top.document.getElementById('frame').cols="210,*";
			displayBar=true;
			obj.value="�ر���߲˵�";
		}
	}
}
</script>

</head>

<body oncontextmenu="return false" ondragstart="return false" onSelectStart="return false">
<div class="top_box">
    <div class="top_logo"></div>
    <div class="top_nav">
         <div class="top_nav_sm">
		 
		 <span style="float:right; padding-right:12px"></span>
		 
		<span style="float:right; padding-right:12px"> [<a href="http://www.haoid.cn" target='main'>����������ϵͳ</a>]</span>
		 
		���ã�<?php echo $_username;?> <?php echo $_admin == 1 ? ($CFG['founderid'] == $_userid ? '[��վ��ʼ��]' : '��������Ա') : ($_aid ? '[<span class="f_blue">'.$AREA[$_aid]['areaname'].'վ</span>����Ա]' : '��ͨ����Ա'); ?>  &nbsp;&nbsp;&nbsp;&nbsp; <span onclick="changeMenu(this);"><a href="javascript:void(0);" onclick="goindex()"><i>��̨��ҳ</i></a></span>| <a href="./" target="_blank">��վ��ҳ</a>| <a href="?action=cache" target="main">���»���</a>| <a href="http://www.haoid.cn" target="_blank">����֧��</a>   &nbsp; 
		</div>
		         <div class="top_nav_xm">
             <div class="navtit" id="navtit">
			
              <span  class="hover" onclick="ad(this)"><a href="?file=left&action=setting"  target='left'><i>ϵͳ����</i></a></span>
			  <span onclick="ad(this)"><a href="?file=left&menu=6" target="left"><i>�·�����</i></a></span><span onclick="ad(this)"><a href="?file=left&menu=5" target="left"><i>���ַ�����</i></a></span><span onclick="ad(this)"><a href="?file=left&menu=7" target="left"><i>�������</i></a></span><span onclick="ad(this)"><a href="?file=left&menu=8" target="left"><i>��Ѷ����</i></a></span><span onclick="ad(this)"><a href="?file=left&menu=16" target="left"><i>�󹺹���</i></a></span><span onclick="ad(this)"><a href="?file=left&menu=4" target="left"><i>��˾����</i></a></span><span onclick="ad(this)"><a href="?file=left&menu=15" target="left"><i>�Ź�����</i></a></span><span onclick="ad(this)"><a href="?file=left&menu=12" target="left"><i>ͼ�����</i></a></span><span onclick="ad(this)"><a href="?file=left&menu=11" target="left"><i>ר�����</i></a></span><span onclick="ad(this)"><a href="?file=left&menu=18" target="left"><i>С������</i></a></span><span onclick="ad(this)"><a href="?file=left&menu=13" target="left"><i>��װ����</i></a></span><span onclick="ad(this)"><a href="?file=left&menu=14" target="left"><i>��Ƶ����</i></a></span><span onclick="ad(this)"><a href="?moduleid=3&file=webpage"  target='main'><i>��ҳ����</i></a></span><span onclick="ad(this)"><a href="?moduleid=3&file=ad" target='main'><i>������</i></a></span>		
				
             </div>
         </div>
    </div>
	    <div class="top_bar"><input onClick="switchBar(this)" type="button" value="�ر���߲˵�" name="SubmitBtn" class="bntof"/> 
    <div class="top_she"> 
			<a href="javascript:void(0);" onClick="self.top.location.href='?file=logout'">��ȫע��</a>
		<a href="?action=password" target='main'>�޸�����</a>
		<a href="?action=count" target='main'>ͳ����Ϣ</a>
		<a href="?file=left&action=changedata" target='left'>��������</a>
		<a href="?file=left&menu=3" target='left'>��չ����</a>
		 <a href="?file=left&action=member" target='left'>��Ա����</a>
		     </div>
    </div>
</div>

</body>
</html>
