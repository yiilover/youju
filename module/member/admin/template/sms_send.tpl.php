<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">��¼����</div>
<form action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<?php echo $fields_select;?>&nbsp;
<input type="text" size="20" name="kw" value="<?php echo $kw;?>"/>&nbsp;
<?php echo dcalendar('fromtime', $fromtime);?> �� <?php echo dcalendar('totime', $totime);?>&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="��/ҳ"/>&nbsp;
<input type="submit" value="�� ��" class="btn"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="window.location='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>';"/>
</td>
</tr>
</table>
</form>
<form method="post">
<div class="tt">���ͼ�¼</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>��ˮ��</th>
<th>�ֻ���</th>
<th>����</th>
<th>����</th>
<th>����</th>
<th width="80">����ʱ��</th>
<th>������</th>
<th>���ͽ��</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['itemid'];?>"/></td>
<td><?php echo $v['itemid'];?></td>
<td><a href="javascript:_user('<?php echo $v['mobile'];?>', 'mobile');"><?php echo $v['mobile'];?></a></td>
<td align="left" style="width:150px;padding:8px;line-height:20px;"><?php echo $v['message'];?></td>
<td class="px11"><?php echo $v['word'];?></td>
<td class="px11"><?php echo $v['num'];?></td>
<td class="px11"><?php echo $v['sendtime'];?></td>
<td><a href="javascript:_user('<?php echo $v['editor'];?>');"><?php echo $v['editor'];?></a></td>
<td style="width:120px;padding:8px;line-height:20px;"><?php echo $v['code'];?></td>
</tr>
<?php }?>
</table>
<div class="btns">
<input type="submit" value=" ����ɾ�� " class="btn" onclick="if(confirm('ȷ��Ҫɾ��ѡ�м�¼�𣿴˲��������ɳ���')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete_sms'}else{return false;}"/>
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">Menuon(1);</script>
<br/>
<?php include tpl('footer');?>