<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
$menus = array (
    array('��������'),
    array('SEO�Ż�'),
    array('Ȩ���շ�'),
    array('�����ֶ�', 'javascript:Dwidget(\'?file=fields&tb='.$table.'\', \'['.$MOD['name'].']�����ֶ�\');'),
    array('ģ�����', 'javascript:Dwidget(\'?file=template&dir='.$module.'\', \'['.$MOD['name'].']ģ�����\');'),
);
show_menu($menus);
?>
<form method="post" action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="tab" id="tab" value="<?php echo $tab;?>"/>
<div id="Tabs0" style="display:">
<div class="tt">��������</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">��Ϣ����ʽ</td>
<td>
<input type="text" size="50" name="setting[order]" value="<?php echo $order;?>" id="order"/>
<select onchange="if(this.value) Dd('order').value=this.value;">
<option value="">��ѡ��</option>
<option value="vip desc"<?php if($order == 'vip desc') echo ' selected';?>><?php echo VIP;?>����</option>
<option value="userid desc"<?php if($order == 'userid desc') echo ' selected';?>>��ԱID</option>
</select>
</td>
</tr>
<tr>
<td class="tl">�б���������ֶ�</td>
<td><input type="text" size="80" name="setting[fields]" value="<?php echo $fields;?>"/><?php tips('�������һ���̶�������б������Ч�ʣ����������޸����⵼��SQL����');?></td>
</tr>
<tr>
<td class="tl">���ݷֱ�</td>
<td>
<input type="radio" name="setting[split]" value="1"  <?php if($split) echo 'checked';?> onclick="Ds('split_b');Dh('split_a');confirm('��ʾ:����֮ǰ�����Ȳ������\n\n�����ñȽϹؼ����������鲻Ҫ�ٹر�');"/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[split]" value="0"  <?php if(!$split) echo 'checked';?> onclick="Ds('split_a');Dh('split_b');confirm('��ʾ:�ر�֮ǰ�����Ⱥϲ�����');"/> �ر�
&nbsp;&nbsp;
<span style="display:none;" id="split_a">
<a href="?file=split&mid=<?php echo $moduleid;?>&action=merge" target="_blank" class="t" onclick="return confirm('ȷ��Ҫ�ϲ������𣿺ϲ��ɹ�֮���������ر����ݷֱ�\n\n�����ںϲ�֮ǰ����һ�����ݿ�');">[�ϲ�����]</a>
</span>
<span style="display:none;" id="split_b">
<a href="?file=split&mid=<?php echo $moduleid;?>" target="_blank" class="t" onclick="return confirm('ȷ��Ҫ��������𣿺ϲ��ɹ�֮���������������ݷֱ�\n\n�����ڲ��֮ǰ����һ�����ݿ�');">[�������]</a>
</span>
&nbsp;<?php tips('����������ݷֱ����ݱ�����id��50�����ݴ���һ������<br/>��������������50������Ҫ��������ǰ���idΪ'.$maxid.'��'.($maxid > 500000 ? '���鿪��' : '���迪��').'<br/>�����Ҫ���������ȵ������ݣ�Ȼ�󱣴�����<br/>�����Ҫ�رգ����ȵ�ϲ����ݣ�Ȼ�󱣴�����<br/>����һ���������벻Ҫ����رգ��������δ֪����ͬʱȫ���������ر�');?>
<input type="hidden" name="maxid" value="<?php echo $maxid;?>"/>
</td>
</tr>
<tr>
<td class="tl">��˾��ҳ��ʾ����</td>
<td>
<input type="radio" name="setting[comment]" value="1"  <?php if($comment){ ?>checked <?php } ?>/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[comment]" value="0"  <?php if(!$comment){ ?>checked <?php } ?>/> �ر� </td>
</tr>
<tr>
<td class="tl">��˾��ҳ��Ϣ���ӵ���վ</td>
<td>
<input type="radio" name="setting[homeurl]" value="1"  <?php if($homeurl){ ?>checked <?php } ?>/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[homeurl]" value="0"  <?php if(!$homeurl){ ?>checked <?php } ?>/> �ر� </td>
</tr>
<tr>
<td class="tl">����δ���ƹ�˾��ҳ</td>
<td>
<input type="radio" name="setting[openall]" value="1"  <?php if($openall){ ?>checked <?php } ?>/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[openall]" value="0"  <?php if(!$openall){ ?>checked <?php } ?>/> �ر� </td>
</tr>
<tr>
<td class="tl"><?php echo VIP;?>�����Զ�ɾ��</td>
<td>
<input type="radio" name="setting[delvip]" value="1"  <?php if($delvip){ ?>checked <?php } ?>/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[delvip]" value="0"  <?php if(!$delvip){ ?>checked <?php } ?>/> �ر�
<?php tips('���ѡ������������֮��ϵͳ�Զ���'.VIP.'��Ա���ó���ͨ��Ա<br/>���ѡ��رգ�������֮�󣬻�Ա���Լ���ʹ��'.VIP.'������Ҫ����Ա�ӹ���'.VIP.'���ֶ�ɾ��');?>
</td>
</tr>
<tr>
<td class="tl"><?php echo VIP;?>ָ���������</td>
<td>
	<table cellpadding="3" cellspacing="1" width="400" bgcolor="#E5E5E5" style="margin:5px;">
	<tr align="center">
	<td>��Ŀ</td>
	<td>ֵ</td>
	<td>���ֵ</td>
	</tr>
	<tr align="center">
	<td>��Ա��<?php echo VIP;?>ָ��</td>
	<td>���</td>
	<td><input type="text" size="2" name="setting[vip_maxgroupvip]" value="<?php echo $vip_maxgroupvip;?>"/></td>
	</tr>
	<tr align="center">
	<td>��ҵ������֤</td>
	<td><input type="text" size="2" name="setting[vip_cominfo]" value="<?php echo $vip_cominfo;?>"/></td>
	<td><?php echo $vip_cominfo;?></td>
	</tr>
	<tr align="center">
	<td>VIP��ݣ���λ��ֵ/�꣩</td>
	<td><input type="text" size="2" name="setting[vip_year]" value="<?php echo $vip_year;?>"/></td>
	<td><input type="text" size="2" name="setting[vip_maxyear]" value="<?php echo $vip_maxyear;?>"/></td>
	</tr>
	<tr align="center">
	<td>5����������֤��</td>
	<td><input type="text" size="2" name="setting[vip_honor]" value="<?php echo $vip_honor;?>"/></td>
	<td><?php echo $vip_honor;?></td>
	</tr>
	</table>
	<span class="f_gray">&nbsp;&nbsp;������ֵ��Ϊ������<?php echo VIP;?>ָ������10�֣������ֵ֮��Ӧ����10</span>
</td>
</tr>

<tr>
<td class="tl">��˾��ҳ��ͼ�ӿ�</td>
<td>
<select name="setting[map]">
<option value="">��ѡ��</option>
<?php
$dirs = list_dir('api/map');
foreach($dirs as $v) {
	$selected = ($map && $v['dir'] == $map) ? 'selected' : '';
	echo "<option value='".$v['dir']."' ".$selected.">".$v['name']."</option>";
}
echo '</select>';
tips('λ��./api/map/Ŀ¼,һ��Ŀ¼��Ϊһ����ͼ�ӿڣ���ע�����ö�Ӧ��config.inc.php�ļ�Ĭ�������key<br/>�벻ҪƵ�������ӿڣ������û�������ʧЧ��');
?>
</td> 
</tr>


<tr>
<td class="tl">��˾��ҳͳ�ƽӿ�</td>
<td>
<select name="setting[stats]">
<option value="">��ѡ��</option>
<?php
$dirs = list_dir('api/stats');
foreach($dirs as $v) {
	$selected = ($stats && $v['dir'] == $stats) ? 'selected' : '';
	echo "<option value='".$v['dir']."' ".$selected.">".$v['name']."</option>";
}
echo '</select>';
tips('λ��./api/stats/Ŀ¼,һ��Ŀ¼��Ϊһ��ͳ�ƽӿ�<br/>�벻ҪƵ�������ӿڣ������û�������ʧЧ��');
?>
</td> 
</tr>

<tr>
<td class="tl">��˾��ҳ�ͷ��ӿ�</td>
<td>
<select name="setting[kf]">
<option value="">��ѡ��</option>
<?php
$dirs = list_dir('api/kf');
foreach($dirs as $v) {
	$selected = ($kf && $v['dir'] == $kf) ? 'selected' : '';
	echo "<option value='".$v['dir']."' ".$selected.">".$v['name']."</option>";
}
echo '</select>';
tips('λ��./api/kf/Ŀ¼,һ��Ŀ¼��Ϊһ���ͷ��ӿ�<br/>�벻ҪƵ�������ӿڣ������û�������ʧЧ��');
?>
</td> 
</tr>

<tr>
<td class="tl">�������ı���</td>
<td>
<input type="text" name="setting[level]" style="width:98%;" value="<?php echo $level;?>"/>
<br/>�� | �ָ���ͬ���� ���ζ�Ӧ 1|2|3|4|5|6|7|8|9 �� <?php echo level_select('post[level]', '�ύ����Ԥ��Ч��');?>
</td>
</tr>

<tr>
<td class="tl">��ҳ�����Ƽ�����</td>
<td><input type="text" size="3" name="setting[page_irec]" value="<?php echo $page_irec;?>"/></td>
</tr>

<tr>
<td class="tl">��ҳ����<?php echo VIP;?>����</td>
<td><input type="text" size="3" name="setting[page_ivip]" value="<?php echo $page_ivip;?>"/></td>
</tr>

<tr>
<td class="tl">��ҳ��ҵ��������</td>
<td><input type="text" size="3" name="setting[page_inews]" value="<?php echo $page_inews;?>"/></td>
</tr>

<tr>
<td class="tl">��ҳ���¼�������</td>
<td><input type="text" size="3" name="setting[page_inew]" value="<?php echo $page_inew;?>"/></td>
</tr>

<tr>
<td class="tl">�б���Ϣ��ҳ����</td>
<td><input type="text" size="3" name="setting[pagesize]" value="<?php echo $pagesize;?>"/></td>
</tr>


<tr>
<td class="tl">�������������</td>
<td><input type="text" size="3" name="setting[page_subcat]" value="<?php echo $page_subcat;?>"/></td>
</tr>

</table>
</div>

<div id="Tabs1" style="display:none">
<div class="tt">SEO�Ż�</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">��ҳ�Ƿ�����html</td>
<td>
<input type="radio" name="setting[index_html]" value="1"  <?php if($index_html){ ?>checked <?php } ?>/> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[index_html]" value="0"  <?php if(!$index_html){ ?>checked <?php } ?>/> ��
</td>
</tr>
<tr>
<td class="tl">�б�ҳ�Ƿ�����html</td>
<td>
<input type="radio" name="setting[list_html]" value="1"  <?php if($list_html){ ?>checked <?php } ?> onclick="Dd('list_html').style.display='';Dd('list_php').style.display='none';"/> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[list_html]" value="0"  <?php if(!$list_html){ ?>checked <?php } ?> onclick="Dd('list_html').style.display='none';Dd('list_php').style.display='';"/> ��
</td>
</tr>
<tbody id="list_html" style="display:<?php echo $list_html ? '' : 'none'; ?>">
<tr>
<td class="tl">HTML�б�ҳ�ļ���ǰ׺</td>
<td><input name="setting[htm_list_prefix]" type="text" id="htm_list_prefix" value="<?php echo $htm_list_prefix;?>" size="10"></td>
</tr>
<tr>
<td class="tl">HTML�б�ҳ��ַ����</td>
<td><?php echo url_select('setting[htm_list_urlid]', 'htm', 'list', $htm_list_urlid);?><?php tips('��ʾ:�����б����./api/url.inc.php�ļ����Զ���');?></td>
</tr>
</tbody>
<tr id="list_php" style="display:<?php echo $list_html ? 'none' : ''; ?>">
<td class="tl">PHP�б�ҳ��ַ����</td>
<td><?php echo url_select('setting[php_list_urlid]', 'php', 'list', $php_list_urlid);?></td>
</tr>

<tr>
<td class="tl">ģ����ҳTitle<br/>(��ҳ����)</td>
<td><input name="setting[seo_title_index]" type="text" id="seo_title_index" value="<?php echo $seo_title_index;?>" style="width:90%;"/><br/> 
���ñ�����<?php echo seo_title('seo_title_index', array('modulename', 'sitename', 'sitetitle', 'page', 'delimiter'));?><br/>
֧��ҳ��PHP����������{$MOD[name]}��ʾģ������
</td>
</tr>
<tr>
<td class="tl">ģ����ҳKeywords<br/>(��ҳ�ؼ���)</td>
<td><input name="setting[seo_keywords_index]" type="text" id="seo_keywords_index" value="<?php echo $seo_keywords_index;?>" style="width:90%;"/><br/> 
<?php echo seo_title('seo_keywords_index', array('modulename', 'sitename', 'sitetitle'));?>
</td>
</tr>
<tr>
<td class="tl">ģ����ҳDescription<br/>(��ҳ����)</td>
<td><input name="setting[seo_description_index]" type="text" id="seo_description_index" value="<?php echo $seo_description_index;?>" style="width:90%;"/><br/> 
<?php echo seo_title('seo_description_index', array('modulename', 'sitename', 'sitetitle'));?>
</td>
</tr>

<tr>
<td class="tl">�б�ҳTitle<br/>(��ҳ����)</td>
<td><input name="setting[seo_title_list]" type="text" id="seo_title_list" value="<?php echo $seo_title_list;?>" style="width:90%;"/><br/> 
<?php echo seo_title('seo_title_list', array('catname', 'cattitle', 'modulename', 'sitename', 'sitetitle', 'page', 'delimiter'));?>
</td>
</tr>
<tr>
<td class="tl">�б�ҳKeywords<br/>(��ҳ�ؼ���)</td>
<td><input name="setting[seo_keywords_list]" type="text" id="seo_keywords_list" value="<?php echo $seo_keywords_list;?>" style="width:90%;"/><br/> 
<?php echo seo_title('seo_keywords_list', array('catname', 'catkeywords', 'modulename', 'sitename', 'sitekeywords'));?></td>
</tr>
<tr>
<td class="tl">�б�ҳDescription<br/>(��ҳ����)</td>
<td><input name="setting[seo_description_list]" type="text" id="seo_description_list" value="<?php echo $seo_description_list;?>" style="width:90%;"/><br/> 
<?php echo seo_title('seo_description_list', array('catname', 'catdescription', 'modulename', 'sitename', 'sitedescription'));?></td>
</tr>

<tr>
<td class="tl">����ҳTitle<br/>(��ҳ����)</td>
<td><input name="setting[seo_title_show]" type="text" id="seo_title_show" value="<?php echo $seo_title_show;?>" style="width:90%;"/><br/>
<?php echo seo_title('seo_title_show', array('showtitle', 'catname', 'cattitle', 'modulename', 'sitename', 'sitetitle', 'delimiter'));?>
</td>
</tr>
<tr>
<td class="tl">����ҳKeywords<br/>(��ҳ�ؼ���)</td>
<td><input name="setting[seo_keywords_show]" type="text" id="seo_keywords_show" value="<?php echo $seo_keywords_show;?>" style="width:90%;"/><br/>
<?php echo seo_title('seo_keywords_show', array('showtitle', 'catname', 'catkeywords', 'modulename', 'sitename', 'sitekeywords'));?>
</td>
</tr>
<tr>
<td class="tl">����ҳDescription<br/>(��ҳ����)</td>
<td><input name="setting[seo_description_show]" type="text" id="seo_description_show" value="<?php echo $seo_description_show;?>" style="width:90%;"/><br/>
<?php echo seo_title('seo_description_show', array('showtitle', 'showintroduce', 'catname', 'catdescription', 'modulename', 'sitename', 'sitedescription'));?>
</td>
</tr>
</table>
</div>

<div id="Tabs2" style="display:none">
<div class="tt">Ȩ���շ�</div>
<table cellpadding="2" cellspacing="1" class="tb">

<tr>
<td class="tl">�������ģ����ҳ</td>
<td><?php echo group_checkbox('setting[group_index][]', $group_index);?></td>
</tr>
<tr>
<td class="tl">������������б�</td>
<td><?php echo group_checkbox('setting[group_list][]', $group_list);?></td>
</tr>

<tr>
<td class="tl">����������Ϣ</td>
<td><?php echo group_checkbox('setting[group_search][]', $group_search);?></td>
</tr>

<tr>
<td class="tl">����鿴��˾��ҳ��ϵ��ʽ</td>
<td><?php echo group_checkbox('setting[group_contact][]', $group_contact);?></td>
</tr>

<tr>
<td class="tl">����鿴��˾��ҳ�ɹ��б�</td>
<td><?php echo group_checkbox('setting[group_buy][]', $group_buy);?></td>
</tr>

<tr>
<td class="tl">�����ڹ�˾��ҳ����</td>
<td><?php echo group_checkbox('setting[group_message][]', $group_message);?></td>
</tr>

<tr>
<td class="tl">�����ڹ�˾��ҳѯ��</td>
<td><?php echo group_checkbox('setting[group_inquiry][]', $group_inquiry);?></td>
</tr>

<tr>
<td class="tl">�����ڹ�˾��ҳ����</td>
<td><?php echo group_checkbox('setting[group_price][]', $group_price);?></td>
</tr>

</table>
</div>

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