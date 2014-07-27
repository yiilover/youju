
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk"/>
<title>头部</title>
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
			obj.value="关闭左边菜单";
		}
		else{
			parent.frame.cols="210,*";
			displayBar=true;
			obj.value="打开左边菜单";
		}
	}
	else //Firefox 
	{  
		if (displayBar)
		{
			self.top.document.getElementById('frame').cols="0,*";
			displayBar=false;
			obj.value="打开左边菜单";
		}
		else{
			self.top.document.getElementById('frame').cols="210,*";
			displayBar=true;
			obj.value="关闭左边菜单";
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
		 
		<span style="float:right; padding-right:12px"> [<a href="http://www.haoid.cn" target='main'>房产网管理系统</a>]</span>
		 
		您好！<?php echo $_username;?> <?php echo $_admin == 1 ? ($CFG['founderid'] == $_userid ? '[网站创始人]' : '超级管理员') : ($_aid ? '[<span class="f_blue">'.$AREA[$_aid]['areaname'].'站</span>管理员]' : '普通管理员'); ?>  &nbsp;&nbsp;&nbsp;&nbsp; <span onclick="changeMenu(this);"><a href="javascript:void(0);" onclick="goindex()"><i>后台首页</i></a></span>| <a href="./" target="_blank">网站首页</a>| <a href="?action=cache" target="main">更新缓存</a>| <a href="http://www.haoid.cn" target="_blank">技术支持</a>   &nbsp; 
		</div>
		         <div class="top_nav_xm">
             <div class="navtit" id="navtit">
			
              <span  class="hover" onclick="ad(this)"><a href="?file=left&action=setting"  target='left'><i>系统设置</i></a></span>
			  <span onclick="ad(this)"><a href="?file=left&menu=6" target="left"><i>新房管理</i></a></span><span onclick="ad(this)"><a href="?file=left&menu=5" target="left"><i>二手房管理</i></a></span><span onclick="ad(this)"><a href="?file=left&menu=7" target="left"><i>出租管理</i></a></span><span onclick="ad(this)"><a href="?file=left&menu=8" target="left"><i>资讯管理</i></a></span><span onclick="ad(this)"><a href="?file=left&menu=16" target="left"><i>求购管理</i></a></span><span onclick="ad(this)"><a href="?file=left&menu=4" target="left"><i>公司管理</i></a></span><span onclick="ad(this)"><a href="?file=left&menu=15" target="left"><i>团购管理</i></a></span><span onclick="ad(this)"><a href="?file=left&menu=12" target="left"><i>图库管理</i></a></span><span onclick="ad(this)"><a href="?file=left&menu=11" target="left"><i>专题管理</i></a></span><span onclick="ad(this)"><a href="?file=left&menu=18" target="left"><i>小区管理</i></a></span><span onclick="ad(this)"><a href="?file=left&menu=13" target="left"><i>家装管理</i></a></span><span onclick="ad(this)"><a href="?file=left&menu=14" target="left"><i>视频管理</i></a></span><span onclick="ad(this)"><a href="?moduleid=3&file=webpage"  target='main'><i>单页管理</i></a></span><span onclick="ad(this)"><a href="?moduleid=3&file=ad" target='main'><i>广告管理</i></a></span>		
				
             </div>
         </div>
    </div>
	    <div class="top_bar"><input onClick="switchBar(this)" type="button" value="关闭左边菜单" name="SubmitBtn" class="bntof"/> 
    <div class="top_she"> 
			<a href="javascript:void(0);" onClick="self.top.location.href='?file=logout'">安全注销</a>
		<a href="?action=password" target='main'>修改密码</a>
		<a href="?action=count" target='main'>统计信息</a>
		<a href="?file=left&action=changedata" target='left'>更新数据</a>
		<a href="?file=left&menu=3" target='left'>扩展管理</a>
		 <a href="?file=left&action=member" target='left'>会员管理</a>
		     </div>
    </div>
</div>

</body>
</html>
