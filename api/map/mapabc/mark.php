<?php
require '../../../common.inc.php';
include AJ_ROOT.'/api/map/mapabc/config.inc.php';
$map = isset($map) ? $map : '';
preg_match("/^[0-9\.\,]{17,21}$/", $map) or $map = $map_mid;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo AJ_CHARSET;?>" />
<title>MapABC - �����עλ��</title>
<style type="text/css">
html{height:100%}
body{height:100%;margin:0px;padding:0px}
#map{height:100%}
</style>
<script type="text/javascript">window.onerror=function(){return true;}</script>
<script type="text/javascript" src="<?php echo AJ_PATH;?>file/script/config.js"></script>
<script type="text/javascript" src="http://app.mapabc.com/apis?&t=flashmap&v=2.4&key=<?php echo $map_key;?>"></script>
<script type="text/javascript">
var mapObj=null;
function mapInit() {
	var mapoption = new MMapOptions();
	mapoption.toolbar = MConstants.ROUND; //���õ�ͼ��ʼ����������ROUND:�°�Բ������
	mapoption.overviewMap = MConstants.SHOW; //����ӥ�۵�ͼ��״̬��SHOW:��ʾ��HIDE:���أ�Ĭ�ϣ�
	mapoption.scale = MConstants.SHOW; //���õ�ͼ��ʼ��������״̬��SHOW:��ʾ��Ĭ�ϣ���HIDE:���ء�
	mapoption.zoom = 13;//Ҫ���صĵ�ͼ�����ż���
	mapoption.center = new MLngLat(<?php echo $map;?>);//Ҫ���صĵ�ͼ�����ĵ㾭γ������
	mapoption.language = MConstants.MAP_CN;//���õ�ͼ���ͣ�MAP_CN:���ĵ�ͼ��Ĭ�ϣ���MAP_EN:Ӣ�ĵ�ͼ
	mapoption.fullScreenButton = MConstants.SHOW;//�����Ƿ���ʾȫ����ť��SHOW:��ʾ��Ĭ�ϣ���HIDE:����
	mapoption.centerCross = MConstants.SHOW;//�����Ƿ��ڵ�ͼ����ʾ����ʮ��,SHOW:��ʾ��Ĭ�ϣ���HIDE:����
	mapoption.toolbarPos=new MPoint(20,20); //���ù������ڵ�ͼ�ϵ���ʾλ��
	mapObj = new MMap("map", mapoption); //��ͼ��ʼ��
	mapObj.addEventListener(mapObj,MConstants.MOUSE_CLICK,MclickMouse);//������¼�
}
function MclickMouse(param){	
	window.parent.document.getElementById('map').value = param.eventX+','+param.eventY;
	window.parent.cDialog();
}
</script>
</head>
<body onload="mapInit();">
<div id="map"></div>
</body>
</html>