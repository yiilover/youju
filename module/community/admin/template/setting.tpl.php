<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
$menus = array (
    array('��������'),
    array('SEO�Ż�'),
    array('Ȩ���շ�'),
    array('�����ֶ�', '?file=fields&tb='.$table),
    array('ģ�����', '?file=template&dir='.$module),
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
<td class="tl">Ĭ������ͼ[��X��]</td>
<td>
<input type="text" size="3" name="setting[thumb_width]" value="<?php echo $thumb_width;?>"/>
X
<input type="text" size="3" name="setting[thumb_height]" value="<?php echo $thumb_height;?>"/> px
</td>
</tr>
<tr>
<td class="tl">�Զ���ȡ���������</td>
<td><input type="text" size="3" name="setting[introduce_length]" value="<?php echo $introduce_length;?>"/> �ַ�</td>
</tr>
<tr>
<td class="tl">�༭�����߰�ť</td>
<td>
<select name="setting[editor]">
<option value="Default"<?php if($editor == 'Default') echo ' selected';?>>ȫ��</option>
<option value="aijiacms"<?php if($editor == 'aijiacms') echo ' selected';?>>����</option>
<option value="Simple"<?php if($editor == 'Simple') echo ' selected';?>>���</option>
<option value="Basic"<?php if($editor == 'Basic') echo ' selected';?>>����</option>
</select>
</td>
</tr>
<tr>
<td class="tl">��Ϣ����ʽ</td>
<td>
<input type="text" size="50" name="setting[order]" value="<?php echo $order;?>" id="order"/>
<select onchange="if(this.value) Dd('order').value=this.value;">
<option value="">��ѡ��</option>
<option value="editdate desc,vip desc,edittime desc"<?php if($order == 'editdate desc,vip desc,edittime desc') echo ' selected';?>>��������,<?php echo VIP;?>����,����ʱ��</option>
<option value="adddate desc,vip desc,addtime desc"<?php if($order == 'adddate desc,vip desc,addtime desc') echo ' selected';?>>�������,<?php echo VIP;?>����,���ʱ��</option>
<option value="edittime desc"<?php if($order == 'edittime desc') echo ' selected';?>>����ʱ��</option>
<option value="addtime desc"<?php if($order == 'addtime desc') echo ' selected';?>>���ʱ��</option>
<option value="vip desc"<?php if($order == 'vip desc') echo ' selected';?>><?php echo VIP;?>����</option>
<option value="itemid desc"<?php if($order == 'itemid desc') echo ' selected';?>>��ϢID</option>
</select>
</td>
</tr>
<tr>
<td class="tl">�б���������ֶ�</td>
<td><input type="text" size="80" name="setting[fields]" value="<?php echo $fields;?>"/><?php tips('�������һ���̶�������б������Ч�ʣ����������޸����⵼��SQL����');?></td>
</tr>
<tr>
<td class="tl"><?php echo $MOD['name'];?>���</td>
<td><input type="text" size="80" name="setting[type]" value="<?php echo $type;?>"/><?php tips('��ͬ����� | �ָ������úú�����Ƶ���Ķ�');?></td>
</tr>
<tr>
<td class="tl">����ǼǷ�Դ��Ϣ</td>
<td><input type="text" size="80" name="setting[inquiry_type]" value="<?php echo $inquiry_type;?>"/></td>
</tr>
<tr>
<td class="tl">����Ǽǿ�������</td>
<td>
<textarea name="setting[inquiry_ask]" style="width:98%;height:50px;overflow:visible;"><?php echo $inquiry_ask;?></textarea>
<br/>��ͬ������ | �ָ�
</td>
</tr>
<tr>
<td class="tl">�������Բ���</td>
<td>
<input type="radio" name="setting[cat_property]" value="1"  <?php if($cat_property) echo 'checked';?>/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[cat_property]" value="0"  <?php if(!$cat_property) echo 'checked';?>/> �ر�
</td>
</tr>
<tr>
<td class="tl">��������Զ��ͼƬ</td>
<td>
<input type="radio" name="setting[save_remotepic]" value="1"  <?php if($save_remotepic) echo 'checked';?>/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[save_remotepic]" value="0"  <?php if(!$save_remotepic) echo 'checked';?>/> �ر�
</td>
</tr>
<tr>
<td class="tl">�����������</td>
<td>
<input type="radio" name="setting[clear_link]" value="1"  <?php if($clear_link) echo 'checked';?>/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[clear_link]" value="0"  <?php if(!$clear_link) echo 'checked';?>/> �ر�
</td>
</tr>
<tr>
<td class="tl">���ݹ�������</td>
<td>
<input type="radio" name="setting[keylink]" value="1"  <?php if($keylink) echo 'checked';?>/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[keylink]" value="0"  <?php if(!$keylink) echo 'checked';?>/> �ر�
&nbsp;&nbsp;
<a href="?file=keylink&item=<?php echo $moduleid;?>" target="_blank" class="t">[��������]</a>
</td>
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
<td class="tl">Sphinxȫ������</td>
<td>
<input type="radio" name="setting[sphinx]" value="1" <?php if($sphinx) echo 'checked';?> onclick="Ds('sphinx');"/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[sphinx]" value="0" <?php if(!$sphinx) echo 'checked';?> onclick="Dh('sphinx');"/> �ر�
</td>
</tr>
<tbody id="sphinx" style="display:<?php echo $sphinx ? '' : 'none';?>">
<tr>
<td class="tl">Sphinx������ַ</td>
<td><input name="setting[sphinx_host]" type="text" size="20" value="<?php echo $sphinx_host;?>"/><?php tips('Ĭ��Ϊlocalhost��������');?></td>
</tr>
<tr>
<td class="tl">Sphinx�����˿�</td>
<td><input name="setting[sphinx_port]" type="text" size="5" value="<?php echo $sphinx_port;?>"/><?php tips('Ĭ��Ϊ9312��������');?></td>
</tr>
<tr>
<td class="tl">Sphinx��������</td>
<td><input name="setting[sphinx_name]" type="text" size="20" value="<?php echo $sphinx_name;?>"/></td>
</tr>
</tbody>

<tr>
<td class="tl">��ͨȫ������</td>
<td>
<input type="radio" name="setting[fulltext]" value="1" <?php if($fulltext==1){ ?>checked <?php } ?>/> LIKE&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[fulltext]" value="2" <?php if($fulltext==2){ ?>checked <?php } ?>/> MATCH&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[fulltext]" value="0" <?php if($fulltext==0){ ?>checked <?php } ?>/> �ر�
<?php tips('��������ӷ������������������Ҫ�ͷ��������þ����Ƿ�����MATCHģʽ��ҪMySQL 4���ϰ汾������Ҫ��MySQL��my.ini���ft_min_word_len=1����֧��2�����ֵ���������������������ÿ���ʹ��LIKEģʽ������Ч�ʻ����MATCHģʽ��<br/>����MATCHģʽ�������ݿ�ά����ִ������SQL���ȫ������<br/>ALTER TABLE `'.$table_data.'` ADD FULLTEXT (`content`);<br/>ȫ������ռ��һ�����ݿռ䣬���������MATCHģʽ����ִ���������ɾ������<br/>ALTER TABLE `'.$table_data.'` DROP INDEX `content`;');?></td>
</tr>
<tr>
<td class="tl">�������ı���</td>
<td>
<input type="text" name="setting[level]" style="width:98%;" value="<?php echo $level;?>"/>
<br/>�� | �ָ���ͬ���� ���ζ�Ӧ 1|2|3|4|5|6|7|8|9 �� <?php echo level_select('post[level]', '�ύ����Ԥ��Ч��');?>
</td>
</tr>
<tr>
<td class="tl">�༭��������ͼ</td>
<td>
<input type="radio" name="setting[swfu]" value="0"  <?php if($swfu==0) echo 'checked';?>/> �ر�&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[swfu]" value="1"  <?php if($swfu==1) echo 'checked';?>/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[swfu]" value="2"  <?php if($swfu==2) echo 'checked';?>/> ��̨���� <?php tips('�����󣬱༭���½�����������ͼ���ܣ��������ݲ���ͼƬ');?>
</td>
</tr>
<tr>
<td class="tl">��Ա�����ϴ�һ�ŷ�Դͼ</td>
<td>
<input type="radio" name="setting[upload_thumb]" value="1"  <?php if($upload_thumb) echo 'checked';?>/> ����&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[upload_thumb]" value="0"  <?php if(!$upload_thumb) echo 'checked';?>/> �ر�
<?php tips('�������һ���̶������Ϣ����������������Ϣ');?>
</td>
</tr>

<tr>
<td class="tl">�б���Ϣ��ҳ����</td>
<td><input type="text" size="3" name="setting[pagesize]" value="<?php echo $pagesize;?>"/></td>
</tr>

<tr>
<td class="tl">����ͼƬ�����</td>
<td><input type="text" size="3" name="setting[max_width]" value="<?php echo $max_width;?>"/> px</td>
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
<td class="tl">����ҳ�Ƿ�����html</td>
<td>
<input type="radio" name="setting[show_html]" value="1"  <?php if($show_html){ ?>checked <?php } ?> onclick="Dd('show_html').style.display='';Dd('show_php').style.display='none';"/> ��&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[show_html]" value="0"  <?php if(!$show_html){ ?>checked <?php } ?> onclick="Dd('show_html').style.display='none';Dd('show_php').style.display='';"/> ��
</td>
</tr>
<tbody id="show_html" style="display:<?php echo $show_html ? '' : 'none'; ?>">
<tr>
<td class="tl">HTML����ҳ�ļ���ǰ׺</td>
<td><input name="setting[htm_item_prefix]" type="text" id="htm_item_prefix" value="<?php echo $htm_item_prefix;?>" size="10"></td>
</tr>
<tr>
<td class="tl">HTML����ҳ��ַ����</td>
<td><?php echo url_select('setting[htm_item_urlid]', 'htm', 'item', $htm_item_urlid);?></td>
</tr>
</tbody>
<tr id="show_php" style="display:<?php echo $show_html ? 'none' : ''; ?>">
<td class="tl">PHP����ҳ��ַ����</td>
<td><?php echo url_select('setting[php_item_urlid]', 'php', 'item', $php_item_urlid);?></td>
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
<tr>
<td class="tl">����ҳTitle<br/>(��ҳ����)</td>
<td><input name="setting[seo_title_search]" type="text" id="seo_title_search" value="<?php echo $seo_title_search;?>" style="width:90%;"/><br/> 
<?php echo seo_title('seo_title_search', array('kw', 'areaname', 'catname', 'cattitle', 'modulename', 'sitename', 'sitetitle', 'page', 'delimiter'));?>
</td>
</tr>
<tr>
<td class="tl">����ҳKeywords<br/>(��ҳ�ؼ���)</td>
<td><input name="setting[seo_keywords_search]" type="text" id="seo_keywords_search" value="<?php echo $seo_keywords_search;?>" style="width:90%;"/><br/> 
<?php echo seo_title('seo_keywords_search', array('kw', 'areaname', 'catname', 'catkeywords', 'modulename', 'sitename', 'sitekeywords'));?>
</td>
</tr>
<tr>
<td class="tl">����ҳDescription<br/>(��ҳ����)</td>
<td><input name="setting[seo_description_search]" type="text" id="seo_description_search" value="<?php echo $seo_description_search;?>" style="width:90%;"/><br/> 
<?php echo seo_title('seo_description_search', array('kw', 'areaname', 'catname', 'catdescription', 'modulename', 'sitename', 'sitedescription'));?>
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
<td class="tl">���������Ϣ����</td>
<td><?php echo group_checkbox('setting[group_show][]', $group_show);?></td>
</tr>
<tr>
<td class="tl">���������ϵ��ʽ</td>
<td><?php echo group_checkbox('setting[group_contact][]', $group_contact);?></td>
</tr>
<tr>
<td class="tl">����������Ϣ</td>
<td><?php echo group_checkbox('setting[group_search][]', $group_search);?></td>
</tr>
<tr>
<td class="tl">�������ñ�����ɫ</td>
<td><?php echo group_checkbox('setting[group_color][]', $group_color);?></td>
</tr>
<tr>
<td class="tl">ˢ����Ϣ���ۻ���</td>
<td><?php echo group_checkbox('setting[group_refresh][]', $group_refresh);?></td>
</tr>
<tr>
<td class="tl">����Ա���Ϣ</td>
<td><?php echo group_checkbox('setting[group_compare][]', $group_compare);?></td>
</tr>
<tr>
<td class="tl">���������Ƽ�����վ��ҳ</td>
<td><?php echo group_checkbox('setting[group_elite][]', $group_elite);?></td>
</tr>
<tr>
<td class="tl">����Ǽ�������֤��</td>
<td>
<input type="radio" name="setting[captcha_inquiry]" value="2"  <?php if($captcha_inquiry == 2) echo 'checked';?>> �̳л�Ա������&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[captcha_inquiry]" value="1"  <?php if($captcha_inquiry == 1) echo 'checked';?>> ȫ������&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[captcha_inquiry]" value="0"  <?php if($captcha_inquiry == 0) echo 'checked';?>> ȫ���ر�
</td>
</tr>
<tr>
<td class="tl">����Ǽ�����������</td>
<td>
<input type="radio" name="setting[question_inquiry]" value="2"  <?php if($question_inquiry == 2) echo 'checked';?>> �̳л�Ա������&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[question_inquiry]" value="1"  <?php if($question_inquiry == 1) echo 'checked';?>> ȫ������&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[question_inquiry]" value="0"  <?php if($question_inquiry == 0) echo 'checked';?>> ȫ���ر�
</td>
</tr>
<tr>
<td class="tl">��˷�����Ϣ</td>
<td>
<input type="radio" name="setting[check_add]" value="2"  <?php if($check_add == 2) echo 'checked';?>> �̳л�Ա������&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[check_add]" value="1"  <?php if($check_add == 1) echo 'checked';?>> ȫ������&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[check_add]" value="0"  <?php if($check_add == 0) echo 'checked';?>> ȫ���ر�
</td>
</tr>
<tr>
<td class="tl">������Ϣ������֤��</td>
<td>
<input type="radio" name="setting[captcha_add]" value="2"  <?php if($captcha_add == 2) echo 'checked';?>> �̳л�Ա������&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[captcha_add]" value="1"  <?php if($captcha_add == 1) echo 'checked';?>> ȫ������&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[captcha_add]" value="0"  <?php if($captcha_add == 0) echo 'checked';?>> ȫ���ر�
</td>
</tr>
<tr>
<td class="tl">������Ϣ����������</td>
<td>
<input type="radio" name="setting[question_add]" value="2"  <?php if($question_add == 2) echo 'checked';?>> �̳л�Ա������&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[question_add]" value="1"  <?php if($question_add == 1) echo 'checked';?>> ȫ������&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[question_add]" value="0"  <?php if($question_add == 0) echo 'checked';?>> ȫ���ر�
</td>
</tr>
<tr>
<td class="tl">��Ա�Ƿ��շ�</td>
<td>
<input type="radio" name="setting[fee_mode]" value="1"  <?php if($fee_mode == 1) echo 'checked';?>> �̳л�Ա������&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[fee_mode]" value="0"  <?php if($fee_mode == 0) echo 'checked';?>> ȫ������
</td>
</tr>
<tr>
<td class="tl">��Ա�շ�ʹ��</td>
<td>
<input type="radio" name="setting[fee_currency]" value="money"  <?php if($fee_currency == 'money') echo 'checked';?>/> <?php echo $AJ['money_name'];?>&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="setting[fee_currency]" value="credit"  <?php if($fee_currency == 'credit') echo 'checked';?>/> <?php echo $AJ['credit_name'];?>
</td>
</tr>
<tr>
<td class="tl">������Ϣ�շ�</td>
<td><input type="text" size="5" name="setting[fee_add]" value="<?php echo $fee_add;?>"/> <?php echo $fee_currency == 'money' ? $AJ['money_unit'] : $AJ['credit_unit'];?>/��</td>
</tr>
<tr>
<td class="tl">�鿴��Ϣ�շ�</td>
<td><input type="text" size="5" name="setting[fee_view]" value="<?php echo $fee_view;?>"/> <?php echo $fee_currency == 'money' ? $AJ['money_unit'] : $AJ['credit_unit'];?>/��</td>
</tr>
<tr>
<td class="tl">�շ���Чʱ��</td>
<td><input type="text" size="5" name="setting[fee_period]" value="<?php echo $fee_period;?>"/> ���� <?php tips('���֧��ʱ�䳬����Чʱ�䣬ϵͳ�������շ�<br/>�����ʾ���ظ��շ�');?></td>
</tr>
</table>
<div class="tt"><?php echo $AJ['credit_name'];?>����</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl">������Ϣ����</td>
<td>
<input type="text" size="5" name="setting[credit_add]" value="<?php echo $credit_add;?>"/>
</td>
</tr>
<tr>
<td class="tl">��Ϣ��ɾ���۳�</td>
<td>
<input type="text" size="5" name="setting[credit_del]" value="<?php echo $credit_del;?>"/>
</td>
</tr>
<tr>
<td class="tl">��Ϣ������ɫ�۳�</td>
<td>
<input type="text" size="5" name="setting[credit_color]" value="<?php echo $credit_color;?>"/>
</td>
</tr>
<tr>
<td class="tl">�Ƽ�����վ��ҳ�۳�</td>
<td>
<input type="text" size="5" name="setting[credit_elite]" value="<?php echo $credit_elite;?>"/>
</td>
</tr>
<tr>
<td class="tl">ˢ��һ����Ϣһ�ο۳�</td>
<td>
<input type="text" size="5" name="setting[credit_refresh]" value="<?php echo $credit_refresh;?>"/>
</td>
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