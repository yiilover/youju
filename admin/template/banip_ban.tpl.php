<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">IP����</div>
<form action="?" method="post">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="unban"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
IP��ַ�� <input type="text" name="ip" size="30"/> &nbsp; <input type="submit" name="submit" value="ɾ ��" class="btn"/>
</td>
</tr>
</table>
</form>
<form method="post">
<div class="tt">�����б�</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>IP</th>
<th>����</th>
<th>����ʱ��</th>
<th width="25"></th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="ip[]" value="<?php echo $v['ip'];?>"/></td>
<td><?php echo $v['ip'];?></td>
<td><?php echo ip2area($v['ip']);?></td>
<td><?php echo $v['addtime'];?></td>
<td><a href="?file=<?php echo $file;?>&action=unban&ip=<?php echo $v['ip'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="ɾ��" alt=""/></a></td>
</tr>
<?php }?>
</table>
</div>
<div class="btns">
<input type="submit" value="ɾ��ѡ��" class="btn" onclick="if(confirm('ȷ��Ҫɾ��ѡ��IP��')){this.form.action='?file=<?php echo $file;?>&action=unban'}else{return false;}"/>
</div>
</form>
<script type="text/javascript">Menuon(2);</script>
<?php include tpl('footer');?>