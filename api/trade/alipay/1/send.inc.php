<?php
defined('IN_AIJIACMS') or exit('Access Denied');
/* *
 * ���ܣ�ȷ�Ϸ����ӿڽ���ҳ
 * �汾��3.2
 * �޸����ڣ�2011-03-25
 * ˵����
 * ���´���ֻ��Ϊ�˷����̻����Զ��ṩ���������룬�̻����Ը����Լ���վ����Ҫ�����ռ����ĵ���д,����һ��Ҫʹ�øô��롣
 * �ô������ѧϰ���о�֧�����ӿ�ʹ�ã�ֻ���ṩһ���ο���

 *************************ע��*************************
 * ������ڽӿڼ��ɹ������������⣬���԰��������;�������
 * 1���̻��������ģ�https://b.alipay.com/support/helperApply.htm?action=consultationApply�����ύ���뼯��Э�������ǻ���רҵ�ļ�������ʦ������ϵ��Э�����
 * 2���̻��������ģ�http://help.alipay.com/support/232511-16307/0-16307.htm?sh=Y&info_type=9��
 * 3��֧������̳��http://club.alipay.com/read-htm-tid-8681712.html��
 * �������ʹ����չ���������չ���ܲ�������ֵ��
 
 * ȷ�Ϸ���û�з������첽֪ͨҳ�棨notify_url����ҳ����תͬ��֪ͨҳ�棨return_url����
 * ���������󣬸ñʽ��׵�״̬�����˱����֧��������������֪ͨ���̻���վ�����̻���վ�ڵ������׻�˫���ܵĽӿ��еķ������첽֪ͨҳ�棨notify_url��
 * �÷����ӿڽ���Ե������׽ӿڡ�˫���ܽӿ��еĵ�������֧�����漰����Ҫ�����������Ĳ���

 * ���ҿ�ݹ�˾������EXPRESS����ݣ��ķ���
 */


//require_once("alipay.config.php");
require_once AJ_ROOT.'/api/trade/alipay/1/send/alipay_service.class.php';

/**************************�������**************************/

//�������//

//֧�������׺š����ǵ�½֧������վ�ڽ��׹����в�ѯ�õ���һ����8λ���ڿ�ͷ�Ĵ����֣��磺20100419XXXXXXXXXX�� 
$trade_no		= $td['trade_no'];

//������˾����
$logistics_name	= $send_type;

//������������
$invoice_no		= $send_no;

//��������ʱ���������ͣ�����ֵ��ѡ��POST��ƽ�ʣ���EXPRESS����ݣ���EMS��EMS��
$transport_type	= 'EXPRESS';

/************************************************************/

//����Ҫ����Ĳ������飬����Ķ�
$parameter = array(
		"service"			=> "send_goods_confirm_by_platform",
		"partner"			=> trim($aliapy_config['partner']),
		"_input_charset"	=> trim(strtolower($aliapy_config['input_charset'])),
		"trade_no"			=> $trade_no,
		"logistics_name"	=> $logistics_name,
		"invoice_no"		=> $invoice_no,
		"transport_type"	=> $transport_type
);

//����ȷ�Ϸ����ӿ�
$alipayService = new AlipayService($aliapy_config);
$doc = $alipayService->send_goods_confirm_by_platform($parameter);

//������������̻���ҵ���߼��������

//�������������ҵ���߼�����д�������´�������ο�������

//��ȡ֧������֪ͨ���ز������ɲο������ĵ���ҳ����תͬ��֪ͨ�����б�

//����XML
$response = '';
if( ! empty($doc->getElementsByTagName( "response" )->item(0)->nodeValue) ) {
	$response= $doc->getElementsByTagName( "response" )->item(0)->nodeValue;
}

echo $response;

//�������������ҵ���߼�����д�������ϴ�������ο�������

?>