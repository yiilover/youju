<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">��������</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">��Ʒ����</td>
<td class="tr"><a href="<?php echo $item['linkurl'];?>" target="_blank" class="t f_b"><?php echo $item['title'];?></a></td>
</tr>
<tr>
<td class="tl">��������</td>
<td><?php echo $item['itemid'];?></td>
</tr>
<tr>
<td class="tl">��ƷͼƬ</td>
<td class="tr"><a href="<?php echo $item['linkurl'];?>" target="_blank"><img src="<?php if($item['thumb']) { ?><?php echo $item['thumb'];?><?php } else { ?><?php echo AJ_SKIN;?>image/nopic60.gif<?php } ?>" width="60" height="60"/></a></td>
</tr>
<tr>
<td class="tl">����</td>
<td><a href="javascript:_user('<?php echo $item['seller'];?>');" class="t"><?php echo $item['seller'];?></a></td>
</tr>
<tr>
<td class="tl">���</td>
<td><a href="javascript:_user('<?php echo $item['buyer'];?>');" class="t"><?php echo $item['buyer'];?></a></td>
</tr>
<tr>
<td class="tl">�ʱ�</td>
<td><?php echo $item['buyer_postcode'];?></td>
</tr>
<tr>
<td class="tl">��ַ</td>
<td><?php echo $item['buyer_address'];?></td>
</tr>
<tr>
<td class="tl">�ջ���</td>
<td><?php echo $item['buyer_name'];?></td>
</tr>
<tr>
<td class="tl">�绰</td>
<td><?php echo $item['buyer_phone'];?></td>
</tr>
<tr>
<td class="tl">�ֻ�</td>
<td><?php echo $item['buyer_mobile'];?></td>
</tr>
<tr>
<td class="tl">�µ�ʱ��</td>
<td><?php echo $item['addtime'];?></td>
</tr>
<tr>
<td class="tl">����ʱ��</td>
<td><?php echo $item['updatetime'];?></td>
</tr>
<tr>
<td class="tl">��ע˵��</td>
<td><?php echo $item['note'];?></td>
</tr>
<tr>
<td class="tl">��������</td>
<td><?php echo $item['password'];?></td>
</tr>
<tr>
<td class="tl">���</td>
<td class="f_red"><?php echo $item['amount'];?></td>
</tr>
<tr>
<td class="tl">����</td>
<td><?php echo $item['number'];?></td>
</tr>
<tr>
<td class="tl">�ܶ�</td>
<td class="f_red f_b"><?php echo $item['money'];?></td>
</tr>
<tr>
<td class="tl">��������</td>
<td><?php echo $item['send_type'];?></td>
</tr>
<tr>
<td class="tl">��������</td>
<td><?php echo $item['send_no'];?></td>
</tr>
<tr>
<td class="tl">����ʱ��</td>
<td><?php echo $item['send_time'];?></td>
</tr>
<tr>
<td class="tl">����״̬</td>
<td><?php echo $_status[$item['status']];?></td>
</tr>
</table>

<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>