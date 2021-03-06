<?php
defined('IN_AIJIACMS') or die('Access Denied');
function dhtmlspecialchars($string)
{
    return is_array($string) ? array_map('dhtmlspecialchars', $string) : str_replace('&amp;', '&', htmlspecialchars($string, ENT_QUOTES));
}
function daddslashes($string)
{
    if (!is_array($string)) {
        return addslashes($string);
    }
    foreach ($string as $key => $val) {
        $string[$key] = daddslashes($val);
    }
    return $string;
}
function dstripslashes($string)
{
    if (!is_array($string)) {
        return stripslashes($string);
    }
    foreach ($string as $key => $val) {
        $string[$key] = dstripslashes($val);
    }
    return $string;
}
function dsafe($string)
{
    if (is_array($string)) {
        return array_map('dsafe', $string);
    } else {
        if (strlen($string) < 20) {
            return $string;
        }
        $match = array("/&#([a-z0-9]+)([;]*)/i", "/(j[\s\r\n\t]*a[\s\r\n\t]*v[\s\r\n\t]*a[\s\r\n\t]*s[\s\r\n\t]*c[\s\r\n\t]*r[\s\r\n\t]*i[\s\r\n\t]*p[\s\r\n\t]*t|jscript|vbscript|vbs|about|expression|script|frame|link|import|meta)/i", "/on(mouse|exit|error|click|dblclick|key|load|unload|change|move|submit|reset|cut|copy|select|start|stop)/i");
        $replace = array("", "<d>\\1</d>", "on\n\\1");
        return preg_replace($match, $replace, $string);
    }
}
function dtrim($string)
{
    return str_replace(array(chr(10), chr(13), '	', ' '), array('', '', '', ''), $string);
}
function dwrite($string)
{
    return str_replace(array(chr(10), chr(13), '\''), array('', '', '\\\''), $string);
}
function dheader($url)
{
    global $AJ;
    if (!defined('AJ_ADMIN') && $AJ['defend_reload']) {
        sleep($AJ['defend_reload']);
    }
    die(header('location:' . $url));
}
function dmsg($dmsg = '', $dforward = '')
{
    if (!$dmsg && !$dforward) {
        $dmsg = get_cookie('dmsg');
        if ($dmsg) {
            echo ('<script type="text/javascript">showmsg(\'' . $dmsg) . '\');</script>';
            set_cookie('dmsg', '');
        }
    } else {
        set_cookie('dmsg', $dmsg);
        $dforward = preg_replace('/(.*)([&?]rand=[0-9]*)(.*)/i', '\\1\\3', $dforward);
        $dforward = str_replace('.php&', '.php?', $dforward);
        $dforward = strpos($dforward, '?') === false ? ($dforward . '?rand=') . mt_rand(10, 99) : str_replace('?', ('?rand=' . mt_rand(10, 99)) . '&', $dforward);
        dheader($dforward);
    }
}
function dalert($dmessage = errmsg, $dforward = '', $extend = '')
{
    global $CFG, $AJ;
    die(include template('alert', 'message'));
}
function dsubstr($string, $length, $suffix = '', $start = 0)
{
    if ($start) {
        $tmp = dsubstr($string, $start);
        $string = substr($string, strlen($tmp));
    }
    $strlen = strlen($string);
    if ($strlen <= $length) {
        return $string;
    }
    $string = str_replace(array('&quot;', '&lt;', '&gt;'), array('"', '<', '>'), $string);
    $length = $length - strlen($suffix);
    $str = '';
    if (strtolower(AJ_CHARSET) == 'utf-8') {
        $n = ($tn = ($noc = 0));
        while ($n < $strlen) {
            $t = ord($string[$n]);
            if (($t == 9 || $t == 10) || 32 <= $t && $t <= 126) {
                $tn = 1;
                $n++;
                $noc++;
            } elseif (194 <= $t && $t <= 223) {
                $tn = 2;
                $n += 2;
                $noc += 2;
            } elseif (224 <= $t && $t <= 239) {
                $tn = 3;
                $n += 3;
                $noc += 2;
            } elseif (240 <= $t && $t <= 247) {
                $tn = 4;
                $n += 4;
                $noc += 2;
            } elseif (248 <= $t && $t <= 251) {
                $tn = 5;
                $n += 5;
                $noc += 2;
            } elseif ($t == 252 || $t == 253) {
                $tn = 6;
                $n += 6;
                $noc += 2;
            } else {
                $n++;
            }
            if ($noc >= $length) {
                break;
            }
        }
        if ($noc > $length) {
            $n -= $tn;
        }
        $str = substr($string, 0, $n);
    } else {
        for ($i = 0; $i < $length; $i++) {
            $str .= ord($string[$i]) > 127 ? $string[$i] . $string[++$i] : $string[$i];
        }
    }
    $str = str_replace(array('"', '<', '>'), array('&quot;', '&lt;', '&gt;'), $str);
    return $str == $string ? $str : $str . $suffix;
}
function encrypt($txt, $key = '')
{
    $rnd = md5(microtime());
    $len = strlen($txt);
    $ren = strlen($rnd);
    $ctr = 0;
    $str = '';
    for ($i = 0; $i < $len; $i++) {
        $ctr = $ctr == $ren ? 0 : $ctr;
        $str .= $rnd[$ctr] . ($txt[$i] ^ $rnd[$ctr++]);
    }
    return str_replace('=', '', base64_encode(kecrypt($str, $key)));
}
function decrypt($txt, $key = '')
{
    $txt = kecrypt(base64_decode($txt), $key);
    $len = strlen($txt);
    $str = '';
    for ($i = 0; $i < $len; $i++) {
        $tmp = $txt[$i];
        $str .= $txt[++$i] ^ $tmp;
    }
    return $str;
}
function kecrypt($txt, $key)
{
    $key = md5($key);
    $len = strlen($txt);
    $ken = strlen($key);
    $ctr = 0;
    $str = '';
    for ($i = 0; $i < $len; $i++) {
        $ctr = $ctr == $ken ? 0 : $ctr;
        $str .= $txt[$i] ^ $key[$ctr++];
    }
    return $str;
}
function strtohex($str)
{
    $hex = '';
    for ($i = 0; $i < strlen($str); $i++) {
        $hex .= dechex(ord($str[$i]));
    }
    return $hex;
}
function hextostr($hex)
{
    $str = '';
    for ($i = 0; $i < strlen($hex) - 1; $i += 2) {
        $str .= chr(hexdec($hex[$i] . $hex[($i + 1)]));
    }
    return $str;
}
function dround($var, $precision = 2, $sprinft = false)
{
    $var = round(floatval($var), $precision);
    if ($sprinft) {
        $var = sprintf(('%.' . $precision) . 'f', $var);
    }
    return $var;
}
function dalloc($i, $n = 5000)
{
    return ceil($i / $n);
}
function strip_uri($uri)
{
    if (strpos($uri, '%') !== false) {
        while ($uri != urldecode($uri)) {
            $uri = urldecode($uri);
        }
    }
    if ((strpos($uri, '<') !== false || strpos($uri, '\'') !== false) || strpos($uri, '"') !== false) {
        dhttp(403, 0);
        dalert('HTTP 403 Forbidden', AJ_PATH);
    }
}
function strip_sql($string)
{
    $search = array('/union([[:space:]])/i', '/select([[:space:]])/i', '/update([[:space:]])/i', '/replace([[:space:]])/i', '/delete([[:space:]])/i', '/drop([[:space:]])/i', '/outfile([[:space:]])/i', '/dumpfile([[:space:]])/i', '/substring\\(/i', '/ascii\\(/i', '/hex\\(/i', '/ord\\(/i', '/char\\(/i', '/\\/\\*/');
    $replace = array('unio&#110;\\1', 'selec&#116;\\1', 'updat&#101;\\1', 'replac&#101;\\1', 'delet&#101;\\1', 'dro&#112;\\1', 'outfil&#101;\\1', 'dumpfil&#101;\\1', 'substrin&#103;(', 'asci&#105;(', 'he&#120;(', 'or&#100;(', 'cha&#114;(', '');
    return is_array($string) ? array_map('strip_sql', $string) : preg_replace($search, $replace, $string);
}
function strip_nr($string, $js = false)
{
    $string = str_replace(array(chr(13), chr(10), '
', '
', '	', '  '), array('', '', '', '', '', ''), $string);
    if ($js) {
        $string = str_replace('\'', '\\\'', $string);
    }
    return $string;
}
function template($template = 'index', $dir = '')
{
    global $CFG;
    $to = $dir ? ((((AJ_CACHE . '/tpl/') . $dir) . '-') . $template) . '.php' : ((AJ_CACHE . '/tpl/') . $template) . '.php';
    $isfileto = is_file($to);
    if ($CFG['template_refresh'] || !$isfileto) {
        if ($dir) {
            $dir = $dir . '/';
        }
        $from = (((((AJ_ROOT . '/template/') . $CFG['template']) . '/') . $dir) . $template) . '.htm';
        if ($CFG['template'] != 'default' && !is_file($from)) {
            $from = (((AJ_ROOT . '/template/default/') . $dir) . $template) . '.htm';
        }
        if ((!$isfileto || filemtime($from) > filemtime($to)) || filesize($to) == 0 && filesize($from) > 0) {
            require_once AJ_ROOT . '/include/template.func.php';
            template_compile($from, $to);
        }
    }
    return $to;
}
function ob_template($template, $dir = '')
{
    extract($GLOBALS, EXTR_SKIP);
    ob_start();
    include template($template, $dir);
    $contents = ob_get_contents();
    ob_clean();
    return $contents;
}
function message($dmessage = errmsg, $dforward = 'goback', $AJime = 1)
{
    global $CFG, $AJ;
    if ((!$dmessage && $dforward) && $dforward != 'goback') {
        dheader($dforward);
    }
    die(include template('message', 'message'));
}
function login()
{
    global $_userid, $MODULE, $AJ_URL, $AJ;
    $_userid or dheader((($MODULE[2]['linkurl'] . $AJ['file_login']) . '?forward=') . rawurlencode($AJ_URL));
}
function random($length, $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz')
{
    $hash = '';
    $max = strlen($chars) - 1;
    for ($i = 0; $i < $length; $i++) {
        $hash .= $chars[mt_rand(0, $max)];
    }
    return $hash;
}
function set_cookie($var, $value = '', $time = 0)
{
    global $CFG, $AJ_TIME;
    $time = $time > 0 ? $time : (empty($value) ? $AJ_TIME - 3600 : 0);
    $port = $_SERVER['SERVER_PORT'] == '443' ? 1 : 0;
    $var = $CFG['cookie_pre'] . $var;
    return setcookie($var, $value, $time, $CFG['cookie_path'], $CFG['cookie_domain'], $port);
}
function get_cookie($var)
{
    global $CFG;
    $var = $CFG['cookie_pre'] . $var;
    return isset($_COOKIE[$var]) ? $_COOKIE[$var] : '';
}
function get_table($moduleid, $data = 0)
{
    global $AJ_PRE, $MODULE;
    $module = $MODULE[$moduleid]['module'];
    $C = array('article', 'newhouse', 'buy', 'sale', 'info', 'photo', 'rent', 'video');
    if ($data) {
        return in_array($module, $C) ? (($AJ_PRE . $module) . '_data_') . $moduleid : ($AJ_PRE . $module) . '_data';
    } else {
        if ($moduleid == 18) {
            return in_array($module, $C) ? (($AJ_PRE . $module) . '_') . $moduleid : $AJ_PRE . 'newhouse_6';
        } else {
            return in_array($module, $C) ? (($AJ_PRE . $module) . '_') . $moduleid : $AJ_PRE . $module;
        }
    }
}
function get_process($fromtime, $totime)
{
    global $AJ_TIME;
    if ($fromtime && $AJ_TIME < $fromtime) {
        return 1;
    }
    if ($totime && $AJ_TIME > $totime) {
        return 3;
    }
    return 2;
}
function send_message($touser, $title, $content, $typeid = 4, $fromuser = '', $telephone, $truename, $sex, $email, $linkurl)
{
    global $db, $AJ_TIME, $AJ_IP;
    if ($touser == $fromuser) {
        return false;
    }
    if ((check_name($touser) && $title) && $content) {
        $title = addslashes($title);
        $content = addslashes($content);
        $r = $db->get_one("SELECT black FROM {$db->pre}member WHERE username='{$touser}'");
        if ($r) {
            if ($r['black'] && $typeid != 4) {
                $blacks = explode(' ', $r['black']);
                $_from = $fromuser ? $fromuser : 'Guest';
                if (in_array($_from, $blacks)) {
                    return false;
                }
            }
            $db->query("INSERT INTO {$db->pre}message (title,typeid,touser,fromuser,content,addtime,ip,status,telephone,truename,sex,email,linkurl) VALUES ('{$title}', {$typeid},'{$touser}','{$fromuser}','{$content}','{$AJ_TIME}','{$AJ_IP}',3,'{$telephone}','{$truename}','{$sex}','{$email}','{$linkurl}')");
            $db->query("UPDATE {$db->pre}member SET message=message+1 WHERE username='{$touser}'");
            return true;
        }
    }
    return false;
}
function send_mail($mail_to, $mail_subject, $mail_body, $mail_from = '', $mail_sign = true)
{
    global $AJ;
    require_once AJ_ROOT . '/include/mail.func.php';
    $result = dmail(trim($mail_to), $mail_subject, $mail_body, $mail_from, $mail_sign);
    $success = $result == 'SUCCESS' ? 1 : 0;
    if ($AJ['mail_log']) {
        global $AJ_TIME, $db;
        $status = $success ? 3 : 2;
        $note = $success ? '' : addslashes($result);
        $mail_subject = stripslashes($mail_subject);
        $mail_body = stripslashes($mail_body);
        $mail_subject = addslashes($mail_subject);
        $mail_body = addslashes($mail_body);
        $db->query("INSERT INTO {$db->pre}mail_log (email,title,content,addtime,status,note) VALUES ('{$mail_to}','{$mail_subject}','{$mail_body}','{$AJ_TIME}','{$status}','{$note}')");
    }
    return $success;
}
function strip_sms($message)
{
    global $AJ;
    $message = strip_tags($message);
    $message = trim($message);
    $message = preg_replace('/&([a-z]{1,});/', '', $message);
    if ($AJ['sms_sign']) {
        $message .= $AJ['sms_sign'];
    }
    return $message;
}
function send_sms($mobile, $message, $word = 0, $time = 0)
{
    global $db, $AJ, $AJ_TIME, $AJ_IP, $_username;
    if ((!$AJ['sms'] || !$AJ['sms_uid']) || !$AJ['sms_key']) {
        return false;
    }
    $word or $word = word_count($message);
    $sms_message = rawurlencode(convert($message, AJ_CHARSET, 'UTF-8'));
    $data = (((((((((('sms_uid=' . $AJ['sms_uid']) . '&sms_key=') . $AJ['sms_key']) . '&sms_charset=') . AJ_CHARSET) . '&sms_mobile=') . $mobile) . '&sms_message=') . $sms_message) . '&sms_time=') . $time;
    $header = 'POST /send.php HTTP/1.0
';
    $header .= 'Accept: */*
';
    $header .= 'Content-Type: application/x-www-form-urlencoded
';
    $header .= ('Content-Length: ' . strlen($data)) . '

';
    $fp = function_exists('fsockopen') ? fsockopen('sms.aijiacms.com', 8820) : stream_socket_client('sms.aijiacms.com:8820');
    $code = '';
    if ($fp) {
        fputs($fp, $header . $data);
        while (!feof($fp)) {
            $code .= fgets($fp, 1024);
        }
        fclose($fp);
        if ($code && strpos($code, 'aijiacms_sms_code=') !== false) {
            $code = explode('aijiacms_sms_code=', $code);
            $code = $code[1];
        } else {
            $code = 'Can Not Connect SMS Server';
        }
    } else {
        $code = 'Can Not Connect SMS Server';
    }
    $db->query("INSERT INTO {$db->pre}sms (mobile,message,word,editor,sendtime,code) VALUES ('{$mobile}','{$message}','{$word}','{$_username}','{$AJ_TIME}','{$code}')");
    return $code;
}
function word_count($string)
{
    if (function_exists('mb_strlen')) {
        return mb_strlen($string, AJ_CHARSET);
    }
    $string = convert($string, AJ_CHARSET, 'gbk');
    $length = strlen($string);
    $count = 0;
    for ($i = 0; $i < $length; $i++) {
        $t = ord($string[$i]);
        if ($t > 127) {
            $i++;
        }
        $count++;
    }
    return $count;
}
function cache_read($file, $dir = '', $mode = '')
{
    $file = $dir ? (((AJ_CACHE . '/') . $dir) . '/') . $file : (AJ_CACHE . '/') . $file;
    if (!is_file($file)) {
        return $mode ? '' : array();
    }
    return $mode ? file_get($file) : include $file;
}
function cache_write($file, $string, $dir = '')
{
    if (is_array($string)) {
        $string = ('<?php defined(\'IN_AIJIACMS\') or exit(\'Access Denied\'); return ' . strip_nr(var_export($string, true))) . '; ?>';
    }
    $file = $dir ? (((AJ_CACHE . '/') . $dir) . '/') . $file : (AJ_CACHE . '/') . $file;
    $strlen = file_put($file, $string);
    return $strlen;
}
function cache_delete($file, $dir = '')
{
    $file = $dir ? (((AJ_CACHE . '/') . $dir) . '/') . $file : (AJ_CACHE . '/') . $file;
    return file_del($file);
}
function cache_clear($str, $type = '', $dir = '')
{
    $dir = $dir ? ((AJ_CACHE . '/') . $dir) . '/' : AJ_CACHE . '/';
    $files = glob($dir . '*');
    if (is_array($files)) {
        if ($type == 'dir') {
            foreach ($files as $file) {
                if (is_dir($file)) {
                    dir_delete($file);
                } else {
                    if (file_ext($file) == $str) {
                        file_del($file);
                    }
                }
            }
        } else {
            foreach ($files as $file) {
                if (!is_dir($file) && strpos(basename($file), $str) !== false) {
                    file_del($file);
                }
            }
        }
    }
}
function content_table($moduleid, $itemid, $split, $table_data = '')
{
    if ($split) {
        return split_table($moduleid, $itemid);
    } else {
        $table_data or $table_data = get_table($moduleid, 1);
        return $table_data;
    }
}
function split_table($moduleid, $itemid)
{
    global $AJ_PRE;
    $part = split_id($itemid);
    return (($AJ_PRE . $moduleid) . '_') . $part;
}
function split_id($id)
{
    return $id > 0 ? ceil($id / 500000) : 1;
}
function ip2area($ip, $type = '')
{
    $area = '';
    if (is_ip($ip)) {
        $tmp = explode('.', $ip);
        if ((($tmp[0] == 10 || $tmp[0] == 127) || $tmp[0] == 192 && $tmp[1] == 168) || $tmp[0] == 172 && ($tmp[1] >= 16 && $tmp[1] <= 31)) {
            $area = 'LAN';
        } elseif ((($tmp[0] > 255 || $tmp[1] > 255) || $tmp[2] > 255) || $tmp[3] > 255) {
            $area = 'Unknown';
        } else {
            require_once AJ_ROOT . '/include/ip.class.php';
            $do = new ip($ip, $type);
            $area = $do->area();
        }
    }
    return $area ? $area : 'Unknown';
}
function mobile2area($mobile)
{
    $area = '';
    if (is_mobile($mobile)) {
        $data = file_get('http://www.yodao.com/smartresult-xml/search.s?type=mobile&q=' . $mobile);
        if (strpos($data, '<location>') !== false) {
            $t1 = explode('<location>', $data);
            $t2 = explode('</location>', $t1[1]);
            $area = $t2[0];
        }
    }
    return $area ? convert($area, 'gbk', AJ_CHARSET) : '';
}
function banip($IP)
{
    global $AJ_IP, $AJ_TIME;
    $ban = false;
    foreach ($IP as $v) {
        if ($v['totime'] && $v['totime'] < $AJ_TIME) {
            continue;
        }
        if ($v['ip'] == $AJ_IP) {
            $ban = true;
            break;
        }
        if (preg_match(('/^' . str_replace('*', '[0-9]{1,3}', $v['ip'])) . '$/', $AJ_IP)) {
            $ban = true;
            break;
        }
    }
    if ($ban) {
        message(lang('include->msg_ip_ban', array($AJ_IP)));
    }
}
function banword($WORD, $string, $extend = true)
{
    $string = stripslashes($string);
    foreach ($WORD as $v) {
        $v[0] = preg_quote($v[0]);
        $v[0] = str_replace('/', '\\/', $v[0]);
        $v[0] = str_replace('\\*', '.*', $v[0]);
        if ($v[2] && $extend) {
            if (preg_match(('/' . $v[0]) . '/i', $string)) {
                dalert(lang('include->msg_word_ban'));
            }
        } else {
            if ($string == '') {
                break;
            }
            if (preg_match(('/' . $v[0]) . '/i', $string)) {
                $string = preg_replace(('/' . $v[0]) . '/i', $v[1], $string);
            }
        }
    }
    return addslashes($string);
}
function get_env($type)
{
    switch ($type) {
    case 'ip':
        isset($_SERVER['HTTP_X_FORWARDED_FOR']) or $_SERVER['HTTP_X_FORWARDED_FOR'] = '';
        isset($_SERVER['REMOTE_ADDR']) or $_SERVER['REMOTE_ADDR'] = '';
        isset($_SERVER['HTTP_CLIENT_IP']) or $_SERVER['HTTP_CLIENT_IP'] = '';
        if ($_SERVER['HTTP_X_FORWARDED_FOR'] && $_SERVER['REMOTE_ADDR']) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (strpos($ip, ',') !== false) {
                $tmp = explode(',', $ip);
                $ip = trim(end($tmp));
            }
            if (is_ip($ip)) {
                return $ip;
            }
        }
        if (is_ip($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        }
        if (is_ip($_SERVER['REMOTE_ADDR'])) {
            return $_SERVER['REMOTE_ADDR'];
        }
        return 'unknown';
        break;
    case 'self':
        return isset($_SERVER['PHP_SELF']) ? $_SERVER['PHP_SELF'] : (isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : $_SERVER['ORIG_PATH_INFO']);
        break;
    case 'referer':
        return isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
        break;
    case 'domain':
        return $_SERVER['SERVER_NAME'];
        break;
    case 'scheme':
        return $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
        break;
    case 'port':
        return $_SERVER['SERVER_PORT'] == '80' ? '' : ':' . $_SERVER['SERVER_PORT'];
        break;
    case 'url':
        if (isset($_SERVER['HTTP_X_REWRITE_URL']) && $_SERVER['HTTP_X_REWRITE_URL']) {
            $uri = $_SERVER['HTTP_X_REWRITE_URL'];
        } else {
            if (isset($_SERVER['REQUEST_URI']) && $_SERVER['REQUEST_URI']) {
                $uri = $_SERVER['REQUEST_URI'];
            } else {
                $uri = $_SERVER['PHP_SELF'];
                if (isset($_SERVER['argv'])) {
                    if (isset($_SERVER['argv'][0])) {
                        $uri .= '?' . $_SERVER['argv'][0];
                    }
                } else {
                    $uri .= '?' . $_SERVER['QUERY_STRING'];
                }
            }
        }
        $uri = dhtmlspecialchars($uri);
        return ((get_env('scheme') . $_SERVER['HTTP_HOST']) . (strpos($_SERVER['HTTP_HOST'], ':') === false ? get_env('port') : '')) . $uri;
        break;
    }
}
function convert($str, $from = 'utf-8', $to = 'gb2312')
{
    if (!$str) {
        return '';
    }
    $from = strtolower($from);
    $to = strtolower($to);
    if ($from == $to) {
        return $str;
    }
    $from = str_replace('gbk', 'gb2312', $from);
    $to = str_replace('gbk', 'gb2312', $to);
    $from = str_replace('utf8', 'utf-8', $from);
    $to = str_replace('utf8', 'utf-8', $to);
    if ($from == $to) {
        return $str;
    }
    $tmp = array();
    if (function_exists('iconv')) {
        if (is_array($str)) {
            foreach ($str as $key => $val) {
                $tmp[$key] = iconv($from, $to . '//IGNORE', $val);
            }
            return $tmp;
        } else {
            return iconv($from, $to . '//IGNORE', $str);
        }
    } else {
        if (function_exists('mb_convert_encoding')) {
            if (is_array($str)) {
                foreach ($str as $key => $val) {
                    $tmp[$key] = mb_convert_encoding($val, $to, $from);
                }
                return $tmp;
            } else {
                return mb_convert_encoding($str, $to, $from);
            }
        } else {
            require_once AJ_ROOT . '/include/convert.func.php';
            return dconvert($str, $to, $from);
        }
    }
}
function get_type($item, $cache = 0)
{
    $types = array();
    if ($cache) {
        $types = cache_read(('type-' . $item) . '.php');
    } else {
        global $db;
        $result = $db->query("SELECT * FROM {$db->pre}type WHERE item='{$item}' ORDER BY listorder ASC,typeid DESC ");
        while ($r = $db->fetch_array($result)) {
            $types[$r['typeid']] = $r;
        }
    }
    return $types;
}
function get_cat($catid)
{
    global $db;
    $catid = intval($catid);
    return $catid ? $db->get_one("SELECT * FROM {$db->pre}category WHERE catid={$catid}") : array();
}
function cat_pos($CAT, $str = ' &raquo; ', $target = '')
{
    global $MODULE, $db;
    if (!$CAT) {
        return '';
    }
    $arrparentids = ($CAT['arrparentid'] . ',') . $CAT['catid'];
    $arrparentid = explode(',', $arrparentids);
    $pos = '';
    $target = $target ? ' target="_blank"' : '';
    $CATEGORY = array();
    $result = $db->query("SELECT catid,moduleid,catname,linkurl FROM {$db->pre}category WHERE catid IN ({$arrparentids})", 'CACHE');
    while ($r = $db->fetch_array($result)) {
        $CATEGORY[$r['catid']] = $r;
    }
    foreach ($arrparentid as $catid) {
        if (!$catid || !isset($CATEGORY[$catid])) {
            continue;
        }
        $pos .= ((((((('<a href="' . $MODULE[$CATEGORY[$catid]['moduleid']]['linkurl']) . $CATEGORY[$catid]['linkurl']) . '"') . $target) . '>') . $CATEGORY[$catid]['catname']) . '</a>') . $str;
    }
    $_len = strlen($str);
    if ($str && substr($pos, -$_len, $_len) === $str) {
        $pos = substr($pos, 0, strlen($pos) - $_len);
    }
    return $pos;
}
function cat_url($catid)
{
    global $MODULE, $db;
    $r = $db->get_one("SELECT moduleid,linkurl FROM {$db->pre}category WHERE catid={$catid}");
    return $r ? $MODULE[$r['moduleid']]['linkurl'] . $r['linkurl'] : '';
}
function get_area($areaid)
{
    global $db;
    $areaid = intval($areaid);
    return $db->get_one("SELECT * FROM {$db->pre}area WHERE areaid={$areaid}");
}
function area_pos($areaid, $str = ' &raquo; ', $deep = 0)
{
    if ($areaid) {
        global $AREA;
    } else {
        global $L;
        return $L['allcity'];
    }
    $AREA or $AREA = cache_read('area.php');
    $arrparentid = $AREA[$areaid]['arrparentid'] ? explode(',', $AREA[$areaid]['arrparentid']) : array();
    $arrparentid[] = $areaid;
    $pos = '';
    if ($deep) {
        $i = 1;
    }
    foreach ($arrparentid as $areaid) {
        if (!$areaid || !isset($AREA[$areaid])) {
            continue;
        }
        if ($deep) {
            if ($i > $deep) {
                continue;
            }
            $i++;
        }
        $pos .= $AREA[$areaid]['areaname'] . $str;
    }
    $_len = strlen($str);
    if ($str && substr($pos, -$_len, $_len) === $str) {
        $pos = substr($pos, 0, strlen($pos) - $_len);
    }
    return $pos;
}
function get_maincat($catid, $moduleid, $level = -1)
{
    global $db;
    $condition = $catid ? "parentid={$catid}" : "moduleid={$moduleid} AND parentid=0";
    if ($level >= 0) {
        $condition .= " AND level={$level}";
    }
    $cat = array();
    $result = $db->query("SELECT catid,catname,child,style,linkurl,item FROM {$db->pre}category WHERE {$condition} ORDER BY listorder,catid ASC", 'CACHE');
    while ($r = $db->fetch_array($result)) {
        $cat[] = $r;
    }
    return $cat;
}
function get_mainarea($areaid)
{
    global $db;
    $areaid = intval($areaid);
    $are = array();
    $result = $db->query("SELECT areaid,areaname FROM {$db->pre}area WHERE parentid={$areaid} ORDER BY listorder,areaid ASC", 'CACHE');
    while ($r = $db->fetch_array($result)) {
        $are[] = $r;
    }
    return $are;
}
function get_user($value, $key = 'username', $from = 'userid')
{
    global $db;
    $r = $db->get_one("SELECT `{$from}` FROM {$db->pre}member WHERE `{$key}`='{$value}'");
    return $r[$from];
}
function check_group($groupid, $groupids)
{
    if (!$groupids || $groupid == 1) {
        return true;
    }
    if ($groupid == 4) {
        $groupid = 3;
    }
    return in_array($groupid, explode(',', $groupids));
}
function tohtml($htmlfile, $module = '', $parameter = '')
{
    defined('TOHTML') or define('TOHTML', true);
    extract($GLOBALS, EXTR_SKIP);
    if ($parameter) {
        parse_str($parameter);
    }
    include $module ? ((((AJ_ROOT . '/module/') . $module) . '/') . $htmlfile) . '.htm.php' : ((AJ_ROOT . '/include/') . $htmlfile) . '.htm.php';
}
function set_style($string, $style = '', $tag = 'span')
{
    if (preg_match('/^#[0-9a-zA-Z]{6}$/', $style)) {
        $style = 'color:' . $style;
    }
    return $style ? ((((((('<' . $tag) . ' style="') . $style) . '">') . $string) . '</') . $tag) . '>' : $string;
}
function crypt_action($action)
{
    global $AJ_IP;
    return md5(md5(($action . AJ_KEY) . $AJ_IP));
}
function captcha($captcha, $enable = 1, $return = false)
{
    global $AJ_IP, $AJ, $session;
    if ($enable) {
        if ($AJ['captcha_cn']) {
            if (strlen($captcha) < 4) {
                $msg = lang('include->captcha_missed');
                return $return ? $msg : message($msg);
            }
        } else {
            if (!preg_match('/^[0-9a-z]{4,}$/i', $captcha)) {
                $msg = lang('include->captcha_missed');
                return $return ? $msg : message($msg);
            }
        }
        if (!is_object($session)) {
            $session = new dsession();
        }
        if (!isset($_SESSION['captchastr'])) {
            $msg = lang('include->captcha_expired');
            return $return ? $msg : message($msg);
        }
        if ($_SESSION['captchastr'] != md5(md5((strtoupper($captcha) . AJ_KEY) . $AJ_IP))) {
            $msg = lang('include->captcha_error');
            return $return ? $msg : message($msg);
        }
        unset($_SESSION['captchastr']);
    } else {
        return '';
    }
}
function question($answer, $enable = 1, $return = false)
{
    global $AJ_IP, $session;
    if ($enable) {
        if (!$answer) {
            $msg = lang('include->answer_missed');
            return $return ? $msg : message($msg);
        }
        $answer = stripslashes($answer);
        if (!is_object($session)) {
            $session = new dsession();
        }
        if (!isset($_SESSION['answerstr'])) {
            $msg = lang('include->question_expired');
            return $return ? $msg : message($msg);
        }
        if ($_SESSION['answerstr'] != md5(md5(($answer . AJ_KEY) . $AJ_IP))) {
            $msg = lang('include->answer_error');
            return $return ? $msg : message($msg);
        }
        unset($_SESSION['answerstr']);
    } else {
        return '';
    }
}
function pages($total, $page = 1, $perpage = 20, $demo = '', $step = 3)
{
    global $AJ_URL, $AJ, $L;
    if ($total <= $perpage) {
        return '';
    }
    $items = $total;
    $total = ceil($total / $perpage);
    if ($page < 1 || $page > $total) {
        $page = 1;
    }
    if ($demo) {
        $demo_url = $demo;
        $home_url = str_replace('{aijiacms_page}', '1', $demo_url);
    } else {
        if (((defined('AJ_REWRITE') && $AJ['rewrite']) && $_SERVER['SCRIPT_NAME']) && strpos($AJ_URL, '?') === false) {
            $demo_url = $_SERVER['SCRIPT_NAME'];
            $demo_url = str_replace('//', '/', $demo_url);
            $mark = false;
            if (substr($demo_url, -4) == '.php') {
                if (strpos($_SERVER['QUERY_STRING'], '.html') === false) {
                    $qstr = '';
                    if ($_SERVER['QUERY_STRING']) {
                        if (substr($_SERVER['QUERY_STRING'], -5) == '.html') {
                            $qstr = '-' . substr($_SERVER['QUERY_STRING'], 0, -5);
                        } else {
                            parse_str($_SERVER['QUERY_STRING'], $qs);
                            foreach ($qs as $k => $v) {
                                $qstr .= (('-' . $k) . '-') . rawurlencode($v);
                            }
                        }
                    }
                    $demo_url = ((substr($demo_url, 0, -4) . '-htm-page-{aijiacms_page}') . $qstr) . '.html';
                } else {
                    $demo_url = (substr($demo_url, 0, -4) . '-htm-') . $_SERVER['QUERY_STRING'];
                    $mark = true;
                }
            } else {
                $mark = true;
            }
            if ($mark) {
                if (strpos($demo_url, '%') === false) {
                    $demo_url = rawurlencode($demo_url);
                }
                $demo_url = str_replace(array('%2F', '%3A'), array('/', ':'), $demo_url);
                if (strpos($demo_url, '-page-') !== false) {
                    $demo_url = preg_replace('/page-([0-9]+)/', 'page-{aijiacms_page}', $demo_url);
                } else {
                    $demo_url = str_replace('.html', '-page-{aijiacms_page}.html', $demo_url);
                }
            }
            $home_url = str_replace('-page-{aijiacms_page}', '-page-1', $demo_url);
        } else {
            $AJ_URL = str_replace('&amp;', '&', $AJ_URL);
            $demo_url = ($home_url = preg_replace('/(.*)([&?]page=[0-9]*)(.*)/i', '\\1\\3', $AJ_URL));
            $s = strpos($demo_url, '?') === false ? '?' : '&';
            $demo_url = (($demo_url . $s) . 'page={aijia') . 'cms_page}';
            if (defined('AJ_ADMIN') && strpos($demo_url, 'sum=') === false) {
                $demo_url = str_replace('page=', ('sum=' . $items) . '&page=', $demo_url);
            }
        }
    }
    $pages = '';
    include ((AJ_ROOT . '/api/pages.') . ($AJ['pages_mode'] ? 'sample' : 'default')) . '.php';
    return $pages;
}
function listpages($CAT, $total, $page = 1, $perpage = 20, $step = 2)
{
    global $AJ, $MOD, $L;
    if ($total <= $perpage) {
        return '';
    }
    $items = $total;
    $total = ceil($total / $perpage);
    if ($page < 1 || $page > $total) {
        $page = 1;
    }
    $home_url = $MOD['linkurl'] . $CAT['linkurl'];
    $demo_url = $MOD['linkurl'] . listurl($CAT, '{aijiacms_page}');
    $pages = '';
    include ((AJ_ROOT . '/api/pages.') . ($AJ['pages_mode'] ? 'sample' : 'default')) . '.php';
    return $pages;
}
function showpages($item, $total, $page = 1)
{
    global $MOD, $L;
    $pages = '';
    $home_url = $MOD['linkurl'] . itemurl($item);
    $demo_url = $MOD['linkurl'] . itemurl($item, '{aijiacms_page}');
    $_page = $page <= 1 ? $total : $page - 1;
    $url = $_page == 1 ? $home_url : str_replace('{aijiacms_page}', $_page, $demo_url);
    $pages .= (((((('<input type="hidden" id="aijia' . 'cms_previous" value="') . $url) . '"/><a href="') . $url) . '" title="') . $L['prev_page']) . '">&nbsp;&#171;&nbsp;</a> ';
    for ($_page = 1; $_page <= $total; $_page++) {
        $url = $_page == 1 ? $home_url : str_replace('{aijiacms_page}', $_page, $demo_url);
        $pages .= $page == $_page ? ('<strong>&nbsp;' . $_page) . '&nbsp;</strong> ' : (((' <a href="' . $url) . '">&nbsp;') . $_page) . '&nbsp;</a>  ';
    }
    $_page = $page >= $total ? 1 : $page + 1;
    $url = $_page == 1 ? $home_url : str_replace('{aijiacms_page}', $_page, $demo_url);
    $pages .= (((((('<a href="' . $url) . '" title="') . $L['next_page']) . '">&nbsp;&#187;&nbsp;</a> <input type="hidden" id="aijia') . 'cms_next" value="') . $url) . '"/>';
    return $pages;
}
function linkurl($linkurl)
{
    return strpos($linkurl, '://') === false ? AJ_PATH . $linkurl : $linkurl;
}
function imgurl($imgurl = '', $width = '')
{
    return $imgurl ? $imgurl : ((AJ_SKIN . 'image/nopic') . $width) . '.gif';
}
function userurl($username, $qstring = '', $domain = '')
{
    global $CFG, $AJ, $MODULE;
    $URL = '';
    $subdomain = 0;
    if ($CFG['com_domain']) {
        $subdomain = substr($CFG['com_domain'], 0, 1) == '.' ? 1 : 2;
    }
    if ($username) {
        if ($subdomain || $domain) {
            $URL = $domain ? ('http://' . $domain) . '/' : ($subdomain == 1 ? ((('http://' . ($AJ['com_www'] ? 'www.' : '')) . $username) . $CFG['com_domain']) . '/' : ((('http://' . $CFG['com_domain']) . '/') . $username) . '/');
            if ($qstring) {
                parse_str($qstring, $q);
                if (isset($q['file'])) {
                    $URL .= $CFG['com_dir'] ? $q['file'] . '/' : ('company/' . $q['file']) . '/';
                    unset($q['file']);
                }
                if ($q) {
                    if ($AJ['rewrite']) {
                        foreach ($q as $k => $v) {
                            $v = rawurlencode($v);
                            $URL .= (($k . '-') . $v) . '-';
                        }
                        $URL = substr($URL, 0, -1) . '.shtml';
                    } else {
                        $URL .= 'index.php?';
                        $i = 0;
                        foreach ($q as $k => $v) {
                            $v = rawurlencode($v);
                            $URL .= ((($i++ == 0 ? '' : '&') . $k) . '=') . $v;
                        }
                    }
                }
            }
        } else {
            if ($AJ['rewrite']) {
                $URL = ((AJ_PATH . 'com/') . $username) . '/';
                if ($qstring) {
                    parse_str($qstring, $q);
                    if (isset($q['file'])) {
                        $URL .= $CFG['com_dir'] ? $q['file'] . '/' : ('company/' . $q['file']) . '/';
                        unset($q['file']);
                    }
                    if ($q) {
                        foreach ($q as $k => $v) {
                            $v = rawurlencode($v);
                            $URL .= (($k . '-') . $v) . '-';
                        }
                        $URL = substr($URL, 0, -1) . '.html';
                    }
                }
            } else {
                $URL = (AJ_PATH . 'index.php?homepage=') . $username;
                if ($qstring) {
                    $URL = ($URL . '&') . $qstring;
                }
            }
        }
    } else {
        $URL = $MODULE[4]['linkurl'] . 'guest.php';
    }
    return $URL;
}
function useravatar($var, $size = '', $isusername = 1, $real = 0)
{
    in_array($size, array('large', 'small')) or $size = 'middle';
    if ($real) {
        $ext = 'x48.jpg';
        if ($size == 'large') {
            $ext = '.jpg';
        }
        if ($size == 'small') {
            $ext = 'x20.jpg';
        }
        $file = (AJ_ROOT . '/api/avatar/default') . $ext;
        $md5 = md5($var);
        if ($isusername) {
            $img = ((((((AJ_ROOT . '/file/avatar/') . substr($md5, 0, 2)) . '/') . substr($md5, 2, 2)) . '/_') . $var) . $ext;
            if (is_file($img) && check_name($var)) {
                $file = $img;
            }
        } else {
            $img = ((((((AJ_ROOT . '/file/avatar/') . substr($md5, 0, 2)) . '/') . substr($md5, 2, 2)) . '/') . $var) . $ext;
            if (is_file($img)) {
                $file = $img;
            }
        }
        if ($real == 1) {
            $url = str_replace(AJ_ROOT . '/', AJ_PATH, $file);
            if (strpos($url, '/default') === false) {
                $remote = file_get(AJ_ROOT . '/file/avatar/remote.html');
                if (strlen($remote) > 10) {
                    $url = str_replace(AJ_ROOT . '/file/', $remote, $file);
                }
            }
            return $url;
        }
        return strpos($file, '/api/') === false ? $file : '';
    } else {
        $name = $isusername ? 'username' : 'userid';
        return (((((AJ_PATH . 'api/avatar/show.php?') . $name) . '=') . $var) . '&amp;size=') . $size;
    }
}
function userinfo($username, $cache = 1)
{
    global $db, $dc, $CFG;
    if (!check_name($username)) {
        return array();
    }
    $user = array();
    if ($cache && $CFG['db_expires']) {
        $user = $dc->get('user-' . $username);
        if ($user) {
            return $user;
        }
    }
    $user = $db->get_one("SELECT * FROM {$db->pre}member m, {$db->pre}company c WHERE m.userid=c.userid AND m.username='{$username}'");
    if (($cache && $CFG['db_expires']) && $user) {
        $dc->set('user-' . $username, $user, $CFG['db_expires']);
    }
    return $user;
}
function userclean($username)
{
    global $dc, $CFG;
    $user = array();
    if ($CFG['db_expires']) {
        $dc->rm('user-' . $username);
    }
}
function listurl($CAT, $page = 0)
{
    global $AJ, $MOD, $L;
    include AJ_ROOT . '/api/url.inc.php';
    $catid = $CAT['catid'];
    $file_ext = $AJ['file_ext'];
    $index = $AJ['index'];
    $catdir = $CAT['catdir'];
    $catname = file_vname($CAT['catname']);
    $prefix = $MOD['htm_list_prefix'];
    $urlid = $MOD['list_html'] ? $MOD['htm_list_urlid'] : $MOD['php_list_urlid'];
    $ext = $MOD['list_html'] ? 'htm' : 'php';
    isset($urls[$ext]['list'][$urlid]) or $urlid = 0;
    $url = $urls[$ext]['list'][$urlid];
    $url = $page ? $url['page'] : $url['index'];
    eval("\$listurl = \"{$url}\";");
    if (substr($listurl, 0, 1) == '/') {
        $listurl = substr($listurl, 1);
    }
    return $listurl;
}
function itemurl($item, $page = 0)
{
    global $AJ, $MOD, $L;
    if ($MOD['show_html'] && $item['filepath']) {
        if ($page === 0) {
            return $item['filepath'];
        }
        $ext = file_ext($item['filepath']);
        return str_replace('.' . $ext, (('_' . $page) . '.') . $ext, $item['filepath']);
    }
    include AJ_ROOT . '/api/url.inc.php';
    $file_ext = $AJ['file_ext'];
    $index = $AJ['index'];
    $itemid = $item['itemid'];
    $title = file_vname($item['title']);
    $addtime = $item['addtime'];
    $catid = $item['catid'];
    $year = date('Y', $addtime);
    $month = date('m', $addtime);
    $day = date('d', $addtime);
    $prefix = $MOD['htm_item_prefix'];
    $urlid = $MOD['show_html'] ? $MOD['htm_item_urlid'] : $MOD['php_item_urlid'];
    $ext = $MOD['show_html'] ? 'htm' : 'php';
    $alloc = dalloc($itemid);
    $url = $urls[$ext]['item'][$urlid];
    $url = $page ? $url['page'] : $url['index'];
    if (strpos($url, 'cat') !== false && $catid) {
        $cate = get_cat($catid);
        $catdir = $cate['catdir'];
        $catname = $cate['catname'];
    }
    eval("\$itemurl = \"{$url}\";");
    if (substr($itemurl, 0, 1) == '/') {
        $itemurl = substr($itemurl, 1);
    }
    return $itemurl;
}
function rewrite($url, $encode = 0)
{
    global $AJ, $CFG;
    if (!$AJ['rewrite']) {
        return $url;
    }
    if (strpos($url, '.php?') === false || strpos($url, '=') === false) {
        return $url;
    }
    $url = str_replace(array('+', '-'), array('%20', '%20'), $url);
    $url = str_replace(array('.php?', '&', '='), array('-htm-', '-', '-'), $url) . '.html';
    return $url;
}
function timetodate($time = 0, $type = 6)
{
    if (!$time) {
        global $AJ_TIME;
        $time = $AJ_TIME;
    }
    $types = array('Y-m-d', 'Y', 'm-d', 'Y-m-d', 'm-d H:i', 'Y-m-d H:i', 'Y-m-d H:i:s');
    if (isset($types[$type])) {
        $type = $types[$type];
    }
    return date($type, $time);
}
function log_write($message, $type = 'php')
{
    global $AJ_IP, $AJ_TIME, $_username;
    if (!AJ_DEBUG) {
        return;
    }
    $AJ_IP or $AJ_IP = get_env('ip');
    $AJ_TIME or $AJ_TIME = time();
    $user = $_username ? $_username : 'guest';
    $log = "<{$type}>\n";
    $log .= ('	<time>' . date('Y-m-d H:i:s', $AJ_TIME)) . '</time>
';
    $log .= ('	<ip>' . $AJ_IP) . '</ip>
';
    $log .= ('	<user>' . $user) . '</user>
';
    $log .= ('	<file>' . $_SERVER['SCRIPT_NAME']) . '</file>
';
    $log .= ('	<querystring>' . str_replace('&', '&amp;', $_SERVER['QUERY_STRING'])) . '</querystring>
';
    $log .= ('	<message>' . $message) . '	</message>
';
    $log .= "</{$type}>";
    file_put(((((((((AJ_ROOT . '/file/log/') . date('Ym', $AJ_TIME)) . '/') . $type) . '-') . date('Y.m.d H.i.s', $AJ_TIME)) . '-') . strtolower(random(10))) . '.xml', $log);
}
function load($file)
{
    $ext = file_ext($file);
    if ($ext == 'css') {
        echo (('<link rel="stylesheet" type="text/css" href="' . AJ_SKIN) . $file) . '" />';
    } else {
        if ($ext == 'js') {
            echo ((('<script type="text/javascript" src="' . AJ_STATIC) . 'file/script/') . $file) . '"></script>';
        } else {
            if ($ext == 'htm') {
                $file = str_replace('ad_m', 'ad_t6_m', $file);
                if (is_file((AJ_CACHE . '/htm/') . $file)) {
                    $content = file_get((AJ_CACHE . '/htm/') . $file);
                    if (substr($content, 0, 4) == '<!--') {
                        $content = substr($content, 17);
                    }
                    echo $content;
                } else {
                    echo '';
                }
            } else {
                if ($ext == 'lang') {
                    $file = str_replace('.lang', '.inc.php', $file);
                    return (((AJ_ROOT . '/lang/') . AJ_LANG) . '/') . $file;
                } else {
                    if (($ext == 'inc' || $ext == 'func') || $ext == 'class') {
                        return ((AJ_ROOT . '/include/') . $file) . '.php';
                    }
                }
            }
        }
    }
}
function ad($id, $cid = 0, $kw = '', $tid = 0)
{
    global $cityid;
    if ($tid) {
        if ($kw) {
            $file = (((('ad_t' . $tid) . '_m') . $id) . '_k') . urlencode($kw);
        } else {
            if ($cid) {
                $file = (((('ad_t' . $tid) . '_m') . $id) . '_c') . $cid;
            } else {
                $file = (('ad_t' . $tid) . '_m') . $id;
            }
        }
        $a3 = ((('ad_' . $id) . '_d') . $tid) . '.htm';
    } else {
        $file = 'ad_' . $id;
        $a3 = ('ad_' . $id) . '_d0.htm';
    }
    $a1 = (($file . '_') . $cityid) . '.htm';
    if (is_file((AJ_CACHE . '/htm/') . $a1)) {
        return load($a1);
    }
    $a2 = $file . '_0.htm';
    if (is_file((AJ_CACHE . '/htm/') . $a2)) {
        return load($a2);
    }
    if (is_file((AJ_CACHE . '/htm/') . $a3)) {
        return load($a3);
    }
}
function lang($str, $arr = array())
{
    if (strpos($str, '->') !== false) {
        $t = explode('->', $str);
        include load($t[0] . '.lang');
        $str = $L[$t[1]];
    }
    if ($arr) {
        foreach ($arr as $k => $v) {
            $str = str_replace(('{V' . $k) . '}', $v, $str);
        }
    }
    return $str;
}
function check_name($username)
{
    if (strpos($username, '__') !== false || strpos($username, '--') !== false) {
        return false;
    }
    return preg_match('/^[a-z0-9]{1}[a-z0-9_\\-]{0,}[a-z0-9]{1}$/', $username);
}
function check_post()
{
    if (strtoupper($_SERVER['REQUEST_METHOD']) != 'POST') {
        return false;
    }
    return check_referer();
}
function check_referer()
{
    global $AJ_REF, $CFG, $AJ;
    if ($AJ['check_referer']) {
        if (!$AJ_REF) {
            return false;
        }
        $R = parse_url($AJ_REF);
        if ($CFG['cookie_domain'] && strpos($R['host'], $CFG['cookie_domain']) !== false) {
            return true;
        }
        if ($CFG['com_domain'] && strpos($R['host'], $CFG['com_domain']) !== false) {
            return true;
        }
        if ($AJ['safe_domain']) {
            $tmp = explode('|', $AJ['safe_domain']);
            foreach ($tmp as $v) {
                if (strpos($R['host'], $v) !== false) {
                    return true;
                }
            }
        }
        $U = parse_url(AJ_PATH);
        if (strpos($R['host'], str_replace('www.', '.', $U['host'])) !== false) {
            return true;
        }
        return false;
    } else {
        return true;
    }
}
function is_robot()
{
    return preg_match('/(spider|bot|crawl|slurp|lycos|robozilla)/i', $_SERVER['HTTP_USER_AGENT']);
}
function is_ip($ip)
{
    return preg_match('/^([0-9]{1,3}\\.){3}[0-9]{1,3}$/', $ip);
}
function is_mobile($mobile)
{
    return preg_match('/^1[3|4|5|8]{1}[0-9]{9}$/', $mobile);
}
function is_md5($password)
{
    return preg_match('/^[a-f0-9]{32}$/', $password);
}
function debug()
{
    global $db, $debug_starttime;
    $mtime = explode(' ', microtime());
    $s = number_format(($mtime[1] + $mtime[0]) - $debug_starttime, 3);
    echo ((('Processed in ' . $s) . ' second(s), ') . $db->querynum) . ' queries';
    if (function_exists('memory_get_usage')) {
        echo (', Memory ' . round((memory_get_usage() / 1024) / 1024, 2)) . ' M';
    }
}
function dhttp($status, $exit = 1)
{
    switch ($status) {
    case '301':
        @header('HTTP/1.1 301 Moved Permanently');
        break;
    case '403':
        @header('HTTP/1.1 403 Forbidden');
        break;
    case '404':
        @header('HTTP/1.1 404 Not Found');
        break;
    case '503':
        @header('HTTP/1.1 503 Service Unavailable');
        break;
    }
    if ($exit) {
        die;
    }
}
function d301($url)
{
    dhttp(301, 0);
    dheader($url);
}
function get_categorynum($itemid, $catid)
{
    global $db;
    $CAT = get_cat($catid);
    if ($catid) {
        $condition .= $CAT['child'] ? (' AND catid IN (' . $CAT['arrchildid']) . ')' : " AND catid={$catid}";
    }
    $r = $db->get_one("SELECT COUNT(*) AS num FROM {$db->pre}photo WHERE houseid={$itemid} {$condition}");
    $categorynum = $r['num'];
    return $categorynum;
}
function rentcookies($id)
{
    $TempNum = 5;
    if (isset($_COOKIE['RRecentlyGoods'])) {
        $RecentlyGoods = $_COOKIE['RRecentlyGoods'];
        $RecentlyGoodsArray = explode(',', $RecentlyGoods);
        $RecentlyGoodsNum = count($RecentlyGoodsArray);
    }
    if ($id != '') {
        if (strstr($RecentlyGoods, (string) $id)) {
            
        } else {
            if ($RecentlyGoodsNum < $TempNum) {
                if ($RecentlyGoods == '') {
                    setcookie('RRecentlyGoods', $id, time() + 432000, '/');
                } else {
                    $RecentlyGoodsNew = ($RecentlyGoods . ',') . $id;
                    setcookie('RRecentlyGoods', $RecentlyGoodsNew, time() + 432000, '/');
                }
            } else {
                $pos = strpos($RecentlyGoods, ',') + 1;
                $FirstString = substr($RecentlyGoods, 0, $pos);
                $RecentlyGoods = str_replace($FirstString, '', $RecentlyGoods);
                $RecentlyGoodsNew = ($RecentlyGoods . ',') . $id;
                setcookie('RRecentlyGoods', $RecentlyGoodsNew, time() + 432000, '/');
            }
        }
    }
}
function browseHouse($ids)
{
    global $db;
    $where = (' itemid in (' . $ids) . ')';
    $result = $db->query("select * from {$db->pre}rent_7 where" . $where);
    while ($c = $db->fetch_array($result)) {
        $are[] = $c;
    }
    return $are;
}
function salecookies($id)
{
    $TempNum = 5;
    if (isset($_COOKIE['SRecentlyGoods'])) {
        $RecentlyGoods = $_COOKIE['SRecentlyGoods'];
        $RecentlyGoodsArray = explode(',', $RecentlyGoods);
        $RecentlyGoodsNum = count($RecentlyGoodsArray);
    }
    if ($id != '') {
        if (strstr($RecentlyGoods, (string) $id)) {
            
        } else {
            if ($RecentlyGoodsNum < $TempNum) {
                if ($RecentlyGoods == '') {
                    setcookie('SRecentlyGoods', $id, time() + 432000, '/');
                } else {
                    $RecentlyGoodsNew = ($RecentlyGoods . ',') . $id;
                    setcookie('SRecentlyGoods', $RecentlyGoodsNew, time() + 432000, '/');
                }
            } else {
                $pos = strpos($RecentlyGoods, ',') + 1;
                $FirstString = substr($RecentlyGoods, 0, $pos);
                $RecentlyGoods = str_replace($FirstString, '', $RecentlyGoods);
                $RecentlyGoodsNew = ($RecentlyGoods . ',') . $id;
                setcookie('SRecentlyGoods', $RecentlyGoodsNew, time() + 432000, '/');
            }
        }
    }
}
function browsesale($ids)
{
    global $db;
    $where = (' itemid in (' . $ids) . ')';
    $result = $db->query("select * from {$db->pre}sale_5 where" . $where);
    while ($c = $db->fetch_array($result)) {
        $are[] = $c;
    }
    return $are;
}
function get_rent($itemid)
{
    global $db;
    $r = $db->get_one("SELECT COUNT(*) AS num FROM {$db->pre}rent_7 WHERE houseid={$itemid} and status=3");
    $rentnum = $r['num'];
    return $rentnum;
}
function get_sale($itemid)
{
    global $db;
    $r = $db->get_one("SELECT COUNT(*) AS num FROM {$db->pre}sale_5 WHERE houseid={$itemid} and status=3");
    $rentnum = $r['num'];
    return $rentnum;
}
function get_arent($username)
{
    global $db;
    $r = $db->get_one("SELECT COUNT(*) AS num FROM {$db->pre}rent_7 WHERE username='{$username}' and status=3");
    $rentnum = $r['num'];
    return $rentnum;
}
function get_asale($username)
{
    global $db;
    $r = $db->get_one("SELECT COUNT(*) AS num FROM {$db->pre}sale_5 WHERE username='{$username}' and status=3");
    $rentnum = $r['num'];
    return $rentnum;
}
function get_avg_price($itemid)
{
    global $db;
    $sum_array = $db->query("select sum( t.price/t.houseearm ) as sum_p,count(*) as sum_c from {$db->pre}sale_5 as t where status=3 and  price!='' and houseearm!=''  and houseid={$itemid} and status=3");
    $sum_arrays = $db->fetch_array($sum_array);
    $avg_price = intval(($sum_arrays['sum_p'] * 10000) / $sum_arrays['sum_c']);
    return $avg_price;
}
function get_avg_priceb($itemid)
{
    global $db;
    $pb = mktime(0, 0, 0, date('m') - 1, date('d'), date('Y'));
    $lb = date('m', $pb);
    $sum_array = $db->query("select sum( t.price/t.houseearm ) as sum_p,count(*) as sum_c from {$db->pre}sale_5 as t where status=3 and addtime <={$pb} and price!='' and houseearm!=''  and houseid={$itemid} and status=3");
    $sum_arrays = $db->fetch_array($sum_array);
    $avg_price = intval(($sum_arrays['sum_p'] * 10000) / $sum_arrays['sum_c']);
    return $avg_price;
}
function get_avg_pricec($itemid)
{
    global $db;
    $pb = mktime(0, 0, 0, date('m') - 2, date('d'), date('Y'));
    $lb = date('m', $pb);
    $sum_array = $db->query("select sum( t.price/t.houseearm ) as sum_p,count(*) as sum_c from {$db->pre}sale_5 as t where status=3 and addtime <={$pb} and price!='' and houseearm!=''  and houseid={$itemid} and status=3");
    $sum_arrays = $db->fetch_array($sum_array);
    $avg_price = intval(($sum_arrays['sum_p'] * 10000) / $sum_arrays['sum_c']);
    return $avg_price;
}
function get_avg_priced($itemid)
{
    global $db;
    $pb = mktime(0, 0, 0, date('m') - 3, date('d'), date('Y'));
    $lb = date('m', $pb);
    $sum_array = $db->query("select sum( t.price/t.houseearm ) as sum_p,count(*) as sum_c from {$db->pre}sale_5 as t where status=3 and addtime <={$pb} and price!='' and houseearm!=''  and houseid={$itemid} and status=3");
    $sum_arrays = $db->fetch_array($sum_array);
    $avg_price = intval(($sum_arrays['sum_p'] * 10000) / $sum_arrays['sum_c']);
    return $avg_price;
}
function get_avg_pricee($itemid)
{
    global $db;
    $pb = mktime(0, 0, 0, date('m') - 4, date('d'), date('Y'));
    $lb = date('m', $pb);
    $sum_array = $db->query("select sum( t.price/t.houseearm ) as sum_p,count(*) as sum_c from {$db->pre}sale_5 as t where status=3 and addtime <={$pb} and price!='' and houseearm!=''  and houseid={$itemid} and status=3");
    $sum_arrays = $db->fetch_array($sum_array);
    $avg_price = intval(($sum_arrays['sum_p'] * 10000) / $sum_arrays['sum_c']);
    return $avg_price;
}
function get_lineprice($itemid)
{
    global $db;
    $pae = get_avg_pricee($itemid);
    $pad = get_avg_priced($itemid);
    $pac = get_avg_pricec($itemid);
    $pab = get_avg_priceb($itemid);
    $paa = get_avg_price($itemid);
    $lineprice = "{$pae},{$pad},{$pac},{$pab},{$paa}";
    return $lineprice;
}
function get_linedate($itemid)
{
    global $db;
    $pa = mktime(0, 0, 0, date('m') - 0, date('d'), date('Y'));
    $la = date('m', $pa);
    $pb = mktime(0, 0, 0, date('m') - 1, date('d'), date('Y'));
    $lb = date('m', $pb);
    $pc = mktime(0, 0, 0, date('m') - 2, date('d'), date('Y'));
    $lc = date('m', $pc);
    $pd = mktime(0, 0, 0, date('m') - 3, date('d'), date('Y'));
    $ld = date('m', $pd);
    $pe = mktime(0, 0, 0, date('m') - 4, date('d'), date('Y'));
    $le = date('m', $pe);
    $linedate = ((((((((('"' . $le) . '","') . $ld) . '","') . $lc) . '","') . $lb) . '","') . $la) . '"';
    return $linedate;
}
function get_percent_change($itemid)
{
    global $db;
    $percent_change = round(((get_avg_price($itemid) - get_avg_priceb($itemid)) / get_avg_priceb($itemid)) * 100, 2);
    return $percent_change;
}
function get_cats($catid, $moduleid = 1)
{
    global $MODULE, $db;
    $condition = "moduleid={$moduleid} AND parentid=0 AND catid IN ({$catid})";
    $result = $db->query("SELECT catid,moduleid,catname FROM {$db->pre}category where {$condition}");
    while ($c = $db->fetch_array($result)) {
        $html .= $c['catname'] . '&nbsp;';
    }
    $html = rtrim($html, '&nbsp;');
    return $html;
}
function search_cats($catid, $moduleid = 1)
{
    global $MODULE, $db;
    $condition = "moduleid={$moduleid} AND parentid=0 AND catid IN ({$catid})";
    $result = $db->query("SELECT catid,moduleid,catname FROM {$db->pre}category where {$condition}");
    while ($c = $db->fetch_array($result)) {
        $html .= $c['catname'] . '&nbsp;';
    }
    $html = rtrim($html, ',');
    return $html;
}
function search_catss($catid, $moduleid = 1)
{
    global $MODULE, $db;
    $condition = "moduleid={$moduleid} AND parentid=0 AND catid IN ({$catid})";
    $result = $db->query("SELECT catid,moduleid,catname FROM {$db->pre}category where {$condition} limit 0,1");
    while ($c = $db->fetch_array($result)) {
        $html .= $c['catname'] . '&nbsp;';
    }
    $html = rtrim($html, ',');
    return $html;
}
function get_xiqoqu($areaid)
{
    global $db;
    $are = array();
    $result = $db->query("SELECT areaid,areaname FROM {$db->pre}area WHERE parentid={$areaid} ORDER BY listorder,areaid ASC limit 0,5", 'CACHE');
    while ($r = $db->fetch_array($result)) {
        $are[] = $r;
    }
    return $are;
}
function get_maincats($catid, $moduleid, $level = -1)
{
    global $db;
    $condition = $catid ? "parentid={$catid}" : "moduleid={$moduleid} AND parentid=0";
    if ($level >= 0) {
        $condition .= " AND level={$level}";
    }
    $cat = array();
    $result = $db->query("SELECT catid,catname,child,style,linkurl,item FROM {$db->pre}category WHERE {$condition} ORDER BY listorder,catid ASC limit 0,6", 'CACHE');
    while ($r = $db->fetch_array($result)) {
        $cat[] = $r;
    }
    return $cat;
}
function get_maincatmenu($catid, $moduleid, $level = -1)
{
    global $db;
    $condition = $catid ? "parentid={$catid}" : "moduleid={$moduleid} AND parentid=0";
    if ($level >= 0) {
        $condition .= " AND level={$level}";
    }
    $cat = array();
    $result = $db->query("SELECT catid,catname,child,style,linkurl,item FROM {$db->pre}category WHERE {$condition} ORDER BY listorder,catid ASC limit 0,10", 'CACHE');
    while ($r = $db->fetch_array($result)) {
        $cat[] = $r;
    }
    return $cat;
}
function area_poss($areaid, $str = ' &raquo; ', $deep = 0)
{
    if ($areaid) {
        global $AREA;
    } else {
        global $AJ;
        return $AJ[city_sitename];
    }
    $AREA or $AREA = cache_read('area.php');
    $arrparentid = $AREA[$areaid]['arrparentid'] ? explode(',', $AREA[$areaid]['arrparentid']) : array();
    $arrparentid[] = $areaid;
    $nums = count($arrparentid);
    if ($nums == 3) {
        $arrparentids = array_slice($arrparentid, -1, 1);
    } else {
        $arrparentids = array_slice($arrparentid, -2, 1);
    }
    $pos = '';
    if ($deep) {
        $i = 1;
    }
    foreach ($arrparentids as $areaid) {
        if (!$areaid || !isset($AREA[$areaid])) {
            continue;
        }
        if ($deep) {
            if ($i > $deep) {
                continue;
            }
            $i++;
        }
        $pos .= $AREA[$areaid]['areaname'] . $str;
    }
    $_len = strlen($str);
    if ($str && substr($pos, -$_len, $_len) === $str) {
        $pos = substr($pos, 0, strlen($pos) - $_len);
    }
    return $pos;
}
function get_mainarea2($areaid)
{
    global $db;
    $are = array();
    if ($areaid) {
        $r = $db->get_one("SELECT child,arrparentid,arrchildid FROM {$db->pre}area WHERE areaid={$areaid}");
        $parents = $r['arrparentid'];
        if ($r['child']) {
            $parents = $areaid;
        }
    } else {
        $parents = 0;
    }
    $result = $db->query(("SELECT areaid,areaname,arrchildid,arrparentid FROM {$db->pre}area WHERE parentid IN  (" . $parents) . ')  and child =0 ORDER BY listorder,areaid ASC', 'CACHE');
    while ($r = $db->fetch_array($result)) {
        $parents = $r['arrparentid'];
        if (strlen($parents) == 5) {
            $are[] = $r;
        }
    }
    return $are;
}
function get_mainarea4($areaid)
{
    global $db;
    $are = array();
    $result = $db->query("SELECT areaid,areaname,arrchildid,arrparentid FROM {$db->pre}area ");
    while ($r = $db->fetch_array($result)) {
        $parents = $r['arrparentid'];
        if (strlen($parents) == 5) {
            $are[] = $r;
        }
    }
    return $are;
}
function get_mainarea3($areaid)
{
    global $db;
    $are = array();
    if ($areaid) {
        $r = $db->get_one("SELECT child,arrparentid,arrchildid FROM {$db->pre}area WHERE areaid={$areaid}");
        $parents = $r['arrparentid'];
        if ($r['child']) {
            $parents = $areaid;
        }
    } else {
        $parents = 0;
    }
    $result = $db->query(("SELECT areaid,areaname,arrchildid,arrparentid FROM {$db->pre}area WHERE parentid IN  (" . $parents) . ')  and  parentid !=0 ORDER BY listorder,areaid ASC', 'CACHE');
    while ($r = $db->fetch_array($result)) {
        $are[] = $r;
    }
    return $are;
}
function get_city($areaid)
{
    global $db;
    $city = array();
    $result = $db->query("SELECT areaid,name,style,domain,letter FROM {$db->pre}city  ORDER BY listorder ASC", 'CACHE');
    while ($r = $db->fetch_array($result)) {
        $city[] = $r;
        $r['domain'] = $r['domain'] ? $r['domain'] : '';
    }
    return $city;
}
function imgurl240($imgurl = '', $absurl = 1)
{
    return $imgurl ? $imgurl : AJ_SKIN . 'image/nopic240.gif';
}
function twoCode($wap_url, $moduleid, $itemid)
{
    $urlToEncode = ((($wap_url . 'index.php?moduleid=') . $moduleid) . '&itemid=') . $itemid;
    generateQRfromGoogle($urlToEncode);
}
function generateQRfromGoogle($chl, $widhtHeight = '90', $EC_level = 'L', $margin = '0')
{
    $url = urlencode($url);
    echo ((((((((((((('<img src="http://chart.apis.google.com/chart?chs=' . $widhtHeight) . 'x') . $widhtHeight) . '&cht=qr&chld=') . $EC_level) . '|') . $margin) . '&chl=') . $chl) . '" alt="" widhtHeight="') . $size) . '" widhtHeight="') . $size) . '"widht="75" height="75"/>';
}
function tupianurl($item, $page = 0)
{
    global $AJ, $MOD, $L;
    if ($MOD['show_html'] && $item['filepath']) {
        if ($page === 0) {
            return $item['filepath'];
        }
        $ext = file_ext($item['filepath']);
        return str_replace('.' . $ext, (('_' . $page) . '.') . $ext, $item['filepath']);
    }
    include AJ_ROOT . '/api/url.inc.php';
    $file_ext = $AJ['file_ext'];
    $index = $AJ['index'];
    $itemid = $item['itemid'];
    $title = file_vname($item['title']);
    $addtime = $item['addtime'];
    $houseid = $item['houseid'];
    $year = date('Y', $addtime);
    $month = date('m', $addtime);
    $day = date('d', $addtime);
    $prefix = $MOD['htm_item_prefix'];
    $urlid = $MOD['show_html'] ? $MOD['htm_item_urlid'] : $MOD['php_item_urlid'];
    $ext = $MOD['show_html'] ? 'htm' : 'php';
    $alloc = dalloc($itemid);
    $url = $urls[$ext]['item'][5];
    $url = $page ? $url['page'] : $url['index'];
    if (strpos($url, 'cat') !== false && $catid) {
        $cate = get_cat($catid);
        $catdir = $cate['catdir'];
        $catname = $cate['catname'];
    }
    eval("\$itemurl = \"{$url}\";");
    if (substr($itemurl, 0, 1) == '/') {
        $itemurl = substr($itemurl, 1);
    }
    return $itemurl;
}
function get_num($biao, $username)
{
    global $db;
    $r = $db->get_one("SELECT COUNT(*) AS num FROM {$db->pre}{$biao} WHERE username='{$username}' and status=3");
    $num = $r['num'];
    return $num;
}
function get_price($module)
{
    global $db;
    for ($i = 4; $i >= 0; $i--) {
        $pb = mktime(0, 0, 0, date('m') - $i, date('d'), date('Y'));
        $la = date('m', $pb);
        $sum_array = $db->query("select sum( t.price/t.houseearm ) as sum_p,count(*) as sum_c from {$db->pre}{$module} as t where status=3 and addtime <={$pb} and price!='' and houseearm!='' and status=3");
        while ($sum_arrays = $db->fetch_array($sum_array)) {
            $avg_price = intval(($sum_arrays['sum_p'] * 10000) / $sum_arrays['sum_c']);
            $strp .= $avg_price . ',';
            $lineprice = substr($strp, 0, strlen($strp) - 1);
            $strd .= ('"' . $la) . '",';
            $linedate = substr($strd, 0, strlen($strd) - 1);
        }
    }
    $lineprice = ((('[' . $linedate) . '],[') . $lineprice) . ']';
    return $lineprice;
}
function get_avg_prices()
{
    global $db;
    $sum_array = $db->query("select sum( t.price/t.houseearm ) as sum_p,count(*) as sum_c from {$db->pre}sale_5 as t where status=3 and  price!='' and houseearm!='' ");
    $sum_arrays = $db->fetch_array($sum_array);
    $avg_price = intval(($sum_arrays['sum_p'] * 10000) / $sum_arrays['sum_c']);
    return $avg_price;
}
function checkdomain()
{
    
}