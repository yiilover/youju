<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">վ���ż�����</div>
<form method="post" action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">�ż�</td>
<td>
<input type="radio" value="0" name="message[status]" checked="checked"/> ȫ��
<input type="radio" value="3" name="message[status]" /> �ռ���
<input type="radio" value="2" name="message[status]" /> �ѷ���
<input type="radio" value="1" name="message[status]" /> �ݸ���
<input type="radio" value="4" name="message[status]" /> ����վ
</td>
</tr>
<tr>
<td class="tl">���ڷ�Χ</td>
<td>
<?php echo dcalendar('message[fromdate]');?> �� <?php echo dcalendar('message[todate]', $todate);?> ��ָ����ʾ����
</td>
</tr>
<tr>
<td class="tl">ѡ��</td>
<td>
<input type="checkbox" value="1" name="message[isread]" checked="checked"/> ����δ���ż�
</td>
</tr>
</tbody>
</table>
<div class="sbt"><input type="submit" name="submit" value=" �� �� " class="btn" onclick="if(!confirm('ȷ��Ҫ�����𣿴˲��������ɳ���')) return false;">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" �� �� " class="btn"/></div>
</form>
<script type="text/javascript">Menuon(4);</script>
<?php include tpl('footer');?>