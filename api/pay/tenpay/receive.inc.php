<?php
defined('IN_AIJIACMS') or exit('Access Denied');
//---------------------------------------------------------
//�Ƹ�ͨ��ʱ����֧��Ӧ�𣨴���ص���ʾ�����̻����մ��ĵ����п�������
//---------------------------------------------------------

require_once AJ_ROOT.'/api/pay/'.$bank.'/ResponseHandler.class.php';
require_once AJ_ROOT.'/api/pay/'.$bank.'/function.php';
require_once AJ_ROOT.'/api/pay/'.$bank.'/config.inc.php';

#log_result("����ǰ̨�ص�ҳ��");


/* ����֧��Ӧ����� */
$resHandler = new ResponseHandler();
$resHandler->setKey($key);

//�ж�ǩ��
if($resHandler->isTenpaySign()) {
	
	//֪ͨid
	$notify_id = $resHandler->getParameter("notify_id");
	//�̻�������
	$out_trade_no = $resHandler->getParameter("out_trade_no");
	//�Ƹ�ͨ������
	$transaction_id = $resHandler->getParameter("transaction_id");
	//���,�Է�Ϊ��λ
	$total_fee = $resHandler->getParameter("total_fee");
	//�����ʹ���ۿ�ȯ��discount��ֵ��total_fee+discount=ԭ�����total_fee
	$discount = $resHandler->getParameter("discount");
	//֧�����
	$trade_state = $resHandler->getParameter("trade_state");
	//����ģʽ,1��ʱ����
	$trade_mode = $resHandler->getParameter("trade_mode");

	$total_fee = ($total_fee+$discount)/100;
	
	
	if("1" == $trade_mode ) {
		if( "0" == $trade_state){ 
			//------------------------------
			//����ҵ��ʼ
			//------------------------------
			
			//ע�⽻�׵���Ҫ�ظ�����
			//ע���жϷ��ؽ��
			
			//------------------------------
			//����ҵ�����
			//------------------------------	
			if($out_trade_no != $charge_orderid) {
				$charge_status = 2;
				$charge_errcode = '�����Ų�ƥ��';
				$note = $charge_errcode.'S:'.$charge_orderid.'R:'.$out_trade_no;
				log_write($note, 'rtenpay');
			} else if($total_fee != $charge_money) {
				$charge_status = 2;
				$charge_errcode = '��ֵ��ƥ��';
				$note = $charge_errcode.'S:'.$charge_money.'R:'.$total_fee;
				log_write($note, 'rtenpay');
			} else {
				$charge_status = 1;
				$db->query("UPDATE {$AJ_PRE}finance_charge SET status=3,money=$charge_money,receivetime='$AJ_TIME',editor='$editor' WHERE itemid=$charge_orderid");
				money_add($r['username'], $r['amount']);
				money_record($r['username'], $r['amount'], $PAY[$bank]['name'], 'system', '���߳�ֵ', 'ID:'.$charge_orderid);
				$show = $MOD['linkurl'].'charge.php';
				$resHandler->doShow($show);
			}
			
			#echo "<br/>" . "��ʱ����֧���ɹ�" . "<br/>";
	
		} else {
			//�������ɹ�����
			#echo "<br/>" . "��ʱ����֧��ʧ��" . "<br/>";
		}
	}elseif( "2" == $trade_mode  ) {
		if( "0" == $trade_state) {
		
			//------------------------------
			//����ҵ��ʼ
			//------------------------------
			
			//ע�⽻�׵���Ҫ�ظ�����
			//ע���жϷ��ؽ��
			
			//------------------------------
			//����ҵ�����
			//------------------------------	
			
			//echo "<br/>" . "�н鵣��֧���ɹ�" . "<br/>";
		
		} else {
			//�������ɹ�����
			//echo "<br/>" . "�н鵣��֧��ʧ��" . "<br/>";
		}
	}
	
} else {
	//echo "<br/>" . "��֤ǩ��ʧ��" . "<br/>";
	//echo $resHandler->getDebugInfo() . "<br>";
}

?>