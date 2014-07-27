<?php
defined('IN_AIJIACMS') or exit('Access Denied');
set_cookie('trade_id', $itemid);
require_once AJ_ROOT.'/api/trade/alipay/1/pay/alipay_service.class.php';
/**************************�������**************************/

//�������//

$out_trade_no		= $itemid;		//�������վ����ϵͳ�е�Ψһ������ƥ��
$subject			= $td['title'];	//�������ƣ���ʾ��֧��������̨��ġ���Ʒ���ơ����ʾ��֧�����Ľ��׹���ġ���Ʒ���ơ����б��
$body				= $td['note'];	//����������������ϸ��������ע����ʾ��֧��������̨��ġ���Ʒ��������
$price				= $money;	//�����ܽ���ʾ��֧��������̨��ġ�Ӧ���ܶ��

$logistics_fee		= "0.00";				//�������ã����˷ѡ�
$logistics_type		= "EXPRESS";			//�������ͣ�����ֵ��ѡ��EXPRESS����ݣ���POST��ƽ�ʣ���EMS��EMS��
$logistics_payment	= "SELLER_PAY";			//����֧����ʽ������ֵ��ѡ��SELLER_PAY�����ҳе��˷ѣ���BUYER_PAY����ҳе��˷ѣ�

$quantity			= "1";					//��Ʒ����������Ĭ��Ϊ1�����ı�ֵ����һ�ν��׿�����һ���¶������ǹ���һ����Ʒ��

//ѡ�����//

//����ջ���Ϣ���Ƽ���Ϊ���
//�ù���������������Ѿ����̻���վ���µ����������һ���ջ���Ϣ��������Ҫ�����֧�����ĸ����������ٴ���д�ջ���Ϣ��
//��Ҫʹ�øù��ܣ������ٱ�֤receive_name��receive_address��ֵ
//�ջ���Ϣ��ʽ���ϸ�����������ַ���ʱࡢ�绰���ֻ��ĸ�ʽ��д
$receive_name		= $td['buyer_name'];			//�ջ����������磺����
$receive_address	= $td['buyer_address'];			//�ջ��˵�ַ���磺XXʡXXX��XXX��XXX·XXXС��XXX��XXX��ԪXXX��
$receive_zip		= $td['buyer_postcode'];				//�ջ����ʱ࣬�磺123456
$receive_phone		= $td['buyer_phone'];		//�ջ��˵绰���룬�磺0571-81234567
$receive_mobile		= $td['buyer_phone'];		//�ջ����ֻ����룬�磺13312341234

//��վ��Ʒ��չʾ��ַ���������?id=123�����Զ������
$show_url			= AJ_PATH.'api/trade/alipay/show.php';

/************************************************************/

//����Ҫ����Ĳ�������
$parameter = array(
		"service"			=> "create_partner_trade_by_buyer",
		"payment_type"		=> "1",
		
		"partner"			=> trim($aliapy_config['partner']),
		"_input_charset"	=> trim(strtolower($aliapy_config['input_charset'])),
        "seller_email"		=> trim($aliapy_config['seller_email']),
        "return_url"		=> trim($aliapy_config['return_url']),
        "notify_url"		=> trim($aliapy_config['notify_url']),

        "out_trade_no"		=> $out_trade_no,
        "subject"			=> $subject,
        "body"				=> $body,
        "price"				=> $price,
		"quantity"			=> $quantity,

		"buyer_email" => $_trade,//DT ADD
		
		"logistics_fee"		=> $logistics_fee,
		"logistics_type"	=> $logistics_type,
		"logistics_payment"	=> $logistics_payment,
		
		"receive_name"		=> $receive_name,
		"receive_address"	=> $receive_address,
		"receive_zip"		=> $receive_zip,
		"receive_phone"		=> $receive_phone,
		"receive_mobile"	=> $receive_mobile,
		
        "show_url"			=> $show_url
);

//���쵣�����׽ӿ�
$alipayService = new AlipayService($aliapy_config);
$html_text = $alipayService->create_partner_trade_by_buyer($parameter);
//echo '<textarea>'.$html_text.'</textarea>';exit;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=<?php echo AJ_CHARSET;?>">
<meta http-equiv="cache-control" content="no-cache">
<title>Loading...</title>
</head>
<body onload="document.getElementById('alipaysubmit').submit();">
<?php echo $html_text;?>
</body>
</html>