<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<script type="text/javascript">
var _del = 0;
</script>
<form action="?">
<div class="tt">��������</div>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="item" value="<?php echo $item;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<input type="text" size="50" name="kw" value="<?php echo $kw;?>" title="�ؼ��ʻ����ӵ�ַ"/>
&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="��/ҳ"/>&nbsp;
<input type="submit" value="�� ��" class="btn"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="window.location='?file=<?php echo $file;?>&item=<?php echo $item;?>';"/>
</td>
</tr>
</table>
</form>
<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="item" value="<?php echo $item;?>"/>
<div class="tt">��������</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="60">ɾ��</th>
<th>�ؼ���</th>
<th>����</th>
</tr>
<?php foreach($lists as $k=>$v) { ?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input name="post[<?php echo $v['itemid'];?>][delete]" type="checkbox" value="1" onclick="if(this.checked){_del++;}else{_del--;}"/></td>
<td><input name="post[<?php echo $v['itemid'];?>][title]" type="text" size="30" value="<?php echo $v['title'];?>"/></td>
<td><input name="post[<?php echo $v['itemid'];?>][url]" type="text" size="50" value="<?php echo $v['url'];?>"/></td>
</tr>
<?php } ?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td class="f_red">����</td>
<td><input name="post[0][title]" type="text" size="30" value=""/></td>
<td><input name="post[0][url]" type="text" size="50" value="http://"/></td>
</tr>
<tr>
<td> </td>
<td height="30" colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="�� ��" onclick="if(_del && !confirm('��ʾ:��ѡ��ɾ��'+_del+'���������ӣ�ȷ��Ҫɾ����')) return false;" class="btn"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="window.location='?file=<?php echo $file;?>&item=<?php echo $item;?>&action=export';"/>&nbsp;
&nbsp;&nbsp;&nbsp;��ʾ������Ĺ������ӻ�Ӱ��ҳ��򿪻������ٶ�</td>
</tr>
</table>
</form>
<div class="pages"><?php echo $pages;?></div>
<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="item" value="<?php echo $item;?>"/>
<input type="hidden" name="action" value="add"/>
<div class="tt">�������</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td width="60" align="center"><span class="f_red">*</span> ����</td>
<td>
<textarea name="content" style="width:500px;height:100px;"><?php echo $content;?></textarea><br/>
һ��һ�����ؼ��ʺ�������|�ָ���磺aijiacms|http://www.aijiacms.com
</td>
</tr>
<tr>
<td></td>
<td>&nbsp;&nbsp;<input type="submit" name="submit" value=" ȷ �� " class="btn"/></td>
</tr>
</table>
</form>
<form action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="item" value="<?php echo $item;?>"/>
<div class="tt">���ӵ���</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td width="60" align="center"><span class="f_red">*</span> ģ��</td>
<td>&nbsp;&nbsp;
<select name="fid" id="fid">
<option value="">��ѡ��</option>
<?php 
foreach($MODULE as $v) {
	if($v['moduleid'] > 4 && $v['moduleid'] != $item && !$v['islink']) echo '<option value="'.$v['moduleid'].'"'.($fid == $v['moduleid'] ? ' selected' : '').'>'.$v['name'].'</option>';
}
?>
</select>&nbsp;&nbsp;
<input type="button" value="�� ��" class="btn" onclick="if(Dd('fid').value){window.open('?file=<?php echo $file;?>&item='+Dd('fid').value);}else{alert('��ѡ��ģ��');}"/>&nbsp;&nbsp;
<input type="submit" value="�� ��" class="btn"/>
</td>
</tr>
</table>
</form>
<br/>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>