<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">��Ա���޸�</div>
<form method="post" action="?" onsubmit="return check();">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="groupid" value="<?php echo $groupid;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> ��Ա������</td>
<td><input type="text" size="20" name="groupname" id="groupname" value="<?php echo $groupname;?>"/> <span id="dgroupname" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ��Աģʽ</td>
<td>
<input type="radio" name="setting[fee_mode]" value="1" <?php if($fee_mode) echo 'checked';?> onclick="Ds('mode_1');Dh('mode_0');"/> �շѻ�Ա&nbsp;&nbsp;
<input type="radio" name="setting[fee_mode]" value="0" <?php if(!$fee_mode) echo 'checked';?> onclick="Ds('mode_0');Dh('mode_1');"/> ��ѻ�Ա
</td>
</tr>
<tbody id="mode_1" style="display:<?php echo $fee_mode ? '' : 'none';?>">
<tr>
<td class="tl"><span class="f_red">*</span> �շ�����</td>
<td><input type="text" size="20" name="setting[fee]" id="fee" value="<?php echo $fee;?>"/> <?php echo $AJ['money_unit'];?>/�� <span class="f_gray">��ѻ�Ա����0</span> <span id="dfee" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> <?php echo VIP;?>ָ��</td>
<td><input type="text" size="20" name="vip" id="vip" value="<?php echo $vip;?>"/> <span class="f_gray">��ѻ�Ա����0���շѻ�Ա����1-9����</span> <span id="dvip" class="f_red"></span></td>
</tr>
</tbody>
<tr id="mode_0" style="display:<?php echo $fee_mode ? 'none' : '';?>">
<td class="tl"><span class="f_red">*</span> �����ۿ�</td>
<td><input type="text" size="20" name="setting[discount]" id="discount" value="<?php echo $discount;?>"/> % �ۿ۽���ϵͳ�շѣ�����Ի�Ա��Դ</td>
</tr>

<tr>
<td class="tl"><span class="f_red">*</span> ��ʾ˳��</td>
<td><input type="text" size="5" name="listorder" id="listorder" value="<?php echo $listorder;?>"/>  <span class="f_gray">����ԽСԽ��ǰ</span></td>
</tr>
</table>
<div class="tt">��ԱȨ��</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">����˵��</td>
<td>���������� <strong>0</strong> ���ʾ����&nbsp;&nbsp;&nbsp;�� <strong>-1</strong> ��ʾ��ֹʹ��</td>
</tr>
<tr>
<td class="tl">�����ڻ�Ա����ҳ����ʾ</td>
<td>
<input type="radio" name="setting[grade]" value="1" <?php if($grade) echo 'checked';?>> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[grade]" value="0" <?php if(!$grade) echo 'checked';?>> ��
</td>
</tr>
<tr>
<td class="tl">�����ڻ�Աע��ҳ����ʾ</td>
<td>
<input type="radio" name="setting[reg]" value="1" <?php if($reg) echo 'checked';?>> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[reg]" value="0" <?php if(!$reg) echo 'checked';?>> �� �����ö�<?php echo VIP;?>��Ա��Ч
</td>
</tr>
<tr>
<td class="tl">�༭�����߰�ť</td>
<td>
<select name="setting[editor]">
<option value="Default"<?php if($editor == 'Default') echo ' selected';?>>ȫ��</option>
<option value="aijiacms"<?php if($editor == 'aijiacms') echo ' selected';?>>����</option>
<option value="Simple"<?php if($editor == 'Simple') echo ' selected';?>>���</option>
<option value="Basic"<?php if($editor == 'Basic') echo ' selected';?>>����</option>
</select>&nbsp;
<?php tips('ȫ����ť�����Ա�༭Դ����Ͳ���FLASH����Ƶ�ļ�<br/>Ϊ�˷�ֹ���������ã�������������εĻ�Ա�鿪��');?>
</td>
</tr>
<tr>
<td class="tl">�����ϴ��ļ�</td>
<td>
<input type="radio" name="setting[upload]" value="1" <?php if($upload) echo 'checked';?>> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[upload]" value="0" <?php if(!$upload) echo 'checked';?>> ��
</td>
</tr>
<tr>
<td class="tl">�����ϴ����ļ�����</td>
<td><input name="setting[uploadtype]" type="text" value="<?php echo $uploadtype;?>" size="60"/> <?php tips('��|�Ÿ����ļ���׺�����ձ�ʾ�̳���վ����');?></td>
</tr>
<tr>
<td class="tl">�����ϴ���С����</td>
<td><input name="setting[uploadsize]" type="text" value="<?php echo $uploadsize;?>" size="10"/> Kb (1024Kb=1M) �������0��ʾ�̳���վ����</td>
</tr>
<tr>
<td class="tl">������Ϣ�ϴ���������</td>
<td><input name="setting[uploadlimit]" type="text" value="<?php echo $uploadlimit;?>" size="5"/> <?php tips('һ����Ϣ������ϴ��ļ��������ƣ�0Ϊ������');?></td>
</tr>
<tr>
<td class="tl">24Сʱ�ϴ���������</td>
<td><input name="setting[uploadday]" type="text" value="<?php echo $uploadday;?>" size="5"/> <?php tips('24Сʱ������ļ��ϴ��������ƣ�0Ϊ������<br/>��������ӷ�����ѹ�������ڿ����ϴ���¼���������Ч');?></td>
</tr>
<tr>
<td class="tl">��ԴͼƬ��������</td>
<td>
<input type="radio" name="setting[uploadpt]" value="1" <?php if($uploadpt) echo 'checked';?>> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[uploadpt]" value="0" <?php if(!$uploadpt) echo 'checked';?>> �� <?php tips('���ѡ���ǣ���ԴͼƬֻ����1�ţ�������޿��Դ�3�ţ�������'.VIP.'��Ա');?>
</td>
</tr>
<tr>
<td class="tl">������Ϣ��Ҫ���</td>
<td>
<input type="radio" name="setting[check]" value="1" <?php if($check) echo 'checked';?>> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[check]" value="0" <?php if(!$check) echo 'checked';?>> ��
</td>
</tr>
<tr>
<td class="tl">������Ϣ������֤��</td>
<td>
<input type="radio" name="setting[captcha]" value="1" <?php if($captcha) echo 'checked';?>> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[captcha]" value="0" <?php if(!$captcha) echo 'checked';?>> ��
</td>
</tr>
<tr>
<td class="tl">������Ϣ������֤����</td>
<td>
<input type="radio" name="setting[question]" value="1" <?php if($question) echo 'checked';?>> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[question]" value="0" <?php if(!$question) echo 'checked';?>> ��
</td>
</tr>



<tr>
<td class="tl">����ʹ�ÿͷ�����</td>
<td>
<input type="radio" name="setting[ask]" value="1" <?php if($ask) echo 'checked';?>> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[ask]" value="0" <?php if(!$ask) echo 'checked';?>> ��
</td>
</tr>

<tr>
<td class="tl">����ʹ�÷�Դ����</td>
<td>
<input type="radio" name="setting[mail]" value="1" <?php if($mail) echo 'checked';?>> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[mail]" value="0" <?php if(!$mail) echo 'checked';?>> ��
</td>
</tr>
<!--
<tr>
<td class="tl">����ʹ���ֻ�����</td>
<td>
<input type="radio" name="setting[sms]" value="1" <?php if($sms) echo 'checked';?>> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[sms]" value="0" <?php if(!$sms) echo 'checked';?>> ��
</td>
</tr>
-->
<tr>
<td class="tl">�����͵����ʼ�</td>
<td>
<input type="radio" name="setting[sendmail]" value="1" <?php if($sendmail) echo 'checked';?>> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[sendmail]" value="0" <?php if(!$sendmail) echo 'checked';?>> ��
</td>
</tr>

<tr>
<td class="tl">����վ�ڸ���</td>
<td>
<input type="radio" name="setting[trade_pay]" value="1" <?php if($trade_pay) echo 'checked';?>> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[trade_pay]" value="0" <?php if(!$trade_pay) echo 'checked';?>> ��
</td>
</tr>

<tr>
<td class="tl">����鿴����</td>
<td>
<input type="radio" name="setting[trade_sell]" value="1" <?php if($trade_sell) echo 'checked';?>> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[trade_sell]" value="0" <?php if(!$trade_sell) echo 'checked';?>> ��
</td>
</tr>

<tr>
<td class="tl">����������</td>
<td>
<input type="radio" name="setting[spread]" value="1" <?php if($spread) echo 'checked';?>> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[spread]" value="0" <?php if(!$spread) echo 'checked';?>> ��
</td>
</tr>

<tr>
<td class="tl">������Ԥ��</td>
<td>
<input type="radio" name="setting[ad]" value="1" <?php if($ad) echo 'checked';?>> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[ad]" value="0" <?php if(!$ad) echo 'checked';?>> ��
</td>
</tr>
<tr>
<td class="tl">��������������</td>
<td>
<input type="radio" name="setting[chat]" value="1" <?php if($chat) echo 'checked';?>> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[chat]" value="0" <?php if(!$chat) echo 'checked';?>> ��
</td>
</tr>
<tr>
<td class="tl">�ռ�����������</td>
<td>
<input type="text" name="setting[inbox_limit]" size="5" value="<?php echo $inbox_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">������������</td>
<td>
<input type="text" name="setting[friend_limit]" size="5" value="<?php echo $friend_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">��Դ�ղ���������</td>
<td>
<input type="text" name="setting[favorite_limit]" size="5" value="<?php echo $favorite_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">��Դ������������</td>
<td>
<input type="text" name="setting[alert_limit]" size="5" value="<?php echo $alert_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">��������������</td>
<td>
<input type="text" name="setting[addmember_limit]" size="5" value="<?php echo $addmember_limit;?>"/>
</td>
</tr>

<!--������-->


<tr>
<td class="tl">ÿ�տɷ�վ��������</td>
<td>
<input type="text" name="setting[message_limit]" size="5" value="<?php echo $message_limit;?>"/> <?php echo tips('ѯ�̺ͱ���Ϊ�����վ���ţ�����һ��ѯ�̻��߱��ۻ�����һ��վ���ŷ��ͻ���');?>
</td>
</tr>

<tr>
<td class="tl">ÿ��ѯ�̴�������</td>
<td>
<input type="text" name="setting[inquiry_limit]" size="5" value="<?php echo $inquiry_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">ÿ�ձ��۴�������</td>
<td>
<input type="text" name="setting[price_limit]" size="5" value="<?php echo $price_limit;?>"/>
</td>
</tr>


<tr>
<td class="tl">�Զ����������</td>
<td>
<input type="text" name="setting[type_limit]" size="5" value="<?php echo $type_limit;?>"/>
</td>
</tr>

</table>

<div class="tt">��˾��ҳ</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">ӵ�й�˾��ҳ</td>
<td>
<input type="radio" name="setting[homepage]" value="1" <?php if($homepage) echo 'checked';?>> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[homepage]" value="0" <?php if(!$homepage) echo 'checked';?>> ��
</td>
</tr>
<tr>
<td class="tl">Ĭ�Ϲ�˾ģ��</td>
<td>
<?php echo homepage_select('setting[styleid]', '��ѡ��', $groupid, $styleid, 'id="styleid"');?>&nbsp;&nbsp;
<a href="javascript:" onclick="if(Dd('styleid').value>0)window.open('?moduleid=2&file=style&action=show&itemid='+Dd('styleid').value);" class="t">[Ԥ��]</a>
</td>
</tr>
<tr>
<td class="tl">�����Զ�����ҳ����</td>
<td>
<input type="radio" name="setting[home]" value="1" <?php if($home) echo 'checked';?>> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[home]" value="0" <?php if(!$home) echo 'checked';?>> ��
</td>
</tr>
<tr>
<td class="tl">�����Զ���˵�</td>
<td>
<input type="radio" name="setting[home_menu]" value="1" <?php if($home_menu) echo 'checked';?>> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[home_menu]" value="0" <?php if(!$home_menu) echo 'checked';?>> ��
</td>
</tr>
<tr>
<td class="tl">���ò˵�</td>
<td>
<ul class="mods">
<?php
	$_menu_c = ','.$menu_c.',';
	foreach($HMENU as $k=>$m) {
		echo '<li><input type="checkbox" name="setting[menu_c][]" value="'.$k.'" '.(strpos($_menu_c, ','.$k.',') !== false ? 'checked' : '').' id="menu_c_'.$k.'"/><label for="menu_c_'.$k.'"> '.$m.'</label></li>';
	}
?>
</ul>
</td>
</tr>
<tr>
<td class="tl">Ĭ�ϲ˵�</td>
<td>
<ul class="mods">
<?php
	$_menu_d = ','.$menu_d.',';
	foreach($HMENU as $k=>$m) {
		echo '<li><input type="checkbox" name="setting[menu_d][]" value="'.$k.'" '.(strpos($_menu_d, ','.$k.',') !== false ? 'checked' : '').' id="menu_d_'.$k.'"/><label for="menu_d_'.$k.'"> '.$m.'</label></li>';
	}
?>
</ul>
</td>
</tr>
<tr>
<td class="tl">�����Զ������</td>
<td>
<input type="radio" name="setting[home_side]" value="1" <?php if($home_side) echo 'checked';?>> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[home_side]" value="0" <?php if(!$home_side) echo 'checked';?>> ��
</td>
</tr>
<tr>
<td class="tl">���ò���</td>
<td>
<ul class="mods">
<?php
	$_side_c = ','.$side_c.',';
	foreach($HSIDE as $k=>$m) {
		echo '<li><input type="checkbox" name="setting[side_c][]" value="'.$k.'" '.(strpos($_side_c, ','.$k.',') !== false ? 'checked' : '').' id="side_c_'.$k.'"/><label for="side_c_'.$k.'"> '.$m.'</label></li>';
	}
?>
</ul>
</td>
</tr>
<tr>
<td class="tl">Ĭ�ϲ���</td>
<td>
<ul class="mods">
<?php
	$_side_d = ','.$side_d.',';
	foreach($HSIDE as $k=>$m) {
		echo '<li><input type="checkbox" name="setting[side_d][]" value="'.$k.'" '.(strpos($_side_d, ','.$k.',') !== false ? 'checked' : '').' id="side_d_'.$k.'"/><label for="side_d_'.$k.'"> '.$m.'</label></li>';
	}
?>
</ul>
</td>
</tr>
<tr>
<td class="tl">�����Զ�����ҳ</td>
<td>
<input type="radio" name="setting[home_main]" value="1" <?php if($home_main) echo 'checked';?>> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[home_main]" value="0" <?php if(!$home_main) echo 'checked';?>> ��
</td>
</tr>
<tr>
<td class="tl">������ҳ</td>
<td>
<ul class="mods">
<?php
	$_main_c = ','.$main_c.',';
	foreach($HMAIN as $k=>$m) {
		echo '<li><input type="checkbox" name="setting[main_c][]" value="'.$k.'" '.(strpos($_main_c, ','.$k.',') !== false ? 'checked' : '').' id="main_c_'.$k.'"/><label for="main_c_'.$k.'"> '.$m.'</label></li>';
	}
?>
</ul>
</td>
</tr>
<tr>
<td class="tl">Ĭ����ҳ</td>
<td>
<ul class="mods">
<?php
	$_main_d = ','.$main_d.',';
	foreach($HMAIN as $k=>$m) {
		echo '<li><input type="checkbox" name="setting[main_d][]" value="'.$k.'" '.(strpos($_main_d, ','.$k.',') !== false ? 'checked' : '').' id="main_d_'.$k.'"/><label for="main_d_'.$k.'"> '.$m.'</label></li>';
	}
?>
</ul>
</td>
</tr>
<tr>
<td class="tl">����ѡ��ģ��</td>
<td>
<input type="radio" name="setting[style]" value="1" <?php if($style) echo 'checked';?>> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[style]" value="0" <?php if(!$style) echo 'checked';?>> ��
</td>
</tr>

<tr>
<td class="tl">����ʹ�õ�������ͼ</td>
<td>
<input type="radio" name="setting[map]" value="1" <?php if($map) echo 'checked';?>> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[map]" value="0" <?php if(!$map) echo 'checked';?>> ��
</td>
</tr>

<tr>
<td class="tl">����ʹ�õ�����ͳ��</td>
<td>
<input type="radio" name="setting[stats]" value="1" <?php if($stats) echo 'checked';?>> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[stats]" value="0" <?php if(!$stats) echo 'checked';?>> ��
</td>
</tr>

<tr>
<td class="tl">����ʹ�õ������ͷ�</td>
<td>
<input type="radio" name="setting[kf]" value="1" <?php if($kf) echo 'checked';?>> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[kf]" value="0" <?php if(!$kf) echo 'checked';?>> ��
</td>
</tr>

<tr>
<td class="tl">��˾������������</td>
<td>
<input type="text" name="setting[news_limit]" size="5" value="<?php echo $news_limit;?>"/>
</td>
</tr>


<tr>
<td class="tl">��˾��ҳ��������</td>
<td>
<input type="text" name="setting[page_limit]" size="5" value="<?php echo $page_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">����������������</td>
<td>
<input type="text" name="setting[honor_limit]" size="5" value="<?php echo $honor_limit;?>"/>
</td>
</tr>
<tr>
<td class="tl">����������������</td>
<td>
<input type="text" name="setting[link_limit]" size="5" value="<?php echo $link_limit;?>"/>
</td>
</tr>
</table>
<div class="tt">��Ϣ����</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">��������Ϣ��ģ��</td>
<td>
<ul class="mods">
<?php
	$moduleids = explode(',', $moduleids);
	foreach($MODULE as $m) {
		if($m['moduleid'] > 4 && is_file(AJ_ROOT.'/module/'.$m['module'].'/my.inc.php')) {
			if($m['moduleid'] == 9) {
				echo '<li><input type="checkbox" name="setting[moduleids][]" value="9" '.(in_array(9, $moduleids) ? 'checked' : '').' id="mod_9"/><label for="mod_9"> ��Ƹ</label></li>';
				echo '<li><input type="checkbox" name="setting[moduleids][]" value="-9" '.(in_array(-9, $moduleids) ? 'checked' : '').' id="mod__9"/><label for="mod__9"> ����</label></li>';
			} else {
				echo '<li><input type="checkbox" name="setting[moduleids][]" value="'.$m['moduleid'].'" '.(in_array($m['moduleid'], $moduleids) ? 'checked' : '').' id="mod_'.$m['moduleid'].'"/><label for="mod_'.$m['moduleid'].'"> '.$m['name'].'</label></li>';
			}
		}
	}
?>
</ul>
</td>
</tr>


<tr>
<td class="tl">����ǿ���ʼ���֤</td>
<td>
<input type="radio" name="setting[vemail]" value="1" <?php if($vemail){ ?>checked <?php } ?>/> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[vemail]" value="0" <?php if(!$vemail){ ?>checked <?php } ?>/> ��&nbsp;&nbsp;
����֮���ʼ���֤�ɹ��ſ��Է�����Ϣ
</td>
</tr>
<tr>
<td class="tl">����ǿ���ֻ���֤</td>
<td>
<input type="radio" name="setting[vmobile]" value="1" <?php if($vmobile){ ?>checked <?php } ?>/> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[vmobile]" value="0" <?php if(!$vmobile){ ?>checked <?php } ?>/> ��&nbsp;&nbsp;
����֮���ֻ���֤�ɹ��ſ��Է�����Ϣ
</td>
</tr>
<tr>
<td class="tl">����ǿ��������֤</td>
<td>
<input type="radio" name="setting[vtruename]" value="1" <?php if($vtruename){ ?>checked <?php } ?>/> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[vtruename]" value="0" <?php if(!$vtruename){ ?>checked <?php } ?>/> ��&nbsp;&nbsp;
����֮��������֤�ɹ��ſ��Է�����Ϣ
</td>
</tr>
<tr>
<td class="tl">����ǿ�ƹ�˾��֤</td>
<td>
<input type="radio" name="setting[vcompany]" value="1" <?php if($vcompany){ ?>checked <?php } ?>/> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[vcompany]" value="0" <?php if(!$vcompany){ ?>checked <?php } ?>/> ��&nbsp;&nbsp;
����֮�󣬹�˾��֤�ɹ��ſ��Է�����Ϣ
</td>
</tr>


<tr>
<td class="tl">����ɾ����Ϣ</td>
<td>
<input type="radio" name="setting[delete]" value="1" <?php if($delete) echo 'checked';?>> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[delete]" value="0" <?php if(!$delete) echo 'checked';?>> ��
</td>
</tr>

<tr>
<td class="tl">��������Ϣ</td>
<td>
<input type="radio" name="setting[copy]" value="1" <?php if($copy) echo 'checked';?>> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[copy]" value="0" <?php if(!$copy) echo 'checked';?>> �� 

������Ϣ��������߷�����ϢЧ��
</td>
</tr>

<tr>
<td class="tl">������Ϣʱ����</td>
<td>
<input type="text" name="setting[add_limit]" size="5" value="<?php echo $add_limit;?>"/>
&nbsp;&nbsp;��λ�� ��&nbsp;&nbsp;�� 0 ��ʾ������&nbsp;&nbsp;��������ʾ�������η���ʱ����
</td>
</tr>

<tr>
<td class="tl">24Сʱ������Ϣ����</td>
<td>
<input type="text" name="setting[day_limit]" size="5" value="<?php echo $day_limit;?>"/>
&nbsp;&nbsp;�� 0 ��ʾ������&nbsp;&nbsp;��������ʾ24Сʱ���ڵ�ģ�鷢����Ϣ��������
</td>
</tr>

<tr>
<td class="tl">ˢ����Ϣʱ����</td>
<td>
<input type="text" name="setting[refresh_limit]" size="5" value="<?php echo $refresh_limit;?>"/>
&nbsp;&nbsp;��λ�� ��&nbsp;&nbsp;�� -1 ��ʾ������ˢ��&nbsp;&nbsp;�� 0 ��ʾ������ʱ����&nbsp;&nbsp;��������ʾ��������ˢ��ʱ��
</td>
</tr>

<tr>
<td class="tl">�����޸���Ϣʱ��</td>
<td>
<input type="text" name="setting[edit_limit]" size="5" value="<?php echo $edit_limit;?>"/>
&nbsp;&nbsp;��λ�� ��&nbsp;&nbsp;�� -1 ��ʾ�������޸�&nbsp;&nbsp;�� 0 ��ʾ������ʱ���޸�&nbsp;&nbsp;��������ʾ����ʱ�䳬���󲻿��޸�
</td>
</tr>

<tr>
<td class="tl">����¥����������</td>
<td>
<input type="text" name="setting[newhouse_limit]" size="5" value="<?php echo $newhouse_limit;?>"/>
&nbsp;&nbsp;�� -1 ��ʾ��ֹ���� �� 0 ��ʾ���������� ��������ʾ������������ͬ
</td>
</tr>

<tr>
<td class="tl">��ѷ���¥������</td>
<td>
<input type="text" name="setting[newhouse_free_limit]" size="5" value="<?php echo $newhouse_free_limit;?>"/>
&nbsp;&nbsp;�� -1 ��ʾ���շ� ���� 0 ��ʾ����� ��������ʾ����ѷ�����������ͬ
</td>
</tr>
<tr>
<td class="tl">�������ַ���������</td>
<td>
<input type="text" name="setting[sell_limit]" size="5" value="<?php echo $sell_limit;?>"/>
&nbsp;&nbsp;�� -1 ��ʾ��ֹ���� �� 0 ��ʾ���������� ��������ʾ������������ͬ
</td>
</tr>

<tr>
<td class="tl">��ѷ������ַ�����</td>
<td>
<input type="text" name="setting[sell_free_limit]" size="5" value="<?php echo $sell_free_limit;?>"/>
&nbsp;&nbsp;�� -1 ��ʾ���շ� ���� 0 ��ʾ����� ��������ʾ����ѷ�����������ͬ
</td>
</tr>

<tr>
<td class="tl">�����ⷿ��������</td>
<td>
<input type="text" name="setting[rent_limit]" size="5" value="<?php echo $rent_limit;?>"/>
&nbsp;&nbsp;�� -1 ��ʾ��ֹ���� �� 0 ��ʾ���������� ��������ʾ������������ͬ
</td>
</tr>

<tr>
<td class="tl">����ⷿ¥������</td>
<td>
<input type="text" name="setting[rent_free_limit]" size="5" value="<?php echo $rent_free_limit;?>"/>
&nbsp;&nbsp;�� -1 ��ʾ���շ� ���� 0 ��ʾ����� ��������ʾ����ѷ�����������ͬ
</td>
</tr>

<tr>
<td class="tl">��������������</td>
<td>
<input type="text" name="setting[buy_limit]" size="5" value="<?php echo $buy_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">��ѷ���������</td>
<td>
<input type="text" name="setting[buy_free_limit]" size="5" value="<?php echo $buy_free_limit;?>"/>
</td>
</tr>




<tr>
<td class="tl">�����Ź���������</td>
<td>
<input type="text" name="setting[group_limit]" size="5" value="<?php echo $group_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">��ѷ����Ź�����</td>
<td>
<input type="text" name="setting[group_free_limit]" size="5" value="<?php echo $group_free_limit;?>"/>
</td>
</tr>



<tr>
<td class="tl">������Ƹ��������</td>
<td>
<input type="text" name="setting[job_limit]" size="5" value="<?php echo $job_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">��ѷ�����Ƹ����</td>
<td>
<input type="text" name="setting[job_free_limit]" size="5" value="<?php echo $job_free_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">����������������</td>
<td>
<input type="text" name="setting[resume_limit]" size="5" value="<?php echo $resume_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">��ѷ�����������</td>
<td>
<input type="text" name="setting[resume_free_limit]" size="5" value="<?php echo $resume_free_limit;?>"/>
</td>
</tr>


<tr>
<td class="tl">����������������</td>
<td>
<input type="text" name="setting[article_limit]" size="5" value="<?php echo $article_limit;?>"/>
�����¡�ָ������ģ�ʹ�����ģ�飬���硰��Ѷ��ģ��
</td>
</tr>

<tr>
<td class="tl">��ѷ�����������</td>
<td>
<input type="text" name="setting[article_free_limit]" size="5" value="<?php echo $article_free_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">������Ϣ��������</td>
<td>
<input type="text" name="setting[info_limit]" size="5" value="<?php echo $info_limit;?>"/>
����Ϣ��ָ����Ϣģ�ʹ�����ģ�飬���硰���͡�ģ��
</td>
</tr>

<tr>
<td class="tl">��ѷ�����Ϣ����</td>
<td>
<input type="text" name="setting[info_free_limit]" size="5" value="<?php echo $info_free_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">����֪����������</td>
<td>
<input type="text" name="setting[know_limit]" size="5" value="<?php echo $know_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">��ѷ���֪������</td>
<td>
<input type="text" name="setting[know_free_limit]" size="5" value="<?php echo $know_free_limit;?>"/>
</td>
</tr>



<tr>
<td class="tl">����ͼ����������</td>
<td>
<input type="text" name="setting[photo_limit]" size="5" value="<?php echo $photo_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">��ѷ���ͼ������</td>
<td>
<input type="text" name="setting[photo_free_limit]" size="5" value="<?php echo $photo_free_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">������Ƶ��������</td>
<td>
<input type="text" name="setting[video_limit]" size="5" value="<?php echo $video_limit;?>"/>
</td>
</tr>

<tr>
<td class="tl">��ѷ�����Ƶ����</td>
<td>
<input type="text" name="setting[video_free_limit]" size="5" value="<?php echo $video_free_limit;?>"/>
</td>
</tr>

</table>

<div class="sbt"><input type="submit" name="submit" value=" ȷ �� " class="btn">&nbsp;&nbsp;&nbsp;&nbsp;</div>
</form>
<script type="text/javascript">
function check() {
	var l;
	var f;
	f = 'groupname';
	l = Dd(f).value.length;
	if(l < 2) {
		Dmsg('����д��Ա������', f);
		return false;
	}
	return true;
}
</script>
<script type="text/javascript">Menuon(<?php echo $menuid;?>);</script>
<?php include tpl('footer');?>