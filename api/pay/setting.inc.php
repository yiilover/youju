<?php
defined('IN_AIJIACMS') or exit('Access Denied');
?>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">��ʾ��Ϣ��</td>
<td>���½ӿ���Ҫ�������B2C<span class="f_red">��ʱ����</span>���ף��ӿڹ������ƣ�һ��ֻ��Ҫ��ͨ����һ������</td>
</tr>
<tr>
<td class="tl"><a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?url=www.tenpay.com" target="_blank" class="t"><strong>�Ƹ�ͨ TenPay</strong></a></td>
<td>
<input type="radio" name="pay[tenpay][enable]" value="1"  <?php if($tenpay['enable']) echo 'checked';?> onclick="Dd('tenpay').style.display='';"/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="pay[tenpay][enable]" value="0"  <?php if(!$tenpay['enable']) echo 'checked';?> onclick="Dd('tenpay').style.display='none';"/> ����&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?url=http://mch.tenpay.com/market/opentrans_immediately.shtml" target="_blank" class="t">[�ʺ�����]</a>
</td>
</tr>
<tbody style="display:<?php echo $tenpay['enable'] ? '' : 'none';?>" id="tenpay">
<tr>
<td class="tl">��ʾ����</td>
<td><input type="text" size="30" name="pay[tenpay][name]" value="<?php echo $tenpay['name'];?>"/></td>
</tr>
<tr>
<td class="tl">��ʾ˳��</td>
<td><input type="text" size="2" name="pay[tenpay][order]" value="<?php echo $tenpay['order'];?>"/></td>
</tr>
<tr>
<td class="tl">�̻����</td>
<td><input type="text" size="60" name="pay[tenpay][partnerid]" value="<?php echo $tenpay['partnerid'];?>"/></td>
</tr>
<tr>
<td class="tl">֧����Կ</td>
<td><input type="text" size="60" name="pay[tenpay][keycode]" value="<?php echo $tenpay['keycode'];?>" onfocus="if(this.value.indexOf('**')!=-1)this.value='';"/></td>
</tr>
<tr>
<td class="tl">���շ�����֪ͨ�ļ���</td>
<td><input type="text" size="30" name="pay[tenpay][notify]" value="<?php echo $tenpay['notify'];?>"/> <?php tips('Ĭ��Ϊnotify.php ������ api/pay/tenpay/notify.php<br/>�������޸Ĵ��ļ�����Ȼ���ڴ���д���ļ������Է��ܵ�ɧ��');?></td>
</tr>
<tr>
<td class="tl">�۳�������</td>
<td><input type="text" size="2" name="pay[tenpay][percent]" value="<?php echo $tenpay['percent'];?>"/> %</td>
</tr>
</tbody>

<tr>
<td class="tl"><a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?url=www.alipay.com" target="_blank" class="t"><strong>֧���� Alipay</strong></a></td>
<td>
<input type="radio" name="pay[alipay][enable]" value="1"  <?php if($alipay['enable']) echo 'checked';?> onclick="Dd('alipay').style.display='';"/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="pay[alipay][enable]" value="0"  <?php if(!$alipay['enable']) echo 'checked';?> onclick="Dd('alipay').style.display='none';"/> ����&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?url=https://b.alipay.com/order/productDetail.htm?productId=2012111200373124" target="_blank" class="t">[�ʺ�����]</a>
</td>
</tr>
<tbody style="display:<?php echo $alipay['enable'] ? '' : 'none';?>" id="alipay">
<tr>
<td class="tl">��ʾ����</td>
<td><input type="text" size="30" name="pay[alipay][name]" value="<?php echo $alipay['name'];?>"/></td>
</tr>
<tr>
<td class="tl">��ʾ˳��</td>
<td><input type="text" size="2" name="pay[alipay][order]" value="<?php echo $alipay['order'];?>"/></td>
</tr>
<tr>
<td class="tl">֧�����ʺ�</td>
<td><input type="text" size="30" name="pay[alipay][email]" value="<?php echo $alipay['email'];?>"/><?php tips('��֧�ּ�ʱ���˽ӿ�');?></td>
</tr>
<tr>
<td class="tl">��������ݣ�partnerID��</td>
<td><input type="text" size="60" name="pay[alipay][partnerid]" value="<?php echo $alipay['partnerid'];?>"/></td>
</tr>
<tr>
<td class="tl">���װ�ȫУ���루key��</td>
<td><input type="text" size="60" name="pay[alipay][keycode]" value="<?php echo $alipay['keycode'];?>" onfocus="if(this.value.indexOf('**')!=-1)this.value='';"/></td>
</tr>
<tr>
<td class="tl">���շ�����֪ͨ�ļ���</td>
<td><input type="text" size="30" name="pay[alipay][notify]" value="<?php echo $alipay['notify'];?>"/> <?php tips('Ĭ��Ϊnotify.php ������ api/pay/alipay/notify.php<br/>�������޸Ĵ��ļ�����Ȼ���ڴ���д���ļ������Է��ܵ�ɧ��');?></td>
</tr>
<tr>
<td class="tl">�۳�������</td>
<td><input type="text" size="2" name="pay[alipay][percent]" value="<?php echo $alipay['percent'];?>"/> %</td>
</tr>
</tbody>



<tr>
<td class="tl"><a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?url=www.chinabank.com.cn" target="_blank" class="t"><strong>�������� ChinaBank</strong></a></td>
<td>
<input type="radio" name="pay[chinabank][enable]" value="1"  <?php if($chinabank['enable']) echo 'checked';?> onclick="Dd('chinabank').style.display='';"/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="pay[chinabank][enable]" value="0"  <?php if(!$chinabank['enable']) echo 'checked';?> onclick="Dd('chinabank').style.display='none';"/> ����&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?url=www.chinabank.com.cn" target="_blank" class="t">[�ʺ�����]</a>
</td>
</tr>
<tbody style="display:<?php echo $chinabank['enable'] ? '' : 'none';?>" id="chinabank">
<tr>
<td class="tl">��ʾ����</td>
<td><input type="text" size="30" name="pay[chinabank][name]" value="<?php echo $chinabank['name'];?>"/></td>
</tr>
<tr>
<td class="tl">��ʾ˳��</td>
<td><input type="text" size="2" name="pay[chinabank][order]" value="<?php echo $chinabank['order'];?>"/></td>
</tr>
<tr>
<td class="tl">�̻����</td>
<td><input type="text" size="60" name="pay[chinabank][partnerid]" value="<?php echo $chinabank['partnerid'];?>"/></td>
</tr>
<tr>
<td class="tl">֧����Կ</td>
<td><input type="text" size="60" name="pay[chinabank][keycode]" value="<?php echo $chinabank['keycode'];?>" onfocus="if(this.value.indexOf('**')!=-1)this.value='';"/></td>
</tr>
<tr>
<td class="tl">�۳�������</td>
<td><input type="text" size="2" name="pay[chinabank][percent]" value="<?php echo $chinabank['percent'];?>"/> %</td>
</tr>
</tbody>

<tr>
<td class="tl"><a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?url=www.yeepay.com" target="_blank" class="t"><strong>�ױ�֧�� YeePay</strong></a></td>
<td>
<input type="radio" name="pay[yeepay][enable]" value="1"  <?php if($yeepay['enable']) echo 'checked';?> onclick="Dd('yeepay').style.display='';"/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="pay[yeepay][enable]" value="0"  <?php if(!$yeepay['enable']) echo 'checked';?> onclick="Dd('yeepay').style.display='none';"/> ����&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?url=www.yeepay.com" target="_blank" class="t">[�ʺ�����]</a>
</td>
</tr>
<tbody style="display:<?php echo $yeepay['enable'] ? '' : 'none';?>" id="yeepay">
<tr>
<td class="tl">��ʾ����</td>
<td><input type="text" size="30" name="pay[yeepay][name]" value="<?php echo $yeepay['name'];?>"/></td>
</tr>
<tr>
<td class="tl">��ʾ˳��</td>
<td><input type="text" size="2" name="pay[yeepay][order]" value="<?php echo $yeepay['order'];?>"/></td>
</tr>
<tr>
<td class="tl">�̻����</td>
<td><input type="text" size="60" name="pay[yeepay][partnerid]" value="<?php echo $yeepay['partnerid'];?>"/></td>
</tr>
<tr>
<td class="tl">�̻���Կ</td>
<td><input type="text" size="60" name="pay[yeepay][keycode]" value="<?php echo $yeepay['keycode'];?>" onfocus="if(this.value.indexOf('**')!=-1)this.value='';"/></td>
</tr>
<tr>
<td class="tl">�۳�������</td>
<td><input type="text" size="2" name="pay[yeepay][percent]" value="<?php echo $yeepay['percent'];?>"/> %</td>
</tr>
</tbody>

<tr>
<td class="tl"><a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?url=www.99bill.com" target="_blank" class="t"><strong>��Ǯ֧�� 99bill</strong></a></td>
<td>
<input type="radio" name="pay[kq99bill][enable]" value="1"  <?php if($kq99bill['enable']) echo 'checked';?> onclick="Dd('kq99bill').style.display='';"/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="pay[kq99bill][enable]" value="0"  <?php if(!$kq99bill['enable']) echo 'checked';?> onclick="Dd('kq99bill').style.display='none';"/> ����&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?url=www.99bill.com" target="_blank" class="t">[�ʺ�����]</a>
</td>
</tr>
<tbody style="display:<?php echo $kq99bill['enable'] ? '' : 'none';?>" id="kq99bill">
<tr>
<td class="tl">��ʾ����</td>
<td><input type="text" size="30" name="pay[kq99bill][name]" value="<?php echo $kq99bill['name'];?>"/></td>
</tr>
<tr>
<td class="tl">��ʾ˳��</td>
<td><input type="text" size="2" name="pay[kq99bill][order]" value="<?php echo $kq99bill['order'];?>"/></td>
</tr>
<tr>
<td class="tl">�̻����</td>
<td><input type="text" size="60" name="pay[kq99bill][partnerid]" value="<?php echo $kq99bill['partnerid'];?>"/></td>
</tr>
<tr>
<td class="tl">֤���ļ�</td>
<td><input type="text" size="60" name="pay[kq99bill][cert]" value="<?php echo $kq99bill['cert'];?>"/> <?php tips('�뽫֤���ļ����ϴ��� api/pay/kq99bill/��֤���ļ�������99bill[1].cert.rsa.20140803.cer��pcarduser.pem�ļ�Ҳ�ϴ�����Ŀ¼');?></td>
</tr>
<tr>
<td class="tl">���շ�����֪ͨ�ļ���</td>
<td><input type="text" size="30" name="pay[kq99bill][notify]" value="<?php echo $kq99bill['notify'];?>"/> <?php tips('Ĭ��Ϊnotify.php ������ api/pay/kq99bill/notify.php<br/>�������޸Ĵ��ļ�����Ȼ���ڴ���д���ļ������Է��ܵ�ɧ��');?></td>
</tr>
<tr>
<td class="tl">�۳�������</td>
<td><input type="text" size="2" name="pay[kq99bill][percent]" value="<?php echo $kq99bill['percent'];?>"/> %</td>
</tr>
</tbody>

<tr>
<td class="tl"><a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?url=www.chinapay.com" target="_blank" class="t"><strong>�й����� ChinaPay</strong></a></td>
<td>
<input type="radio" name="pay[chinapay][enable]" value="1"  <?php if($chinapay['enable']) echo 'checked';?> onclick="Dd('chinapay').style.display='';"/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="pay[chinapay][enable]" value="0"  <?php if(!$chinapay['enable']) echo 'checked';?> onclick="Dd('chinapay').style.display='none';"/> ����&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?url=www.chinapay.com" target="_blank" class="t">[�ʺ�����]</a> <?php tips('���ӿ���Ҫ mcrypt �� bcmath ����PHP��չ���֧�֣�����ȷ������װ����������������');?>
</td>
</tr>
<tbody style="display:<?php echo $chinapay['enable'] ? '' : 'none';?>" id="chinapay">
<tr>
<td class="tl">��ʾ����</td>
<td><input type="text" size="30" name="pay[chinapay][name]" value="<?php echo $chinapay['name'];?>"/></td>
</tr>
<tr>
<td class="tl">��ʾ˳��</td>
<td><input type="text" size="2" name="pay[chinapay][order]" value="<?php echo $chinapay['order'];?>"/></td>
</tr>
<tr>
<td class="tl">˽Կ�ļ�</td>
<td><input type="text" size="60" name="pay[chinapay][partnerid]" value="<?php echo $chinapay['partnerid'];?>"/> <?php tips('�����ṩ��Mer��ͷ��.key�ļ���������MerPrK_808080808080808_20101111222333.key���뽫�����ṩ������key�ļ��ϴ���api/pay/chinapay/Ŀ¼����һ��key�ļ���ΪPgPubk.key');?></td>
</tr>
<tr>
<td class="tl">�۳�������</td>
<td><input type="text" size="2" name="pay[chinapay][percent]" value="<?php echo $chinapay['percent'];?>"/> %</td>
</tr>
</tbody>

<tr>
<td class="tl"><a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?url=www.paypal.com" target="_blank" class="t"><strong>��&nbsp;&nbsp;&nbsp;�� PayPal</strong></a></td>
<td>
<input type="radio" name="pay[paypal][enable]" value="1"  <?php if($paypal['enable']) echo 'checked';?> onclick="Dd('paypal').style.display='';"/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="pay[paypal][enable]" value="0"  <?php if(!$paypal['enable']) echo 'checked';?> onclick="Dd('paypal').style.display='none';"/> ����&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo $MODULE[3]['linkurl'];?>redirect.php?url=www.paypal.com" target="_blank" class="t">[�ʺ�����]</a>
</td>
</tr>
<tbody style="display:<?php echo $paypal['enable'] ? '' : 'none';?>" id="paypal">
<tr>
<td class="tl">��ʾ����</td>
<td><input type="text" size="30" name="pay[paypal][name]" value="<?php echo $paypal['name'];?>"/></td>
</tr>
<tr>
<td class="tl">��ʾ˳��</td>
<td><input type="text" size="2" name="pay[paypal][order]" value="<?php echo $paypal['order'];?>"/></td>
</tr>
<tr>
<td class="tl">�̻��ʺ�</td>
<td><input type="text" size="30" name="pay[paypal][partnerid]" value="<?php echo $paypal['partnerid'];?>"/></td>
</tr>
<tr>
<td class="tl">֧������</td>
<td><input type="text" size="3" name="pay[paypal][currency]" value="<?php echo $paypal['currency'];?>"/> ֵ����Ϊ "CNY"��"USD"��"EUR"��"GBP"��"CAD"��"JPY"��</td>
</tr>
<tr>
<td class="tl">�۳�������</td>
<td><input type="text" size="2" name="pay[paypal][percent]" value="<?php echo $paypal['percent'];?>"/> %</td>
</tr>
</tbody>
</table>