<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form action="?" method="post">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="order"/>
<div class="tt">�ɼ��������ù���</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="100">�ɼ�������</th>
<th width="100">�ɼ�����ʶ</th>
<th width="60">ģ��</th>
<th width="120">���ݲɼ�����</th>
<th width="120">�б�ɼ�����</th>
<th>����</th>
</tr>
<?php foreach($Collectsite as $k=>$v) {?>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td><a href="<?php echo $v['url'];?>" target="_blank"><?php echo $v['name'];?></a></td>
<td><?php echo $v['config'];?></td>
<td><?php echo $modules[$v['modid']];?></td>
<td><a href="?file=collectset&action=edit&config=<?php echo $v['config'];?>">�༭</a> | <a href="javascript:if(confirm('ȷʵҪɾ���òɼ�����ô��')) document.location='?file=collectset&action=del&config=<?php echo $v['config'];?>'">ɾ��</a></td>
<td><a href="?file=collectpage&siteid=<?php echo $k;?>&config=<?php echo $v['config'];?>">�������</a></td>
<td>
<a href="?file=<?php echo $file;?>&action=copy&copyid=<?php echo $k;?>">���ƹ���</a> | 
<a href="?file=<?php echo $file;?>&action=export&exportid=<?php echo $k;?>">��������</a> | 
<a href="" onclick="clearUrl('<?php echo $v['config'];?>');return false;">�����ַ</a><?php tips('�ɼ����ɼ��ɹ������¼�ɼ��ɹ���ַ��ÿ�βɼ���Ա���ַ�⣬�ɼ������Զ������������ַ���ļ��������Ӱ���ٶȣ����߸ı����URLʱ�����������ַ��');?>
</td>
</tr>
<?php }?>
</table>
</form>
<script type="text/javascript">Menuon(1);</script>
<script language="javascript"> 
function copyUrl(txt)
{  
    window.clipboardData.setData("Text",txt); 
    alert("�����ɼ�URL���Ƴɹ�!"); 
} 
function clearUrl(txt) {
	makeRequest('file=<?php echo $file;?>&action=clearurl&arrname='+txt, '?', function(){
		if(xmlHttp.readyState==4 && xmlHttp.status==200) {
			if(xmlHttp.responseText) {
				var s = xmlHttp.responseText;
				alert(s);
			}
		}
	});
}
</script>
<span style="font-size:11px;color:#BCC9F0">
<?php echo '<BR>&nbsp;&nbsp;'.MYAJ_NAME.'&nbsp;'.MYAJ_VERSION.'<BR>&nbsp;&nbsp;����֧��QQ��'.MYAJ_QQ;?>
</span>
</body>
</html>