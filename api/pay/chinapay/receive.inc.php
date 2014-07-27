<?php
defined('IN_AIJIACMS') or exit('Access Denied');
require AJ_ROOT.'/api/pay/'.$bank.'/netpayclient_config.php';
//���� netpayclient ���
require AJ_ROOT.'/api/pay/'.$bank.'/netpayclient.php';
//���빫Կ�ļ�
$flag = buildKey(PUB_KEY);
if(!$flag) {
	echo "���빫Կ�ļ�ʧ�ܣ�";
	exit;
}
//��ȡ����Ӧ��ĸ���ֵ
$merid = $merid;
$orderno = $orderno;
$transdate = $transdate;
$amount = $amount;
$currencycode = $currencycode;
$transtype = $transtype;
$status = $status;
$checkvalue = $checkvalue;
$gateId = $GateId;
$priv1 = $Priv1;
/*	
	$merid = $_REQUEST["merid"];
	$orderno = $_REQUEST["orderno"];
	$transdate = $_REQUEST["transdate"];
	$amount = $_REQUEST["amount"];
	$currencycode = $_REQUEST["currencycode"];
	$transtype = $_REQUEST["transtype"];
	$status = $_REQUEST["status"];
	$checkvalue = $_REQUEST["checkvalue"];
	$gateId = $_REQUEST["GateId"];
	$priv1 = $_REQUEST["Priv1"];

	echo "�̻���: [$merid]<br/>";
	echo "������: [$orderno]<br/>";
	echo "��������: [$transdate]<br/>";
	echo "�������: [$amount]<br/>";
	echo "���Ҵ���: [$currencycode]<br/>";
	echo "��������: [$transtype]<br/>";
	echo "����״̬: [$status]<br/>";
	echo "���غ�: [$gateId]<br/>";
	echo "��ע: [$priv1]<br/>";
	echo "ǩ��ֵ: [$checkvalue]<br/>";
	echo "===============================<br/>";
*/	
//��֤ǩ��ֵ��true ��ʾ��֤ͨ��
$flag = verifyTransResponse($merid, $orderno, $amount, $currencycode, $transdate, $transtype, $status, $checkvalue);
if($flag) {
	if($status == '1001') {
		//���Ĵ����߼���д�������������ݿ�ȡ�
		//ע�⣺��������ύʱͬʱ��д��ҳ�淵�ص�ַ�ͺ�̨���ص�ַ���ҵ�ַ��ͬ��������������һ�����ݿ��ѯ�ж϶���״̬���Է�ֹ�ظ�����ñʶ���
		if($priv1 != $charge_orderid) {
			$charge_status = 2;
			$charge_errcode = '�����Ų�ƥ��';
			$note = $charge_errcode.'S:'.$charge_orderid.'R:'.$priv1;
			log_write($note, 'rchinapay');
		} else if($amount != padstr($charge_money*100, 12)) {
			$charge_status = 2;
			$charge_errcode = '��ֵ��ƥ��';
			$note = charge_errcode.'S:'.$charge_money.'R:'.$amount;
			log_write($note, 'rchinapay');
		} else {
			$charge_status = 1;
		}
	}
}