<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include tpl('header');
//show_menu($menus);
?>
<form action="?">
<div class="tt">��¼����</div>
<input type="hidden" name="moduleid" value="<?php echo $moduleid;?>"/>
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="pollid" value="<?php echo $pollid;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>
&nbsp;
<input type="text" size="30" name="kw" value="<?php echo $kw;?>" title="��Ա��IP"/>&nbsp;
<select name="itemid">
<option value="0">ͶƱѡ��</option>
<?php
foreach($I as $k=>$v) {
?>
<option value="<?php echo $k;?>" <?php echo $k == $itemid ? ' selected' : '';?>><?php echo $v['title'];?></option>
<?php
}
?>
</select>
&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="��/ҳ"/>
<input type="submit" value="�� ��" class="btn"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="Go('?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>&pollid=<?php echo $pollid;?>');"/>&nbsp;&nbsp;
<input type="button" value=" �� �� " class="btn" onclick="window.parent.cDialog();"/>
</td>
</tr>
</table>
</form>
<div class="tt">[<?php echo $P['title'];?>] ͶƱ��¼</div>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<th>IP</th>
<th>����</th>
<th>��Ա��</th>
<th>ͶƱʱ��</th>
<th>ѡ��</th>
</tr>
<?php foreach($lists as $k=>$v) {?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><?php echo $v['ip'];?></td>
<td><?php echo ip2area($v['ip']);?></td>
<td><a href="javascript:_user('<?php echo $v['username'];?>');"><?php echo $v['username'];?></a></td>
<td class="px11"><?php echo $v['polldate'];?></td>
<td><?php echo $I[$v['itemid']]['title'];?></td>
</tr>
<?php }?>
</table>
<div class="pages"><?php echo $pages;?></div>
<br/>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>