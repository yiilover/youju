<?php
defined('IN_AIJIACMS') or exit('Access Denied');
preg_match("/^[0-9a-z]{32}$/", $kf) or $kf = '';
?>
<tr>
<td class="tl">���߿ͷ��ʺ�</td>
<td class="tr">
<input type="text" name="setting[kf]" id="kf" value="<?php echo $kf;?>" size="40"/>&nbsp;&nbsp;
<?php if($kf) { ?>
<a href="http://qiao.baidu.com/" class="t" target="_blank">�ʺŹ���</a>
<?php } else { ?>
<a href="http://qiao.baidu.com/" class="t" target="_blank">�ʺ�����</a>
<?php } ?><br/><br/>
��ʾ��ע����ȡ�Ŀͷ�����"...hm.baidu.com/h.js%3F<span class="f_red">321c361fa45809b610d5ec4ae9a392c2</span>' type=..."��<span class="f_red">321c361fa45809b610d5ec4ae9a392c2</span>��Ϊ�ͷ��ʺ�
</td>
</tr>