<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">����Ա����</div>
<form action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>&nbsp;
<?php echo $fields_select;?>&nbsp;
<input type="text" size="30" name="kw" value="<?php echo $kw;?>" title="�ؼ���"/>&nbsp;
<select name="type">
<option value="0">����Ա����</option>
<option value="1"<?php echo $type == 1 ? ' selected' : '';?>>��������Ա</option>
<option value="2"<?php echo $type == 2 ? ' selected' : '';?>>��ͨ����Ա</option>
</select>&nbsp;
<?php echo ajax_area_select('areaid', '������վ', $areaid);?>&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="��/ҳ"/>
<input type="submit" value="�� ��" class="btn"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="Go('?file=<?php echo $file;?>');"/>
</td>
</tr>
</table>
</form>
<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="add"/>
<div class="tt">����Ա����</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th>����</th>
<th>�û���</th>
<th>������</th>
<th>�����ɫ</th>
<th>������վ</th>
<th>�ϴε�¼ʱ��</th>
<th>��¼IP</th>
<th>��¼����</th>
<th>��¼����</th>
<th width="150">����</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td><?php echo $v['truename'];?></td>
<td><a href="javascript:_user('<?php echo $v['username'];?>');"><?php echo $v['username'];?></a></td>
<td><?php echo $v['adminname'];?></td>
<td><?php echo $v['role'];?></td>
<td><?php echo $v['aid'] ? $AREA[$v['aid']]['areaname'] : '';?></td>
<td class="px11"><?php echo $v['logintime'];?></td>
<td class="px11"><a href="javascript:_ip('<?php echo $v['loginip'];?>');"><?php echo $v['loginip'];?></a></td>
<td><?php echo ip2area($v['loginip']);?></td>
<td><?php echo $v['logintimes'];?></td>
<td>
<a href="?file=<?php echo $file;?>&action=edit&userid=<?php echo $v['userid'];?>" title="�޸Ĺ����𡢽�ɫ����վ">�޸�</a> | 
<a href="javascript:Dwidget('?file=<?php echo $file;?>&action=right&userid=<?php echo $v['userid'];?>', '[<?php echo $v['username'];?>]����Ȩ�޺͹������');" title="����Ȩ�� / �������">Ȩ��/���</a> | 
<a href="?file=<?php echo $file;?>&action=delete&username=<?php echo $v['username'];?>" onclick="return _delete();" title="��������Ա">����</a>
</td>
</tr>
<?php }?>
</table>
<div class="pages"><?php echo $pages;?></div>
<br/>
<?php if(isset($id) && isset($tm) && $id && $tm > $AJ_TIME) { ?>
<script type="text/javascript">Dwidget('?file=<?php echo $file;?>&action=right&userid=<?php echo $id;?>', '�����Ȩ�޺͹������');</script>
<?php } ?>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>