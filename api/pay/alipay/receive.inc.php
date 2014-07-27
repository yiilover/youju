<?php 
defined('IN_AIJIACMS') or exit('Access Denied');
require AJ_ROOT.'/api/pay/'.$bank.'/notify.class.php';
require AJ_ROOT.'/api/pay/'.$bank.'/config.inc.php';
/*
	*���ܣ���������ת��ҳ��
	*�汾��2.0
	*���ڣ�2008-08-01
	*���ߣ�֧������˾���۲�����֧���Ŷ�
	*��ϵ��0571-26888888
	*��Ȩ��֧������˾
*/

$alipay = new alipay_notify($partner,$security_code,$sign_type,$_input_charset,$transport);
$verify_result = $alipay->return_verify();
/*
 //��ȡ֧�����ķ�������
   //$dingdan    = $out_trade_no;   //��ȡ������
   //$total_fee  = $total_fee;      //��ȡ�ܼ۸�
 
    $receive_name    =$receive_name;    //��ȡ�ջ�������
	$receive_address =$receive_address; //��ȡ�ջ��˵�ַ
	$receive_zip     =$receive_zip;     //��ȡ�ջ����ʱ�
	$receive_phone   =$receive_phone;   //��ȡ�ջ��˵绰
	$receive_mobile  =$receive_mobile;  //��ȡ�ջ����ֻ�
*/

if($verify_result) {    //��֤�ϸ�
	if($out_trade_no != $charge_orderid) {
		$charge_status = 2;
		$charge_errcode = '�����Ų�ƥ��';
		$note = $charge_errcode.'S:'.$charge_orderid.'R:'.$out_trade_no;
		log_result($note);
	} else if($total_fee != $charge_money) {
		$charge_status = 2;
		$charge_errcode = '��ֵ��ƥ��';
		$note = $charge_errcode.'S:'.$charge_money.'R:'.$total_fee;
		log_result($note);
	} else {
		$charge_status = 1;
	}
	//����������Զ������,������ݲ�ͬ��trade_status���в�ͬ����
	//log_result("verify_success"); 
}
function log_result($word) {
	log_write($word, 'ralipay');
}
?>