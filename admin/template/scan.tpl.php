<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
show_menu($menus);
?>
<?php if($submit) { ?>

<div class="tt">ɨ����</div>
<table cellpadding="2" cellspacing="1" class="tb">
<?php if($lists) { ?>
<tr>
<th>�ļ�</th>
<th>������</th>
<th>ƥ�����</th>
<th>��С</th>
<th>�޸�ʱ��</th>
</tr>
	<?php foreach($lists as $v) { ?>
	<tr align="center">
	<td align="left">&nbsp;<img src="admin/image/notice.gif" alt="" align="absmiddle"/> <a href="<?php echo $v['file'];?>" target="_blank" class="f_fd">./<?php echo $v['file'];?></a></td>
	<td><input type="text" size="30" value="<?php echo $v['code'];?>" class="f_fd f_red"/></td>
	<td class="px11<?php echo $v['num'] > 2 ? ' f_red' : '';?>"><?php echo $v['num'];?></td>
	<td class="px11"><?php echo dround(filesize(AJ_ROOT.'/'.$v['file'])/1024);?> Kb</td>
	<td class="px11"><?php echo timetodate(filemtime(AJ_ROOT.'/'.$v['file']), 6);?></td>
	</tr>
	<?php } ?>
	<tr>
	<td colspan="5" height="30" class="f_blue">&nbsp;&nbsp;&nbsp;&nbsp;- ������<strong><?php echo $find;?></strong>�������ļ����������ֶ�����ļ������Ƿ�ȫ&nbsp;&nbsp;&nbsp;&nbsp;<a href="?file=<?php echo $file;?>" class="t">[����ɨ��]</a></td>
	</tr>
<?php } else { ?>
<tr>
<td class="f_green" height="40">&nbsp;- ָ����Χû��ɨ�赽�����ļ�&nbsp;&nbsp;&nbsp;&nbsp;<a href="?file=<?php echo $file;?>" class="t">[����ɨ��]</a></td>
</tr>
<?php } ?>
</table>

<?php } else { ?>
<form method="post" action="?" id="scan_form">
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<div class="tt">ľ��ɨ��</div>
<table cellpadding="6" cellspacing="1" class="tb">
<tr>
<td width="80">&nbsp;ѡ��Ŀ¼<br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:" onclick="checkall(Dd('scan_form'), 0);Dd('dir_file').checked=false;" class="t">ȫѡ</a></td>
<td>
<table cellpadding="2" cellspacing="2" width="600">
<?php foreach($dirs as $k=>$d) { ?>
<?php if($k%4==0) {?><tr><?php } ?>
<td width="150"><input type="checkbox" name="filedir[]" value="<?php echo $d;?>"<?php echo in_array($d, $sys) ? ' checked' : '';?><?php echo in_array($d, $fbs) ? ' disabled' : '';?> id="dir_<?php echo $d;?>"/><label for="dir_<?php echo $d;?>">&nbsp;<img src="admin/image/folder.gif" width="16" height="14" alt="" align="absmiddle"/> <?php echo $d;?></label></td>
<?php if($k%4==3) {?></tr><?php } ?>
<?php } ?>
</table>
</td>
</tr>
<tr>
<td>&nbsp;�ļ�����</td>
<td>&nbsp;<input type="text" size="60" name="fileext" value="<?php echo $fileext;?>" class="f_fd"/></td>
</tr>
<tr>
<td>&nbsp;�ļ�����</td>
<td>
&nbsp;<input type="radio" name="charset" value="gbk" checked/> GBK&nbsp;&nbsp;
<input type="radio" name="charset" value="utf-8"/> UTF-8
</td>
</tr>
<tr>
<td>&nbsp;��������</td>
<td>&nbsp;<textarea name="code" id="code" style="width:600px;height:50px;overflow:visible;font-family:Fixedsys,verdana;"><?php echo $code;?></textarea></td>
</tr>
<tr>
<td>&nbsp;ƥ�����</td>
<td>&nbsp;<input type="text" size="2" name="codenum" value="2" class="f_fd"/> ������</td>
</tr>
<tr>
<td></td>
<td height="30">&nbsp;<input type="submit" name="submit" value="��ʼɨ��" class="btn" onclick="this.value='ɨ����..';this.blur();this.className='btn f_gray';"/>
</td>
</tr>
</table>
</form>
<?php } ?>
<script type="text/javascript">Menuon(0);</script>
<?php include tpl('footer');?>