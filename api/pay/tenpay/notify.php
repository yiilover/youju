<?php
$_DPOST = $_POST;
require '../../../common.inc.php';
$_POST = $_DPOST;
if(!$_POST) exit('fail');
$bank = 'tenpay';
$PAY = cache_read('pay.php');
if(!$PAY[$bank]['enable']) exit('fail');
if(!$PAY[$bank]['partnerid']) exit('fail');
if(!$PAY[$bank]['keycode']) exit('fail');
$receive_url = '';

require AJ_ROOT.'/api/pay/'.$bank.'/ResponseHandler.class.php';
require AJ_ROOT.'/api/pay/'.$bank.'/RequestHandler.class.php';
require AJ_ROOT.'/api/pay/'.$bank.'/ClientResponseHandler.class.php';
require AJ_ROOT.'/api/pay/'.$bank.'/TenpayHttpClient.class.php';
require AJ_ROOT.'/api/pay/'.$bank.'/function.php';
require AJ_ROOT.'/api/pay/'.$bank.'/config.inc.php';


		#log_result("�����̨�ص�ҳ��");


	/* ����֧��Ӧ����� */
		$resHandler = new ResponseHandler();
		$resHandler->setKey($key);

	//�ж�ǩ��
		if($resHandler->isTenpaySign()) {
	
	//֪ͨid
		$notify_id = $resHandler->getParameter("notify_id");
	
	//ͨ��֪ͨID��ѯ��ȷ��֪ͨ�����Ƹ�ͨ
	//������ѯ����
		$queryReq = new RequestHandler();
		$queryReq->init();
		$queryReq->setKey($key);
		$queryReq->setGateUrl("https://gw.tenpay.com/gateway/simpleverifynotifyid.xml");
		$queryReq->setParameter("partner", $partner);
		$queryReq->setParameter("notify_id", $notify_id);
		
	//ͨ�Ŷ���
		$httpClient = new TenpayHttpClient();
		$httpClient->setTimeOut(5);
	//������������
		$httpClient->setReqContent($queryReq->getRequestURL());
	
	//��̨����
		if($httpClient->call()) {
	//���ý������
			$queryRes = new ClientResponseHandler();
			$queryRes->setContent($httpClient->getResContent());
			$queryRes->setKey($key);
		
		if($resHandler->getParameter("trade_mode") == "1"){
	//�ж�ǩ�����������ʱ���ʣ�
	//ֻ��ǩ����ȷ,retcodeΪ0��trade_stateΪ0����֧���ɹ�
		if($queryRes->isTenpaySign() && $queryRes->getParameter("retcode") == "0" && $resHandler->getParameter("trade_state") == "0") {
				#log_result("��ʱ������ǩID�ɹ�");
	//ȡ���������ҵ����
				$out_trade_no = $resHandler->getParameter("out_trade_no");
	//�Ƹ�ͨ������
				$transaction_id = $resHandler->getParameter("transaction_id");
	//���,�Է�Ϊ��λ
				$total_fee = $resHandler->getParameter("total_fee");
	//�����ʹ���ۿ�ȯ��discount��ֵ��total_fee+discount=ԭ�����total_fee
				$discount = $resHandler->getParameter("discount");
				
				//------------------------------
				//����ҵ��ʼ
				//------------------------------
				
				//�������ݿ��߼�
				//ע�⽻�׵���Ҫ�ظ�����
				//ע���жϷ��ؽ��

				$total_fee = ($total_fee+$discount)/100;

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
							#log_result($note);
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
					#log_result('֪ͨ�����Ų�����R:'.$out_trade_no);
					exit('fail');
				}

				
				//------------------------------
				//����ҵ�����
				//------------------------------
				#log_result("��ʱ���ʺ�̨�ص��ɹ�");
				echo "success";
				
			} else {
	//����ʱ�����ؽ������û��ǩ����д��־trade_state��retcode��retmsg��ʧ�����顣
	//echo "��֤ǩ��ʧ�� �� ҵ�������Ϣ:trade_state=" . $resHandler->getParameter("trade_state") . ",retcode=" . $queryRes->                         getParameter("retcode"). ",retmsg=" . $queryRes->getParameter("retmsg") . "<br/>" ;
			   #log_result("��ʱ���ʺ�̨�ص�ʧ��");
			   echo "fail";
			}
		}
		
	    
		
		
	//��ȡ��ѯ��debug��Ϣ,���������Ӧ�����ݡ�debug��Ϣ��ͨ�ŷ�����д����־�����㶨λ����
	/*
		echo "<br>------------------------------------------------------<br>";
		echo "http res:" . $httpClient->getResponseCode() . "," . $httpClient->getErrInfo() . "<br>";
		echo "query req:" . htmlentities($queryReq->getRequestURL(), ENT_NOQUOTES, "GB2312") . "<br><br>";
		echo "query res:" . htmlentities($queryRes->getContent(), ENT_NOQUOTES, "GB2312") . "<br><br>";
		echo "query reqdebug:" . $queryReq->getDebugInfo() . "<br><br>" ;
		echo "query resdebug:" . $queryRes->getDebugInfo() . "<br><br>";
		*/
	} else {
		//ͨ��ʧ��
		echo "fail";
		//��̨����ͨ��ʧ��,д��־�����㶨λ����
		echo "<br>call err:" . $httpClient->getResponseCode() ."," . $httpClient->getErrInfo() . "<br>";
	 } 
	
	
   } else {
    echo "<br/>" . "��֤ǩ��ʧ��" . "<br/>";
    echo $resHandler->getDebugInfo() . "<br>";
}
?>