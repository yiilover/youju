<?php
defined('IN_AIJIACMS') or exit('Access Denied');
preg_match("/^[0-9]{5,11}$/", $kf) or $kf = '';
?>
<tr>
<td class="tl">在线客服帐号</td>
<td class="tr">
<input type="text" name="setting[kf]" id="kf" value="<?php echo $kf;?>" size="10"/>&nbsp;&nbsp;
<?php if($kf) { ?>
<a href="http://www.tq.cn/" class="t" target="_blank">帐号管理</a>
<?php } else { ?>
<a href="http://www.tq.cn/" class="t" target="_blank">帐号申请</a>
<?php } ?><br/><br/>
提示：注册后获取的客服代码"...http://float2006.tq.cn/floatcard?adminid=<span class="f_red">1234567</span>&sort=0..."中<span class="f_red">1234567</span>即为客服帐号
</td>
</tr>