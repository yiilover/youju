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
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
<table cellpadding="2" cellspacing="1" class="tb">
<tr>
<td>
&nbsp;
<input type="text" size="50" name="kw" value="<?php echo $kw;?>" title="��Ա��IP"/>
&nbsp;
<input type="text" name="psize" value="<?php echo $pagesize;?>" size="2" class="t_c" title="��/ҳ"/>
<input type="submit" value="�� ��" class="btn"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="Go('?moduleid=<?php echo $moduleid;?>&file=<?php echo $file;?>&action=<?php echo $action;?>&itemid=<?php echo $itemid;?>');"/>&nbsp;
<input type="button" value="�� ��" class="btn" onclick="window.parent.cDialog();"/>
</td>
</tr>
</table>
</form>
<div class="tt">[<?php echo $title;?>] ͶƱ��¼</div>
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
<td class="px11"><?php echo $v['votedate'];?></td>
<td>
<?php
foreach(explode(',', $v['votes']) as $v) {
	echo $votes[$v].'<br/>';
}
?>
</td>
</tr>
<?php }?>
</table>
<div class="pages"><?php echo $pages;?></div>
<br/>
<script type="text/javascript">Menuon(1);</script>
<?php include tpl('footer');?>