<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');

?>
<form action="?">
<div class="tt">�Ź�����</div>
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>
&nbsp;<?php echo $fields_select;?>&nbsp;
<input type="text" size="30" name="kw" value="<?php echo $kw;?>" title="�ؼ���"/>&nbsp;

<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="��/ҳ"/>
<input type="submit" value="�� ��" class="btn"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="window.location='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>';"/>
</td>
</tr>
</table>
</form>
<form method="post">
<div class="tt">�Ź��б�</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="25"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th width="35">����</th>
<th width="30">�Ա�</th>
<th width="80">��ϵ�绰</th>
<th  width="90">�����ʼ�</th>
<th  width="90">¥������</th>
<th width="30">�û���</th>
<th width="70">�Ź�ʱ��</th>
<th width="30">ɾ</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['itemid'];?>"/></td>
<td><?php echo $v['truename'];?></td>
<td><?php echo $v['sex'];?></td>
<td><?php echo $v['telephone'];?></td>
<td><?php echo $v['email'];?></td>
<td ><a href="<?php echo $v['linkurl'];?>" title="<?php echo $v['title'];?>"><?php echo dsubstr($v['title'], 20, '');?></a></td>
<td><?php echo $v['fromuser'] ? $v['fromuser'] : '�ο�';?></td>
<td class="px11"><?php echo timetodate($v['addtime'], 5);?></td>
<td>
<a href="?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete&itemid=<?php echo $v['itemid'];?>" onclick="return _delete();"><img src="admin/image/delete.png" width="16" height="16" title="ɾ��" alt=""/></a>
</td>
</tr>
<?php }?>
</table>
<div class="btns">
<input type="submit" value=" ɾ �� " class="btn" onclick="if(confirm('ȷ��Ҫɾ��ѡ���ż��𣿴˲��������ɳ���')){this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=delete'}else{return false;}"/>
</div>
</form>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">Menuon(1);</script>
<br/>
<?php include tpl('footer');?>