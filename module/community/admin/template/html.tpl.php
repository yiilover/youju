<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<form method="post">
<div class="tt">������ҳ</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td height="30">&nbsp;
<input type="submit" value=" һ������ " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=all';" title="���ɸ�ģ��������ҳ"/>&nbsp;&nbsp;
<input type="submit" value=" ������ҳ " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=index';" title="���ɸ�ģ����ҳ"/>&nbsp;&nbsp;
<input type="submit" value=" �����б� " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=list';" title="���ɸ�ģ�����з���"/>&nbsp;&nbsp;
<input type="submit" value=" �������� " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=show';" title="���ɸ�ģ����������ҳ"/>&nbsp;&nbsp;
<input type="submit" value=" ������Ϣ " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=show&update=1';" title="���¸�ģ��������Ϣ��ַ����Ŀ"/>
</td>
</tr>
</table>
</form>
<form method="post">
<div class="tt">����<?php echo $MOD['name'];?></div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th>��ʼID</th>
<th>����ID</th>
<th width="200">ÿ����������</th>
<th width="200">����</th>
</tr>
<tr align="center">
<td><input type="text" size="6" name="fid" value="<?php echo $fid;?>"/></td>
<td><input type="text" size="6" name="tid" value="<?php echo $tid;?>"/></td>
<td><input type="text" size="5" name="num" value="100"/></td>
<td><input type="submit" value=" �������� " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=show';"/>&nbsp;
<input type="submit" value=" ������Ϣ " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=show&update=1';"/>
</td>
</tr>
</table>
</form>
<form method="post">
<div class="tt">�ֶ�����</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th>ѡ�����</th>
<th width="200">ÿ����������</th>
<th width="200">����</th>
</tr>
<tr align="center">
<td>
<?php echo category_select('catid', 'ѡ�����', 0, 6);?>
&nbsp;&nbsp;&nbsp;&nbsp;
�� <input type="text" size="3" name="fpage" value="1"/> ҳ �� <input type="text" size="3" name="tpage" value=""/> ҳ
</td>
<td><input type="text" size="5" name="num" value="100"/></td>
<td>
<input type="submit" value=" �����б� " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=cate';"/>&nbsp;
<input type="submit" value=" �������� " class="btn" onclick="this.form.action='?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=item';"/>
</td>
</tr>
</table>
</form>
<script type="text/javascript">Menuon(0);</script>
<br/>
<?php include tpl('footer');?>