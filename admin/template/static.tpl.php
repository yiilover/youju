<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
?>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td style="padding:6px 10px 6px 10px;">
ͨ����̬�ļ����벿���ܣ����Խ���վ�ľ�̬�ļ����𵽶����ķ��������Ӷ�������վ��ѹ���������վ�����ٶȡ�<br/>
���羲̬�ļ����ڷ������󶨵�����Ϊstatic.aijiacms.com�����ڲ����ַ����дhttp://static.aijiacms.com/��Ȼ���ϴ���վ�ľ�̬�ļ���static.aijiacms.com���ڵ�վ��Ŀ¼��<br/>
<?php if($itemid) { ?>
��̬�ļ��Ѿ�����վ��<span class="f_red">file/static</span>Ŀ¼���뽫staticĿ¼�µ������ļ��ϴ�����̬�ļ���������վ��Ŀ¼��
<?php } else { ?>
<a href="?action=static&itemid=1" class="t">������������Ҫ����ľ�̬�ļ�&raquo;</a>
<?php } ?>
</td>
</tr>
</table>
<?php include tpl('footer');?>