<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form action="?">
<div class="tt"><?php echo VIP;?>����</div>
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<?php echo $fields_select;?>&nbsp;
<input type="text" size="30" name="kw" value="<?php echo $kw;?>" title="�ؼ���"/>&nbsp;
<?php echo $group_select;?>&nbsp;
<?php echo $order_select;?>
&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="��/ҳ"/>
<input type="submit" value="�� ��" class="btn"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="Go('?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>');"/>
</td>
</tr>
<tr>
<td>&nbsp;
<select name="timetype">
<option value="fromtime" <?php if($timetype == 'fromtime') echo 'selected';?>>��ͨʱ��</option>
<option value="totime" <?php if($timetype == 'totime') echo 'selected';?>>����ʱ��</option>
</select>&nbsp;
<?php echo dcalendar('dfromtime', $dfromtime);?> �� <?php echo dcalendar('dtotime', $dtotime);?>&nbsp;

<select name="vip">
<option value="0"><?php echo VIP;?>ָ��</option>
<?php 
for($i = 1; $i < 11; $i++) {
	echo '<option value="'.$i.'"'.($i == $vip ? ' selected' : '').'>'.$i.' ��</option>';
}
?>
</select>&nbsp;
����ֵ��<input type="text" name="vipt" value="<?php echo $vipt;?>" size="2"/>&nbsp;
����ֵ��<input type="text" name="vipr" value="<?php echo $vipr;?>" size="2"/>&nbsp;
</td>
</tr>
</table>
</form>
<form method="post">
<div class="tt"><?php echo VIP;?>����</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>��ԱID</th>
<th>��˾����</th>
<th>��Ա��</th>
<th>��Ա��</th>
<th>��ͨʱ��</th>
<th>����ʱ��</th>
<th><?php echo VIP;?>ָ��</th>
<th>����ֵ</th>
<th>����ֵ</th>
<th>����</th>
</tr>
<?php foreach($companys as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="userid[]" value="<?php echo $v['userid'];?>"/></td>
<td><?php echo $v['userid'];?></td>
<td align="left">&nbsp;<a href="<?php echo $v['linkurl'];?>" target="_blank"><?php echo $v['company'];?></a></td>
<td><a href="javascript:_user('<?php echo $v['username'];?>');"><?php echo $v['username'];?></a></td>
<td><?php echo $GROUP[$v['groupid']]['groupname'];?></td>
<td class="px11"><?php echo timetodate($v['fromtime'], 3);?></td>
<td class="px11"><?php echo timetodate($v['totime'], 3);?></td>
<td><img src="<?php echo AJ_SKIN;?>image/vip_<?php echo $v['vip'];?>.gif"/></td>
<td><?php echo $v['vipt'];?></td>
<td><?php echo $v['vipr'];?></td>
<td>
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=edit&userid=<?php echo $v['userid'];?>"><img src="admin/image/edit.png" width="16" height="16" title="�޸�" alt=""/></a>&nbsp;
<a href="?moduleid=2&action=show&username=<?php echo $v['username'];?>"><img src="admin/image/view.png" width="16" height="16" title="��Ա[<?php echo $v['username'];?>]��ϸ����" alt=""/></a>&nbsp;
<a href="?moduleid=2&action=login&userid=<?php echo $v['userid'];?>" target="_blank"><img src="admin/image/set.png" width="16" height="16" title="�����Ա��Ա����" alt=""/></a>
</td>
</tr>
<?php }?>
</table>
<div class="btns">
<input type="submit" value=" ����ָ�� " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=update';"/>&nbsp;
<input type="submit" value=" ����<?php echo VIP;?> " class="btn" onclick="if(confirm('ȷ��Ҫ����ѡ�й�˾<?php echo VIP;?>�ʸ�����')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete'}else{return false;}"/>&nbsp;
<input type="submit" value=" �������� " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=html&action=show&update=1';"/>&nbsp;
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<div class="tt">���ʽ���</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><?php echo VIP;?>ָ��</td>
<td class="f_gray"><?php echo VIP;?>ָ�����Ƕ�<?php echo VIP;?>��Ա���ۺ����ֵ�һ��1-10�����֣�������ֵ������ֵ֮�͡�ָ��Խ�󣬻�Ա�ļ���ʵ�������Ŷȵ�Խ�ߣ���Ϣ����Խ��ǰ</td>
</tr>
<tr>
<td class="tl">����ֵ</td>
<td class="f_gray">����ֵ����ϵͳ���ݹ���Ա���õ����ֱ�׼�������<?php echo VIP;?>ָ��ֵ</td>
</tr>
<tr>
<td class="tl">����ֵ</td>
<td class="f_gray">Ϊ����������ֵ���Աʵ���ۺ�ʵ�������ɹ���Ա�����˹���Ԥ����ֵ����Ϊ������Ҳ��Ϊ����</td>
</tr>
</table>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>