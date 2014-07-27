<?php
defined('IN_AIJIACMS') or exit('Access Denied');
require AJ_ROOT.'/api/pay/'.$bank.'/netpayclient_config.php';
//���� netpayclient ���
require AJ_ROOT.'/api/pay/'.$bank.'/netpayclient.php';
//����˽Կ�ļ�, ����ֵ��Ϊ�����̻��ţ�����15λ
$merid = buildKey(PRI_KEY);
$merid or exit('����˽Կ�ļ�ʧ�ܣ�');

//���ɶ����ţ�����16λ������������ϣ�һ���ڲ������ظ����������õ�ǰʱ���������
$ordid = "00" . date('YmdHis');
//����������12λ���Է�Ϊ��λ��������0������
$transamt = padstr($charge*100,12);
//���Ҵ��룬3λ�������̻��̶�Ϊ156����ʾ����ң�����
$curyid = "156";
//�������ڣ��������õ�ǰ���ڣ�����
$transdate = date('Ymd');
//�������ͣ�0001 ��ʾ֧�����ף�0002 ��ʾ�˿��
$transtype = "0001";
//�ӿڰ汾�ţ�����֧��Ϊ 20070129������
$version = "20070129";
//ҳ�淵�ص�ַ(���������Ͽɷ��ʵ�URL)���80λ�����û����֧��������ҳ����Զ���ת����ҳ�棬��POST���������Ϣ����ѡ
$pagereturl = $receive_url;
//��̨���ص�ַ(���������Ͽɷ��ʵ�URL)���80λ�����û����֧�����ҷ���������POST���������Ϣ����ҳ�棬����
$bgreturl = AJ_PATH.'api/pay/'.$bank.'/notify.php';

/************************
ҳ�淵�ص�ַ�ͺ�̨���ص�ַ������
��̨���ش��ҷ������������������û��������������Ӱ�죬�Ӷ���֤���׽�����ʹ
************************/

//֧�����غţ�4λ������ʱ�������գ�����ת�������б�ҳ�����û�����ѡ�񣬱�ʾ��ѡ��0001ũ�������ر��ڲ��ԣ���ѡ
$gateid = "";//"0001";
//��ע���60λ�����׳ɹ����ԭ�����أ������ڶ���Ķ������ٵȣ���ѡ
$priv1 = $orderid;//����Ϊ����ID

//��������϶�����ϢΪ��ǩ����
$plain = $merid . $ordid . $transamt . $curyid . $transdate . $transtype . $priv1;
//����ǩ��ֵ������
$chkvalue = sign($plain);
$chkvalue or exit('ǩ��ʧ�ܣ�');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=<?php echo AJ_CHARSET;?>">
<title>������ת��<?php echo $PAY[$bank]['name'];?>����֧��ƽ̨...</title>
</head>
<body onload="document.getElementById('pay').submit();">
<form method="post" action="<?php echo REQ_URL_PAY;?>" id="pay">
<input type="hidden" name="MerId"		value="<?php echo $merid;?>">
<input type="hidden" name="Version"     value="<?php echo $version;?>">
<input type="hidden" name="OrdId"		value="<?php echo $ordid;?>">
<input type="hidden" name="TransAmt"    value="<?php echo $transamt;?>">
<input type="hidden" name="CuryId"		value="<?php echo $curyid;?>">
<input type="hidden" name="TransDate"   value="<?php echo $transdate;?>">
<input type="hidden" name="TransType"   value="<?php echo $transtype;?>">
<input type="hidden" name="BgRetUrl"    value="<?php echo $bgreturl;?>">
<input type="hidden" name="PageRetUrl"  value="<?php echo $pagereturl;?>">
<input type="hidden" name="GateId"      value="<?php echo $gateid;?>">
<input type="hidden" name="Priv1"		value="<?php echo $priv1;?>">
<input type="hidden" name="ChkValue"    value="<?php echo $chkvalue;?>">
</form>
</body>
</html>