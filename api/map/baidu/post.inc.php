<?php
defined('IN_AIJIACMS') or exit('Access Denied');
?>

<input type="text" name="post[map]" id="map" value="<?php echo $map;?>" readonly size="50" onclick="MapMark();"/>&nbsp;&nbsp;
<a href="###" onclick="MapMark();" class="t">��ע</a>&nbsp;|&nbsp;<a href="###" onclick="Dd('map').value=''" class="t">���</a>
<script type="text/javascript">
function MapMark() {
	window.open(DTPath+'api/map/baidu/mark.php?map='+Dd('map').value);
}
</script>
