<?php
defined('IN_AIJIACMS') or exit('Access Denied');
$menu = array(
	array('��ӻ�Ա', '?moduleid=2&action=add'),
	array('��Ա�б�', '?moduleid=2'),
	array('��˻�Ա', '?moduleid=2&action=check'),
	array(VIP.'����', '?moduleid=4&file=vip'),
	array('��ϵ��Ա', '?moduleid=2&file=contact'),
	array('���߻�Ա', '?moduleid=2&file=online'),
	array('���߶Ի�', '?moduleid=2&file=chat'),
	array('һ����¼', '?moduleid=2&file=oauth'),
	array('��Ա����', '?moduleid=2&file=grade&action=check'),
	array('��Ա�����', '?moduleid=2&file=group'),
	array('ģ������', '?moduleid=2&file=setting'),
);
$menu_finance = array(
	array($AJ['money_name'].'����', '?moduleid=2&file=record'),
	array($AJ['credit_name'].'����', '?moduleid=2&file=credit'),
	array('���Ź���', '?moduleid=2&file=sms&action=record'),
	array('��ֵ��¼', '?moduleid=2&file=charge'),
	array('���ּ�¼', '?moduleid=2&file=cash'),
	array('��Ϣ֧��', '?moduleid=2&file=pay'),
	array('��ֵ������', '?moduleid=2&file=card'),
	array('�Ż������', '?moduleid=2&file=promo'),
);
$menu_relate = array(
	array('������֤', '?moduleid=2&file=validate'),
	array('�ֻ�����', '?moduleid=2&file=sendsms'),
	array('�����ʼ�', '?moduleid=2&file=sendmail'),
	array('�ͷ�����', '?moduleid=2&file=ask'),
	array('ó������', '?moduleid=2&file=alert'),
	array('�ʼ�����', '?moduleid=2&file=mail'),
	array('վ���ż�', '?moduleid=2&file=message'),
	array('��Դ�ղ�', '?moduleid=2&file=favorite'),
	array('��Ա����', '?moduleid=2&file=friend'),
	array('�ջ���ַ', '?moduleid=2&file=address'),
	array('��¼��־', '?moduleid=2&file=loginlog'),
);
if(!$_founder) unset($menu_relate[7]);
?>