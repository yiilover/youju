<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">�����굥</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">��Ա��</td>
<td><?php echo $item['username'];?> <a href="javascript:_user('<?php echo $item['username'];?>');" class="t">[��ҳ]</a></td>
</tr>
<tr>
<td class="tl">���ֽ��</td>
<td class="f_red"><strong><?php echo $item['amount'];?></strong></td>
</tr>
<tr>
<td class="tl">������</td>
<td class="f_blue"><strong><?php echo $item['fee'];?></strong></td>
</tr>
<tr class="on">
<td class="tl">�տʽ</td>
<td><?php echo $item['bank'];?></td>
</tr>
<tr>
<td class="tl">�տ��ʺ�</td>
<td><?php echo $item['account'];?></td>
</tr>
<tr>
<td class="tl">�տ���</td>
<td><?php echo $item['truename'];?></td>
</tr>
<tr>
<td class="tl">�ֻ�</td>
<td><?php echo $member['mobile'];?></td>
</tr>
<?php if($member['qq']) { ?>
<tr>
<td class="tl">QQ</td>
<td><a href="tencent://message/?uin=<?php echo $member['qq'];?>&Site=<?php echo $AJ['sitename'];?>&Menu=yes"><img src="http://wpa.qq.com/pa?p=1:<?php echo $member['qq'];?>:17" width="25" height="17" title="���QQ��̸/����" alt=""/></a> <?php echo $member['qq'];?></td>
</tr>
<?php } ?>
<?php if($member['msn']) { ?>
<tr>
<td class="tl">MSN</td>
<td><a href="msnim:chat?contact=<?php echo $member['msn'];?>"><img src="<?php echo AJ_SKIN;?>image/msnchat.gif" width="25" height="17" title="���MSN��̸/����" alt=""/></a> <?php echo $member['msn'];?></td>
</tr>
<?php } ?>
<tr>
<td class="tl">����ʱ��</td>
<td><?php echo $item['addtime'];?></td>
</tr>
<tr>
<td class="tl">����IP</td>
<td><?php echo $item['ip'];?> ���� <?php echo ip2area($item['ip']);?></td>
</tr>
<tr class="on">
<td class="tl">������</td>
<td><?php echo $_status[$item['status']];?></td>
</tr>
<tr>
<td class="tl">ԭ�򼰱�ע</td>
<td><?php echo $item['note'];?></td>
</tr>
<tr>
<td class="tl">������</td>
<td><?php echo $item['editor'];?></td>
</tr>
<tr>
<td class="tl">����ʱ��</td>
<td><?php echo $item['edittime'];?></td>
</tr>
</table>
<div class="sbt"><input type="button" value=" �� �� " class="btn" onclick="history.back(-1);"/></div>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>