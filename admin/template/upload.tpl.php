<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
?>
<div class="tt">�ֱ�[<?php echo $id;?>]��¼����</div>
<form action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="id" value="<?php echo $id;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<?php echo $fields_select;?>&nbsp;
<input type="text" size="10" name="kw" value="<?php echo $kw;?>" title="�ؼ���"/>&nbsp;
<?php echo dcalendar('fromdate', $fromdate);?> �� <?php echo dcalendar('todate', $todate);?>&nbsp;
<select name="mid">
<option value="0">ģ��</option>
<?php foreach($MODULE as $m) { if(!$m['islink']) { ?>
<option value="<?php echo $m['moduleid'];?>"<?php echo $mid == $m['moduleid'] ? ' selected' : '';?>><?php echo $m['name'];?></option>
<?php } } ?>
</select>&nbsp;
<?php echo $order_select;?>&nbsp;
<input type="checkbox" name="thumb" value="1"<?php echo $thumb ? ' checked' : '';?>/>ͼ��&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="��/ҳ"/>
<input type="submit" value="�� ��" class="btn"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="Go('?file=<?php echo $file;?>&id=<?php echo $id;?>');"/>
</td>
</tr>
</table>
</form>
<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="id" value="<?php echo $id;?>"/>
<div class="tt">�ֱ�[<?php echo $id;?>]�ϴ���¼</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th width="20"></th>
<th>�ļ���</th>
<th>��С</th>
<th>���</th>
<th>�߶�</th>
<th>ģ��</th>
<th>��ϢID</th>
<th>��Դ</th>
<th>��Ա��</th>
<th width="150">ʱ��</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input name="itemid[]" type="checkbox" value="<?php echo $v['pid'];?>"/></td>
<td><img src="<?php echo AJ_PATH.'file/ext/'.$v['ext'].'.gif';?>"/></td>
<td align="left" title="<?php echo $v['fileurl'];?>">
<?php if($thumb && $v['image']) { ?>
<a href="javascript:_preview('<?php echo $v['fileurl'];?>');"><img src="<?php echo $v['fileurl'];?>" width="80" style="margin:5px;"/></a>
<?php } else { ?>
&nbsp;<a href="<?php echo $v['fileurl'];?>" target="_blank"><?php echo basename($v['fileurl']);?></a><?php if($v['image']) { ?>&nbsp;<a href="javascript:_preview('<?php echo $v['fileurl'];?>');"><img src="admin/image/img.gif" width="10" height="10" title="���Ԥ��" alt=""/><?php } ?>
<?php } ?>
</td>
<td><?php echo $v['size'];?></td>
<td><?php echo $v['width'] ? $v['width'] : '';?></td>
<td><?php echo $v['height'] ? $v['height'] : '';?></td>
<td><a href="?file=<?php echo $file;?>&mid=<?php echo $v['moduleid'];?>&id=<?php echo $id;?>"><?php echo $MODULE[$v['moduleid']]['name'];?></a></td>
<td><a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?mid=<?php echo $v['moduleid'];?>&itemid=<?php echo $v['itemid'];?>" target="_blank"><?php echo $v['itemid'];?></a></td>
<td><a href="?file=<?php echo $file;?>&upfrom=<?php echo $v['upfrom'];?>&id=<?php echo $id;?>"><?php echo $v['upfrom'];?></a></td>
<td><a href="javascript:_user('<?php echo $v['username'];?>');"><?php echo $v['username'];?></a></td>
<td class="px11"><?php echo $v['addtime'];?></td>
</tr>
<?php }?>
</table>
<div class="btns">
<input title="��ɾ����¼" type="submit" value="ɾ����¼" class="btn" onclick="if(confirm('ȷ��Ҫɾ��ѡ�м�¼�𣿴˲��������ɳ���')){this.form.action='?file=<?php echo $file;?>&id=<?php echo $id;?>&action=delete_record'}else{return false;}"/>&nbsp;&nbsp;
<input title="ɾ����¼�Ͷ�Ӧ�ļ�" type="submit" value="����ɾ��" class="btn" onclick="if(confirm('ȷ��Ҫɾ��ѡ�м�¼��ϵͳͬʱ��ɾ����Ӧ�ļ����˲��������ɳ���')){this.form.action='?file=<?php echo $file;?>&id=<?php echo $id;?>&action=delete'}else{return false;}"/>
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<?php include tpl('footer');?>