<?php
defined('IN_AIJIACMS') or exit('Access Denied');
?>
<tr>
<td class="tl">��˾��ͼ��ע</td>
<td class="tr">
<input type="text" name="setting[map]" id="map" value="<?php echo $map;?>" readonly size="50" onclick="MapMark();"/>&nbsp;&nbsp;
<a href="javascript:MapMark();" class="t">��ע</a>&nbsp;|&nbsp;<a href="javascript:DelMark();" class="t">���</a>
<script type="text/javascript">
function MapMark() {
	Dwidget(DTPath+'api/map/google/mark.php?map='+Dd('map').value, '�ȸ��ͼ��ע - �ڵ�ͼ��˫�������ɱ�ע');
}
function DelMark() {
	Dd('map').value='';
}
</script>
</td>
</tr>