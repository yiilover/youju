<?php
require '../../../common.inc.php';
if(!$_REQUEST) exit('error');
$bank = 'kq99bill';
$PAY = cache_read('pay.php');
if(!$PAY[$bank]['enable']) exit('error');
function kq_ck_null($kq_va,$kq_na){if($kq_va == ""){return $kq_va="";}else{return $kq_va=$kq_na.'='.$kq_va.'&';}}
//����������˺ţ����˺�Ϊ11λ����������̻����+01,��ֵ���ύʱ��ͬ��
$kq_check_all_para=kq_ck_null($_REQUEST[merchantAcctId],'merchantAcctId');
//���ذ汾���̶�ֵ��v2.0,��ֵ���ύʱ��ͬ��
$kq_check_all_para.=kq_ck_null($_REQUEST[version],'version');
//�������࣬1����������ʾ��2����Ӣ����ʾ��Ĭ��Ϊ1,��ֵ���ύʱ��ͬ��
$kq_check_all_para.=kq_ck_null($_REQUEST[language],'language');
//ǩ������,��ֵΪ4������PKI���ܷ�ʽ,��ֵ���ύʱ��ͬ��
$kq_check_all_para.=kq_ck_null($_REQUEST[signType],'signType');
//֧����ʽ��һ��Ϊ00���������е�֧����ʽ�����������ֱ���̻�����ֵΪ10,��ֵ���ύʱ��ͬ��
$kq_check_all_para.=kq_ck_null($_REQUEST[payType],'payType');
//���д��룬���payTypeΪ00����ֵΪ�գ����payTypeΪ10,��ֵ���ύʱ��ͬ��
$kq_check_all_para.=kq_ck_null($_REQUEST[bankId],'bankId');
//�̻������ţ�,��ֵ���ύʱ��ͬ��
$kq_check_all_para.=kq_ck_null($_REQUEST[orderId],'orderId');
//�����ύʱ�䣬��ʽ��yyyyMMddHHmmss���磺20071117020101,��ֵ���ύʱ��ͬ��
$kq_check_all_para.=kq_ck_null($_REQUEST[orderTime],'orderTime');
//����������ԡ��֡�Ϊ��λ���̻�������1�ֲ��Լ��ɣ������Դ������,��ֵ��֧��ʱ��ͬ��
$kq_check_all_para.=kq_ck_null($_REQUEST[orderAmount],'orderAmount');
// ��Ǯ���׺ţ��̻�ÿһ�ʽ��׶����ڿ�Ǯ����һ�����׺š�
$kq_check_all_para.=kq_ck_null($_REQUEST[dealId],'dealId');
//���н��׺� ����Ǯ����������֧��ʱ��Ӧ�Ľ��׺ţ��������ͨ�����п�֧������Ϊ��
$kq_check_all_para.=kq_ck_null($_REQUEST[bankDealId],'bankDealId');
//��Ǯ����ʱ�䣬��Ǯ�Խ��׽��д����ʱ��,��ʽ��yyyyMMddHHmmss���磺20071117020101
$kq_check_all_para.=kq_ck_null($_REQUEST[dealTime],'dealTime');
//�̻�ʵ��֧����� �Է�Ϊ��λ���ȷ�10Ԫ���ύʱ���ӦΪ1000���ý������̻���Ǯ�˻������յ��Ľ�
$kq_check_all_para.=kq_ck_null($_REQUEST[payAmount],'payAmount');
//���ã���Ǯ��ȡ�̻��������ѣ���λΪ�֡�
$kq_check_all_para.=kq_ck_null($_REQUEST[fee],'fee');
//��չ�ֶ�1����ֵ���ύʱ��ͬ
$kq_check_all_para.=kq_ck_null($_REQUEST[ext1],'ext1');
//��չ�ֶ�2����ֵ���ύʱ��ͬ��
$kq_check_all_para.=kq_ck_null($_REQUEST[ext2],'ext2');
//�������� 10֧���ɹ���11 ֧��ʧ�ܣ�00��������ɹ���01 ��������ʧ��
$kq_check_all_para.=kq_ck_null($_REQUEST[payResult],'payResult');
//������� ������ա���������ؽӿ��ĵ�����󲿷ֵ���ϸ���͡�
$kq_check_all_para.=kq_ck_null($_REQUEST[errCode],'errCode');

$trans_body=substr($kq_check_all_para,0,strlen($kq_check_all_para)-1);
$MAC=base64_decode($_REQUEST[signMsg]);

$fp = fopen(AJ_ROOT."/api/pay/".$bank."/".$PAY[$bank]['cert'], "r"); 
$cert = fread($fp, 8192); 
fclose($fp); 
$pubkeyid = openssl_get_publickey($cert); 
$ok = openssl_verify($trans_body, $MAC, $pubkeyid); 
if($ok == 1) { 
	switch($_REQUEST[payResult]){
		case '10':
			//�˴����̻��߼�����
			$itemid = intval($_REQUEST['orderId']);
			$amount = $_REQUEST['payAmount']/100;
			$r = $db->get_one("SELECT * FROM {$AJ_PRE}finance_charge WHERE itemid='$itemid'");
			if($r) {
				if($r['status'] == 0) {
					$charge_orderid = $r['itemid'];
					$charge_money = $r['amount'] + $r['fee'];
					$charge_amount = $r['amount'];
					$editor = 'N'.$bank;
					if($amount == $charge_money) {
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
					} else {
						$note = '��ֵ��ƥ��S:'.$charge_money.'R:'.$amount;
						$db->query("UPDATE {$AJ_PRE}finance_charge SET status=1,receivetime='$AJ_TIME',editor='$editor',note='$note' WHERE itemid=$charge_orderid");//֧��ʧ��
					}
				}
			}
			$rtnOK=1;
			//���������ǿ�Ǯ���õ�showҳ�棬�̻���Ҫ�Լ������ҳ�档
			$rtnUrl = $MODULE[2]['linkurl'].'charge.php';
		break;
		default:
			$rtnOK=1;
			//���������ǿ�Ǯ���õ�showҳ�棬�̻���Ҫ�Լ������ҳ�档
			$rtnUrl = $MODULE[2]['linkurl'].'charge.php';
		break;
	}

} else {
	$rtnOK=1;
	//���������ǿ�Ǯ���õ�showҳ�棬�̻���Ҫ�Լ������ҳ�档
	$rtnUrl = $MODULE[2]['linkurl'].'charge.php';					
}
?>

<result><?php echo $rtnOK; ?></result> <redirecturl><?php echo $rtnUrl; ?></redirecturl>