<?php 
defined('IN_AIJIACMS') or exit('Access Denied');
require AJ_ROOT.'/api/pay/'.$bank.'/service.class.php';
require AJ_ROOT.'/api/pay/'.$bank.'/config.inc.php';
$parameter = array(
	'service' => $service_type,	//�������ͣ�����ʵ�ｻ�ף�trade_create_by_buyer����Ҫ��д������ ������Ʒ���ף�create_digital_goods_trade_p
	'partner' =>$partner,					//�����̻���
	'return_url' =>$return_url,				//ͬ������
	'notify_url' =>$notify_url,				//�첽����
	'_input_charset' => $_input_charset,	//�ַ�����Ĭ��ΪGBK
	'subject' => $AJ['sitename'].'��Ա��ֵ',	//��Ʒ���ƣ�����
	'body' => $charge_title ? $charge_title : '��Ա('.$_username.')�ʻ���ֵ(������:'.$orderid.')',      //��Ʒ����������

	"out_trade_no"   => $orderid,     //��Ʒ�ⲿ���׺ţ������֤Ψһ�ԣ�
	"price"          => $charge,           //��Ʒ���ۣ�����۸���Ϊ0��
	"payment_type"   => "1",              //Ĭ��Ϊ1,����Ҫ�޸�
	"quantity"       => "1",              //��Ʒ����������
		
	"logistics_fee"      =>'0.00',        //�������ͷ���
	"logistics_payment"  =>'SELLER_PAY',   //�������ø��ʽ��SELLER_PAY(����֧��)��BUYER_PAY(���֧��)��BUYER_PAY_AFTER_RECEIVE(��������)
	"logistics_type"     =>'EXPRESS',     //�������ͷ�ʽ��POST(ƽ��)��EMS(EMS)��EXPRESS(�������)

	"show_url"       => $show_url,        //��Ʒ�����վ
	"seller_email"   => $seller_email,     //�������䣬����
	"buyer_email"    =>  $_email,
);

//��URL���
$alipay = new alipay_service($parameter, $security_code, $sign_type);
$URI = $alipay->create_url();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=<?php echo AJ_CHARSET;?>">
<title>������ת��<?php echo $PAY[$bank]['name'];?>����֧��ƽ̨...</title>
<meta http-equiv="refresh" content="0;url=<?php echo $URI;?>">
</head>
<body>
</body>
</html>