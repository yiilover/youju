<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form action="?" method="post"  id="form">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="moduleid" id="moduleid" value="1"/>
<input type="hidden" name="modid" id="modid" value="<?php echo $modid;?>"/>
<div class="tt">�ɼ���Ϣ����</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="40">ѡ��</th>
<th>����</th>
<th width="120">�ɼ���</th>
<th width="120">�б����</th>
<th width="180">�ɼ�ʱ��</th>
</tr>
<?php foreach($info as $k=>$v) {?>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td><input type="checkbox" name="item[]" value="<?php echo $v['sid'].'|'.$v['tid'].'|'.$v['huid'];?>" /></td>
<td><a href="?file=<?php echo $file;?>&action=show&tid=<?php echo $v['tid'];?>&modid=<?php echo $modid;?>"><?php echo $v['title'];?></a></td>
<td><?php echo (!empty($Collectsite[$v['robotid']]['name'])) ? $Collectsite[$v['robotid']]['name'] : $v['robotid'];?></td>
<td><?php echo $v['listname'];?></td>
<td><?php echo date("Y-m-d H:i:s",$v['robottime']);?></td>
</tr>
<?php }?>
</table>
<div class="btns">
���������� <input type="checkbox" name="chkall" onclick="checkall(this.form, 'item')">ȫѡ <input type="radio" name="action" value="dataimport" onClick="jsop(this.value)"> ����&nbsp;&nbsp;<input type="radio" name="action" value="delete" onClick="jsop(this.value)"> ɾ��&nbsp;&nbsp; <?php tips('�����ɾ����Ϣ��ֻ��������Ϣ����Ϣ���ݻ��������ļ��ڣ�����������ݻ�ɾ�����������ļ���Ϊ��֤�ٶȼ��ȶ��ԣ��붨ʱ�����������');?>
</div>
<div class="btns">
����ά���� <input type="radio" name="action" value="backup" onClick="jsop(this.value)"> ��������&nbsp;&nbsp; <input type="radio" name="action" value="recover" onClick="jsop(this.value)"> �ָ�����&nbsp;&nbsp; <input type="radio" name="action" value="deldb" onClick="jsop(this.value)"> �����������
</div>
<div class="btns" id="import1" style="display:none;">
ѡ����ࣺ <?php echo ajax_category_select('newcatid', 'ѡ�����', '', $modid == 2 ? 4 : $modid);?> <?php tips('��ѡ�������ʹ�òɼ��������');?>
</div>
<div class="btns" id="import2" style="display:none;">
ѡ������� <?php echo ajax_area_select('newareaid', 'ѡ�����', 0, '', 2);?> <?php tips('��ѡ�������ʹ�òɼ��������');?>
</div>
<div class="btns" id="import3" style="display:none;">
����ʱ�䣺 <input type="text" size="30" name="newtime" value="<?php echo date("Y-m-d H:i:s");?>"> <?php tips('�밴��ʱ���ʽ���ã����հ��ɼ�����ʱ�����');?>
</div>
<div class="btns" id="import4" style="display:none;">
������Ա�� <input type="radio" name="relateduser" value="1"> ����&nbsp;&nbsp; <input type="radio" name="relateduser" value="0" checked="checked"> ������ <?php tips('ѡ�������Ա���ڵ�����Ϣʱ���Զ���������Ļ�Ա��Ϣ���Ի�Աģ����Ч');?>
</div>
<div class="btns">
<input type="submit" name="listsubmit" value="�ύ����" class="submit">
<input type="reset" name="listreset" value="����">
</div>
</form>
<div class="pages">
<?php 
if($page==1) echo '   <strong>&nbsp;1&nbsp;</strong>';
if($page>1) echo '   <a href="'.$this_forward.'&page='.($page-1).'&modid='.$modid.'" title="ǰҳ">&nbsp;&lt;&nbsp;</a>   <a href="'.$this_forward.'&page=1&modid='.$modid.'" title="��ҳ">&nbsp;1&nbsp;</a>&nbsp;��&nbsp;';
$i=$page-4;
if($i<2) $i=2;
while($i<$page+4 && $i<$pages) {
	if($i==$page) echo '   <strong>&nbsp;'.$i.'&nbsp;</strong>';
	else echo '   <a href="'.$this_forward.'&page='.$i.'&modid='.$modid.'">&nbsp;'.$i.'&nbsp;</a>';
	$i++;
}
if ($page<$pages) echo '   &nbsp;��&nbsp;<a href="'.$this_forward.'&page='.$pages.'&modid='.$modid.'">&nbsp;'.$pages.'&nbsp;</a>   <a href="'.$this_forward.'&page='.($page+1).'&modid='.$modid.'" title="��ҳ">&nbsp;&gt;&nbsp;</a>';
if($page==$pages) echo '   <strong>&nbsp;'.$page.'&nbsp;</strong>';
echo '   &nbsp;<cite>��'.$cnts.'��/'.$pages.'ҳ</cite>&nbsp;';
?>
<input type="text" class="pages_inp" id="aijiacms_pageno" value="<?php echo $page;?>" onkeydown="if(event.keyCode==13 && this.value) {window.location.href='http://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'].'?file='.$file.'&page={aijiacms_page}&modid='.$modid;?>'.replace(/\{aijiacms_page\}/, this.value);return false;}"> <input type="button" class="pages_btn" value="ת" onclick="if($('aijiacms_pageno').value>0)window.location.href='http://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'].'?file='.$file.'&page={aijiacms_page}&modid='.$modid;?>'.replace(/\{aijiacms_page\}/, $('aijiacms_pageno').value);"/>
</div>
<script type="text/javascript">Menuon(<?php echo $m;?>);</script>
<script language="javascript"> 
function jsop(opval)
{
		if(opval=='dataimport')
		{
				$('import1').style.display = '';
				$('import2').style.display = '';
				$('import3').style.display = '';
				$('import4').style.display = '';
				$('moduleid').value = '<?php echo $modid;?>';
		}
		else
		{
				$('import1').style.display = 'none';
				$('import2').style.display = 'none';
				$('import3').style.display = 'none';
				$('import4').style.display = 'none';
				$('moduleid').value = '1';
		}
}
function checkall(form, prefix, checkall, type) {
	var checkall = checkall ? checkall : 'chkall';
	var type = type ? type : 'name';
	
	for(var i = 0; i < form.elements.length; i++) {
		var e = form.elements[i];
		
		if(type == 'value' && e.type == "checkbox" && e.name != checkall) {
			if(e.name != checkall && (prefix && e.value == prefix)) {
				e.checked = form.elements[checkall].checked;
			}
		}else if(type == 'name' && e.type == "checkbox" && e.name != checkall) {
			if((!prefix || (prefix && e.name.match(prefix)))) {
				e.checked = form.elements[checkall].checked;
			}
		}
	}
}
</script>
</body>
</html>