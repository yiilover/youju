<?php
$_DPOST = $_POST;
$_DGET = $_GET;
require '../../../../common.inc.php';
$_POST = $_DPOST;
$_GET = $_DGET;
require '../config.inc.php';
if($_GET['seller_email']) $aliapy_config['seller_email'] = $_GET['seller_email'];
#cache_write('ali/'.$api.'-return-server-'.date('Ymdhis').'.php', $_SERVER);
#cache_write('ali/'.$api.'-return-post-'.date('Ymdhis').'.php', $_POST);
#cache_write('ali/'.$api.'-return-get-'.date('Ymdhis').'.php', $_GET);
/* * 
 * ���ܣ�֧����ҳ����תͬ��֪ͨҳ��
 * �汾��3.2
 * ���ڣ�2011-03-25
 * ˵����
 * ���´���ֻ��Ϊ�˷����̻����Զ��ṩ���������룬�̻����Ը����Լ���վ����Ҫ�����ռ����ĵ���д,����һ��Ҫʹ�øô��롣
 * �ô������ѧϰ���о�֧�����ӿ�ʹ�ã�ֻ���ṩһ���ο���

 *************************ҳ�湦��˵��*************************
 * ��ҳ����ڱ������Բ���
 * �ɷ���HTML������ҳ��Ĵ��롢�̻�ҵ���߼��������
 * ��ҳ�����ʹ��PHP�������ߵ��ԣ�Ҳ����ʹ��д�ı�����AlipayFunction.logResult���ú����ѱ�Ĭ�Ϲرգ���alipay_notify_class.php�еĺ���verifyReturn
 
 * WAIT_SELLER_SEND_GOODS(��ʾ�������֧�������׹����в����˽��׼�¼�Ҹ���ɹ���������û�з���);
 */

//require_once("alipay.config.php");
require_once AJ_ROOT.'/api/trade/alipay/1/pay/alipay_notify.class.php';

$alipayNotify = new AlipayNotify($aliapy_config);
$verify_result = $alipayNotify->verifyReturn();
if($verify_result) {//��֤�ɹ�
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//������������̻���ҵ���߼��������
	
	//�������������ҵ���߼�����д�������´�������ο�������
    //��ȡ֧������֪ͨ���ز������ɲο������ĵ���ҳ����תͬ��֪ͨ�����б�
    $out_trade_no	= $_GET['out_trade_no'];	//��ȡ������
    $trade_no		= $_GET['trade_no'];		//��ȡ֧�������׺�
    $total_fee		= $_GET['price'];			//��ȡ�ܼ۸�

	$itemid = $out_trade_no;
	$td = $db->get_one("SELECT * FROM {$AJ_PRE}mall_order WHERE itemid=$itemid");
	$money = $td['amount'] + $td['fee'];
	if(!$td || $total_fee != $money) message('����(Code:002)', $MODULE[2]['linkurl'].'trade.php?error=2');
	$seller = $td['seller'];
	$seller_email = $_GET['seller_email'];
	$buyer = $td['buyer'];
	$buyer_email = $_GET['buyer_email'];
	$mallid = $td['mallid'];
	$timenow = timetodate($AJ_TIME, 3);
	$memberurl = $MODULE[2]['linkurl'];	
	include load('member.lang');

    if($_GET['trade_status'] == 'WAIT_SELLER_SEND_GOODS') {
		//�жϸñʶ����Ƿ����̻���վ���Ѿ����������ɲο������ɽ̡̳��С�3.4�������ݴ�����
			//���û�������������ݶ����ţ�out_trade_no�����̻���վ�Ķ���ϵͳ�в鵽�ñʶ�������ϸ����ִ���̻���ҵ�����
			//���������������ִ���̻���ҵ�����
		if($td['status'] == 1) {
			$db->query("UPDATE {$AJ_PRE}mall_order SET trade_no='$trade_no',status=2,updatetime=$AJ_TIME WHERE itemid=$itemid");
			$db->query("UPDATE {$AJ_PRE}member SET trade='$seller_email',vtrade=1 WHERE username='$seller' AND vtrade=0");
			$db->query("UPDATE {$AJ_PRE}member SET trade='$buyer_email',vtrade=1 WHERE username='$buyer' AND vtrade=0");

			$myurl = userurl($td['buyer']);
			$_username = $td['seller'];
			//send message
			$touser = $td['seller'];
			$title = lang($L['trade_message_t2'], array($itemid));
			$url = $memberurl.'trade.php?itemid='.$itemid;
			$content = lang($L['trade_message_c2'], array($myurl, $_username, $timenow, $url));
			$content = ob_template('messager', 'mail');
			send_message($touser, $title, $content);

			message('��������ɹ�����ȴ����ҷ���', $MODULE[2]['linkurl'].'trade.php?action=order&itemid='.$itemid);
		}
    } else if($_GET['trade_status'] == 'WAIT_BUYER_CONFIRM_GOODS') {
		if(isset($_GET['refund_status'])) {
			if($_GET['refund_status'] == 'WAIT_SELLER_AGREE' && $td['status'] == 3) {//��������˿� �ȴ�����ͬ��
				$db->query("UPDATE {$AJ_PRE}mall_order SET status=5,updatetime=$AJ_TIME WHERE itemid=$itemid");
				message('�����˿�ɹ�����ȴ�������Ӧ', $MODULE[2]['linkurl'].'trade.php?itemid='.$itemid);
			}
		}
		//���ҷ���
		if($td['status'] == 2) {
			$db->query("UPDATE {$AJ_PRE}mall_order SET status=3,updatetime=$AJ_TIME WHERE itemid=$itemid");

			$myurl = userurl($td['seller']);
			$_username = $td['buyer'];
			//send message
			$touser = $td['buyer'];
			$title = lang($L['trade_message_t3'], array($itemid));
			$url = $memberurl.'trade.php?action=order&itemid='.$itemid;
			$content = lang($L['trade_message_c3'], array($myurl, $_username, $timenow, $url));
			$content = ob_template('messager', 'mail');
			send_message($touser, $title, $content);

			message('�����ɹ�����ȴ����ȷ���ջ�', $MODULE[2]['linkurl'].'trade.php?itemid='.$itemid);
		}
    } else if($_GET['trade_status'] == 'TRADE_FINISHED') {
		//�жϸñʶ����Ƿ����̻���վ���Ѿ����������ɲο������ɽ̡̳��С�3.4�������ݴ�����
			//���û�������������ݶ����ţ�out_trade_no�����̻���վ�Ķ���ϵͳ�в鵽�ñʶ�������ϸ����ִ���̻���ҵ�����
			//���������������ִ���̻���ҵ�����
		if($td['status'] == 3) {
			$db->query("UPDATE {$AJ_PRE}mall_order SET status=4,updatetime=$AJ_TIME WHERE itemid=$itemid");
			//������Ʒ����
			$db->query("UPDATE {$AJ_PRE}mall SET orders=orders+1,sales=sales+$td[number],amount=amount-$td[number] WHERE itemid=$mallid");

			$myurl = userurl($td['buyer']);
			$_username = $td['seller'];			
			//send message
			$touser = $td['seller'];
			$title = lang($L['trade_message_t4'], array($itemid));
			$url = $memberurl.'trade.php?itemid='.$itemid;
			$content = lang($L['trade_message_c4'], array($myurl, $_username, $timenow, $url));
			$content = ob_template('messager', 'mail');
			send_message($touser, $title, $content);

			message('���׳ɹ�', $MODULE[2]['linkurl'].'trade.php?action=order&itemid='.$itemid);
		}
	} else if($_GET['trade_status'] == 'WAIT_BUYER_PAY') {
		message('���������ɹ����뾡��ͨ��֧��������', $MODULE[2]['linkurl'].'trade.php?action=order&itemid='.$itemid);
    } else {
      //echo "trade_status=".$_GET['trade_status'];
    }
	
	message('��֤�ɹ�(Code:000)', $MODULE[2]['linkurl'].'trade.php?error=0');
	//echo "��֤�ɹ�<br />";
	//echo "trade_no=".$trade_no;

	//�������������ҵ���߼�����д�������ϴ�������ο�������
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
else {
    //��֤ʧ��
    //��Ҫ���ԣ��뿴alipay_notify.phpҳ���return_verify�������ȶ�sign��mysign��ֵ�Ƿ���ȣ����߼��$veryfy_result��û�з���true
    message('��֤ʧ��(Code:001)', $MODULE[2]['linkurl'].'trade.php?error=1');
}
?>