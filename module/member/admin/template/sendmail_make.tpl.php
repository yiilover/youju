<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<div class="tt">��ȡ��Ա�ʼ��б�</div>
<form method="post" action="?">
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="make" value="1"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td class="tl"><span class="f_red">*</span> ���ݱ�</td>
<td><input type="text" size="50" name="tb" id="tb" value="<?php echo $AJ_PRE;?>member"/></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> �ֶ���</td>
<td><input type="text" size="20" name="field" id="field" value="email"/></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> SQL�������</td>
<td class="f_gray"><input type="text" size="60" name="sql" id="sql" value="groupid>4"/>
<select onchange="mk(this.value);">
<option value="member|groupid>4|email">����SQL���</option>
<option value="member|logintime<<?php echo $AJ_TIME;?>-3600*24*30|email">30��δ��¼��Ա</option>
<option value="member|regtime<<?php echo $AJ_TIME;?>-3600*24*365|email">ע��ʱ�䳬��1��</option>
<option value="member|message>10|email">δ��վ���ų���10��</option>
<option value="member|money>1000|email">�ʻ�����<?php echo $AJ['money_name'];?>����1000<?php echo $AJ['money_unit'];?></option>
<option value="member|locking>1000|email">�ʻ�����<?php echo $AJ['money_name'];?>����1000<?php echo $AJ['money_unit'];?></option>
<option value="member m,company c|m.userid=c.userid and c.vip>6|m.email"><?php echo VIP;?>ָ������6����ҵ</option>
<option value="member m,company c|m.userid=c.userid and c.totime><?php echo $AJ_TIME;?>|m.email"><?php echo VIP;?>������ڵ���ҵ</option>
<option value="member m,company c|m.userid=c.userid and c.totime><?php echo $AJ_TIME;?>-3600*24*30|m.email"><?php echo VIP;?>����30���ڹ��ڵ���ҵ</option>
<option value="member m,company c|m.userid=c.userid and c.validated=1|m.email">����ͨ����֤����ҵ</option>
<option value="member m,company c|m.userid=c.userid and c.domain<>''|m.email">���˶��������ĵ���ҵ</option>
<?php foreach($GROUP as $k=>$v) { 
	if($v['groupid'] != 3) { 
?>
<option value="member|groupid=<?php echo $v['groupid'];?>|email"><?php echo $v['groupname'];?></option>
<?php 
	}
} 
?>
</select>
<br/>�������ȡ��ͨ����֤��Email��ַ�����Լ�and vemail>0 ���� groupid=6 and vemail>0
<script type="text/javascript">
function mk(v) {
	var pre = '<?php echo $AJ_PRE;?>';
	var arr = v.split("|");
	if(arr[0]) Dd('tb').value = pre+arr[0].replace(/,/, ','+pre);
	if(arr[1]) Dd('sql').value = arr[1];
	if(arr[2]) Dd('field').value = arr[2];
}
</script>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> ÿ����ȡ��Ŀ</td>
<td><input type="text" size="5" name="num" value="1000"/></td>
</tr>
<tr>
<td class="tl">�����ļ���</td>
<td class="f_gray"><input type="text" size="20" id="title" name="title"/><br/>��������(���������֧��)��������ϵͳ�Զ�����</td>
</tr>
</table>
<div class="sbt"><input type="submit" name="submit" value=" ȷ �� " class="btn">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="reset" value=" �� �� " class="btn"/></div>
</form>
<script type="text/javascript">Menuon(2);</script>
<?php include tpl('footer');?>