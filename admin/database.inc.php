<?php
/*
	[aijiacms house system] Copyright (c) 2008-2013 aijiacms.COM
	This is NOT a freeware, use is subject to license.txt
*/
defined('IN_AIJIACMS') or exit('Access Denied');
require AJ_ROOT.'/include/sql.func.php';
$menus = array (
    array('���ݿⱸ��', '?file='.$file),
    array('���ݿ�ָ�', '?file='.$file.'&action=import'),
    array('�ַ��滻', '?file='.$file.'&action=replace'),
    array('ִ��SQL', '?file='.$file.'&action=execute'),
    array('��ʾ����', '?file='.$file.'&action=process'),
    //array('���ݻ�ת', '?file='.$file.'&action=move'),
    array('���ݵ���', '?file=data'),
);
$this_forward = '?file='.$file;
$D = AJ_ROOT.'/file/backup/';
isset($dir) or $dir = '';
switch($action) {
	case 'repair':
		$AJ['close'] or msg('Ϊ�����ݰ�ȫ���˲�����������վ������ر���վ');
		$table or msg('TableΪ��');
		$db->query("REPAIR TABLE `$table`");
		dmsg('�޸��ɹ�', $this_forward);
	break;
	case 'optimize':
		$AJ['close'] or msg('Ϊ�����ݰ�ȫ���˲�����������վ������ر���վ');
		$table or msg('TableΪ��');
		$db->query("OPTIMIZE TABLE `$table`");
		dmsg('�Ż��ɹ�', $this_forward);
	break;
	case 'drop':
		if(!$tables) msg();
		if(is_array($tables)) {
			foreach($tables as $table) {
				if(strpos($table, $AJ_PRE) === false) $db->query("DROP TABLE `$table`");
			}
		}
		dmsg('ɾ���ɹ�', $this_forward);
	break;
	case 'execute':
		if(!isset($CFG['executesql']) || !$CFG['executesql']) msg('ϵͳ��ֹ��ִ��SQL����FTP�޸ĸ�Ŀ¼config.inc.php<br/>$CFG[\'executesql\'] = \'0\'; �޸�Ϊ $CFG[\'executesql\'] = \'1\';');
		if($submit) {
			if(trim($sql) == '') {
				msg('SQL���Ϊ��');
			} else {
				$sql = stripslashes($sql);
				if(preg_match("/DROP(.*)(TABLE|DATABASE)/i", $sql)) msg('ϵͳ��ֹDROP���');				
				sql_execute($sql);
				dmsg('ִ�гɹ�', '?file='.$file.'&action=execute');
			}
		} else {
			include tpl('database_execute');
		}
	break;
	case 'process':
		$lists = array();
		$result = $db->query("SHOW PROCESSLIST");
		while($r = $db->fetch_array($result)) {
			$lists[] = $r;
		}
		include tpl('database_process');
	break;
	case 'kill':
		$id = isset($id) ? intval($id) : 0;
		$db->halt = 0;
		if($id) $db->query("KILL $id");
		dmsg('�����ɹ�', '?file='.$file.'&action=process');
	break;
	case 'comments':
		$db->halt = 0;
		$C = include(AJ_ROOT.'/file/setting/table-comment.php');
		foreach($C as $k=>$v) {
			$sql = "ALTER TABLE `{$AJ_PRE}{$k}` COMMENT='{$v}'";
			$db->query($sql);
		}
		foreach($MODULE as $k=>$v) {
			if(in_array($v['module'], array('article', 'brand', 'buy', 'down', 'info', 'photo', 'sell', 'video'))) {
				$sql = "ALTER TABLE `".$AJ_PRE.$v['module']."_".$v['moduleid']."` COMMENT='".$v['name']."'";
				$db->query($sql);
				$sql = "ALTER TABLE `".$AJ_PRE.$v['module']."_data_".$v['moduleid']."` COMMENT='".$v['name']."����'";
				$db->query($sql);
			}
		}
		dmsg('�ؽ��ɹ�', '?file='.$file);
	break;
	case 'comment':
		$table or msg('TableΪ��');
		if($submit) {
			$name = trim($name);
			$db->query("ALTER TABLE `{$table}` COMMENT='{$name}'");
			dmsg('�޸ĳɹ�', '?file='.$file);
		} else {
			include tpl('database_comment');
		}
	break;
	case 'export':
		if(!$table) msg();
		//$memory_limit = trim(@ini_get('memory_limit'));
		$sizelimit = 1024*1024;//Max 1G
		file_down('', $table.'.sql', sql_dumptable($table));
	break;
	case 'download':
		$file_ext = file_ext($filename);
		if($file_ext != 'sql') msg('ֻ������SQL�ļ�');
		file_down($dir ? $D.$dir.'/'.$filename : $D.$filename);
	break;
	case 'delete':
		if(!is_array($filenames)) {
			$tmp = $filenames;
			$filenames = array();
			$filenames[0] = $tmp;
		}
		foreach($filenames as $filename) {
			if(file_ext($filename) == 'sql') {
				file_del($dir ? $D.$dir.'/'.$filename : $D.$filename);
			} else if(is_dir($D.$filename)) {
				dir_delete($D.$filename);
			}
		}
		dmsg('ɾ���ɹ�', $forward);
	break;
	case 'move':
		if($submit) {
			$condition = str_replace('and', 'AND', trim($condition));
			$condition = strpos($condition, 'AND') === false ? "itemid IN ($condition)" : substr($condition, 3);
			if($type == 1) {
				$ftb = $AJ_PRE.'sell_5';
				$ftb_data = $AJ_PRE.'sell_data_5';
				$fmid = 5;
				$ttb = $AJ_PRE.'buy_6';
				$ttb_data = $AJ_PRE.'buy_data_6';
				$tmid = 6;
			} else if($type == 2) {
				$ftb = $AJ_PRE.'buy_6';
				$ftb_data = $AJ_PRE.'buy_data_6';
				$fmid = 6;
				$ttb = $AJ_PRE.'sell_5';
				$ttb_data = $AJ_PRE.'sell_data_5';
				$tmid = 5;
			} else if($type == 5) {
				$ftb = $AJ_PRE.'sell_5';
				$ftb_data = $AJ_PRE.'sell_data_5';
				$fmid = 5;
				$ttb = $AJ_PRE.'mall';
				$ttb_data = $AJ_PRE.'mall_data';
				$tmid = 16;
			} else if($type == 6) {
				$ftb = $AJ_PRE.'mall';
				$ftb_data = $AJ_PRE.'mall_data';
				$fmid = 16;
				$ttb = $AJ_PRE.'sell_5';
				$ttb_data = $AJ_PRE.'sell_data_5';
				$tmid = 5;
			} else if($type == 3) {
				$ftb = $AJ_PRE.'article_'.$afid;
				$ftb_data = $AJ_PRE.'article_data_'.$afid;
				$fmid = $afid;
				$ttb = $AJ_PRE.'article_'.$atid;
				$ttb_data = $AJ_PRE.'article_data_'.$atid;
				$tmid = $atid;
			} else if($type == 4) {
				$ftb = $AJ_PRE.'info_'.$ifid;
				$ftb_data = $AJ_PRE.'info_data_'.$ifid;
				$fmid = $ifid;
				$ttb = $AJ_PRE.'info_'.$itid;
				$ttb_data = $AJ_PRE.'info_data_'.$itid;
				$tmid = $itid;
			} else {
				message('��ѡ��ת������');
			}
			$i = 0;
			$fs = array();
			$result = $db->query("SHOW COLUMNS FROM `$ttb`");
			while($r = $db->fetch_array($result)) {
				$fs[] = $r['Field'];
			}
			$result = $db->query("SELECT * FROM {$ftb} WHERE $condition");
			while($r = $db->fetch_array($result)) {
				$fid = $r['itemid'];
				unset($r['itemid']);
				$r['catid'] = $catid;
				$r = daddslashes($r);
				if(is_file(AJ_CACHE.'/'.$fmid.'.part')) $ftb_data = split_table($fmid, $fid);
				$d = $db->get_one("SELECT content FROM {$ftb_data} WHERE itemid=$fid");
				$content = daddslashes($d['content']);			
				$sqlk = $sqlv = '';
				foreach($r as $k=>$v) {
					if($fs && !in_array($k, $fs)) continue;
					$sqlk .= ','.$k; $sqlv .= ",'$v'";
				}
				$sqlk = substr($sqlk, 1);
				$sqlv = substr($sqlv, 1);
				$db->query("INSERT INTO {$ttb} ($sqlk) VALUES ($sqlv)");
				$tid = $db->insert_id();
				if(is_file(AJ_CACHE.'/'.$tmid.'.part')) $ttb_data = split_table($tmid, $tid);
				$db->query("INSERT INTO {$ttb_data} (itemid,content)  VALUES ('$tid', '$content')");
				$linkurl = str_replace($fid, $tid, $r['linkurl']);
				$db->query("UPDATE {$ttb} SET linkurl='$linkurl' WHERE itemid=$tid");
				if($delete) {
					$db->query("DELETE FROM {$ftb} WHERE itemid=$fid");
					$db->query("DELETE FROM {$ftb_data} WHERE itemid=$fid");
					$html = AJ_ROOT.'/'.$MODULE[$fmid]['moduledir'].'/'.$r['linkurl'];
					if(is_file($html)) @unlink($html);
				}
				$i++;
			}
			message('�ɹ�ת�� '.$i.' ������', '?file='.$file.'&action='.$action, 2);
		} else {
			include tpl('database_move');
		}
	break;
	case 'replace':
		if($submit) {
			if(!$table || !$fields) msg('��ѡ���ֶ�');
			if($type == 1) {
				if(!$from) msg('����д��������');
				$from = stripslashes($from);
				$to = stripslashes($to);
			} else {
				if(!$add) msg('����д׷������');
				$add = stripslashes($add);
			}
			if($conditon) $conditon = stripslashes($conditon);
			$key = '';
			$result = $db->query("SHOW COLUMNS FROM `$table`");
			while($r = $db->fetch_array($result)) {
				if($r['Key'] == 'PRI') {
					$key = $r['Field'];
					break;
				}
			}
			$key or msg('��'.$table.'���������޷���ɲ���');
			$key != $fields or msg('�޷������������');
			$result = $db->query("SELECT `$fields`,`$key` FROM `$table` WHERE 1 $condition");
			while($r = $db->fetch_array($result)) {
				$value = '';
				if($type == 1) {
					$value = str_replace($from, $to, $r[$fields]);
				} else if($type == 2) {
					$value = $add.$r[$fields];
				} else if($type == 3) {
					$value = $r[$fields].$add;
				} else {
					msg();
				}
				$value = addslashes($value);
				$db->query("UPDATE `$table` SET $fields='".$value."' WHERE `$key`='".$r[$key]."'");
			}
			dmsg('�����ɹ�', '?file='.$file.'&action='.$action);
		} else {
			$table_select = '';
			$query = $db->query("SHOW TABLES FROM `".$CFG['db_name']."`");
			while($r = $db->fetch_row($query)) {
				$table = $r[0];
				if(preg_match("/^".$AJ_PRE."/i", $table)) {
					$table_select .= '<option value="'.$table.'">'.$table.'</option>';         
				}
			}
			$sql_select = '';
			$sqlfiles = glob($D.'*');
			if(is_array($sqlfiles)) {				
				$sqlfiles = array_reverse($sqlfiles);
				foreach($sqlfiles as $id=>$sqlfile)	{
					$tmp = basename($sqlfile);
					if(is_dir($sqlfile)) $sql_select .= '<option value="'.$tmp.'">'.$tmp.'</option>'; 
				}
			}
			include tpl('database_replace');
		}
	break;
	case 'file_replace':
		if(!$file_pre) msg('��ѡ�������д�����ļ�ǰ׺');
		if(!$file_from) msg('������д��������');
		isset($tid) or $tid = count(glob($D.$file_pre.'/*.sql'));
		$fileid = isset($fileid) ? $fileid : 1;
		$filename = $file_pre.'/'.$fileid.'.sql';
		$dfile = $D.$filename;
		$file_from = urldecode($file_from);
		$file_to = urldecode($file_to);
		if(is_file($dfile)) {
			$sql = file_get($dfile);
			$sql = str_replace($file_from, $file_to, $sql);
			file_put($dfile, $sql);
			$fid = $fileid;
			msg('�־� <strong>#'.$fileid++.'</strong> �滻�ɹ� �����Զ�����...'.progress(0, $fid, $tid), '?file='.$file.'&action='.$action.'&file_pre='.$file_pre.'&fileid='.$fileid.'&tid='.$tid.'&file_from='.urlencode($file_from).'&file_to='.urlencode($file_to));
		} else {
			msg('�ļ������滻�ɹ�', '?file='.$file.'&action=replace');
		}
	break;
	case 'open':
		if(!$dir) msg('��ѡ�񱸷�ϵ��');
		if(!is_dir($D.$dir)) msg('����ϵ�в�����');
		$sql = $sqls = array();
		$sqlfiles = glob($D.$dir.'/*.sql');
		if(!$sqlfiles) msg('����ϵ���ļ�������');
		$tid = count($sqlfiles);
		foreach($sqlfiles as $id=>$sqlfile)	{
			$tmp = basename($sqlfile);
			$sql['filename'] = $tmp;
			$sql['filesize'] = round(filesize($sqlfile)/(1024*1024), 2);
			$sql['pre'] = $dir;
			$sql['number'] = str_replace('.sql', '', $tmp);
			$sql['mtime'] = timetodate(filemtime($sqlfile), 5);
			$sql['btime'] = substr(str_replace('.', ':', $dir), 0, -3);
			$sqls[$sql['number']] = $sql;
		}
		include tpl('database_open');
	break;
	case 'fields':
		(isset($table) && $table) or exit;
		$fields_select = '';
		$result = $db->query("SHOW COLUMNS FROM `$table`");
		while($r = $db->fetch_array($result)) {
			$fields_select .= '<option value="'.$r['Field'].'">'.$r['Field'].'</option>';
		}
		echo '<select name="fields" id="fd"><option value="">ѡ���ֶ�</option>'.$fields_select.'</select>';
		exit;
	break;
	case 'import':
		if(isset($import)) {
			if(isset($filename) && $filename && file_ext($filename) == 'sql') {
				$dfile = $D.$filename;
				if(!is_file($dfile)) msg('�ļ������ڣ�����');
				$sql = file_get($dfile);
				sql_execute($sql);
				msg($filename.' ����ɹ�', '?file='.$file.'&action=import');
			} else {
				$fileid = isset($fileid) ? $fileid : 1;
				$tid = isset($tid) ? intval($tid) : 0;
				$filename = is_dir($D.$filepre) ? $filepre.'/'.$fileid : $filepre.$fileid;
				$filename = $D.$filename.'.sql';
				if(is_file($filename)) {
					$sql = file_get($filename);
					if(substr($sql, 0, 11) == '# aijiacms V') {
						$v = substr($sql, 11, 3);
						if(AJ_VERSION != $v) msg('�������ݽṹ���ڲ��죬�������ݲ����Կ�汾����<br/>���ݰ汾��V'.$v.'<br/>��ǰϵͳ��V'.AJ_VERSION);
					}
					sql_execute($sql);
					$prog = $tid ? progress(1, $fileid, $tid) : '';
					msg('�־� <strong>#'.$fileid++.'</strong> ����ɹ� �����Զ�����...'.$prog, '?file='.$file.'&action='.$action.'&filepre='.$filepre.'&fileid='.$fileid.'&tid='.$tid.'&import=1');
				} else {
					msg('���ݿ�ָ��ɹ�', '?file='.$file.'&action=import');
				}
			}
		} else {
			$dbak = $dbaks = $dsql = $dsqls = $sql = $sqls = array();
			$sqlfiles = glob($D.'*');
			if(is_array($sqlfiles)) {
				$class = 1;
				foreach($sqlfiles as $id=>$sqlfile)	{
					$tmp = basename($sqlfile);
					if(is_dir($sqlfile)) {
						$dbak['filename'] = $tmp;
						$size = $number = 0;
						$ss = glob($D.$tmp.'/*.sql');
						foreach($ss as $s) {
							$size += filesize($s);
							$number++;
						}
						$dbak['filesize'] = round($size/(1024*1024), 2);
						$dbak['pre'] = $tmp;
						$dbak['number'] = $number;
						$dbak['mtime'] = str_replace('.', ':', substr($tmp,	0, 19));
						$dbak['btime'] = substr($dbak['mtime'], 0, -3);
						$dbaks[] = $dbak;
					} else {
						if(preg_match("/([a-z0-9_]+_[0-9]{8}_[0-9a-z]{8}_)([0-9]+)\.sql/i", $tmp, $num)) {
							$dsql['filename'] = $tmp;
							$dsql['filesize'] = round(filesize($sqlfile)/(1024*1024), 2);
							$dsql['pre'] = $num[1];
							$dsql['number'] = $num[2];
							$dsql['mtime'] = timetodate(filemtime($sqlfile), 5);	if(preg_match("/[a-z0-9_]+_([0-9]{4})([0-9]{2})([0-9]{2})_([0-9]{2})([0-9]{2})([0-9a-z]{4})_/i", $num[1], $tm)) {
								$dsql['btime'] = $tm[1].'-'.$tm[2].'-'.$tm[3].' '.$tm[4].':'.$tm[5];
							} else {
								$dsql['btime'] = $dsql['mtime'];
							}
							if($dsql['number'] == 1) $class = $class  ? 0 : 1;
							$dsql['class'] = $class;
							$dsqls[] = $dsql;
						} else {
							if(file_ext($tmp) != 'sql') continue;
							$sql['filename'] = $tmp;
							$sql['filesize'] = round(filesize($sqlfile)/(1024*1024),2);
							$sql['mtime'] = timetodate(filemtime($sqlfile), 5);
							$sqls[] = $sql;
						}
					}
				}
			}
		}
		if($dbaks) $dbaks = array_reverse($dbaks);
		include tpl('database_import');
	break;
	default:
		if(isset($backup)) {
			$fileid = isset($fileid) ? intval($fileid) : 1;
			$sizelimit = $sizelimit ? intval($sizelimit) : 2048;
			if($fileid == 1 && $tables) {
				if(!isset($tables) || !is_array($tables)) msg('��ѡ����Ҫ���ݵı�');
				$random = timetodate($AJ_TIME, 'Y-m-d H.i.s').' '.strtolower(random(10));
				$tsize = 0;
				foreach($tables as $k=>$v) {
					$tsize += $sizes[$v];
				}
				$tid = ceil($tsize*1024/$sizelimit);
				cache_write($_username.'_backup.php', $tables);
			} else {
				if(!$tables = cache_read($_username.'_backup.php')) msg('��ѡ����Ҫ���ݵı�');
			}
			$dumpcharset = $sqlcharset ? $sqlcharset : $CFG['db_charset'];
			$setnames = ($sqlcharset && $db->version() > '4.1' && (!$sqlcompat || $sqlcompat == 'MYSQL41')) ? "SET NAMES '$dumpcharset';\n\n" : '';
			if($db->version() > '4.1') {
				if($sqlcharset) $db->query("SET NAMES '".$sqlcharset."';\n\n");
				if($sqlcompat == 'MYSQL40')	{
					$db->query("SET SQL_MODE='MYSQL40'");
				} else if($sqlcompat == 'MYSQL41') {
					$db->query("SET SQL_MODE=''");
				}
			}
			$sqldump = '';
			$tableid = isset($tableid) ? $tableid - 1 : 0;
			$startfrom = isset($startfrom) ? intval($startfrom) : 0;
			$tablenumber = count($tables);
			for($i = $tableid; $i < $tablenumber && strlen($sqldump) < $sizelimit * 1000; $i++) {
				$sqldump .= sql_dumptable($tables[$i], $startfrom, strlen($sqldump));
				$startfrom = 0;
			}
			if(trim($sqldump)) {
				$sqldump = "# aijiacms V".AJ_VERSION." R".AJ_RELEASE." http://www.aijiacms.com\n# ".timetodate($AJ_TIME, 6)."\n# --------------------------------------------------------\n\n\n".$sqldump;
				$tableid = $i;
				$filename = $random.'/'.$fileid.'.sql';
				file_put($D.$filename, $sqldump);
				$fid = $fileid;
				msg('�־� <strong>#'.$fileid++.'</strong> ���ݳɹ�.. �����Զ�����...'.progress(0, $fid, $tid), '?file='.$file.'&sizelimit='.$sizelimit.'&sqlcompat='.$sqlcompat.'&sqlcharset='.$sqlcharset.'&tableid='.$tableid.'&fileid='.$fileid.'&fileid='.$fileid.'&tid='.$tid.'&startfrom='.$startrow.'&random='.$random.'&backup=1');
			} else {
			   cache_delete($_username.'_backup.php');
			   $db->query("DELETE FROM {$AJ_PRE}setting WHERE item='aijiacms' AND item_key='backtime'");
			   $db->query("INSERT INTO {$AJ_PRE}setting (item,item_key,item_value) VALUES('aijiacms','backtime','$AJ_TIME')");
			   msg('���ݿⱸ�ݳɹ�', '?file='.$file.'&action=import');
			}
		} else {
			$dtables = $tables = $C = $T = array();
			$i = $j = $dtotalsize = $totalsize = 0;
			$result = $db->query("SHOW TABLES FROM `".$CFG['db_name']."`");
			while($rr = $db->fetch_row($result)) {
				if(!$rr[0]) continue;
				$T[$rr[0]] = $rr[0];
			}
			uksort($T, 'strnatcasecmp');
			foreach($T as $t) {
				$r = $db->get_one("SHOW TABLE STATUS FROM `".$CFG['db_name']."` LIKE '".$t."'");
				if(preg_match('/^'.$AJ_PRE.'/', $t)) {
					$dtables[$i]['name'] = $r['Name'];
					$dtables[$i]['rows'] = $r['Rows'];
					$dtables[$i]['size'] = round($r['Data_length']/1024/1024, 2);
					$dtables[$i]['index'] = round($r['Index_length']/1024/1024, 2);
					$dtables[$i]['tsize'] = $dtables[$i]['size']+$dtables[$i]['index'];
					$dtables[$i]['auto'] = $r['Auto_increment'];
					$dtables[$i]['updatetime'] = $r['Update_time'];
					$dtables[$i]['note'] = $r['Comment'];
					$dtables[$i]['chip'] = $r['Data_free'];
					$dtotalsize += $r['Data_length']+$r['Index_length'];
					$C[str_replace($AJ_PRE, '', $r['Name'])] = $r['Comment'];
					$i++;
				} else {
					$tables[$j]['name'] = $r['Name'];
					$tables[$j]['rows'] = $r['Rows'];
					$tables[$j]['size'] = round($r['Data_length']/1024/1024, 2);
					$tables[$j]['index'] = round($r['Index_length']/1024/1024, 2);
					$tables[$j]['tsize'] = $tables[$j]['size']+$tables[$j]['index'];
					$tables[$j]['auto'] = $r['Auto_increment'];
					$tables[$j]['updatetime'] = $r['Update_time'];
					$tables[$j]['note'] = $r['Comment'];
					$tables[$j]['chip'] = $r['Data_free'];
					$totalsize += $r['Data_length']+$r['Index_length'];
					$j++;
				}
			}
			//cache_write('table-comment.php', $C);
			$dtotalsize = round($dtotalsize/1024/1024, 2);
			$totalsize = round($totalsize/1024/1024, 2);
			include tpl('database');
		}
	break;
}
?>