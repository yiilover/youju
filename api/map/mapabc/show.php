<?php
require '../../../common.inc.php';
include AJ_ROOT.'/api/map/mapabc/config.inc.php';
$map = isset($map) ? $map : '';
preg_match("/^[0-9\.\,]{17,21}$/", $map) or $map = $map_mid;
$company = isset($company) ? trim(strip_tags($company)) : '';
$address = isset($address) ? trim(strip_tags($address)) : '';
($company && $address) or exit;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo AJ_CHARSET;?>" />
<title>MapABC</title>
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
	mapObj.addEventListener(mapObj,MConstants.ADD_OVERLAY,addOverlayEvent);
}
var tipOption=new MTipOptions();
function addFlashTip(){
	mapObj.removeAllOverlays();
	var fontstyle=new MFontStyle();
	fontstyle.size=13;
	fontstyle.color=0x333333;
	fontstyle.bold=true;

	var fontstyle1=new MFontStyle();
	fontstyle1.size=12;
	fontstyle1.color=0x333333;//����������ɫ��Ч
	fontstyle1.bold=false;

	tipOption.title="<?php echo $company;?>";
	tipOption.titleFontStyle=fontstyle;

	tipOption.content="<?php echo $address;?>";
	tipOption.contentFontStyle=fontstyle1;

	tipOption.roundRectSize=20;//tip����Բ�߳���
	tipOption.tipType=MConstants.FLASH_BUBBLE_TIP;
	tipOption.hasShadow=true;
}
function addMarker(){
	addFlashTip();
	var markerOption = new MMarkerOptions();
	markerOption.imageUrl="http://code.mapabc.com/images/lan_1.png";
	markerOption.picAgent=false;
	markerOption.imageAlign=MConstants.BOTTOM_CENTER;
	markerOption.tipOption = tipOption;
	markerOption.canShowTip= true;
	var marker = new MMarker(new MLngLat(<?php echo $map;?>),markerOption);
	marker.id="marker01";
	mapObj.addOverlay(marker,true) ;
}
function addOverlayEvent(param){
	mapObj.openOverlayTip(param.overlayId);
}
</script>
</head>
<body onload="mapInit();addMarker();">
<div id="map"></div>
</body>
</html>