<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form action="?">
<div class="tt">��Ա����</div>
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<?php echo $fields_select;?>&nbsp;
<input type="text" size="20" name="kw" value="<?php echo $kw;?>" title="�ؼ���"/>&nbsp;
<?php echo $group_select;?>&nbsp;
<?php echo $gender_select;?>&nbsp;
<?php echo ajax_area_select('areaid', '���ڵ���', $areaid);?>&nbsp;
<?php echo $order_select;?>
&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="��/ҳ"/>
<input type="submit" value="�� ��" class="btn"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="Go('?moduleid=<?php echo $moduleid;?>&action=<?php echo $action;?>');"/>
</td>
</tr>
<tr>
<td>&nbsp;
<select name="timetype">
<option value="regtime" <?php if($timetype == 'regtime') echo 'selected';?>>ע��ʱ��</option>
<option value="logintime" <?php if($timetype == 'logintime') echo 'selected';?>>��¼ʱ��</option>
</select>&nbsp;
<?php echo dcalendar('fromtime', $fromtime);?> �� <?php echo dcalendar('totime', $totime);?>&nbsp;
<?php echo $AJ['money_name'];?>��<input type="text" size="3" name="minmoney" value="<?php echo $minmoney;?>"/> ~ <input type="text" size="3" name="maxmoney" value="<?php echo $maxmoney;?>"/>&nbsp;
<?php echo $AJ['credit_name'];?>��<input type="text" size="3" name="mincredit" value="<?php echo $mincredit;?>"/> ~ <input type="text" size="3" name="maxcredit" value="<?php echo $maxcredit;?>"/>&nbsp;
���ţ�<input type="text" size="3" name="minsms" value="<?php echo $minsms;?>"/> ~ <input type="text" size="3" name="maxsms" value="<?php echo $maxsms;?>"/>&nbsp;
</td>
</tr>
<tr>
<td>&nbsp;
<?php echo $vprofile_select;?> 
<?php echo $vemail_select;?> 
<?php echo $vmobile_select;?> 
<?php echo $vtruename_select;?> 
<?php echo $vbank_select;?> 
<?php echo $vcompany_select;?> 
<?php echo $vtrade_select;?> 
<?php echo $avatar_select;?> 
��Ա����<input type="text" name="username" value="<?php echo $username;?>" size="8"/>&nbsp;
��ԱID��<input type="text" name="uid" value="<?php echo $uid;?>" size="4"/>
</td>
</tr>
</table>
</form>
<form method="post">
<div class="tt">��Ա����</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>��ԱID</th>
<th>��Ա����</th>
<th>��˾</th>
<th><?php echo $AJ['money_name'];?></th>
<th><?php echo $AJ['credit_name'];?></th>
<th>����</th>
<th>�Ա�</th>
<th>��Ա��</th>
<th>ע��ʱ��</th>
<th>����¼</th>
<th>��¼����</th>
<th width="100">����</th>
</tr>
<?php foreach($members as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="userid[]" value="<?php echo $v['userid'];?>"/></td>
<td class="px11"><?php echo $v['userid'];?></td>
<td align="left">&nbsp;<a href="javascript:_user('<?php echo $v['username'];?>');" title="<?php echo $v['truename'];?>"><?php echo $v['username'];?></a></td>
<td align="left">&nbsp;<a href="<?php echo userurl($v['username']);?>" target="_blank"><?php echo $v['company'];?></a></td>
<td class="px11"><a href="javascript:Dwidget('?moduleid=<?php echo $moduleid;?>&file=record&username=<?php echo $v['username'];?>', '[<?php echo $v['username'];?>] <?php echo $AJ['money_name'];?>��¼');"><?php echo $v['money'];?></a></td>
<td class="px11"><a href="javascript:Dwidget('?moduleid=<?php echo $moduleid;?>&file=credit&username=<?php echo $v['username'];?>', '[<?php echo $v['username'];?>] <?php echo $AJ['credit_name'];?>��¼');"><?php echo $v['credit'];?></a></td>
<td class="px11"><a href="javascript:Dwidget('?moduleid=<?php echo $moduleid;?>&file=sms&username=<?php echo $v['username'];?>&action=record', '[<?php echo $v['username'];?>] ���ż�¼');"><?php echo $v['sms'];?></a></td>
<td><?php echo gender($v['gender']);?></td>
<td><a href="?moduleid=<?php echo $moduleid;?>&groupid=<?php echo $v['groupid'];?>"><?php echo $GROUP[$v['groupid']]['groupname'];?></a></td>
<td class="px11"><?php echo $v['regdate'];?></td>
<td class="px11"><?php echo $v['logindate'];?></td>
<td class="px11"><a href="javascript:Dwidget('?moduleid=<?php echo $moduleid;?>&file=loginlog&username=<?php echo $v['username'];?>&action=record', '[<?php echo $v['username'];?>] ��¼��¼');"><?php echo $v['logintimes'];?></a></td>
<td>
<a href="?moduleid=<?php echo $moduleid;?>&action=edit&userid=<?php echo $v['userid'];?>"><img src="admin/image/edit.png" width="16" height="16" title="�޸�" alt=""/></a>&nbsp;
<a href="?moduleid=2&action=show&userid=<?php echo $v['userid'];?>"><img src="admin/image/view.png" width="16" height="16" title="��Ա[<?php echo $v['username'];?>]��ϸ����" alt=""/></a>&nbsp;
<a href="?moduleid=<?php echo $moduleid;?>&action=login&userid=<?php echo $v['userid'];?>" target="_blank"><img src="admin/image/set.png" width="16" height="16" title="�����Ա��Ա����" alt=""/></a>&nbsp;
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete&userid=<?php echo $v['userid'];?>" onclick="if(!confirm('ȷ��Σ�գ���Ҫɾ���˻�Ա��ϵͳ��ɾ��ѡ���û�������Ϣ���˲��������ɳ���')) return false;"><img src="admin/image/delete.png" width="16" height="16" title="ɾ��" alt=""/></a>
</td>
</tr>
<?php }?>
</table>
<div class="btns">
<input type="submit" value=" ɾ����Ա " class="btn" onclick="if(confirm('ȷ��Ҫɾ��ѡ�л�Ա��ϵͳ��ɾ��ѡ���û�������Ϣ���˲��������ɳ���')){this.form.action='?moduleid=<?php echo $moduleid;?>&action=delete'}else{return false;}"/>&nbsp;
<input type="submit" value=" ��ֹ���� " class="btn" onclick="if(confirm('ȷ��Ҫ��ֹѡ�л�Ա������')){this.form.action='?moduleid=<?php echo $moduleid;?>&action=move&groupids=2'}else{return false;}"/>&nbsp;
<input type="submit" value=" ����<?php echo VIP;?> " class="btn" onclick="this.form.action='?moduleid=4&file=vip&action=add';"/>&nbsp;
<input type="submit" value=" <?php echo $AJ['money_name'];?>���� " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=record&action=add';"/>&nbsp;
<input type="submit" value=" <?php echo $AJ['credit_name'];?>���� " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=credit&action=add';"/>&nbsp;
<input type="submit" value=" �������� " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=sms&action=add';"/>&nbsp;
<input type="submit" value=" ���Ͷ��� " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=sendsms';"/>&nbsp;
<input type="submit" value=" �����ʼ� " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=sendmail';"/>&nbsp;
<input type="submit" value=" ������Ϣ " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=message&action=send';"/>&nbsp;
<input type="submit" value=" ó������ " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=alert&action=add';"/>&nbsp;
<input type="submit" value=" �ƶ��� " class="btn" onclick="if(Dd('mgroupid').value==0){alert('��ѡ���Ա��');Dd('mgroupid').focus();return false;}this.form.action='?moduleid=<?php echo $moduleid;?>&action=move';"/> <?php echo group_select('groupid', '��Ա��', 0, 'id="mgroupid"');?> 
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<div class="tt">�޸Ļ�Ա��</div>
<form method="post" action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="rename"/>
<a name="#editusername"></a>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;��ǰ��Ա���� <input type="text" name="cusername" size="20" value="<?php echo $username;?>"/> &nbsp; �»�Ա���� <input type="text" name="nusername" size="20"<?php if($catid) echo ' style="color:#FF6600;" value="�������»�Ա��" onclick="if(this.value==\'�������»�Ա��\')this.value=\'\';"';?>/>  &nbsp; <input type="submit" name="submit" value=" ȷ �� " class="btn"/>&nbsp;&nbsp;<span class="f_gray">����������������鲻ҪƵ���޸Ļ�Ա��</span>
</td>
</tr>
</table>
</form>	
<div class="tt">�ֻ���ѯ</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;�ֻ��ţ� <input type="text" name="mob" size="30" id="mob"/> &nbsp; <input type="button"  value=" �� ѯ " class="btn" onclick="if(Dd('mob').value){_mobile(Dd('mob').value);}"/>&nbsp;&nbsp;<span class="f_gray">�ɲ�ѯ�ֻ����ڵ���</span>
</td>
</tr>
</table>
<div class="tt">IP��ѯ</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;IP��ַ�� <input type="text" name="ip" size="30" id="ip"/> &nbsp; <input type="button"  value=" �� ѯ " class="btn" onclick="if(Dd('ip').value){_ip(Dd('ip').value);}"/>&nbsp;&nbsp;<span class="f_gray">�ɲ�ѯIP���ڵ���</span>
</td>
</tr>
</table>
<div class="tt">IP����</div>
<form method="post" action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="unlock"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;IP��ַ�� <input type="text" name="ip" size="30"/> &nbsp; <input type="submit" name="submit" value=" �� �� " class="btn"/>&nbsp;&nbsp;<span class="f_gray">�ɽ�����¼ʧ�ܴ����������������¼��IP</span>
</td>
</tr>
</table>
</form>
<br/><br/><br/>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>