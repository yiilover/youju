<?php
defined('IN_AIJIACMS') or exit('Access Denied');
/*
 * @Description �ױ�֧��B2C����֧���ӿڷ��� 
 * @V3.0
 * @Author rui.xin
 */
 
include AJ_ROOT.'/api/pay/'.$bank.'/yeepayCommon.php';	
	
#	ֻ��֧���ɹ�ʱ�ױ�֧���Ż�֪ͨ�̻�.
##֧���ɹ��ص������Σ�����֪ͨ������֧����������е�p8_Url�ϣ�������ض���;��������Ե�ͨѶ.

#	�������ز���.
$return = getCallBackValue($r0_Cmd,$r1_Code,$r2_TrxId,$r3_Amt,$r4_Cur,$r5_Pid,$r6_Order,$r7_Uid,$r8_MP,$r9_BType,$hmac);

#	�жϷ���ǩ���Ƿ���ȷ��True/False��
$bRet = CheckHmac($r0_Cmd,$r1_Code,$r2_TrxId,$r3_Amt,$r4_Cur,$r5_Pid,$r6_Order,$r7_Uid,$r8_MP,$r9_BType,$hmac);
#	���ϴ���ͱ�������Ҫ�޸�.
	 	
#	У������ȷ.
if($bRet){
	if($r1_Code=="1"){
		
	#	��Ҫ�ȽϷ��صĽ�����̼����ݿ��ж����Ľ���Ƿ���ȣ�ֻ����ȵ�����²���Ϊ�ǽ��׳ɹ�.
	#	������Ҫ�Է��صĴ������������ƣ����м�¼�������Դ����ڽ��յ�֧�����֪ͨ���ж��Ƿ���й�ҵ���߼�������Ҫ�ظ�����ҵ���߼�������ֹ��ͬһ�������ظ��������������.      	  	
		
		if($r9_BType=="1"){
			if($r6_Order != $charge_orderid) {
				$charge_status = 2;
				$charge_errcode = '�����Ų�ƥ��';
				$note = $charge_errcode.'S:'.$charge_orderid.'R:'.$r6_Order;
				log_write($note, 'ryeepay');
			} else if($r3_Amt != $charge_money) {
				$charge_status = 2;
				$charge_errcode = '��ֵ��ƥ��';
				$note = charge_errcode.'S:'.$charge_money.'R:'.$r3_Amt;
				log_write($note, 'ryeepay');
			} else {
				$charge_status = 1;
			}
			//echo "���׳ɹ�";
			//echo  "<br />����֧��ҳ�淵��";
		}elseif($r9_BType=="2"){
			#�����ҪӦ�����������д��,��success��ͷ,��Сд������.
			//echo "success";
			//echo "<br />���׳ɹ�";
			//echo  "<br />����֧������������";      			 
		}
	}
	
}else{
	//echo "������Ϣ���۸�";
}
   
?>