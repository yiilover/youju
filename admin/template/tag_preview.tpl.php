<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include template('header');
?>
<div class="m">
<br/>
<table width="800" cellpadding="5" cellspacing="3" align="center">
<tr>
<td bgcolor="#E3EEF5" class="px13 f_b">��ǩԤ��</td>
</tr>
<tr>
<td><?php echo $code_eval;?></td>
</tr>
<tr>
<td bgcolor="#E3EEF5" class="px13 f_b">HTML���ô���</td>
</tr>
<tr>
<td><textarea  style="width:100%;height:40px;font-family:Fixedsys,verdana;overflow:visible;color:blue;" onmouseover="this.select();"><?php echo $code_call;?></textarea></td>
</tr>
<tr>
<td bgcolor="#E3EEF5" class="px13 f_b">JS���ô���</td>
</tr>
<tr>
<td><textarea  style="width:100%;height:40px;font-family:Fixedsys,verdana;overflow:visible;color:#800000;" onmouseover="this.select();"><?php echo $tag_js;?></textarea></td>
</tr>
<tr>
<td bgcolor="#E3EEF5" class="px13 f_b">������Ϣ</td>
</tr>
<tr>
<td><textarea  style="width:100%;height:40px;font-family:Fixedsys,verdana;overflow:visible;color:#800000;" onmouseover="this.select();"><?php echo $tag_debug;?></textarea></td>
</tr>
<tr>
<td bgcolor="#E3EEF5" class="px13"><span class="f_r"><a href="javascript:window.close();">[�رմ���]</a>&nbsp;</span><strong>Դ����</strong></td>
</tr>
<tr>
<td><textarea  style="width:100%;height:200px;font-family:Fixedsys,verdana;overflow:visible;"><?php echo $code_eval;?></textarea></td>
</tr>
</table>
<br/>
</div>
<?php
include template('footer');
?>