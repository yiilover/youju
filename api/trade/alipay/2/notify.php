<?php
$_DPOST = $_POST;
$_DGET = $_GET;
require '../../../../common.inc.php';
$_POST = $_DPOST;
$_GET = $_DGET;
require '../config.inc.php';
if($_POST['seller_email']) $aliapy_config['seller_email'] = $_POST['seller_email'];
#cache_write('ali/'.$api.'-notify-server-'.date('Ymdhis').'.php', $_SERVER);
#cache_write('ali/'.$api.'-notify-post-'.date('Ymdhis').'.php', $_POST);
#cache_write('ali/'.$api.'-notify-get-'.date('Ymdhis').'.php', $_GET);
/* *
 * ���ܣ�֧�����������첽֪ͨҳ��
 * �汾��3.2
 * ���ڣ�2011-03-25
 * ˵����
 * ���´���ֻ��Ϊ�˷����̻����Զ��ṩ���������룬�̻����Ը����Լ���վ����Ҫ�����ռ����ĵ���д,����һ��Ҫʹ�øô��롣
 * �ô������ѧϰ���о�֧�����ӿ�ʹ�ã�ֻ���ṩһ���ο���


 *************************ҳ�湦��˵��*************************
 * ������ҳ���ļ�ʱ�������ĸ�ҳ���ļ������κ�HTML���뼰�ո�
 * ��ҳ�治���ڱ������Բ��ԣ��뵽�������������ԡ���ȷ���ⲿ���Է��ʸ�ҳ�档
 * ��ҳ����Թ�����ʹ��д�ı�����logResult���ú����ѱ�Ĭ�Ϲرգ���alipay_notify_class.php�еĺ���verifyNotify
 * ���û���յ���ҳ�淵�ص� success ��Ϣ��֧��������24Сʱ�ڰ�һ����ʱ������ط�֪ͨ
 
 * WAIT_BUYER_PAY(��ʾ�������֧�������׹����в����˽��׼�¼����û�и���);
 * WAIT_SELLER_SEND_GOODS(��ʾ�������֧�������׹����в����˽��׼�¼�Ҹ���ɹ���������û�з���);
 * WAIT_BUYER_CONFIRM_GOODS(��ʾ�����Ѿ����˻�������һ�û����ȷ���ջ��Ĳ���);
 * TRADE_FINISHED(��ʾ����Ѿ�ȷ���ջ�����ʽ������);
 
 * ����жϸñʽ�����ͨ����ʱ���ʷ�ʽ�����ͨ���������׷�ʽ���
 * 
 * �������׵Ľ���״̬�仯˳���ǣ��ȴ���Ҹ��������Ѹ���ȴ����ҷ����������ѷ������ȴ�����ջ���������ջ����������
 * ��ʱ���ʵĽ���״̬�仯˳���ǣ��ȴ���Ҹ�����������
 * 
 * ÿ���յ�֧��������֪ͨʱ���Ϳ��Ի�ȡ����ʽ��׵Ľ���״̬�������̻���Ҫ�����̻������Ų�ѯ�̻���վ�Ķ������ݣ�
 * �õ���ʶ������̻���վ�е�״̬��ʲô�����̻���վ�еĶ���״̬���֧����֪ͨ�л�ȡ����״̬�����Աȡ�
 * ����̻���վ��Ŀǰ��״̬�ǵȴ���Ҹ������֧����֪ͨ��ȡ����״̬������Ѹ���ȴ����ҷ�������ô��ʽ���������õ������׷�ʽ�����
 * ����̻���վ��Ŀǰ��״̬�ǵȴ���Ҹ������֧����֪ͨ��ȡ����״̬�ǽ�����ɣ���ô��ʽ���������ü�ʱ���ʷ�ʽ�����
 */

//require_once("alipay.config.php");
require_once AJ_ROOT.'/api/trade/alipay/2/pay/alipay_notify.class.php';

//����ó�֪ͨ��֤���
$alipayNotify = new AlipayNotify($aliapy_config);
$verify_result = $alipayNotify->verifyNotify();

if($verify_result) {//��֤�ɹ�
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//������������̻���ҵ���߼������
	
	//�������������ҵ���߼�����д�������´�������ο�������
    //��ȡ֧������֪ͨ���ز������ɲο������ĵ��з������첽֪ͨ�����б�
    $out_trade_no	= $_POST['out_trade_no'];	    //��ȡ������
    $trade_no		= $_POST['trade_no'];	    	//��ȡ֧�������׺�
    $total			= $_POST['price'];				//��ȡ�ܼ۸�

	$itemid = $out_trade_no;
	$td = $db->get_one("SELECT * FROM {$AJ_PRE}mall_order WHERE itemid=$itemid");
	$money = $td['amount'] + $td['fee'];
	if(!$td || $total_fee != $money) exit("fail");
	$seller = $td['seller'];
	$seller_email = $_POST['seller_email'];
	$buyer = $td['buyer'];
	$buyer_email = $_POST['buyer_email'];
	$mallid = $td['mallid'];
	$timenow = timetodate($AJ_TIME, 3);
	$memberurl = $MODULE[2]['linkurl'];	
	include load('member.lang');

	if($_POST['trade_status'] == 'WAIT_BUYER_PAY') {
	//���жϱ�ʾ�������֧�������׹����в����˽��׼�¼����û�и���
	
		//�жϸñʶ����Ƿ����̻���վ���Ѿ����������ɲο������ɽ̡̳��С�3.4�������ݴ�����
			//���û�������������ݶ����ţ�out_trade_no�����̻���վ�Ķ���ϵͳ�в鵽�ñʶ�������ϸ����ִ���̻���ҵ�����
			//���������������ִ���̻���ҵ�����
		
			
        echo "success"; //�벻Ҫ�޸Ļ�ɾ��

        //�����ã�д�ı�������¼������������Ƿ�����
        //logResult("����д����Ҫ���ԵĴ������ֵ�����������еĽ����¼");
    }
	else if($_POST['trade_status'] == 'WAIT_SELLER_SEND_GOODS') {
	//���жϱ�ʾ�������֧�������׹����в����˽��׼�¼�Ҹ���ɹ���������û�з���
	
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

			echo "success";
		}
			
        		//�벻Ҫ�޸Ļ�ɾ��

        //�����ã�д�ı�������¼������������Ƿ�����
        //logResult("����д����Ҫ���ԵĴ������ֵ�����������еĽ����¼");
    }
	else if($_POST['trade_status'] == 'WAIT_BUYER_CONFIRM_GOODS') {
	//���жϱ�ʾ�����Ѿ����˻�������һ�û����ȷ���ջ��Ĳ���
	
		//�жϸñʶ����Ƿ����̻���վ���Ѿ����������ɲο������ɽ̡̳��С�3.4�������ݴ�����
			//���û�������������ݶ����ţ�out_trade_no�����̻���վ�Ķ���ϵͳ�в鵽�ñʶ�������ϸ����ִ���̻���ҵ�����
			//���������������ִ���̻���ҵ�����

		if(isset($_POST['refund_status'])) {
			if($_POST['refund_status'] == 'WAIT_SELLER_AGREE' && $td['status'] == 3) {//��������˿� �ȴ�����ͬ��
				$db->query("UPDATE {$AJ_PRE}mall_order SET status=5,updatetime=$AJ_TIME WHERE itemid=$itemid");
				exit('success');
			}
		}
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
			echo "success";
		}
			
        //�벻Ҫ�޸Ļ�ɾ��

        //�����ã�д�ı�������¼������������Ƿ�����
        //logResult("����д����Ҫ���ԵĴ������ֵ�����������еĽ����¼");
    }
	else if($_POST['trade_status'] == 'TRADE_FINISHED') {
	//���жϱ�ʾ����Ѿ�ȷ���ջ�����ʽ������
	
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

			echo "success";
		}
			
        		//�벻Ҫ�޸Ļ�ɾ��

        //�����ã�д�ı�������¼������������Ƿ�����
        //logResult("����д����Ҫ���ԵĴ������ֵ�����������еĽ����¼");
	} else if($_POST['trade_status'] == 'TRADE_CLOSED') {
		if(isset($_POST['refund_status'])) {
			if($_POST['refund_status'] == 'REFUND_SUCCESS' && $td['status'] == 5) {//�˿�ɹ�
				$db->query("UPDATE {$AJ_PRE}mall_order SET status=6,updatetime=$AJ_TIME WHERE itemid=$itemid");
				exit('success');
			}
			if($_POST['refund_status'] == 'REFUND_CLOSED' && $td['status'] == 5) {//�˿�ر�
				$db->query("UPDATE {$AJ_PRE}mall_order SET status=7,updatetime=$AJ_TIME WHERE itemid=$itemid");
				exit('success');
			}
		}
    }  else {
		//����״̬�ж�
        echo "success";

        //�����ã�д�ı�������¼������������Ƿ�����
        //logResult ("����д����Ҫ���ԵĴ������ֵ�����������еĽ����¼");
    }

	//�������������ҵ���߼�����д�������ϴ�������ο�������
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
else {
    //��֤ʧ��
    echo "fail";

    //�����ã�д�ı�������¼������������Ƿ�����
    //logResult("����д����Ҫ���ԵĴ������ֵ�����������еĽ����¼");
}
?>