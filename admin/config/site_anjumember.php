<?php
$myCollect['sitename'] = "安居客会员";
$myCollect['siteurl'] = "http://chengdu.anjuke.com";
$myCollect['modid'] = "2";
$myCollect['apiname'] = "";
$myCollect['proxy_host'] = "";
$myCollect['proxy_port'] = "";
$myCollect['verify_mode'] = "2";
$myCollect['spider_auth'] = "123456";
$myCollect['spider_ip'] = "";
$myCollect['spider_mode'] = "0";
$myCollect['spider_status'] = "3";
$myCollect['spider_errlog'] = "0";
$myCollect['referer'] = "0";
$myCollect['pagecharset'] = "auto";
$myCollect['titlerepeat'] = "1";
$myCollect['formatcontent'] = "0";
$myCollect['collectuser'] = "0";
$myCollect['urluser'] = "";
$myCollect['urlinfo'] = "http://chengdu.anjuke.com/shop/view/<{infoid}>";
$myCollect['contpagemode'] = "0";
$myCollect['rule']['username'] = "<dl class=\"profile_content_right\">\s*<dt><b>(.*)</b>";
$myCollect['rule']['truename'] = "<dl class=\"profile_content_right\">\s*<dt><b>(.*)</b>";
$myCollect['rule']['company'] = "就职于：<a href=\".*\" target=\"_store\">(.*)</a>";
$myCollect['rule']['telephone'] = "<span>&nbsp;&nbsp;&nbsp;&nbsp;(.*)</span>";
$myCollect['rule']['mobile'] = "<span>&nbsp;&nbsp;&nbsp;&nbsp;(.*)</span>";
$myCollect['rule']['touxiang'] = "<img width=\"100\" height=\"133\" src=\"(.*)\" onclick";
$myCollect['defaultvalue']['password'] = "123888";
$myCollect['defaultvalue']['cpassword'] = "123888";
$myCollect['defaultvalue']['groupid'] = "6";
$myCollect['listcollect']['0']['title'] = "锦江区会员";
$myCollect['listcollect']['0']['catid'] = "20";
$myCollect['listcollect']['0']['areaid'] = "2";
$myCollect['listcollect']['0']['urlpage'] = "http://chengdu.anjuke.com/tycoon/jinjiang/p<{pageid}>-st1";
$myCollect['listcollect']['0']['listarea'] = "<div class=\"tycoon_list\">(.*)";
$myCollect['listcollect']['0']['infoid'] = "<li id=\"(\d*)\" class=\"list_box\"";
$myCollect['listcollect']['0']['nextpageid'] = "++";
$myCollect['listcollect']['0']['startpageid'] = "1";
$myCollect['listcollect']['0']['maxpagenum'] = "0";

?>