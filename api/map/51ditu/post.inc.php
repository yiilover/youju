<?php
defined('IN_AIJIACMS') or exit('Access Denied');
include AJ_ROOT.'/api/map/51ditu/config.inc.php';
preg_match("/^[0-9\.\,]{13,17}$/", $map) or $map = $map_mid;
?>
<tr>
<td class="tl">��˾��ͼ��ע</td>
<td class="tr">
<input type="text" name="setting[map]" id="map" value="<?php echo $map;?>" readonly size="50" onclick="MapMark();"/>&nbsp;&nbsp;
<a href="javascript:MapMark();" class="t">��ע</a>&nbsp;|&nbsp;<a href="javascript:DelMark();" class="t">���</a>
<script type="text/javascript">
function MapMark() {
	Dwidget(DTPath+'api/map/51ditu/mark.php?map='+Dd('map').value, '��ͼ��ע');
}
function DelMark() {
	Dd('map').value='';
}
</script>
</td>
</tr>