<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<style>
.tb .t1{text-align:center;}
.tb .t2{text-align:left;padding-left:20px;}
.tb span{color:red;}
</style>
<div class="tt">��������</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td width="200" class="t1">Invalid Request</td>
<td class="t2">1.����Ƿ��հ�װ˵���޸��˸�Ŀ¼��admin.php�ļ�</td>
</tr>
<tr>
<td width="200" class="t1">�հ׽���</td>
<td class="t2">1.�״ΰ�װ����admin/config/collectsite.default.php�Ƿ��Ϊcollectsite.php<BR>2..����Ƿ�ȱ���ļ�</td>
</tr>
<tr>
<td width="200" class="t1">��Դ����Ϊ��</td>
<td class="t2">������ɼ��ķ�ԴС��3���ַ���AJϵͳĬ��С��3�ַ���ʾ����</td>
</tr>
</table>
<div class="tt">��ӹ���˵��</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td width="200" class="t1"><span>*</span> �ɼ�������</td>
<td class="t2">�����ظ�����Ϊ�����֣��������ظ���һ��Ϊ��վ���ơ�����������</td>
</tr>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td class="t1"><span>*</span> ��վ��ַ</td>
<td class="t2">Ҫ�ɼ���վ��ַ������http://chengdu.aifang.com </td>
</tr>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td class="t1"><span>*</span> �ɼ�����ʶ</td>
<td class="t2">�����ظ���һ��Ϊ���ɼ�վ���������д���Ժ������������֡�����aifang</td>
</tr>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td class="t1">���ݲɼ����ӿ�</td>
<td class="t2">����Բ�ͬ������ò�ͬ�ɼ����ӿڣ�����������Ҫ��һ�㲻��Ҫ��д��Ĭ��Ϊ�գ�ʹ��ϵͳapi�ӿ�</td>
</tr>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td class="t1">�����������ַ</td>
<td class="t2">��Ҫ����е���վ���ܻ����Ĳɼ�IP����ʱ��ʹ�ô���IP����ʹ�ô��������������</td>
</tr>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td class="t1">�����֤ģʽ</td>
<td class="t2">�ɼ�ʱ��֤���ʹ��<BR>
1. ��ʼ�� ��֤�Ƿ�Ϊ��ʼ�ˣ���Ҫ��¼<BR>
2. ��֤��Կ �������Ϊ��֤��Կ����������� �����Կ[�Ƽ�]<BR>
3. ��֤IP �������Ϊ��֤IP����������� �����IP<BR>
4. �رսӿ�
</td>
</tr>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td class="t1">�������ģʽ</td>
<td class="t2">
1.	�������ģʽΪ��ϵͳ��⡱ʱ��ϵͳ�������õ����ļ���⣬�Զ����������ֶ�<BR>
2.	�������Զ��塱ģʽ��ϵͳ���ݷ��͵����ݹ���SQL�����⣬���Է��͵��ֶν��д����ֶ��������ݱ���һ��<BR>
ǿ�ҽ���ʹ�á�ϵͳ��⡱ ģʽ���������������
</td>
</tr>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td class="t1">��Ϣ����״̬</td>
<td class="t2">��Ϣ�ɼ�����״̬��Ĭ�ϡ�ͨ����</td>
</tr>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td class="t1">������־</td>
<td class="t2">����������ɼ�������д����־�ļ�����־�ļ�λ�ã�admin/config/spider/</td>
</tr>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td class="t1">����REFERER</td>
<td class="t2">����ͻ�Ʒ��ɼ����� ��Ĭ��ѡ����,��֪����ô�ã�ѡ���ǡ���ͻ������˵</td>
</tr>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td class="t1">�Է���ҳ����</td>
<td class="t2">���Զ���� GB2312  UTF8  BIG5��Ĭ�ϡ��Զ���⡱ �����뱾վ��ͬ���Զ�����ת��</td>
</tr>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td class="t1">���ⲻ�����ظ�</td>
<td class="t2">�����󣬶����Ѵ��ڵ���Ϣ���⽫���ٲɼ������ô����΢�������ݿ�ĸ���</td>
</tr>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td class="t1">��ϸ�����Ƿ��ʽ��</td>
<td class="t2">��ʽ�����ݽ�ȥ�����ݵ�HTML��ǩ��ָ�ɼ���Ϣ����ϸ���ݣ���ָ���вɼ���ǩ���ݣ�������ɼ����������Ű��ʽ����ʽ���󽫲����ڣ�һ�㲻�ø�ʽ��</td>
</tr>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td class="t1">��Ϣ���������</td>
<td class="t2">���÷�������⣬�ɼ���Ϣͬʱ��ɼ���Ϣ��������Ϣ������ֻ��¼�������û���������ɼ�������������Ϣ����ʹ�õ�ǰ��½�û���Ϊ�����ˡ���������������ݿ�ĸ��أ������������ڲɼ������б�����Ӳɼ���ǩuid�����滻��Ա����ҳURL��ַ�ı���<{infoid}>��uidΪ��ʱʹ��usernameֵ
</td>
</tr>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td class="t1">�����˹�������</td>
<td class="t2">������Ϣ��������⣬��ѡ��һ����Ա�ɼ�����</td>
</tr>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td class="t1"><span>*</span> ����ҳURL��ַ</td>
<td class="t2">Ҫ�ɼ�������ҳURL������http://chengdu.aifang.com/loupan/canshu-<{infoid}>.html��<{infoid}>��Ҫ�滻����ű���</td>
</tr>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td class="t1"><span>*</span> �ɼ������б�</td>
<td class="t2">����Ҫ�ɼ������ݱ�ǩ����ÿ��������뻻�У���д��ʽΪ����ǩ��=��������title=&lt;input type='hidden' name='title' value="(.*)"������һ������ɼ�����<br>ÿ��ģ�鶼������ǩ��������ÿ����ǩ��Ҫ�ɼ�</td>
</tr>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td class="t1">��ҳ�ɼ�����</td>
<td class="t2">�˴�����ָ���ݵķ�ҳ�ɼ�������ָҪ�ɼ��ı�ǩ���ܲ�����ͬһҳ�棬���磺��Ա��Ϣ�Ĳɼ�����ϵ��Ϣ�͹�˾��Ϣ�ڲ�ͬҳ�棬��Ҫʹ�ö�ҳ�ɼ���<BR>
��ҳ������д��ʽ��pageurl=�ɼ�ҳURL��URL��ʽ����������ҳURL��ʽһ������ʹ������ҳURL�ı���<{infoid}>����������ɼ������б����Ѳɼ��ı���������<{��}>��������<{username}>��username�����������Ѿ��ɼ����ı������������Ǿ������Ȼ������д������򣬸�ʽ�Ͳɼ������б��ʽһ��<BR>��ҳ�ɼ�������ɼ��ٶȣ�������ʹ��
</td>
</tr>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td class="t1">���ݷ�ҳ�ɼ�ģʽ</td>
<td class="t2">
������ҳ����Ĭ��Ϊ����ҳ��ѡ���ģʽ����ʱ��д�˷�ҳ����Ҳ���ɼ���ҳ<BR>
����ҳ�б�����ģʽ�Ȳɼ����з�ҳURL�б��ٰ��б�ɼ���ҳ����<BR>
����һҳ�����ڲɼ��굱ǰҳ���ݺ��ٲɼ���һ��ҳURL��ѭ��ֱ����ҳ�������������������������ѭ����������ʹ��
</td>
</tr>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td class="t1">���ݷ�ҳ����</td>
<td class="t2">
����ҳ�б�������д��ǩcont_listarea,cont_listurl��cont_listurlΪ���еķ�ҳURL<BR>
����һҳ��������д��ǩcont_listarea,cont_nextpage��cont_nextpageΪ��һҳURL���������������������ѭ����������ʹ��<BR>
���У�cont_listareaΪѡ������Ǳ�����д
</td>
</tr>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td class="t1">�滻�����б�</td>
<td class="t2">�ɼ��������ǩֵ������滻����ʽ��Ҫ�滻ֵ@@�滻ֵ�����ޡ�@@������˷������ݣ������滻�á�##����������°汾�Ѿ�֧����������content=&lt;a.+?&gt;##&lt;script&gt;.+?&lt;/script&gt;����������������A��ǩ��script��ǩ</td>
</tr>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td class="t1">Ĭ�ϳ����б�</td>
<td class="t2">���ɼ���ǩֵΪ�ջ�û�вɼ��˱�ǩʱ��ʹ�����õ�Ĭ��ֵ����</td>
</tr>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td class="t1"></td>
<td class="t2"></td>
</tr>
</table>
<div class="tt">�б����˵��</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td width="200" class="t1"><span>*</span> �ɼ���������</td>
<td class="t2">�������д����Ҫ��Ϊ������</td>
</tr>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td class="t1">Ĭ�Ϸ���</td>
<td class="t2">�˴�������һ���б�����Ĭ�Ϸ��࣬����˴�������Ĭ�Ϸ��࣬������ʹ�ô˴�Ĭ��ֵ������ʹ�����ݹ����Ĭ��ֵ</td>
</tr>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td class="t1">Ĭ�ϵ���</td>
<td class="t2">�˴�������һ���б�����Ĭ�ϵ���������˴�������Ĭ�ϵ�����������ʹ�ô˴�Ĭ��ֵ������ʹ�����ݹ����Ĭ��ֵ</td>
</tr>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td class="t1"><span>*</span> �б�ҳ��URL</td>
<td class="t2">
Ŀ����վ�б�ҳ��ַ���ɼ�����ҳ����ţ������滻���ݹ���ҳ���е�����URL�����<{infoid}>������б�ҳֻ��һҳ����ֱ����д�б�ҳURL��ַ�����Ϊ��ҳ������<{pageid}>����ҳ��<br>
�����Ҫʹ�ð���Ա�б�ģʽ�ɼ���Ա��Ϣ��ͬʱ�ɼ���Ա��������Ϣ�б��˴���Ҫʹ��<{compuserid}>�����ԱID������http://chengdu.aifang.com/loupan/jinjiang/s?m=1&p=<{pageid}>&p1=904
</td>
</tr>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td class="t1">�б�����ʶ�����</td>
<td class="t2">������ȡ����ҳURL�б�����</td>
</tr>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td class="t1"><span>*</span> ��Ϣ��Ųɼ�����</td>
<td class="t2">��ȡ����ҳ��<{infoid}>���</td>
</tr>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td class="t1">��һҳ��ҳ��ɼ�����</td>
<td class="t2">���Ҫ�ɼ���ҳ�б��˴���дҪ�ɼ�����һҳURL��ҳ�룬����������URL���������ձ�ʾû�еڶ�ҳ������ ++ ���ʾҳ������Ǽ�1��ʽ�����ģ���������ҳ��Ĳɼ�����</td>
</tr>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td class="t1">��ʼҳҳ��</td>
<td class="t2">���Ҫ�ɼ���ҳ�б��˴�������Ҫ�ɼ��б�ҳ����ʼҳ���ɲ���д��Ĭ��Ϊ��ʱ�б�ҳ�ӵ�һҳ�ɼ�</td>
</tr>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td class="t1">���ɼ�ҳ��</td>
<td class="t2">��0�����ձ�ʾ�����Ʋɼ�ҳ��</td>
</tr>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td class="t1"></td>
<td class="t2"></td>
</tr>
</table>
<div class="tt">�����ɼ�˵��</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td width="200" class="t1">����Ա�б�ɼ���Ϣ�б�</td>
<td class="t2">�������ɼ����ѡ��ɼ���Ա�ɼ�����ʱ������һ������˾��Ϣ�б�ɼ�URL�����˴�Ĭ�����գ������дURL����ʾ�ڲɼ���Ա��Ϣʱ����ɼ���Ա��˾ҳ�������Ϣ�б���Ҫ����Ӷ�Ӧ��Ϣ�б����Ȼ������б���������棬���ƶ����ɼ�URL�����˴������� ��http://localhost/admin.php?file=collectbatch&action=collect&moduleid=5&siteid=2&auth=123456&collectname=1&startpageid=��ʼҳ���&maxpagenum=���ɼ�ҳ����</td>
</tr>
</table>
<div class="tt">���ݹ���˵��</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td width="200" class="t1">�ɼ����ݹ���</td>
<td class="t2">���ɼ�ѡ������ģʽʱ���ɼ�����ʫ�䲻��⣬�ᱣ����TXT�ļ�������ݹ�������Ե������ݣ����ݵ������Զ�ɾ��<br>
�ɼ�������Ҳ���Ա��ݡ��ָ���ɾ������Ϊ�������ı���ʽ���棬����ɾ����Ϣ������ɾ����Ϣ��һ����ʶ����ǰ̨������ʾ�������ݻ��Ǵ��ڵģ����Ųɼ�����Խ��Խ�࣬�ı��ļ�ҲԽ��Խ�󣬽��鶨ʱ����������ݣ���ʱ��������ɾ�����вɼ�����<BR>
ȱ�㣺��Ϊ���������Ǳ������ı��ļ��������ʱ��������������Ϣ��ʧ����Ϣ����<BR>
�ŵ㣺���߲ɼ�ģʽ����ӿ�ɼ��ٶȣ����ҵ�������ʱ����ѡ����ࡢ�����ͷ���ʱ�䣬������Ϣ�����ɣ����Ҳɼ������������ݣ����Դ�������κ�AIJIACMSϵͳ���з��������Ŀ¼admin/config/data/
</td>
</tr>
<tr>
<td width="200" class="t1">EXCEL����</td>
<td class="t2">���°汾֧�ִ�EXCEL���ﵼ�����ݣ�����EXCEL��֧�ֶ���������룬Ҫע����ǣ�һ��EXCEL�������ͬһ��ģ������ݣ������ڵ���ʱ������ѡ����Ӧ��ģ�飬��������<BR>
EXCEL�����ݵı���ʽҲ�ܼ򵥣�ÿ��������ĵ�һ�б�����ģ��ı�ǩ������title��content�ȣ��ڶ��п�ʼ�Ǿ�������
</td>
</tr>
</table>
<div class="tt">���ñ�ǩ˵��</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th width="200">��ǩ��</th>
<th>��ǩ˵��</th>
</tr>
<?php foreach($names as $k=>$v) {?>
<tr align="center" onmouseover="this.className='on';" onmouseout="this.className='';">
<td><?php echo  $k;?></td>
<td><?php echo $v;?></td>
</tr>
<?php }?>
</table>
<script type="text/javascript">Menuon(3);</script>
</body>
</html>