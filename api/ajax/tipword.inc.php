<?php
defined('IN_AIJIACMS') or exit('Access Denied');
if(!$AJ['search_tips']) exit;
$mid = isset($mid) ? intval($mid) : 0;
$mid or exit;
isset($MODULE[$mid]) or exit;
if(!$word || strlen($word) < 2 || strlen($word) > 30) exit;
$word = convert($word, 'UTF-8', AJ_CHARSET);	
$word = str_replace(array(' ','*', "\'"), array('%', '%', ''), $word);
if(preg_match("/^[a-z0-9A-Z]+$/", $word)) {			
	tag("moduleid=$mid&table=keyword&condition=moduleid=$mid and letter like '%$word%'&pagesize=10&order=total_search desc&template=list-search_tip", -2);
} else {
	tag("moduleid=$mid&table=keyword&condition=moduleid=$mid and keyword like '%$word%'&pagesize=10&order=total_search desc&template=list-search_tip", -2);
}
?>