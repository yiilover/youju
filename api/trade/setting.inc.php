<?php
defined('IN_AIJIACMS') or exit('Access Denied');
?>
<tr>
<td class="tl">֧������������</td>
<td>
<input type="radio" name="setting[trade]" value="alipay"  <?php if($trade){ ?>checked <?php } ?> onclick="Ds('dtrade');"/> ����&nbsp;&nbsp;
<input type="radio" name="setting[trade]" value=""  <?php if(!$trade){ ?>checked <?php } ?> onclick="Dh('dtrade');"/> �ر�&nbsp;&nbsp;&nbsp;&nbsp;
<img src="<?php echo AJ_PATH;?>api/trade/alipay/ico.gif" align="absmiddle"/> <a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?url=https://b.alipay.com/order/productDetail.htm?productId=2011042200323187" target="_blank" class="t">[�����ʺ�]</a>
</td>
</tr>
<tbody id="dtrade" style="display:<?php if(!$trade) echo 'none';?>">
<tr>
<td class="tl">��ʾ����</td>
<td><input name="setting[trade_nm]" type="text" value="<?php echo $trade_nm;?>" size="30"/></td> 
</tr>
<tr>
<td class="tl">�ٷ���վ</td>
<td><input name="setting[trade_hm]" type="text" value="<?php echo $trade_hm;?>" size="30"/></td> 
</tr>
<tr>
<td class="tl">�̻�ID</td>
<td><input name="setting[trade_id]" type="text" value="<?php echo $trade_id;?>" size="30"/></td> 
</tr>
<tr>
<td class="tl">��ȫ��Կ</td>
<td><input name="setting[trade_pw]" type="text" id="trade_pw" size="41" value="<?php echo $trade_pw;?>" onfocus="if(this.value.indexOf('**')!=-1)this.value='';"/></td>
</tr>
<tr>
<td class="tl">�̻��ʺ�</td>
<td><input name="setting[trade_ac]" type="text" value="<?php echo $trade_ac;?>" size="30"/></td> 
</tr>
<tr>
<td class="tl">�ӿ�����</td>
<td>
<select name="setting[trade_tp]">
<option value="0" <?php if($trade_tp == 0) echo 'selected';?>>ƽ̨�̵�������</option>
<option value="1" <?php if($trade_tp == 1) echo 'selected';?>>ƽ̨��˫����</option>
</select> <?php tips('�������� ƽ̨�̵�������');?>
</td>
</tr>
<tr>
<td class="tl">���շ�����֪ͨ�ļ���</td>
<td><input type="text" size="30" name="setting[trade_nu]" value="<?php echo $trade_nu;?>"/> <?php tips('Ĭ��Ϊnotify.php ������ api/trade/alipay/1/notify.php(ƽ̨�̵�������)��api/trade/alipay/2/notify.php(ƽ̨��˫����)<br/>�������޸Ĵ��ļ�����Ȼ���ڴ���д���ļ������Է��ܵ�ɧ��');?></td>
</tr>
</tbody>