<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form action="?">
<div class="tt"><?php echo $MOD['name'];?>����</div>
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<?php echo $fields_select;?>&nbsp;
<input type="text" size="25" name="kw" value="<?php echo $kw;?>" title="�ؼ���"/>&nbsp;
<?php echo $level_select;?>&nbsp;
<select name="vip">
<option value=""><?php echo VIP;?>����</option>
<?php 
for($i = 0; $i < 11; $i++) {
	echo '<option value="'.$i.'"'.($i == $vip ? ' selected' : '').'>'.$i.' ��</option>';
}
?>
</select>&nbsp;
<?php echo $valid_select;?>&nbsp;
<?php echo $order_select;?>&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="��/ҳ"/>
<input type="submit" value="�� ��" class="btn"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="Go('?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>');"/>
</td>
</tr>
<tr>
<td>&nbsp;
<?php echo category_select('catid', '������ҵ', $catid, $moduleid);?>&nbsp;
<?php echo ajax_area_select('areaid', '���ڵ���', $areaid);?>&nbsp;
<?php echo $mode_select;?>&nbsp;
<?php echo $type_select;?>&nbsp;
<?php echo $size_select;?>&nbsp;
<input type="checkbox" name="thumb" value="1"<?php echo $thumb ? ' checked' : '';?>/>ͼƬ&nbsp;
</td>
</tr>
<tr>
<td>&nbsp;
<select name="timetype">
<option value="totime" <?php if($timetype == 'totime') echo 'selected';?>>������</option>
<option value="fromtime" <?php if($timetype == 'fromtime') echo 'selected';?>>����ʼ</option>
<option value="validtime" <?php if($timetype == 'validtime') echo 'selected';?>>��֤ʱ��</option>
<option value="styletime" <?php if($timetype == 'styletime') echo 'selected';?>>ģ�嵽��</option>
</select>&nbsp;
<?php echo dcalendar('fromtime', $fromtime);?> �� <?php echo dcalendar('totime', $totime);?>&nbsp;
ע���ʱ���<input type="text" size="5" name="mincapital" value="<?php echo $mincapital;?>"/> ~ <input type="text" size="5" name="maxcapital" value="<?php echo $maxcapital;?>"/> ��&nbsp;
��Ա����<input type="text" name="username" value="<?php echo $username;?>" size="10"/>&nbsp;
��ԱID��<input type="text" name="uid" value="<?php echo $uid;?>" size="10"/>&nbsp;
</td>
</tr>
</table>
</form>
<form method="post">
<div class="tt"><?php echo $MOD['name'];?>����</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th width="14"> </th>
<th><?php echo $MOD['name'];?>����</th>
<th>���ڵ�</th>
<th>ע�����</th>
<th>ע���ʱ�</th>
<th><?php echo VIP;?>ָ��</th>
<th>����</th>
<th width="100">����</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center" title="<?php echo $MOD['name'];?>����:<?php echo $v['type'];?>&#10;<?php echo $MOD['name'];?>��ģ:<?php echo $v['size'];?>">
<td><input type="checkbox" name="userid[]" value="<?php echo $v['userid'];?>"/></td>
<td><?php if($v['level']) {?><a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>&level=<?php echo $v['level'];?>"><img src="admin/image/level_<?php echo $v['level'];?>.gif" title="<?php echo $v['level'];?>��" alt=""/></a><?php } ?></td>
<td align="left">&nbsp;<a href="<?php echo $v['linkurl'];?>" target="_blank"><?php echo $v['company'];?></a><?php if($v['vip']) {?> <img src="<?php echo AJ_SKIN;?>image/vip_<?php echo $v['vip'];?>.gif" title="<?php echo VIP;?>:<?php echo $v['vip'];?>" align="absmiddle"/><?php } ?><?php if($v['thumb']) {?> <a href="javascript:_preview('<?php echo $v['thumb'];?>');"><img src="admin/image/img.gif" width="10" height="10" title="����ͼ,���Ԥ��" alt=""/></a><?php } ?></td>
<td><?php echo area_pos($v['areaid'], '/');?></td>
<td><?php echo $v['regyear'];?></td>
<td><?php echo $v['capital'] ? $v['capital'].'��'.$v['regunit'] : 'δ��';?></td>
<td><img src="<?php echo AJ_SKIN;?>image/vip_<?php echo $v['vip'];?>.gif"/></td>
<td><?php echo $v['hits'];?></td>
<td><a href="?moduleid=2&action=edit&userid=<?php echo $v['userid'];?>"><img src="admin/image/edit.png" width="16" height="16" title="�޸Ļ�Ա[<?php echo $v['username'];?>]����" alt=""/></a>&nbsp;
<a href="?moduleid=2&action=show&userid=<?php echo $v['userid'];?>"><img src="admin/image/view.png" width="16" height="16" title="��Ա[<?php echo $v['username'];?>]��ϸ����" alt=""/></a>&nbsp;
<a href="?moduleid=2&action=login&userid=<?php echo $v['userid'];?>" target="_blank"><img src="admin/image/set.png" width="16" height="16" title="�����Ա��Ա����" alt=""/></a>&nbsp;
<a href="?moduleid=2&action=delete&userid=<?php echo $v['userid'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="ɾ��" alt=""/></a></td>
</tr>
<?php }?>
</table>
<div class="btns">
<input type="submit" value=" ɾ����˾ " class="btn" onclick="if(confirm('ȷ��Ҫɾ��ѡ�л�Ա��ϵͳ��ɾ��ѡ���û�������Ϣ���˲��������ɳ���')){this.form.action='?moduleid=2&action=delete'}else{return false;}"/>&nbsp;
<input type="submit" value=" ��ֹ���� " class="btn" onclick="if(confirm('ȷ��Ҫ��ֹѡ�л�Ա������')){this.form.action='?moduleid=2&action=move&groupids=2'}else{return false;}"/>&nbsp;
<input type="submit" value=" ����<?php echo VIP;?> " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=vip&action=add';"/>&nbsp;
<input type="submit" value=" �ƶ����� " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=move';"/>&nbsp;
<input type="submit" value=" ���¹�˾ " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=update';"/>&nbsp;
<input type="submit" value=" �ƶ��� " class="btn" onclick="if(Dd('mgroupid').value==0){alert('��ѡ���Ա��');Dd('mgroupid').focus();return false;}this.form.action='?moduleid=2&action=move';"/> <?php echo group_select('groupid', '��Ա��', 0, 'id="mgroupid"');?>&nbsp;
<?php echo level_select('level', '���ü���Ϊ</option><option value="0">ȡ��', 0, 'onchange="this.form.action=\'?moduleid='.$moduleid.'&file='.$file.'&action=level\';this.form.submit();"');?>
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<br/>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>