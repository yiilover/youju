<?php
defined('IN_AIJIACMS') or exit('Access Denied');
//****************************************	//MD5��ԿҪ�������ύҳ��ͬ����Send.asp��� key = "test" ,�޸�""���� test Ϊ������Կ
											//�������û������MD5��Կ���¼����Ϊ���ṩ�̻���̨����ַ��https://merchant3.chinabank.com.cn/
$key = $PAY[$bank]['keycode'];	//��¼��������ĵ�����������ҵ���B2C�����ڶ������������С�MD5��Կ���á�
											//����������һ��16λ���ϵ���Կ����ߣ���Կ���64λ��������16λ�Ѿ��㹻��
//****************************************
	
$v_oid     =trim($_POST['v_oid']);       // �̻����͵�v_oid�������   
$v_pmode   =trim($_POST['v_pmode']);    // ֧����ʽ���ַ�����   
$v_pstatus =trim($_POST['v_pstatus']);   //  ֧��״̬ ��20��֧���ɹ�����30��֧��ʧ�ܣ�
$v_pstring =trim($_POST['v_pstring']);   // ֧�������Ϣ �� ֧����ɣ���v_pstatus=20ʱ����ʧ��ԭ�򣨵�v_pstatus=30ʱ,�ַ������� 
$v_amount  =trim($_POST['v_amount']);     // ����ʵ��֧�����
$v_moneytype  =trim($_POST['v_moneytype']); //����ʵ��֧������    
$remark1   =trim($_POST['remark1' ]);      //��ע�ֶ�1
$remark2   =trim($_POST['remark2' ]);     //��ע�ֶ�2
$v_md5str  =trim($_POST['v_md5str' ]);   //ƴ�պ��MD5У��ֵ  

/**
 * ���¼���md5��ֵ
 */
                           
$md5string = strtoupper(md5($v_oid.$v_pstatus.$v_amount.$v_moneytype.$key));

/**
 * �жϷ�����Ϣ�����֧���ɹ�������֧��������ţ�������һ���Ĵ���
 */


if ($v_md5str == $md5string) {
	if($v_pstatus == "20") {
		//֧���ɹ����ɽ����߼�����
		//�̻�ϵͳ���߼����������жϽ��ж�֧��״̬�����¶���״̬�ȵȣ�......
		if($v_oid != $charge_orderid) {
			$charge_status = 2;
			$charge_errcode = '�����Ų�ƥ��';
			$note = $charge_errcode.'S:'.$charge_orderid.'R:'.$v_oid;
			log_write($note, 'rchinabank');
		} else if($v_amount != $charge_money) {
			$charge_status = 2;
			$charge_errcode = '��ֵ��ƥ��';
			$note = $charge_errcode.'S:'.$charge_money.'R:'.$v_amount;
			log_write($note, 'rchinabank');
		} else {
			$charge_status = 1;
		}
	}
}
?>