<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form action="?">
<div class="tt">��վ����</div>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<input type="text" size="50" name="kw" value="<?php echo $kw;?>" title="��վ���ƻ������"/>
&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="��/ҳ"/>&nbsp;
<input type="submit" value="�� ��" class="btn"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="window.location='?file=<?php echo $file;?>';"/>
</td>
</tr>
</table>
</form>
<div class="tt">��վ����</div>
<form method="post">
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>��ĸ����</th>
<th>����</th>
<th>����</th>
<th>��վ����</th>
<th>������</th>
<th width="100">����</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="areaids[]" value="<?php echo $v['areaid'];?>"/></td>
<td>
<input name="post[<?php echo $v['areaid'];?>][areaid]" type="hidden" value="<?php echo $v['areaid'];?>"/>
<input name="post[<?php echo $v['areaid'];?>][letter]" type="text" value="<?php echo $v['letter'];?>" size="3"/>
</td>
<td><input name="post[<?php echo $v['areaid'];?>][listorder]" type="text" size="3" value="<?php echo $v['listorder'];?>"/></td>
<td>&nbsp;<a href="<?php echo $v['linkurl'];?>" target="_blank"><?php echo $AREA[$v['areaid']]['areaname'];?></a>&nbsp;</td>

<td>
<input name="post[<?php echo $v['areaid'];?>][name]" type="text" value="<?php echo $v['name'];?>" style="width:100px;color:<?php echo $v['style'];?>"/>
<?php echo dstyle('post['.$v['areaid'].'][style]', $v['style']);?>
</td>
<td><input name="post[<?php echo $v['areaid'];?>][domain]" type="text" value="<?php echo $v['domain'];?>" size="30"/></td>

<td>
<a href="?file=<?php echo $file;?>&action=edit&areaid=<?php echo $v['areaid'];?>"><img src="admin/image/edit.png" width="16" height="16" title="�޸�" alt=""/></a>&nbsp;
<a href="?file=<?php echo $file;?>&action=delete&areaid=<?php echo $v['areaid'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="ɾ��" alt=""/></a></td>
</tr>
<?php }?>
</table>
<div class="btns">&nbsp;
<input type="submit" name="submit" value="���·�վ" class="btn" onclick="this.form.action='?file=<?php echo $file;?>&action=update'"/>&nbsp;
<input type="submit" value="ɾ��ѡ��" class="btn" onclick="if(confirm('ȷ��Ҫɾ��ѡ�з�վ�𣿴˲��������ɳ���')){this.form.action='?file=<?php echo $file;?>&action=delete'}else{return false;}"/>&nbsp;

</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>