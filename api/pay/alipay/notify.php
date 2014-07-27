<?php
$_DPOST = $_POST;
require '../../../common.inc.php';
$_POST = $_DPOST;
if(!$_POST) exit('fail');
$bank = 'alipay';
$PAY = cache_read('pay.php');
if(!$PAY[$bank]['enable']) exit('fail');
if(!$PAY[$bank]['partnerid']) exit('fail');
if(!$PAY[$bank]['keycode']) exit('fail');
$receive_url = '';
require AJ_ROOT.'/api/pay/'.$bank.'/notify.class.php';
require AJ_ROOT.'/api/pay/'.$bank.'/config.inc.php';
$alipay = new alipay_notify($partner,$security_code,$sign_type,$_input_charset,$transport);
$verify_result = $alipay->notify_verify();
if($verify_result) {
	$r = $db->get_one("SELECT * FROM {$AJ_PRE}finance_charge WHERE itemid='$out_trade_no'");
	if($r) {
		if($r['status'] == 0) {
			$charge_orderid = $r['itemid'];
			$charge_money = $r['amount'] + $r['fee'];
			$charge_amount = $r['amount'];
			$editor = 'N'.$bank;
			if($total_fee == $charge_money) {
				$db->query("UPDATE {$AJ_PRE}finance_charge SET status=3,money=$charge_money,receivetime='$AJ_TIME',editor='$editor' WHERE itemid=$charge_orderid");
				require AJ_ROOT.'/include/module.func.php';
				money_add($r['username'], $r['amount']);
				money_record($r['username'], $r['amount'], $PAY[$bank]['name'], 'system', '���߳�ֵ', '����ID:'.$charge_orderid);
				$MOD = cache_read('module-2.php');
				if($MOD['credit_charge'] > 0) {
					$credit = intval($r['amount']*$MOD['credit_charge']);
					if($credit > 0) {
						credit_add($r['username'], $credit);
						credit_record($r['username'], $credit, 'system', '��ֵ����', '��ֵ'.$r['amount'].$AJ['money_unit']);
					}
				}
				exit('success');
			} else {
				$note = '��ֵ��ƥ��S:'.$charge_money.'R:'.$total_fee;
				$db->query("UPDATE {$AJ_PRE}finance_charge SET status=1,receivetime='$AJ_TIME',editor='$editor',note='$note' WHERE itemid=$charge_orderid");//֧��ʧ��
				exit('fail');
			}
		} else if($r['status'] == 1) {
			exit('fail');
		} else if($r['status'] == 2) {
			exit('fail');
		} else {
			exit('success');
		}
	} else {
		exit('fail');
	}
} 
exit('fail');
?>