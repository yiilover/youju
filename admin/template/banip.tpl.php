<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">IP��ֹ</div>
<form action="?" method="post">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="add"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
IP��ַ/�� <input type="text" size="30" name="ip"/>&nbsp;
��Ч���� <?php echo dcalendar('todate');?>&nbsp;
<input type="submit" value="�� ��" class="btn"/>&nbsp;
</td>
</tr>
<tr>
<td>
&nbsp;1��IP��ֹ������վǰ̨��Ч�����鲻Ҫ��ӹ��࣬����Ӱ�����Ч��<br/>
&nbsp;2��֧�ֽ���IP�Σ�������192.168.*.*����������192.168��ͷ��IP<br/>
&nbsp;3����Ч�ڲ����ʾ���ý���<br/>
</td>
</tr>
</table>
</form>
<form method="post">
<div class="tt">��ֹ�б�</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>IP��ַ/��</th>
<th>����</th>
<th>��Ч����</th>
<th>״̬</th>
<th>������</th>
<th>��ֹʱ��</th>
<th width="25"></th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['itemid'];?>"/></td>
<td><?php echo $v['ip'];?></td>
<td><?php echo ip2area($v['ip']);?></td>
<td><?php echo $v['totime'];?></td>
<td><?php echo $v['status'];?></td>
<td><?php echo $v['editor'];?></td>
<td><?php echo $v['addtime'];?></td>
<td><a href="?file=<?php echo $file;?>&action=delete&itemid=<?php echo $v['itemid'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="ɾ��" alt=""/></a></td>
</tr>
<?php }?>
</table>
<div class="btns">
<input type="submit" value=" ����ɾ�� " class="btn" onclick="if(confirm('ȷ��Ҫɾ��ѡ�м�¼�𣿴˲��������ɳ���')){this.form.action='?file=<?php echo $file;?>&action=delete'}else{return false;}"/>
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>