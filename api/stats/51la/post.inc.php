<?php
defined('IN_AIJIACMS') or exit('Access Denied');
preg_match("/^[0-9]{5,11}$/", $stats) or $stats = '';
?>
<tr>
<td class="tl">����ͳ���ʺ�</td>
<td class="tr">
<input type="text" name="setting[stats]" id="stats" value="<?php echo $stats;?>" size="10"/>&nbsp;&nbsp;
<?php if($stats) { ?>
<a href="http://www.51.la/?<?php echo $stats;?>" class="t" target="_blank">�鿴ͳ��</a>
<?php } else { ?>
<a href="http://www.51.la/" class="t" target="_blank">�ʺ�����</a>
<?php } ?><br/><br/>
��ʾ��ע����ȡ��ͳ�ƴ���"...http://js.users.51.la/<span class="f_red">1234567</span>.js..."��<span class="f_red">1234567</span>��Ϊͳ���ʺ�
</td>
</tr>