<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">��־����</div>
<form action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<?php echo $fields_select;?>&nbsp;
<input type="text" size="12" name="kw" value="<?php echo $kw;?>" title="�ؼ���"/>&nbsp;
<?php echo dcalendar('fromdate', $fromdate);?> �� <?php echo dcalendar('todate', $todate);?>&nbsp;
<select name="robot">
<option value="">��������</option>
<?php
foreach($ROBOT as $k=>$v) {
?>
<option value="<?php echo $k;?>" <?php echo $k == $robot ? ' selected' : '';?>><?php echo $v;?></option>
<?php
}
?>
</select>&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="��/ҳ"/>
<input type="submit" value="�� ��" class="btn"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="Go('?file=<?php echo $file;?>');"/>
</td>
</tr>
</table>
</form>
<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<div class="tt">404��־</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th width="80">��������</th>
<th>URL</th>
<th>IP</th>
<th>����</th>
<th>��Ա��</th>
<th width="150">ʱ��</th>
<th width="30">ɾ��</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input name="itemid[]" type="checkbox" value="<?php echo $v['itemid'];?>"/></td>
<td>
<?php if($v['robot']) { ?>
<img src="<?php echo AJ_PATH;?>file/image/robot_ico_<?php echo $v['robot'];?>.gif" title="<?php echo $ROBOT[$v['robot']];?>"/>
<?php } else { ?>
&nbsp;
<?php } ?>
</td>
<td align="left" title="<?php echo $v['url'];?>">&nbsp;<a href="<?php echo $v['url'];?>" target="_blank"><?php echo $v['durl'];?></a></td>
<td><a href="javascript:_ip('<?php echo $v['ip'];?>');"><?php echo $v['ip'];?></a></td>
<td><?php echo ip2area($v['ip']);?></td>
<td><a href="javascript:_user('<?php echo $v['username'];?>');"><?php echo $v['username'];?></a></td>
<td class="px11"><?php echo $v['addtime'];?></td>
<td><a href="?file=<?php echo $file;?>&action=delete&itemid=<?php echo $v['itemid'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="ɾ��" alt=""/></a></td>
</tr>
<?php }?>
</table>
<div class="btns">
<input type="submit" value="����ɾ��" class="btn" onclick="if(confirm('ȷ��Ҫɾ��ѡ����־�𣿴˲��������ɳ���')){this.form.action='?file=<?php echo $file;?>&action=delete'}else{return false;}"/>&nbsp;
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>