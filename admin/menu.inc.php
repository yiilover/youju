<?php
defined('IN_AIJIACMS') or exit('Access Denied');
$menu = array(
	array('����ά��', '?file=database'),
	array('��Ϣͳ��', '?file=count'),
	array('ģ����', '?file=template'),
	array('��ǩ��', '?file=tag'),
	array('��̨����', '?file=search'),
	array('ľ��ɨ��', '?file=scan'),
	array('��̨��־', '?file=log'),
	array('�ϴ���¼', '?file=upload'),
	array('404��־', '?file=404'),
	array('������¼', '?file=keyword'),
	array('������֤', '?file=question'),
	array('�������', '?file=banword'),
	array('�������', '?file=repeat'),
	array('��ֹIP', '?file=banip'),
	array('�༭����', '?file=word'),
	array('��ҳ�ɱ�', '?file=fetch'),
	array('ϵͳ���', '?file=doctor'),
);
if(!$_founder) unset($menu[0],$menu[1],$menu[3]);
$menu_help = array(
	array('ʹ��Э��', '?file=cloud&action=license'),
	array('�����ĵ�', '?file=cloud&action=doc'),
	array('����֧��', '?file=cloud&action=support'),
	array('�ٷ���̳', '?file=cloud&action=bbs'),
	array('��Ϣ����', '?file=cloud&action=feedback'),
	array('������', '?file=cloud&action=update'),
	array('�������', '?file=cloud&action=about'),
);
$menu_system = array(
	array('��վ����', '?file=setting'),
	array('ģ�����', '?file=module'),
	array('��������', '?file=area'),
	array('���з�վ', '?file=city'),
	array('����Ա����', '?file=admin'),
);
?>