<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<style type="text/css">
.t1 {width:200px;padding:3px 10px 3px 10px;color:#006699;}
.t2 {width:100px;padding:3px 10px 3px 10px;color:green;text-align:center;}
.t2 span {color:red;}
.t3 {padding:5px 10px 5px 10px;line-height:180%;}
</style>
<div class="tt">ϵͳ���</div>
<table cellpadding="2" cellspacing="1" class="tb" style="line-height:200%;">
<tr>
<th>��Ŀ</th>
<th>ֵ</th>
<th>˵��</th>
</tr>
<?php
	if(strpos(get_env('self'), '/admin.php') !== false) {
?>
<tr>
<td class="t1">��̨��¼��ַ</td>
<td class="t2"><span>admin.php</span></td>
<td class="t3">
��������ʺ�й©����̨�������ܹ�����Ϊ��ϵͳ��ȫ�����޸ĸ�Ŀ¼admin.php���ļ���
</td>
</tr>
<?php } ?>
<?php
	$D = is_write(AJ_ROOT.'/file/') && is_write(AJ_ROOT.'/file/cache/') && is_write(AJ_ROOT.'/file/cache/tpl/') && is_write(AJ_ROOT.'/file/upload/');
?>
<tr>
<td class="t1">fileĿ¼�Ƿ��д</td>
<td class="t2"><?php echo $D ? '��д' : '<span>����д</span>';?></td>
<td class="t3">
fileĿ¼��������Ŀ¼�����ļ����������ÿ�д�����������������⣺<br/>
ϵͳ�����޷�����<br/>
��̨�޷���¼<br/>
��¼��̨����ʾ���������<br/>
ǰ̨ҳ���޷�������ʾ<br/>
�ļ��޷��ϴ�<br/>
</td>
</tr>
<?php
	$S = 0;
	foreach($MODULE as $v) {
		if($v['moduleid'] > 1 && $v['domain']) $S = 1;
	}
	if($CFG['com_domain']) $S = 1;
	if(!$S && $AJ['city']) {
		$r = $db->get_one("SELECT areaid FROM {$AJ_PRE}city WHERE domain<>''");
		if($r) $S = 1;
	}
	$D = $CFG['cookie_domain'];
	if($S) {
?>
<tr>
<td class="t1">Cookie������</td>
<td class="t2"><?php echo $D ? $D : '<span>δ����</span>';?></td>
<td class="t3">
��ǰϵͳʹ�ù�����������δ����Cookie�����������������⣺<br/>
��֤��/��֤����У�����<br/>
��Ա��¼״̬��ʾ����<br/>
���۲���ʾ<br/>
</td>
</tr>
<?php } ?>

<?php
	if($CFG['skin'] == $CFG['template'] && $CFG['template'] != 'default') {
?>
<tr>
<td class="t1">ģ��ͷ��Ŀ¼</td>
<td class="t2"><span>ͬ��</span></td>
<td class="t3">
ģ��ͷ��Ŀ¼ͬ�����ܵ���ģ�屻���أ�����ģ��ͷ��ʹ�ò���ͬ��Ŀ¼����
</td>
</tr>
<?php } ?>

<?php
	$D = ini_get('allow_url_fopen');
?>
<tr>
<td class="t1">����ʹ��URL���ļ�<br/>allow_url_fopen</td>
<td class="t2"><?php echo $D ? 'On' : '<span>Off</span>';?></td>
<td class="t3">
��������ΪOn�����������������⣺<br/>
Զ��ͼƬ�޷�����<br/>
����ͼƬ�޷��ϴ�<br/>
һ����¼�޷���¼<br/>
</td>
</tr>

<?php
	$D = ini_get('memory_limit');
?>
<tr>
<td class="t1">�����������ʹ���ڴ���<br/>memory_limit</td>
<td class="t2"><?php echo $D;?></td>
<td class="t3">
�ڴ����ù�С�ᵼ�²��ֲ����޷����У���ʾ�հ�
</td>
</tr>

<?php
	$D = ini_get('post_max_size');
?>
<tr>
<td class="t1">POST����ֽ���<br/>post_max_size</td>
<td class="t2"><?php echo $D;?></td>
<td class="t3">
����<?php echo $D;?>���ļ��޷��ϴ�<br/>
����<?php echo $D;?>����Ϣ�޷��ύ
</td>
</tr>

<?php
	$D = ini_get('upload_max_filesize');
?>
<tr>
<td class="t1">��������ϴ��ļ�<br/>upload_max_filesize</td>
<td class="t2"><?php echo $D;?></td>
<td class="t3">
����<?php echo $D;?>���ļ��޷��ϴ�
</td>
</tr>

<?php
	$D = function_exists('fsockopen');
?>
<tr>
<td class="t1">fsockopen</td>
<td class="t2"><?php echo $D ? '֧��' : '<span>��֧��</span>';?></td>
<td class="t3">
�����֧�֣���������������⣺<br/>
��ֵ�ӿ��޷�ʹ��<br/>
�ֻ������޷�����<br/>
�����ʼ��޷�����<br/>
һ����¼�޷���¼<br/>

</td>
</tr>

<?php
	$D = function_exists('curl_init');
?>
<tr>
<td class="t1">curl</td>
<td class="t2"><?php echo $D ? '֧��' : '<span>��֧��</span>';?></td>
<td class="t3">
�����֧�֣���������������⣺<br/>
һ����¼�޷���¼<br/>
</td>
</tr>

<?php
	$D = function_exists('json_decode');
?>
<tr>
<td class="t1">json</td>
<td class="t2"><?php echo $D ? '֧��' : '<span>��֧��</span>';?></td>
<td class="t3">
�����֧�֣���������������⣺<br/>
һ����¼�޷���¼<br/>
</td>
</tr>
<?php
	$D = function_exists('openssl_sign');
?>
<tr>
<td class="t1">OpenSSL</td>
<td class="t2"><?php echo $D ? '֧��' : '<span>��֧��</span>';?></td>
<td class="t3">
�����֧�֣���������������⣺<br/>
��Ǯ�ӿ��޷�ʹ��<br/>
�޷�ʹ��Gmail����SMTP����<br/>
</td>
</tr>
</table>
</div>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>