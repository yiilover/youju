<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">վ���ż�ת��</div>
<form method="post" action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="send" value="1"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">��ʾ</td>
<td>����ͨ���˹��ܽ���Ա��δ��վ���ŷ�������ע������</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ʱ�䷶Χ</td>
<td>
<input type="text" size="5" name="hour" id="hour" value="48"/> Сʱ<?php tips('���ͳ�����ʱ��δ����վ���� ��������24Сʱ����<br/>ÿ��վ����ֻ����һ�Σ��Ѿ����͹��Ĳ����ظ�����');?>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ÿ�ַ����ʼ���</td>
<td><input type="text" size="5" name="pernum" id="pernum" value="5"/></td>
</tr>
<?php if($lasttime) { ?>
<tr>
<td class="tl">�ϴη���</td>
<td><?php echo $lasttime;?></td>
</tr>
<?php } ?>
</tbody>
</table>
<div class="sbt"><input type="submit" name="submit" value=" ��ʼ���� " class="btn" onclick="if(!confirm('ȷ�����ͳ��� '+Dd('hour').value+' Сʱδ����վ��������Ա������')) return false;"></div>
</form>
<script type="text/javascript">Menuon(3);</script>
<?php include tpl('footer');?>