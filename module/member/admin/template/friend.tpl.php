<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form action="?">
<div class="tt">��������</div>
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>
&nbsp;<?php echo $fields_select;?>&nbsp;
<input type="text" size="50" name="kw" value="<?php echo $kw;?>" title="�ؼ���"/>&nbsp;
��ԱID:<input type="text" name="userid" value="<?php echo $userid;?>" size="5"/>&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="��/ҳ"/>&nbsp;
<input type="submit" value="�� ��" class="btn"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="Go('?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>');"/>
</td>
</tr>
</table>
</form>
<form method="post">
<div class="tt">��������</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>����</th>
<th>��Ա</th>
<th>��˾</th>
<th colspan="8">��ϵ��ʽ</th>
<th>��ԱID</th>
<th width="120">���ʱ��</th>
<th width="50">����</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center" title="��ע:<?php echo $v['note'];?>">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['itemid'];?>"/></td>
<td align="left">&nbsp;<?php echo $v['truename'];?></td>
<td><a href="javascript:_user('<?php echo $v['username'];?>');"><?php echo $v['username'];?></a></td>
<td align="left">&nbsp;<?php echo $v['company'];?></td>

<td width="20"><?php if($v['homepage']) { ?><a href="<?php echo $v['homepage'];?>" target="_blank"><img width="16" height="16" src="<?php echo AJ_SKIN;?>image/homepage.gif" title="��˾��ҳ" alt=""/></a><?php } else { ?>&nbsp;<?php } ?></td>

<td width="20"><?php if($v['mobile']) { ?><a href="javascript:Dwidget('?moduleid=2&file=sendsms&mobile=<?php echo $v['mobile'];?>', '���Ͷ���');"><img src="<?php echo AJ_SKIN;?>image/mobile.gif" title="���Ͷ���" alt=""/></a><?php } else { ?>&nbsp;<?php } ?></td>

<td width="20"><?php if($v['username']) { ?><a href="javascript:Dwidget('?moduleid=2&file=message&action=send&touser=<?php echo $v['username'];?>', '������Ϣ');"><img width="16" height="16" src="<?php echo AJ_SKIN;?>image/msg.gif" title="������Ϣ" alt=""/></a><?php } else { ?>&nbsp;<?php } ?></td> 

<td width="20"><?php if($v['email']) { ?><a href="javascript:Dwidget('?moduleid=2&file=sendmail&email=<?php echo $v['email'];?>', '�����ʼ�');"><img width="16" height="16" src="<?php echo AJ_SKIN;?>image/email.gif" title="�����ʼ�" alt=""/></a><?php } else { ?>&nbsp;<?php } ?></td>

<td width="20"><?php if($v['qq']) { echo im_qq($v['qq']); } else { echo '&nbsp;'; } ?></td>

<td width="20"><?php if($v['ali']) { echo im_ali($v['ali']); } else { echo '&nbsp;'; } ?></td>

<td width="20"><?php if($v['msn']) { echo im_msn($v['msn']); } else { echo '&nbsp;'; } ?></td>

<td width="20"><?php if($v['skype']) { echo im_skype($v['skype']); } else { echo '&nbsp;'; } ?></td>

<td><a href="javascript:_user('<?php echo $v['userid'];?>', 'userid');"><?php echo $v['userid'];?></a></td>
<td class="px11"><?php echo $v['adddate'];?></td>
<td>
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=edit&itemid=<?php echo $v['itemid'];?>"><img src="admin/image/edit.png" width="16" height="16" title="�޸�" alt=""/></a>&nbsp;
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete&itemid=<?php echo $v['itemid'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="ɾ��" alt=""/></a>
</td>
</tr>
<?php }?>
</table>
<div class="btns">
<input type="submit" value=" ɾ �� " class="btn" onclick="if(confirm('ȷ��Ҫɾ��ѡ�������𣿴˲��������ɳ���')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete'}else{return false;}"/>&nbsp;&nbsp;&nbsp;��ע����ԱID�������ѵ������(ӵ����)
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<br/>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>