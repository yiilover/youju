<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
$menus = array (
    array('��������'),
    array('SEO�Ż�'),
    array('�������Ż�'),
    array('��ȫ����'),
    array('ͼƬ����'),
    array('�ʼ�����'),
    array('ҳ��ϸ��'),
);
show_menu($menus);
?>
<form method="post" action="?">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="tab" id="tab" value="<?php echo $tab;?>"/>
<div id="Tabs0" style="display:">
<div class="tt">��������</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">��վ����</td>
<td><input name="setting[sitename]" type="text" value="<?php echo $sitename;?>" size="40"/></td>
</tr>
<tr>
<td class="tl">��վ��ַ</td>
<td><input name="config[url]" type="text" value="<?php echo $url;?>" size="40"/><?php tips('����д����URL��ַ,����http://www.haoid.cn/<br/>ע���� / ��β');?></td>
</tr>
<tr>
<td class="tl">��վLOGO</td>
<td><input name="setting[logo]" type="text" value="<?php echo $logo;?>" id="logo" size="60"/> <span onclick="Dthumb(1,180,60, Dd('logo').value, 0, 'logo');" class="jt">[�ϴ�]</span>&nbsp;&nbsp;<span onclick="if(Dd('logo').value){Dd('showlogo').src=Dd('logo').value;}" class="jt">[Ԥ��]</span>&nbsp;&nbsp;<span onclick="Dd('logo').value='';Dd('showlogo').src='<?php echo AJ_SKIN;?>image/logo.gif';" class="jt">[ɾ��]</span><br/>
<a href="<?php echo AJ_PATH;?>" target="_blank"><img src="<?php echo $logo ? $logo : AJ_SKIN.'image/logo.gif';?>" style="margin:2px;" id="showlogo"/></a></td>
</tr>
<tr>
<td class="tl">��Ȩ��Ϣ</td>
<td><textarea name="setting[copyright]" id="copyright" style="width:500px;height:50px;"><?php echo $copyright;?></textarea><br/>֧��HTML�﷨�����ô��룺��Ȩ&copy; &amp;copy; �ո� &amp;nbsp; ����  &lt;br/&gt;
</td> 
</tr>
<tr>
<td class="tl">�ͷ��绰</td>
<td><input name="setting[telephone]" type="text" value="<?php echo $telephone;?>" size="20"/></td>
</tr>
<tr>
<td class="tl">��ϵQQ</td>
<td><input name="setting[QQ]" type="text" value="<?php echo $QQ;?>" size="20"/></td>
</tr>
<tr>
<td class="tl">ICP�������</td>
<td><input name="setting[icpno]" type="text" value="<?php echo $icpno;?>" size="20"/></td>
</tr>
<tr>
<td class="tl">��վ״̬</td>
<td>
<input type="radio" name="setting[close]" value="0"  <?php if(!$close){ ?>checked <?php } ?> onclick="Dh('dclose');"/> ����&nbsp;&nbsp;
<input type="radio" name="setting[close]" value="1"  <?php if($close){ ?>checked <?php } ?> onclick="Ds('dclose');"/> �ر�
</td>
</tr>
<tr id="dclose" style="display:<?php if(!$close) echo 'none';?>">
<td class="tl">�ر�ԭ��</td>
<td><textarea name="setting[close_reason]" id="close_reason" style="width:500px;height:50px;overflow:visible;"><?php echo $close_reason;?></textarea><br/>֧��HTML�﷨����վ�رղ�Ӱ���̨����
</td> 
</tr>
<tr>
<td class="tl">Ĭ�ϳ���</td>
<td><input name="setting[city_sitename]" type="text" value="<?php echo $city_sitename;?>" size="15"/><?php tips('����������з�վ���ù�����Ч��');?></td>
</tr>
<tr>
<td class="tl">baidu��ͼ��������</td>
<td><input name="setting[map_mid]" type="text" value="<?php echo $map_mid;?>" size="35"/><?php tips('����������з�վ���ù�����Ч��');?> <a href="http://api.map.baidu.com/lbsapi/getpoint/" target="_blank">ʰȡ��ͼ����</a> | <a href="http://www.haoid.cn/" target="_blank">ʰȡ��ͼ����̳�</a></td>
</tr>
<tr>
<td class="tl">���з�վ</td>
<td>
<input type="radio" name="setting[city]" value="1"  <?php if($city){ ?>checked <?php } ?>/> ����&nbsp;&nbsp;
<input type="radio" name="setting[city]" value="0"  <?php if(!$city){ ?>checked <?php } ?>/> �ر�&nbsp;&nbsp;<?php tips('����������з�վ����վ��ҳ��ģ����ҳ��ģ���б�ҳ��ر����ɾ�̬');?></a>
</td>
</tr>
<tr>
<td class="tl">����IP�Զ���ת��վ</td>
<td>
<input type="radio" name="setting[city_ip]" value="1"  <?php if($city_ip){ ?>checked <?php } ?>/> ����&nbsp;&nbsp;
<input type="radio" name="setting[city_ip]" value="0"  <?php if(!$city_ip){ ?>checked <?php } ?>/> �ر�&nbsp;&nbsp;<?php tips('����ȽϺķ�ϵͳ��Դ��Ϊ�˷�ֹ���������ظ���¼��ϵͳ���жϷÿ�Ϊ��������ʱ���Զ���ת');?></a>
</td>
</tr>
<tr>
<td class="tl">��վĬ������</td>
<td>
<?php
$select = '';
$dirs = list_dir('lang');
foreach($dirs as $v) {
	$selected = ($v['dir'] == AJ_LANG) ? 'selected' : '';
	$select .= "<option value='".$v['dir']."' ".$selected.">".$v['name']."</option>";
}
$select = '<select name="config[language]">'.$select.'</select>';
echo $select;
?>
</td> 
</tr>

<tr>
<td class="tl">��վĬ�Ϸ��</td>
<td>
<?php
$select = '';
$dirs = list_dir('skin');
foreach($dirs as $v) {
	$selected = ($CFG['skin'] && $v['dir'] == $CFG['skin']) ? 'selected' : '';
	$select .= "<option value='".$v['dir']."' ".$selected.">".$v['name']."</option>";
}
$select = '<select name="config[skin]">'.$select.'</select>';
echo $select;
tips('λ��./skin/Ŀ¼,һ��Ŀ¼��Ϊһ�׷��');
?>
</td> 
</tr>
<tr>
<td class="tl">��վĬ��ģ��</td>
<td>
<?php
$select = '';
$dirs = list_dir('template');
foreach($dirs as $v) {
	$selected = ($CFG['template'] && $v['dir'] == $CFG['template']) ? 'selected' : '';
	$select .= "<option value='".$v['dir']."' ".$selected.">".$v['name']."</option>";
}
$select = '<select name="config[template]">'.$select.'</select>';
echo $select;
tips('λ��./template/Ŀ¼,һ��Ŀ¼��Ϊһ��ģ��');
?>
</td> 
</tr>
<tr>
<td class="tl">VIP��Ա����</td>
<td><input name="config[com_vip]" type="text" value="<?php echo $com_vip;?>" size="10"/></td>
</tr>
<tr>
<td class="tl">��ʵ��������</td>
<td><input name="setting[money_name]" type="text" value="<?php echo $money_name;?>" size="10"/></td>
</tr>
<tr>
<td class="tl">��ʵ���ҵ�λ</td>
<td><input name="setting[money_unit]" type="text" value="<?php echo $money_unit;?>" size="10"/></td>
</tr>
<tr>
<td class="tl">�����������</td>
<td><input name="setting[credit_name]" type="text" value="<?php echo $credit_name;?>" size="10"/></td>
</tr>
<tr>
<td class="tl">������ֵ�λ</td>
<td><input name="setting[credit_unit]" type="text" value="<?php echo $credit_unit;?>" size="10"/></td>
</tr>
<tr>
<td class="tl">��̨��������</td>
<td><input name="setting[admin_left]" type="text" value="<?php echo $admin_left;?>" size="5"/> px</td>
</tr>
<tr>
<td class="tl">��ʱͨѶվ�ڽ�̸</td>
<td>
<input type="radio" name="setting[im_web]" value="1"  <?php if($im_web){ ?>checked <?php } ?>/> ����&nbsp;&nbsp;
<input type="radio" name="setting[im_web]" value="0"  <?php if(!$im_web){ ?>checked <?php } ?>/> �ر�
</td>
</tr>
<tr>
<td class="tl">��ʱͨѶQQ</td>
<td>
<input type="radio" name="setting[im_qq]" value="1"  <?php if($im_qq){ ?>checked <?php } ?>/> ����&nbsp;&nbsp;
<input type="radio" name="setting[im_qq]" value="0"  <?php if(!$im_qq){ ?>checked <?php } ?>/> �ر�
</td>
</tr>
<tr>
<td class="tl">��ʱͨѶ��������</td>
<td>
<input type="radio" name="setting[im_ali]" value="1"  <?php if($im_ali){ ?>checked <?php } ?>/> ����&nbsp;&nbsp;
<input type="radio" name="setting[im_ali]" value="0"  <?php if(!$im_ali){ ?>checked <?php } ?>/> �ر�
</td>
</tr>
<tr>
<td class="tl">��ʱͨѶMSN</td>
<td>
<input type="radio" name="setting[im_msn]" value="1"  <?php if($im_msn){ ?>checked <?php } ?>/> ����&nbsp;&nbsp;
<input type="radio" name="setting[im_msn]" value="0"  <?php if(!$im_msn){ ?>checked <?php } ?>/> �ر�
</td>
</tr>
<tr>
<td class="tl">��ʱͨѶSkype</td>
<td>
<input type="radio" name="setting[im_skype]" value="1"  <?php if($im_skype){ ?>checked <?php } ?>/> ����&nbsp;&nbsp;
<input type="radio" name="setting[im_skype]" value="0"  <?php if(!$im_skype){ ?>checked <?php } ?>/> �ر�
</td>
</tr>
<?php include AJ_ROOT.'/api/trade/setting.inc.php';?>
<!--
<tr>

<td class="tl">�ֻ�����</td>
<td>
<input type="radio" name="setting[sms]" value="1"  <?php if($sms){ ?>checked <?php } ?> onclick="Ds('dsms');"/> ����&nbsp;&nbsp;
<input type="radio" name="setting[sms]" value="0"  <?php if(!$sms){ ?>checked <?php } ?> onclick="Dh('dsms');"/> �ر�&nbsp;&nbsp;&nbsp;&nbsp;
<img src="<?php echo AJ_SKIN;?>image/mobile.gif" align="absmiddle"/> <a href="?file=aijiacms&action=sms" target="_blank" class="t">[�����ʺ�<?php if($sms && $sms_uid && $sms_key) { ?> ���ö���<strong class="f_red"><script type="text/javascript" src="http://www.yuanmaa.com/sms.php?uid=<?php echo $sms_uid;?>&key=<?php echo $sms_key;?>"></script></strong>��<?php } ?>]</a>
</td>
</tr>
<tbody id="dsms" style="display:<?php if(!$sms) echo 'none';?>">
<tr>
<td class="tl">���Žӿ���·</td>
<td>
<select name="setting[sms_host]">
<option value="sms"<?php if($sms_host == 'sms') echo ' selected';?>>��·1(����)</option>
<option value="smsm"<?php if($sms_host == 'smsm') echo ' selected';?>>��·2(����)</option>
</select><?php tips('��������ѡ����·1(����)���ٶȸ��죬������ŷ�����ʾCan Not Connect SMS Server�����Գ���ѡ����·2(����)');?>
</td> 
</tr>
<tr>
<td class="tl">���Žӿ��ʺ�</td>
<td><input name="setting[sms_uid]" type="text" value="<?php echo $sms_uid;?>" size="30"/></td> 
</tr>
<tr>
<td class="tl">���Žӿ���Կ</td>
<td><input name="setting[sms_key]" type="text" id="sms_key" size="30" value="<?php echo $sms_key;?>" onfocus="if(this.value.indexOf('**')!=-1)this.value='';"/></td>
</tr>
<tr>
<td class="tl">��������ǩ��</td>
<td><input name="setting[sms_sign]" type="text" value="<?php echo $sms_sign;?>" size="30"/> <?php tips('����ʾ�ڶ������ݽ�β���Ա��Աʶ���뾡�����<br/>���� [ĳĳ��]');?></td> 
</tr>
<tr>
<td class="tl">���ŵ���</td>
<td><input name="setting[sms_fee]" type="text" value="<?php echo $sms_fee;?>" size="5"/> Ԫ/�� <?php tips('������Ի�Ա�շ�');?></td> 
</tr>
<tr>
<td class="tl">���ų���</td>
<td><input name="setting[sms_len]" type="text" value="<?php echo $sms_len;?>" size="5"/> ��/��</td> 
</tr>
<tr>
<td class="tl">�ɹ���ʶ</td>
<td><input name="setting[sms_ok]" type="text" value="<?php echo $sms_ok;?>" size="10"/> <?php tips('���ŷ��ͳɹ���ʶ�ַ���ϵͳ���ݴ��ַ�ȷ���Ƿ�۳���Ա�������');?></td> 
</tr>
-->
</tbody>
</table>
</div>

<div id="Tabs1" style="display:none">
<div class="tt">SEO�Ż�</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">����ָ���</td>
<td><input name="setting[seo_delimiter]" type="text" value="<?php echo $seo_delimiter;?>" size="10"/></td>
</tr>
<tr>
<td class="tl">Title(��վ����)</td>
<td><input name="setting[seo_title]" type="text" value="<?php echo $seo_title;?>" size="61"><?php tips('��������������õ���ҳ����');?></td>
</tr>
<tr>
<td class="tl">Meta Keywords<br/>(��ҳ�ؼ���)</td>
<td><textarea name="setting[seo_keywords]" cols="60" rows="3"><?php echo $seo_keywords;?></textarea><?php tips('��������������õĹؼ���');?></td>
</tr>
<tr>
<td class="tl">Meta Description<br/>(��ҳ����)</td>
<td><textarea name="setting[seo_description]" cols="60" rows="3"><?php echo $seo_description;?></textarea><?php tips('��������������õ���ҳ����');?></td>
</tr>


<tr>
<td class="tl">Ŀ¼��ҳ�ļ���</td>
<td><input name="setting[index]" type="text" value="<?php echo $index;?>" size="8"/>
</td>
</tr>
<tr>
<td class="tl">�����ļ���չ��</td>
<td>
<select name="setting[file_ext]">
<option value="html"<?php if($file_ext == 'html') echo ' selected';?>>.html</option>
<option value="htm"<?php if($file_ext == 'htm') echo ' selected';?>>.htm</option>
<option value="shtm"<?php if($file_ext == 'shtm') echo ' selected';?>>.shtm</option>
<option value="shtml"<?php if($file_ext == 'shtml') echo ' selected';?>>.shtml</option>
</select>
</td>
</tr>
<tr>
<td class="tl">��վ��ҳ����html</td>
<td>
<input type="radio" name="setting[index_html]" value="1"  <?php if($index_html){ ?>checked <?php } ?>/> ����&nbsp;&nbsp;
<input type="radio" name="setting[index_html]" value="0"  <?php if(!$index_html){ ?>checked <?php } ?>/> �ر�
</td>
</tr>
<tr>
<td class="tl">URL Rewrite(α��̬)</td>
<td>
<input type="radio" name="setting[rewrite]" value="1"  <?php if($rewrite){ ?>checked <?php } ?>/> ����&nbsp;&nbsp;
<input type="radio" name="setting[rewrite]" value="0"  <?php if(!$rewrite){ ?>checked <?php } ?>/> �ر� <?php tips('��ȷ�Ϸ������������������ã�����������<br/>ReWrite����������ĵ�<br/>��������ĵ�ַ���������������ʾ��˵���������óɹ�<br/><a href=index-htm-url-rule.html target=_blank>index-htm-url-rule.html</a>');?>
</td>
</tr>
<tr>
<td class="tl">��˾��ҳ�󶨶�������</td>
<td><input name="config[com_domain]" type="text" value="<?php echo $com_domain;?>" size="30"/> <?php tips('�����д .yuanmaa.com ͬʱ��Ҫ������������ *.yuanmaa.com ָ�������IP�������ڷ������˰󶨷������� ��վ��Ŀ¼ ���� ��վ��Ŀ¼/company Ŀ¼�����ɵ���ҳ��ʽΪusername.yuanmaa.com<br/>�����д i.yuanmaa.com ͬʱ��Ҫ������������ i.yuanmaa.com ָ�������IP�������ڷ������˰���������վ��Ŀ¼/company Ŀ¼�����ɵ���ҳ��ʽΪi.yuanmaa.com/username/(ע���˷�ʽ����֧��α��̬)');?></td>
</tr>
<tr>
<td class="tl">��������Ŀ¼</td>
<td>
<select name="config[com_dir]">
<option value="0"<?php echo $com_dir == 0 ? ' selected' : '';?>>��Ŀ¼</option>
<option value="1"<?php echo $com_dir == 1 ? ' selected' : '';?>>companyĿ¼</option>
</select>&nbsp;
<?php tips('���������֧�֣��Ƽ�����companyĿ¼');?>
</td>
</tr>
<tr>
<td class="tl">��˾����������www</td>
<td>
<input type="radio" name="setting[com_www]" value="1"  <?php if($com_www){ ?>checked <?php } ?>/> ����&nbsp;&nbsp;
<input type="radio" name="setting[com_www]" value="0"  <?php if(!$com_www){ ?>checked <?php } ?>/> �ر� <?php tips('�����������Ϊsell.yuanmaa.com<br/>���www��Ϊ www.sell.yuanmaa.com');?>
</td>
</tr>
<tr>
<td class="tl">��Ա��������Rewrite</td>
<td>
<input type="radio" name="config[com_rewrite]" value="1"  <?php if($com_rewrite){ ?>checked <?php } ?>/> ����&nbsp;&nbsp;
<input type="radio" name="config[com_rewrite]" value="0"  <?php if(!$com_rewrite){ ?>checked <?php } ?>/> �ر� <?php tips('���ַ����������޷�������Ա�󶨵Ķ�������Rewrite������޷����������ڴ˹رգ�������ִ򲻿�ҳ���������������Ի�Ա������������Ӱ������ҳ��Rewrite');?>
</td>
</tr>

<tr>
<td class="tl">����������·������</td>
<td>
<input type="radio" name="setting[pcharset]" value="0"  <?php if(!$pcharset){ ?>checked <?php } ?>/> δ��&nbsp;&nbsp;
<input type="radio" name="setting[pcharset]" value="gbk"  <?php if($pcharset == 'gbk'){ ?>checked <?php } ?>/> GBK&nbsp;&nbsp;
<input type="radio" name="setting[pcharset]" value="utf-8"  <?php if($pcharset == 'utf-8'){ ?>checked <?php } ?>/> UTF-8 <?php tips('�����ɰ��������ļ������ļ���������������ش����������ļ���ʾ�Ҳ����ļ�ʱ���ɳ������ô���');?>
</td>
</tr>

<tr>
<td class="tl">404������־</td>
<td>
<input type="radio" name="setting[log_404]" value="1"  <?php if($log_404){ ?>checked <?php } ?>/> ����&nbsp;&nbsp;
<input type="radio" name="setting[log_404]" value="0"  <?php if(!$log_404){ ?>checked <?php } ?>/> �ر�
<a href="javascript:Dwidget('?file=404', '404������־');" class="t">[�鿴��־]</a>
<?php tips('����404��־�����ڷ���վ�������Ӻ��û�����������֩��Ĵ����¼<br/>ͬʱ��Ҫ����վ���404ҳ������վ��Ŀ¼404.php');?>
</td>
</tr>
</table>
</div>

<div id="Tabs2" style="display:none">
<div class="tt">�������Ż�</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">��ҳ�Զ�����Ƶ��</td>
<td>
<input name="setting[task_index]" type="text" value="<?php echo $task_index;?>" size="5"/> �� <?php tips('�������ɵľ�̬��ҳ��Ч');?>
</td>
</tr>
<tr>
<td class="tl">�б�ҳ�Զ�����Ƶ��</td>
<td>
<input name="setting[task_list]" type="text" value="<?php echo $task_list;?>" size="5"/> �� <?php tips('�������ɵľ�̬��ҳ��Ч');?>
</td>
</tr>
<tr>
<td class="tl">����ҳ�Զ�����Ƶ��</td>
<td>
<input name="setting[task_item]" type="text" value="<?php echo $task_item;?>" size="5"/> �� <?php tips('�������ɵľ�̬��ҳ��Ч');?>
</td>
</tr>
<tr>
<td class="tl">TAG(��ǩ)�����������</td>
<td><input type="text" name="config[tag_expires]" value="<?php echo $tag_expires;?>" size="5"/> ��<?php tips('��������Լ����ǩ���ݵ��öԷ�������ѹ��');?></td>
</tr>
<tr>
<td class="tl">SQL��ѯ�����������</td>
<td><input type="text" name="config[db_expires]" value="<?php echo $db_expires;?>" size="5"/> ��<?php tips('��������Լ������ݿ��ѯ�Է�������ѹ��<br/>���ǻ���һ���̶������ӻ���Ŀ¼�����');?></td>
</tr>
<tr>
<td class="tl">������������������</td>
<td><input type="text" name="setting[cache_search]" value="<?php echo $cache_search;?>" size="5"/> ��<?php tips('����ɼ��������ȴ����ķ���Դ�Ĳ����Է�������ѹ��<br/>���ǻ���һ���̶������ӻ���Ŀ¼�����');?></td>
</tr>
<tr>
<td class="tl">������������������</td>
<td><input type="text" name="setting[cache_hits]" value="<?php echo $cache_hits;?>" size="5"/> ��<?php tips('��������Լ������ݿ����ѹ�������ǻ��������������ӳ���ʾ');?></td>
</tr>
<tr>
<td class="tl">��˾��ҳ�����������</td>
<td><input type="text" name="setting[cache_home]" value="<?php echo $cache_home;?>" size="5"/> ��<?php tips('��������Լӿ칫˾��ҳ���ٶȣ����ǻ���ɻ�Ա��ҳ�ӳٸ��º���һ���̶������ӻ���Ŀ¼�����');?></td>
</tr>
<tr>
<td class="tl">���ݻ��淽ʽ</td>
<td>
<select name="config[cache]" onchange="if(this.options[this.selectedIndex].innerHTML.indexOf('��')!=-1){alert('ϵͳ��֧�� '+this.value);select_op('ccf', '<?php echo $cache;?>')}" id="ccf">
<option value="file"<?php echo $cache == 'file' ? ' selected' : '';?>>�ļ� (֧��)</option>
<option value="memcache"<?php echo $cache == 'memcache' ? ' selected' : '';?>>Memcache (<?php echo class_exists('Memcache') ? '֧��' : '��֧��'?>)</option>
<option value="xcache"<?php echo $cache == 'xcache' ? ' selected' : '';?>>Xcache (<?php echo function_exists('xcache_get') ? '֧��' : '��֧��'?>)</option>
<option value="eaccelerator"<?php echo $cache == 'eaccelerator' ? ' selected' : '';?>>eAccelerator (<?php echo function_exists('eaccelerator_get') ? '֧��' : '��֧��'?>)</option>
<option value="shmop"<?php echo $cache == 'shmop' ? ' selected' : '';?>>shmop (<?php echo (function_exists('shmop_open') && function_exists('ftok')) ? '֧��' : '��֧��'?>)</option>
<option value="apc"<?php echo $cache == 'apc' ? ' selected' : '';?>>apc (<?php echo function_exists('apc_fetch') ? '֧��' : '��֧��'?>)</option>
</select>
<?php tips('�����ļ����棬�������淽ʽ��Ҫ��������֧�֣�������鿴phpinfo��Ϣ��<br/>����ȷ�Ϸ���������֧�ֵ�����¿�����������ܵ���δ֪�Ĵ���<br/>�����Ҫ����Memcache���棬��������file/config/memcache.inc.php���Ӳ���');?>&nbsp;&nbsp;
<a href="?action=phpinfo" target="_blank" class="t">[�鿴phpinfo]</a>&nbsp;&nbsp;
<a href="?action=cacheclear" target="_blank" class="t">[��ջ���]</a>
</td>
</tr>
<tr>
<td class="tl">���ݿ�/���ӷ�ʽ</td>
<td>
<select name="config[database]">
<option value="mysql"<?php echo $database == 'mysql' ? ' selected' : '';?>>mysql</option>
<option value="mysqli"<?php echo $database == 'mysqli' ? ' selected' : '';?>>mysqli</option>
<option value="mysqlrw"<?php echo $database == 'mysqlrw' ? ' selected' : '';?>>mysqlrw</option>
<option value="mysqlirw"<?php echo $database == 'mysqlirw' ? ' selected' : '';?>>mysqlirw</option>
</select>
<?php tips('mysqli��PHP��mysql�����Ե�һ����չ֧�֣�����Ѽ��ش���չ����ѡ��mysqli��������鿴phpinfo��Ϣ<br/>mysqlrw/mysqlirwָ��̨mysql������ʵ�ֶ�д���룬����֮ǰ��Ҫ����file/config/mysqlrw.inc.phpֻ�����ݿ����Ӳ���');?>
</td>
</tr>
<tr>
<td class="tl">ȥ��ģ�廻�б��</td>
<td>
<input type="radio" name="config[template_trim]" value="1" <?php if($template_trim){ ?>checked <?php } ?>/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="config[template_trim]" value="0" <?php if(!$template_trim){ ?>checked <?php } ?>/> �ر� <?php tips('ȥ�����еȶ����ǣ���һ���̶��Ͽ���ѹ����ҳ���<br/>����������ܵ����Զ����js(���������)�ȴ�����Ҫע���Ų�js��ע�ͼ���β�ķֺ�');?></td>
</tr>
<tr>
<td class="tl">ģ�建���Զ�����</td>
<td>
<input type="radio" name="config[template_refresh]" value="1" <?php if($template_refresh){ ?>checked <?php } ?>/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="config[template_refresh]" value="0" <?php if(!$template_refresh){ ?>checked <?php } ?>/> �ر� <?php tips('�����վģ�������޸ģ��������رմ˹���');?></td>
</tr>
<tr title="��ҳ��������gzipѹ�����䣬���Լӿ촫���ٶȣ���PHP 4.0.4������֧��Zlibģ�����ʹ��">
<td class="tl">ҳ��Gzipѹ��</td>
<td>
<input type="radio" name="setting[gzip_enable]" value="1" <?php if($gzip_enable){ ?>checked <?php } ?>/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[gzip_enable]" value="0" <?php if(!$gzip_enable){ ?>checked <?php } ?>/> �ر� <?php tips(function_exists('ob_gzhandler') ? '��ǰ������֧��Gzip�����鿪��' : '��ǰ��������֧��Gzip����ر�');?>
</td>
</tr>
<tr>
<td class="tl">ͼƬ��ʱ����</td>
<td>
<input type="radio" name="setting[lazy]" value="1" <?php if($lazy){ ?>checked <?php } ?>/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[lazy]" value="0" <?php if(!$lazy){ ?>checked <?php } ?>/> �ر� <?php tips('ҳ��ͼƬ����������ĵ�ǰ����ʱ�ټ��أ������Խ��ͷ������ܴ��վ��ķ���������');?></td>
</tr>
<tr>
<td class="tl">��ҳ��ʾ��ʽ</td>
<td>
<input type="radio" name="setting[pages_mode]" value="0" <?php if(!$pages_mode){ ?>checked <?php } ?>/> Ĭ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[pages_mode]" value="1" <?php if($pages_mode){ ?>checked <?php } ?>/> ���
</td>
</tr>
<tr>
<td class="tl">���ּ�¼</td>
<td>
<input type="radio" name="setting[log_credit]" value="1" <?php if($log_credit){ ?>checked <?php } ?>/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[log_credit]" value="0" <?php if(!$log_credit){ ?>checked <?php } ?>/> �ر�
</td>
</tr>
<tr>
<td class="tl">��ʾ��ϵ��ʽͼƬ��</td>
<td>
<input type="radio" name="setting[anti_spam]" value="1" <?php if($anti_spam){ ?>checked <?php } ?>/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[anti_spam]" value="0" <?php if(!$anti_spam){ ?>checked <?php } ?>/> �ر� <?php tips('���绰�����桢Email����Ҫ��Ϣ��ʾΪͼƬ��ʽ����ֹ�ɼ��͸���');?>
</td>
</tr>
<tr>
<td class="tl">����������ʾ</td>
<td>
<input type="radio" name="setting[search_tips]" value="1" <?php if($search_tips){ ?>checked <?php } ?>/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[search_tips]" value="0" <?php if(!$search_tips){ ?>checked <?php } ?>/> �ر�</td>
</tr>
<tr>
<td class="tl">�༭���Զ�����ݸ�</td>
<td>
<input type="radio" name="setting[save_draft]" value="1" <?php if($save_draft == 1){ ?>checked <?php } ?>/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[save_draft]" value="0" <?php if($save_draft == 0){ ?>checked <?php } ?>/> �ر�&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[save_draft]" value="2" <?php if($save_draft == 2){ ?>checked <?php } ?>/> ��̨���� <?php tips('��̨����ָ���ں�̨������ǰ̨��������<br/>ע�⣺�����˹��ܻ�ռ��һ���ķ������ռ�');?></td>
</tr>
<tr>
<td class="tl">�����ؼ����Զ���¼</td>
<td>
<input type="radio" name="setting[search_kw]" value="1" <?php if($search_kw){ ?>checked <?php } ?>/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[search_kw]" value="0" <?php if(!$search_kw){ ?>checked <?php } ?>/> �ر�&nbsp;&nbsp;<a href="javascript:Dwidget('?file=keyword', '�����ؼ��ʼ�¼');" class="t">[�鿴��¼]</a></td>
</tr>
<tr>
<td class="tl">�˹���˹ؼ��ʼ�¼</td>
<td>
<input type="radio" name="setting[search_check_kw]" value="1" <?php if($search_check_kw){ ?>checked <?php } ?>/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[search_check_kw]" value="0" <?php if(!$search_check_kw){ ?>checked <?php } ?>/> �ر�</td>
</tr>
<tr>
<td class="tl">�����ؼ��ʳ�������</td>
<td><input type="text" size="3" name="setting[min_kw]" value="<?php echo $min_kw;?>"/>
��
<input type="text" size="3" name="setting[max_kw]" value="<?php echo $max_kw;?>"/>
�ַ�<?php tips('һ�����ֵĳ���Ϊ2���ַ�����������Ϊ3-30���ַ�֮��');?></td>
</tr>
<tr>
<td class="tl">��������ʱ����</td>
<td><input type="text" size="3" name="setting[search_limit]" value="<?php echo $search_limit;?>"/> ��<?php tips('��0Ϊ������');?></td>
</tr>

<tr>
<td class="tl">��Ա���߱���ʱ��</td>
<td><input type="text" name="setting[online]" value="<?php echo $online;?>" size="5"/> ��<?php tips('������ʱ��δ�л�Ļ�Ա����Ϊ����');?></td>
</tr>

<tr>
<td class="tl">��ʱ���»�Ա����Ϣ</td>
<td><input type="text" name="setting[pushtime]" value="<?php echo $pushtime;?>" size="5"/> ��<?php tips('����Աͣ����ǰ̨ҳ��ʱ��ÿ��һ��ʱ�䣬ϵͳ�Զ�����һ�η����������Ը��»�Ավ���š��¶Ի������ﳵ�������Ա��Ա��ʱ�յ�����Ϣ����0Ϊ�رգ���������ӷ�����ѹ������������30������');?></td>
</tr>

<tr>
<td class="tl">�б�ÿҳĬ����Ϣ����</td>
<td><input name="setting[pagesize]" type="text" value="<?php echo $pagesize;?>" size="3"/> ��</td>
</tr>
<tr>
<td class="tl">�������෵�ؽ��������</td>
<td><input type="text" size="3" name="setting[schcate_limit]" value="<?php echo $schcate_limit;?>"/> ��<?php tips('��0Ϊ���÷�������');?></td>
</tr>
<tr>
<td class="tl">��̬�ļ����벿���ַ</td>
<td><input name="config[static]" type="text" value="<?php echo $static;?>" size="40"/>&nbsp;&nbsp;
<a href="javascript:Dwidget('?action=static', '��̬�ļ����벿��', 486, 200);" class="t">[ʹ��˵��]</a></td>
</tr>
<tr>
<td class="tl">Զ��FTP�ļ��ϴ�</td>
<td>
<input type="radio" name="setting[ftp_remote]" value="1"  <?php if($ftp_remote){ ?>checked <?php } ?> onclick="Ds('ftp');"/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[ftp_remote]" value="0"  <?php if(!$ftp_remote){ ?>checked <?php } ?> onclick="Dh('ftp');"/> �ر�<?php tips('����Զ���ļ��ϴ��������ϴ��ļ�����FTP�ƶ���Զ�̷������ϣ����Լ���Ļ�����վ����ѹ��');?></td>
</tr>
<tbody id="ftp" style="display:<?php echo $ftp_remote ? '' : 'none';?>">
<?php if(!extension_loaded("ftp")){ ?>
<tr>
<td class="tl">ϵͳ��ʾ</td>
<td class="f_red">��ǰPHP������֧��FTP����</td>
</tr>
<?php }?>
<tr> 
<td class="tl">FTP����</td>
<td><input name="setting[ftp_host]" id="ftp_host" type="text" size="30" value="<?php echo $ftp_host;?>"/><?php tips('������ FTP �������� IP ��ַ������');?></td>
</tr>
<tr> 
<td class="tl">FTP�˿�</td>
<td><input name="setting[ftp_port]" id="ftp_port" type="text" size="30" value="<?php echo $ftp_port;?>"/><?php tips('Ĭ��Ϊ 21');?></td>
</tr>
<tr> 
<td class="tl">FTP�ʺ�</td>
<td><input name="setting[ftp_user]" id="ftp_user" type="text" size="30" value="<?php echo $ftp_user;?>"/><?php tips('���ʺű����������Ȩ�ޣ���ȡ�ļ���д���ļ���ɾ���ļ�������Ŀ¼����Ŀ¼�̳�');?></td>
</tr>
<tr> 
<td class="tl">FTP����<br></td>
<td><input name="setting[ftp_pass]" type="text" id="ftp_pass" size="30" value="<?php echo $ftp_pass;?>" onfocus="if(this.value.indexOf('**')!=-1)this.value='';"/></td>
</tr>
<tr>
<td class="tl">SSL����</td>
<td>
<input type="radio" name="setting[ftp_ssl]" value="1"  <?php if($ftp_ssl){ ?>checked <?php } ?> id="ftp_ssl"/> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[ftp_ssl]" value="0"  <?php if(!$ftp_ssl){ ?>checked <?php } ?>/> ��<?php tips('FTP ���������迪���� SSL �ſ�������');?></td>
</tr>
<tr>
<td class="tl">����ģʽ(PASV)����</td>
<td>
<input type="radio" name="setting[ftp_pasv]" value="1"  <?php if($ftp_pasv){ ?>checked <?php } ?> id="ftp_pasv"/> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[ftp_pasv]" value="0"  <?php if(!$ftp_pasv){ ?>checked <?php } ?>/> ��<?php tips('һ������·Ǳ���ģʽ���ɣ���������ϴ�ʧ�����⣬�ɳ��Դ򿪴�����');?>
</td>
</tr>
<tr> 
<td class="tl">Զ�̴洢Ŀ¼</td>
<td><input name="setting[ftp_path]" id="ftp_path" type="text" size="60" value="<?php echo $ftp_path;?>"/><?php tips('���� /wwwroot/img/ ���� /httpdocs/img/<br/>������ʵ�����Ϊ׼');?></td>
</tr>
<tr>
<td class="tl">Զ�̷���URL</td>
<td><input name="setting[remote_url]" type="text" value="<?php echo $remote_url;?>" size="60"/><?php tips('���� http://static.yuanmaa.com/��ע���� / ��β');?></td>
</tr>
<tr> 
<td class="tl">����FTP����</td>
<td><input name="testftp" type="button" class="btn" value="�������" onclick="TestFTP();"/></td>
</tr>
</table>
<script type="text/javascript">
function TestFTP() {
	if(Dd('ftp_host').value.length < 4) {
		Dalert('FTP��������Ϊ��');
		Dd('ftp_host').focus();
		return false;
	}	
	var fssl = Dd('ftp_ssl').checked ? 1 : 0;
	var fpasv = Dd('ftp_pasv').checked ? 1 : 0;
	var url = '?file=setting&action=ftp&ftp_host='+Dd('ftp_host').value+'&ftp_port='+Dd('ftp_port').value+'&ftp_user='+Dd('ftp_user').value+'&ftp_pass='+Dd('ftp_pass').value+'&ftp_path='+Dd('ftp_path').value+'&ftp_ssl='+fssl+'&ftp_pasv='+fpasv;
	Diframe(url, 0, 0 , 1);
}
</script>
</div>
<div id="Tabs3" style="display:none">
<div class="tt">��ȫ����</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">�����¼��̨�ĵ���</td>
<td><input name="setting[admin_area]" type="text" value="<?php echo $admin_area;?>" size="60"/><?php tips('���ù�����Ա���õĵ�¼���������������|�ָ�<br/>���硰����|�Ϻ�|���ݡ����ǳ��õ�����IP���޷���¼��̨');?></td>
</tr>
<tr>
<td class="tl">�����¼��̨��IP</td>
<td><input name="setting[admin_ip]" type="text" value="<?php echo $admin_ip;?>" size="60"/><?php tips('��������ã����ⷢ�����ɵ�¼��̨�����<br/>IP����*�������֣�����192.168.*.*<br/>���IP��ַ����IP����|�ָ����192.168.1.2|10.0.*.*');?></td>
</tr>
<tr>
<td class="tl">�����¼��̨��ʱ��</td>
<td><input name="setting[admin_hour]" type="text" value="<?php echo $admin_hour;?>" size="60"/><?php tips('���ձ�ʾ�����ƣ���������Ϊ������Ա�°�ʱ�䡣���ʱ�������|�ָ��ʱ�����-�ָʱ����ʹ��24Сʱ��<br/>���磺8:30-18:00 ��ʾʱ�������8:30������18:00<br/>22:30-2:05|5:00-13:15��ʾ����22:30�������賿2:05���賿5:00������13:15����ʱ���<br/>��վ��ʼ���ʺŲ��ܴ�����');?></td>
</tr>
<tr>
<td class="tl">�����¼��̨������</td>
<td>
<?php for($i = 0; $i < 7; $i++) { ?>
<input type="checkbox" name="setting[admin_week][]" value="<?php echo $i;?>"<?php echo strpos(','.$admin_week.',', ','.$i.',') !== false ? ' checked' : '';?>/> ����<?php echo $W[$i];?> 
<?php } ?>
<?php tips('��ѡ���ʾ�����ƣ���վ��ʼ���ʺŲ��ܴ�����');?>
</td>
</tr>
<tr>
<td class="tl">������ϢתΪ�����ʱ��</td>
<td><input name="setting[check_hour]" type="text" value="<?php echo $check_hour;?>" size="60"/><?php tips('�������ǰ̨��Ա������Ϣ�����ձ�ʾ�����ƣ���������Ϊ������Ա�°�ʱ�䡣ʱ��������ο������¼��̨��ʱ�� Tips');?></td>
</tr>
<tr>
<td class="tl">������ϢתΪ���������</td>
<td>
<?php for($i = 0; $i < 7; $i++) { ?>
<input type="checkbox" name="setting[check_week][]" value="<?php echo $i;?>"<?php echo strpos(','.$check_week.',', ','.$i.',') !== false ? ' checked' : '';?>/> ����<?php echo $W[$i];?> 
<?php } ?>
</td>
</tr>
<tr>
<td class="tl">��֤������ַ�</td>
<td><input name="setting[captcha_chars]" type="text" value="<?php echo $captcha_chars;?>" size="60"/><?php tips('����д0-9�����֡�a-z����ĸ��ϣ�����������Ż�����<br/>����ֻ��ʾ������֤�����д0123456789<br/>����ϵͳ�Զ���ʾ��Сд��ĸ�����ֵ����');?></td>
</tr>
<tr>
<td class="tl">������֤�� </td>
<td>
<input type="radio" name="setting[captcha_cn]" value="1"  <?php if($captcha_cn){ ?>checked <?php } ?>/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[captcha_cn]" value="0"  <?php if(!$captcha_cn){ ?>checked <?php } ?>/> �ر�
</td>
</tr>
<tr>
<td class="tl">��̨��¼��֤�� </td>
<td>
<input type="radio" name="setting[captcha_admin]" value="1"  <?php if($captcha_admin){ ?>checked <?php } ?>/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[captcha_admin]" value="0"  <?php if(!$captcha_admin){ ?>checked <?php } ?>/> �ر�
</td>
</tr>
<tr>
<td class="tl">���ܴ�������</td>
<td>
<input type="radio" name="setting[md5_pass]" value="1"  <?php if($md5_pass){ ?>checked <?php } ?>/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[md5_pass]" value="0"  <?php if(!$md5_pass){ ?>checked <?php } ?>/> �ر�
</td>
</tr>
<tr>
<td class="tl">��̨���߼�¼</td>
<td>
<input type="radio" name="setting[admin_online]" value="1"  <?php if($admin_online){ ?>checked <?php } ?>/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[admin_online]" value="0"  <?php if(!$admin_online){ ?>checked <?php } ?>/> �ر�&nbsp;&nbsp;
<a href="?moduleid=2&file=online&action=admin" class="t">[����鿴]</a>
</td>
</tr>
<tr>
<td class="tl">��̨������־ </td>
<td>
<input type="radio" name="setting[admin_log]" value="0" <?php if(!$admin_log){ ?>checked <?php } ?>/> �ر�&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[admin_log]" value="1" <?php if($admin_log == 1){ ?>checked <?php } ?>/> ���ֿ���<?php tips('����¼��ӡ��޸ġ�ɾ�������õȹؼ�����');?>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[admin_log]" value="2" <?php if($admin_log == 2){ ?>checked <?php } ?>/> ��ȫ����<?php tips('��¼��̨���в���');?>
</td>
</tr>
<tr>
<td class="tl">��Ա��¼��־ </td>
<td>
<input type="radio" name="setting[login_log]" value="0" <?php if(!$login_log){ ?>checked <?php } ?>/> �ر�&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[login_log]" value="1" <?php if($login_log == 1){ ?>checked <?php } ?>/> ��̨����<?php tips('����¼��վ��̨��¼��־');?>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[login_log]" value="2" <?php if($login_log == 2){ ?>checked <?php } ?>/> ��ȫ����<?php tips('��¼���е�¼��־');?>
</td>
</tr>
<tr>
<td class="tl">ͬһ�ʺ�ͬʱ��ص�¼</td>
<td>
<input type="radio" name="setting[ip_login]" value="0"  <?php if(!$ip_login){ ?>checked <?php } ?>/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[ip_login]" value="1"  <?php if($ip_login == 1){ ?>checked <?php } ?>/> ����ǰ̨<?php tips('����ǰ̨����ͬһ�ʺ�ͬʱ��ص�¼<br/>��̨��������ͬһ�ʺ�ͬʱ��ص�¼');?>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[ip_login]" value="2"  <?php if($ip_login == 2){ ?>checked <?php } ?>/> ��ȫ��ֹ<?php tips('��ȫ��ֹͬһ�ʺ�ͬʱ��ص�¼');?>
</td>
</tr>
<tr>
<td class="tl">����ҳ��ֹ����</td>
<td>
<input type="radio" name="setting[anticopy]" value="1"  <?php if($anticopy){ ?>checked <?php } ?>/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[anticopy]" value="0"  <?php if(!$anticopy){ ?>checked <?php } ?>/> �ر�
</td>
</tr>
<tr>
<td class="tl">�ļ��ϴ���¼</td>
<td>
<input type="radio" name="setting[uploadlog]" value="1"  <?php if($uploadlog){ ?>checked <?php } ?>/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[uploadlog]" value="0"  <?php if(!$uploadlog){ ?>checked <?php } ?>/> �ر�
</td>
</tr>
<tr>
<td class="tl">�����ϴ����ļ�����</td>
<td><input name="setting[uploadtype]" type="text" value="<?php echo $uploadtype;?>" size="60"/> <?php tips('��|�Ÿ����ļ���׺');?></td>
</tr>
<tr>
<td class="tl">�����ϴ���С����</td>
<td><input name="setting[uploadsize]" type="text" value="<?php echo $uploadsize;?>" size="10"/> Kb (1024Kb=1M) <?php tips('��ǰ���������֧��'.ini_get('upload_max_filesize').'�ļ��ϴ�<br/>�����Ҫ�޸����ֵ�������޸�php.ini��upload_max_filesize����');?></td>
</tr>
<tr>
<td class="tl">�ļ�����Ŀ¼</td>
<td>
<select name="setting[uploaddir]">
<option value="Ym/d" <?php if($uploaddir == 'Ym/d') echo 'selected';?>>����/��</option>
<option value="Ym/d/H" <?php if($uploaddir == 'Ym/d/H') echo 'selected';?>>����/��/ʱ</option>
<option value="Ym/d/H/i" <?php if($uploaddir == 'Ym/d/H/i') echo 'selected';?>>����/��/ʱ/��</option>
<option value="Ym/d/H/i/s" <?php if($uploaddir == 'Ym/d/H/i/s') echo 'selected';?>>����/��/ʱ/��/��</option>
</select>
 <?php tips('�ϴ��ļ������� file/upload Ŀ¼');?>
</td>
</tr>
<tr>
<td class="tl">��̨��֤��ʽ</td>
<td>
<select name="setting[authadmin]">
<option value="session" <?php if($authadmin == 'session') echo 'selected';?>>Session</option>
<option value="cookie" <?php if($authadmin == 'cookie') echo 'selected';?>>Cookie</option>
</select>
<?php tips('Session��֤���ܳ��ֺ�̨�Զ��˳������������Զ��˳������Ƶ������Ӱ��ʹ�ã���ʹ��cookie��֤��cookie��֤���ڹر������ʱ�Զ��˳���̨');?>
</td>
</tr>
<tr>
<td class="tl">��վ��ȫ��Կ</td>
<td><input name="config[authkey]" id="authkey" type="text" value="<?php echo $authkey;?>" size="30"/> <a href="javascript:Dd('authkey').value=RandStr();void(0);" class="t">[���]</a> <?php tips('����Ӣ�Ĵ�Сд��ĸ�����ֵ���ϣ�����ʹ��������ţ����鶨���޸�');?></td>
</tr>

<tr>
<td class="tl">��֤������Դ</td>
<td>
<input type="radio" name="setting[check_referer]" value="1"  <?php if($check_referer){ ?>checked <?php } ?>/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[check_referer]" value="0"  <?php if(!$check_referer){ ?>checked <?php } ?>/> �ر�
</td>
</tr>

<tr>
<td class="tl">��������</td>
<td><input name="setting[safe_domain]" type="text" value="<?php echo $safe_domain;?>" size="60"/><?php tips('����д��Ĭ��Ϊ��ǰ����<br/>�����������|�ֿ� ����yuanmaa.com|aijiacms.cn');?></td>
</tr>
<tr>
<td class="tl">ϵͳ����ϵ��</td>
<td><input name="setting[defend_cc]" type="text" value="<?php echo $defend_cc;?>" size="5"/><?php tips('�����ò���Unix/Linux������ϵͳ���ڴ�ֵʱ���ֹ���û����ʣ�ͨ�����������Ϊ5��10��0Ϊ������');?>
</td>
</tr>
<tr>
<td class="tl">��ֹҳ��ˢ��</td>
<td><input name="setting[defend_reload]" type="text" value="<?php echo $defend_reload;?>" size="5"/><?php tips('��ֹ����ˢ��ҳ��ʱ�䣬��λ�룬0Ϊ������');?></td>
</tr>
<tr>
<td class="tl">���ƴ������</td>
<td>
<input type="radio" name="setting[defend_proxy]" value="1"  <?php if($defend_proxy){ ?>checked <?php } ?>/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[defend_proxy]" value="0"  <?php if(!$defend_proxy){ ?>checked <?php } ?>/> �ر�<?php tips('�����û�ʹ�ô��������������վ');?>
</td>
</tr>
<tr>
<td class="tl">Cookie������</td>
<td><input name="config[cookie_domain]" type="text" value="<?php echo $cookie_domain;?>" size="20"/><?php tips('����Ҫ��֤��������yuanmaa.com���ж�����������������¼ע��������д.yuanmaa.com(ע�ⶥ������ǰ��.)');?></td>
</tr>
<tr>
<td class="tl">Cookieǰ׺</td>
<td><input name="config[cookie_pre]" type="text" value="<?php echo $cookie_pre;?>" size="20"/></td>
</tr>
<tr>
<td class="tl">�û�ע���ļ���</td>
<td><input name="setting[file_register]" type="text" value="<?php echo $file_register;?>" size="20"/><input name="old_file_register" type="hidden" value="<?php echo $file_register;?>"/> <a href="<?php echo $MODULE[2]['linkurl'];?><?php echo $file_register;?>" target="_blank">����</a><?php tips('�뱣֤��Ӧ�ļ���д���ύ��ϵͳ�᳢���޸ģ����ϵͳ�޸�ʧ�ܣ���ͨ��ftp�޸�<br/>�ļ�������ʹ�����ֺ���ĸ���ļ������� member/ Ŀ¼');?></td>
</tr>
<tr>
<td class="tl">�û���¼�ļ���</td>
<td><input name="setting[file_login]" type="text" value="<?php echo $file_login;?>" size="20"/><input name="old_file_login" type="hidden" value="<?php echo $file_login;?>"/> <a href="<?php echo $MODULE[2]['linkurl'];?><?php echo $file_login;?>" target="_blank">����</a></td>
</tr>
<tr>
<td class="tl">�û�������Ϣ�ļ���</td>
<td><input name="setting[file_my]" type="text" value="<?php echo $file_my;?>" size="20"/><input name="old_file_my" type="hidden" value="<?php echo $file_my;?>"/> <a href="<?php echo $MODULE[2]['linkurl'];?><?php echo $file_my;?>" target="_blank">����</a></td>
</tr>
</table>
</div>

<div id="Tabs4" style="display:none">
<div class="tt">ͼƬˮӡ</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">ˮӡͼƬ</td>
<td><input name="setting[water_mark]" type="text" value="<?php echo $water_mark;?>" size="40"/><br/>
<img src="file/image/<?php echo $water_mark;?>"/></td>
</tr>
<tr>
<td class="tl">ˮӡ͸����</td>
<td><input name="setting[water_transition]" type="text" value="<?php echo $water_transition;?>" size="5"><?php tips('���ˮӡͼΪgif��ʽ�������÷�ΧΪ 1~100 ������,��ֵԽСˮӡͼƬԽ͸����PNG ����ˮӡ����������͸��Ч�������������');?></td>
</tr>
<tr>
<td class="tl">JPEG ˮӡ����</td>
<td><input name="setting[water_jpeg_quality]" type="text" value="<?php echo $water_jpeg_quality;?>" size="5"><?php tips('��ΧΪ 0~100 ������,��ֵԽ����ͼƬЧ��Խ��,���ߴ�ҲԽ��');?></td>
</tr>
</table>
<div class="tt">����ˮӡ</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">ˮӡ����</td>
<td><input name="setting[water_text]" type="text" id="water_text" value="<?php echo $water_text;?>" size="30" style="color:<?php echo $water_fontcolor;?>;font-size:<?php echo $water_fontsize;?>px;"></td>
</tr>
<tr>
<td class="tl">��������</td>
<td><input name="setting[water_font]" type="text" value="<?php echo $water_font;?>" size="30"> <?php if($water_font && !is_file(AJ_ROOT."/file/font/".$water_font)){ ?><span class="f_red">���岻����,���ϴ����嵽./file/font/Ŀ¼</span><?php } ?></td>
</tr>
<tr>
<td class="tl">���ִ�С</td>
<td><input name="setting[water_fontsize]" type="text" value="<?php echo $water_fontsize;?>" size="8" style="font-size:<?php echo $water_fontsize;?>px;" onblur="this.style.fontSize=this.value+'px';Dd('water_text').style.fontSize=this.value+'px';"> px</td>
</tr>
<tr>
<td class="tl">������ɫ</td>
<td><input name="setting[water_fontcolor]" type="text" value="<?php echo $water_fontcolor;?>" size="8" style="color:<?php echo $water_fontcolor;?>" onblur="this.style.color=this.value;Dd('water_text').style.color=this.value;"></td>
</tr>
</table>
<div class="tt">ͼƬ����</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">ˮӡ����</td>
<td>
<input type="radio" name="setting[water_type]" value="0"  <?php if($water_type==0){ ?>checked <?php } ?> /> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[water_type]" value="1"  <?php if($water_type==1){ ?>checked <?php } ?> /> ����ˮӡ&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[water_type]" value="2"  <?php if($water_type==2){ ?>checked <?php } ?> /> ͼƬˮӡ
</td>
</tr>

<tr>
<td class="tl">ˮӡͼƬ�����ֱ߾�</td>
<td><input name="setting[water_margin]" type="text" value="<?php echo $water_margin;?>" size="5"> px <?php tips('ˮӡͼƬ��������ԭͼ�ı߾�');?>
</td>
</tr>
<tr>
<td class="tl">ͼƬ��������</td>
<td><input name="setting[water_min_wh]" type="text" value="<?php echo $water_min_wh;?>" size="5"> px <?php tips('ͼƬ��Ȼ��߸߶�С�ڴ�ֵ������ˮӡ����');?>
</td>
</tr>
<tr>
<td class="tl">ˮӡλ��</td>
<td>
	<table cellspacing="1" cellpadding="5" width="150" bgcolor="#DDDDDD">
	<tr align="center" bgcolor="#F1F2F3">
	<td onmouseover="this.style.backgroundColor='#FEB685'" onmouseout="this.style.backgroundColor='#F1F2F3'"> <input type="radio" name="setting[water_pos]" value="1" <?php if($water_pos==1){ ?>checked <?php } ?>/> </td>
	<td onmouseover="this.style.backgroundColor='#FEB685'" onmouseout="this.style.backgroundColor='#F1F2F3'"> <input type="radio" name="setting[water_pos]" value="2" <?php if($water_pos==2){ ?>checked <?php } ?>/></td>
	<td onmouseover="this.style.backgroundColor='#FEB685'" onmouseout="this.style.backgroundColor='#F1F2F3'"> <input type="radio" name="setting[water_pos]" value="3" <?php if($water_pos==3){ ?>checked <?php } ?>/> </td>
	</tr>

	<tr align="center"  bgcolor="#F1F2F3">
	<td onmouseover="this.style.backgroundColor='#FEB685'" onmouseout="this.style.backgroundColor='#F1F2F3'"> <input type="radio" name="setting[water_pos]" value="4" <?php if($water_pos==4){ ?>checked <?php } ?>/> </td>
	<td onmouseover="this.style.backgroundColor='#FEB685'" onmouseout="this.style.backgroundColor='#F1F2F3'"> <input type="radio" name="setting[water_pos]" value="5" <?php if($water_pos==5){ ?>checked <?php } ?>/> </td>
	<td onmouseover="this.style.backgroundColor='#FEB685'" onmouseout="this.style.backgroundColor='#F1F2F3'"> <input type="radio" name="setting[water_pos]" value="6" <?php if($water_pos==6){ ?>checked <?php } ?>/> </td>
	</tr>

	<tr align="center" bgcolor="#F1F2F3">
	<td onmouseover="this.style.backgroundColor='#FEB685'" onmouseout="this.style.backgroundColor='#F1F2F3'"> <input type="radio" name="setting[water_pos]" value="7" <?php if($water_pos==7){ ?>checked <?php } ?>/> </td>
	<td onmouseover="this.style.backgroundColor='#FEB685'" onmouseout="this.style.backgroundColor='#F1F2F3'"> <input type="radio" name="setting[water_pos]" value="8" <?php if($water_pos==8){ ?>checked <?php } ?>/> </td>
	<td onmouseover="this.style.backgroundColor='#FEB685'" onmouseout="this.style.backgroundColor='#F1F2F3'"> <input type="radio" name="setting[water_pos]" value="9" <?php if($water_pos==9){ ?>checked <?php } ?>/> </td>
	</tr>
	<tr align="center" bgcolor="#F1F2F3">
	<td onmouseover="this.style.backgroundColor='#FEB685'" onmouseout="this.style.backgroundColor='#F1F2F3'" colspan="3">��� <input type="radio" name="setting[water_pos]" value="0" <?php if($water_pos==0){ ?>checked <?php } ?>/></td>
	</tr>
	</table>
</tr>
<tr>
<td class="tl">BMPͼƬתJPG��ʽ</td>
<td>
<input type="radio" name="setting[bmp_jpg]" value="1"  <?php if($bmp_jpg==1){ ?>checked <?php } ?> /> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[bmp_jpg]" value="0"  <?php if($bmp_jpg==0){ ?>checked <?php } ?> /> �ر�
<?php tips('BMP��ʽͼƬ����ϴ��Ҳ�����������ͼ�����鿪��');?>
</td>
</tr>
<tr>
<td class="tl">��Դ��ͼ�ӹ�˾��ˮӡ</td>
<td>
<input type="radio" name="setting[water_com]" value="1"  <?php if($water_com==1){ ?>checked <?php } ?> /> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[water_com]" value="0"  <?php if($water_com==0){ ?>checked <?php } ?> /> �ر�
</td>
</tr>
<tr>
<td class="tl">��Դ��ͼ��ˮӡ</td>
<td>
<input type="radio" name="setting[water_middle]" value="1"  <?php if($water_middle==1){ ?>checked <?php } ?> /> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[water_middle]" value="0"  <?php if($water_middle==0){ ?>checked <?php } ?> /> �ر�
</td>
</tr>
<tr>
<td class="tl">��Դ��ͼ���Դ�С</td>
<td><input name="setting[middle_w]" type="text" value="<?php echo $middle_w;?>" size="3"/> X <input name="setting[middle_h]" type="text" value="<?php echo $middle_h;?>" size="3"/> px
</td>
</tr>
<tr>
<td class="tl">��ԴͼƬ����ģʽ</td>
<td>
<input type="radio" name="setting[thumb_album]" value="0"  <?php if($thumb_album==0){ ?>checked <?php } ?> /> �ü�&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[thumb_album]" value="1"  <?php if($thumb_album==1){ ?>checked <?php } ?> /> ѹ��
<?php tips('�ü�ģʽ��ͼƬ��ʾ����������ͼ���ܻᱻ�ö��ಿ��<br/>ѹ��ģʽ��ͼƬ��ʾ����������ͼ���ܻ����ױ�');?>
</td>
</tr>
<tr>
<td class="tl">����ͼƬ����ģʽ</td>
<td>
<input type="radio" name="setting[thumb_title]" value="0"  <?php if($thumb_title==0){ ?>checked <?php } ?> /> �ü�&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[thumb_title]" value="1"  <?php if($thumb_title==1){ ?>checked <?php } ?> /> ѹ��
</td>
</tr>
<tr>
<td class="tl">ͼƬ�ļ������</td>
<td><input name="setting[max_image]" type="text" value="<?php echo $max_image;?>" size="5"/> px
<?php tips('������ʾ��������ޣ������˿�ȵ�ͼƬ�����ȱȵ���Ϊ�˿���Խ�ʡ�洢�ռ�');?>
</td>
</tr>
</table>
</div>

<div id="Tabs5" style="display:none">
<div class="tt">�ʼ�����</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">���ͷ�ʽ</td>
<td>
<input type="radio" name="setting[mail_type]" value="close" <?php if($mail_type=="close"){ ?>checked <?php } ?> id="mailtype_close"/> <label for="mailtype_close">�ر��ʼ�����</label><br/>
<input type="radio" name="setting[mail_type]" value="smtp" <?php if($mail_type=="smtp"){ ?>checked <?php } ?> onclick="Ds('dsmtp');Ds('demail');Dd('l_rn').checked=true;" id="mailtype_smtp"/> <label for="mailtype_smtp">ͨ��SMTP SOCKET ���� SMTP ����������(֧��ESMTP��֤)</label><br/>
<input type="radio" name="setting[mail_type]" value="mail"  <?php if($mail_type=="mail"){ ?>checked <?php } ?> onclick="Dh('dsmtp');Dh('demail');Dd('l_n').checked=true;" id="mailtype_mail"/> <label for="mailtype_mail">ͨ��PHP mail ��������(ͨ��ΪUnix/Linux ����)</label><br/>
<input type="radio" name="setting[mail_type]" value="psmtp"  <?php if($mail_type=="psmtp"){ ?>checked <?php } ?> onclick="Ds('dsmtp');Dh('demail');Dd('l_rn').checked=true;" id="mailtype_psmtp"/> <label for="mailtype_psmtp">ͨ��PHP mail ����SMTP����(ͨ��ΪWIN����)</label>
</td>
</tr>
<tr>
<td class="tl">�ʼ�ͷ�ķָ���</td>
<td><input type="radio" name="setting[mail_delimiter]" value="1" <?php if($mail_delimiter==1){ ?>checked <?php } ?> id="l_rn"/> <label for="l_rn">ʹ�� CRLF ��Ϊ�ָ���(ͨ��ΪWindows����)</label><br/>
<input type="radio" name="setting[mail_delimiter]" value="2" <?php if($mail_delimiter==2){ ?>checked <?php } ?> id="l_n"/> <label for="l_n">ʹ�� LF ��Ϊ�ָ���(ͨ��ΪUnix/Linux����)</label><br/>
<input type="radio" name="setting[mail_delimiter]" value="3" <?php if($mail_delimiter==3){ ?>checked <?php } ?> id="l_r"/> <label for="l_r">ʹ�� CR ��Ϊ�ָ���(ͨ��ΪMac����)</label>
</td>
</tr>
<tbody id="dsmtp" style="display:<?php if($mail_type == "mail") echo 'none';?>">
<tr> 
<td class="tl">SMTP������</td>
<td><input name="setting[smtp_host]" id="smtp_host" type="text" size="40" value="<?php echo $smtp_host;?>"/><?php tips('SMTP������,����smtp.xxx.com<br/>��ʾ:Ŀǰ�󲿷��������������䲢��֧��smtp����');?></td>
</tr>
<tr> 
<td class="tl">SMTP�˿�</td>
<td><input name="setting[smtp_port]" id="smtp_port" type="text" size="5" value="<?php echo $smtp_port;?>"/></td>
</tr>
</tbody>
<tbody id="demail" style="display:<?php if($mail_type != "smtp") echo 'none';?>">
<tr> 
<td class="tl">SMTP�������Ƿ���֤</td>
<td>
<input type="radio" name="setting[smtp_auth]" value="1"  <?php if($smtp_auth==1){ ?>checked <?php } ?> id="smtp_auth" onclick="Ds('dsmtp_user');Ds('dsmtp_pass');"/> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[smtp_auth]" value="0" <?php if($smtp_auth==0){ ?>checked <?php } ?> onclick="Dh('dsmtp_user');Dh('dsmtp_pass');"/> ��
</tr>
<tr id="dsmtp_user" style="display:<?php if(!$smtp_auth) echo 'none';?>">
<td class="tl">�����ʺ�</td>
<td><input name="setting[smtp_user]" id="smtp_user" type="text" size="40" value="<?php echo $smtp_user;?>"/><?php tips('SMTP���������û��ʺ�,һ��Ϊ�ʼ���ַ');?></td>
</tr>
<tr id="dsmtp_pass" style="display:<?php if(!$smtp_auth) echo 'none';?>"> 
<td class="tl">��������</td>
<td><input name="setting[smtp_pass]" type="text" id="smtp_pass" size="40" value="<?php echo $smtp_pass;?>" onfocus="if(this.value.indexOf('**')!=-1)this.value='';"/></td>
</tr>
</tbody>
<tr> 
<td class="tl">�ʼ�ǩ��</td>
<td><textarea name="setting[mail_sign]" id="mail_sign" cols="60" rows="4"><?php echo $mail_sign;?></textarea><?php tips('֧��HTML�﷨');?></td>
</tr>
<tr> 
<td class="tl">����������</td>
<td><input name="setting[mail_sender]" id="mail_sender" type="text" size="40" value="<?php echo $mail_sender;?>"/><?php tips('ϵͳ���͵��ż����Դ��������巢��');?></td>
</tr>
<tr> 
<td class="tl">����������</td>
<td><input name="setting[mail_name]" id="mail_name" type="text" size="40" value="<?php echo $mail_name;?>"/><?php tips('ϵͳ���͵��ż�����ʾ�����ƣ���������ʾ��վ��');?></td>
</tr>
<tr> 
<td class="tl">�����ռ���</td>
<td><input name="testemail" type="text" id="testemail" value="" size="30"/> <input type="button" class="btn" value="���Է���" onclick="TestMail();"/><?php tips('�����������һ�����ղ����ʼ����ʼ���ַ');?></td>
</tr>
<tr> 
<td class="tl">�ʼ����ͼ�¼</td>
<td>
<input type="radio" name="setting[mail_log]" value="1"  <?php if($mail_log) echo 'checked';?>/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[mail_log]" value="0"  <?php if(!$mail_log) echo 'checked';?>/> �ر�
</td>
</tr>
<tr> 
<td class="tl">�Զ�ת��δ��վ����</td>
<td>
<input type="radio" name="setting[message_email]" value="1"  <?php if($message_email) echo 'checked';?>/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[message_email]" value="0"  <?php if(!$message_email) echo 'checked';?>/> �ر�
</td>
</tr>
<tr> 
<td class="tl">�Զ�ת����Ա��</td>
<td><?php echo group_checkbox('setting[message_group][]', $message_group, '1,2,3,4');?></td>
</tr>
<tr> 
<td class="tl">δ��ʱ������</td>
<td><input name="setting[message_time]" type="text" size="5" value="<?php echo $message_time;?>"/> ����
<?php tips('δ��ʱ�䳬����ʱ��ʱ��ʼת��');?></td>
</tr>
<tr> 
<td class="tl">ת���ż�����</td>
<td>
<?php
$NAME = array('��ͨ', '����Ǽ�', '����', '����', '��ʹ');
$message_type = explode(',', $message_type);
foreach($NAME as $k=>$v) {
	$checked = in_array($k, $message_type) ? ' checked' : '';
	echo '<input type="checkbox" name="setting[message_type][]" value="'.$k.'"'.$checked.'/> '.$v.'&nbsp;';
}
?>
</td>
</tr>
</table>
</div>

<div id="Tabs6" style="display:none">
<div class="tt">ҳ��ϸ��</div>
<table cellpadding="2" cellspacing="1" class="tb">




<tr>
<td class="tl">��ҳͼƬ��������</td>
<td><input type="text" name="setting[page_photo]" value="<?php echo $page_photo;?>" size="5"/></td>
</tr>

<tr>
<td class="tl">��ҳ��Ƶ�Ƽ�����</td>
<td><input type="text" name="setting[page_video]" value="<?php echo $page_video;?>" size="5"/></td>
</tr>

<tr>
<td class="tl">��ҳ��ʾ��Ա��¼</td>
<td><input type="radio" name="setting[page_login]" value="1"  <?php if($page_login){ ?>checked <?php } ?>/> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[page_login]" value="0"  <?php if(!$page_login){ ?>checked <?php } ?>/> ��</td>
</tr>

<tr>
<td class="tl">��ҳ��ʾͷ����Ѷ</td>
<td><input type="radio" name="setting[page_newsh]" value="1"  <?php if($page_newsh){ ?>checked <?php } ?>/> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[page_newsh]" value="0"  <?php if(!$page_newsh){ ?>checked <?php } ?>/> ��</td>
</tr>

<tr>
<td class="tl">��ҳ������Ѷ����</td>
<td><input type="text" name="setting[page_news]" value="<?php echo $page_news;?>" size="5"/></td>
</tr>

<tr>
<td class="tl">��ҳ�Ƽ�ר������</td>
<td><input type="text" name="setting[page_special]" value="<?php echo $page_special;?>" size="5"/></td>
</tr>

<tr>
<td class="tl">��ҳ�Ƽ��Ź�����</td>
<td><input type="text" name="setting[page_group]" value="<?php echo $page_group;?>" size="5"/></td>
</tr>

<tr>
<td class="tl">��ҳͶƱ��������</td>
<td><input type="text" name="setting[page_vote]" value="<?php echo $page_vote;?>" size="5"/></td>
</tr>
<tr>
<td class="tl">��ҳͼƬ��������</td>
<td><input type="text" name="setting[page_logo]" value="<?php echo $page_logo;?>" size="5"/></td>
</tr>
<tr>
<td class="tl">��ҳ������������</td>
<td><input type="text" name="setting[page_text]" value="<?php echo $page_text;?>" size="5"/></td>
</tr>
</table>
</div>
<script type="text/javascript">
function TestMail() {
	if(Dd('testemail').value == '') {
		Dalert('��������һ�����ղ����ʼ����ʼ���ַ');
		Dd('testemail').focus();
		return false;
	}
	if(Dd('testemail').value == Dd('mail_sender').value) {
		Dalert('�����ռ����벻Ҫ�뷢������ͬ');
		Dd('testemail').focus();
		return false;
	}
	var url = '?file=setting&action=mail';
	var mail_type = '';
	if(Dd('mailtype_close').checked) mail_type = 'close';
	if(Dd('mailtype_mail').checked) mail_type = 'mail';
	if(Dd('mailtype_smtp').checked) mail_type = 'smtp';
	if(Dd('mailtype_psmtp').checked) mail_type = 'psmtp';
	var mail_delimiter = Dd('l_rn').checked ? 1 : (Dd('l_n').checked ? 2 : 3);
	var smtp_auth = Dd('smtp_auth').checked ? 1 : 0;
	url += '&mail_type='+mail_type+'&mail_delimiter='+mail_delimiter+'&smtp_host='+Dd('smtp_host').value+'&smtp_auth='+smtp_auth+'&smtp_user='+Dd('smtp_user').value+'&smtp_pass='+Dd('smtp_pass').value+'&smtp_port='+Dd('smtp_port').value+'&mail_sender='+Dd('mail_sender').value+'&testemail='+Dd('testemail').value+'&mail_name='+Dd('mail_name').value;
	//window.open(url);
	Diframe(url, 0, 0, 1);
}
</script>
<div class="sbt">
<input type="submit" name="submit" value="ȷ ��" class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" value="չ ��" id="ShowAll" class="btn" onclick="TabAll();" title="չ��/�ϲ�����ѡ��"/>
</div>
</form>
<script type="text/javascript">
var tab = <?php echo $tab;?>;
var all = <?php echo $all;?>;
function TabAll() {
	var i = 0;
	while(1) {
		if(Dd('Tabs'+i) == null) break;
		Dd('Tabs'+i).style.display = all ? (i == tab ? '' : 'none') : '';
		i++;
	}
	Dd('ShowAll').value = all ? 'չ ��' : '�� ��';
	all = all ? 0 : 1;
}
window.onload=function() {
	if(tab) Tab(tab);
	if(all) {all = 0; TabAll();}
}
</script>
<?php include tpl('footer');?>