<?php
defined('IN_AIJIACMS') or exit('Access Denied');
preg_match("/^[0-9]{5,11}$/", $kf) or $kf = '';
?>
<tr>
<td class="tl">���߿ͷ��ʺ�</td>
<td class="tr">
<input type="text" name="setting[kf]" id="kf" value="<?php echo $kf;?>" size="10"/>&nbsp;&nbsp;
<?php if($kf) { ?>
<a href="http://www.tq.cn/" class="t" target="_blank">�ʺŹ���</a>
<?php } else { ?>
<a href="http://www.tq.cn/" class="t" target="_blank">�ʺ�����</a>
<?php } ?><br/><br/>
��ʾ��ע����ȡ�Ŀͷ�����"...http://float2006.tq.cn/floatcard?adminid=<span class="f_red">1234567</span>&sort=0..."��<span class="f_red">1234567</span>��Ϊ�ͷ��ʺ�
</td>
</tr>