<?php
defined('IN_AIJIACMS') or exit('Access Denied');
$one = (isset($one) && $one) ? 1 : 0;
if(isset($all)) {
	if($one) dheader('?file=html&action=back&mid='.$moduleid);
	msg('��չ���ܸ��³ɹ�');
} else {
	#spread->ad->announce->webpage->vote
	msg('���ڿ�ʼ������չ', '?moduleid=3&file=spread&action=html&all=1&one='.$one);
}
?>