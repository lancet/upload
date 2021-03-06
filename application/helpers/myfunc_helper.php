<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function show_message($message,$actionurl=array(),$target='_self'){
	$CI =& get_instance();
	$CI->load->vars('message',$message);
	$CI->load->vars('actionurl',$actionurl);
	$CI->load->vars('target',$target);
	$message = $CI->load->view('message.php','',true);
	echo $message;exit;
}

function top_redirect($url){
	header("Content-Type: text/html; charset=utf-8");
	$str = '<script type="text/javascript">';
	$str .= 'top.location.href="'.$url.'"';
	$str .= '</script>';
	echo $str;exit;
}

function show_jsonmsg($data){
	if(is_array($data)){
		$return = $data;	
	}else{
		$return = array('status'=>$data);
	}
	echo json_encode($return);exit;
}

function md5pass($pass,$salt){
	return md5(substr(md5($pass),0,10).$salt);
}

function get_image_url($url){
	if(substr($url,0,4)=='http'){
		return $url;	
	}else{
		return base_url($url);
	}
}

function get_full_url($url){
	if(substr($url,0,4)=='http'){
		return $url;
	}else{
		return site_url($url);
	}
}

function show_page($pagearr,$search=array()){
	$pagearr['pagenum']=isset($pagearr['pagenum'])&&$pagearr['pagenum']?$pagearr['pagenum']:20;
	$pagearr['currentpage']=$pagearr['currentpage']?$pagearr['currentpage']:1;
	$pagearr['numlinks']=isset($pagearr['numlinks'])&&$pagearr['numlinks']>0?$pagearr['numlinks']:5;
	$pagestr = '';
	$totalpage = ceil($pagearr['totalnum']/$pagearr['pagenum']);
	if($totalpage<2){
		return $pagestr;
	}
	if($pagearr['currentpage']>$pagearr['numlinks']){
		$pagestr .= '<a href="javascript:gotopage(1)">'.lang('first_page').'</a>';
	}
	if($pagearr['currentpage']>1){
		$pagestr .= '<a href="javascript:gotopage('.($pagearr['currentpage']-1).')">'.lang('pre_page').'</a>';
	}
	$prestart = $pagearr['currentpage']-$pagearr['numlinks'];
	$start = $prestart>1?$prestart:1;
	$end = $pagearr['currentpage']+$pagearr['numlinks'];
	$end = $end>$totalpage?$totalpage:$end;
	for($i=$start;$i<$pagearr['currentpage'];$i++){
		$pagestr .= '<a href="javascript:gotopage('.$i.')">'.$i.'</a>';
	}
	$pagestr .= '<strong>'.$i.'</strong>';
	for($i=$pagearr['currentpage'];$i<$end;$i++){
		$pagestr .= '<a href="javascript:gotopage('.($i+1).')">'.($i+1).'</a>';
	}
	if($pagearr['currentpage']<$totalpage){
		$pagestr .= '<a href="javascript:gotopage('.($pagearr['currentpage']+1).')">'.lang('next_page').'</a>';
	}
	if($end<$totalpage){
		$pagestr .= '<a href="javascript:gotopage('.$totalpage.')">'.lang('last_page').'</a>';
	}
	$pagestr .= '<form name="formpage" id="formpage" action="" method="post">';
	$pagestr .= '<input type="hidden" name="currentpage" id="currentpage" value="'.$pagearr['currentpage'].'">';
	foreach($search as $key=>$item){
		$pagestr .= '<input type="hidden" name="'.$key.'" value="'.$item.'">';
	}
	$pagestr .= '</form>';
	return $pagestr;
}

function replacekeyword($keywods,$urls,$content){
	$content = preg_replace("#(<a(.*))(>)(.*)(<)(\/a>)#isU", '\\1-]-\\4-[-\\6', $content);
	$content = @preg_replace("#(^|>)([^<]+)(?=<|$)#sUe", "highlight('\\2', \$keywods, \$urls, '\\1')", $content);
	$content = preg_replace("#(<a(.*))-\]-(.*)-\[-(\/a>)#isU", '\\1>\\3<\\4', $content);
	return $content;
}

function highlight($string, $words, $result, $pre){
	global $replaced;
	$string = str_replace('\"', '"', $string);
		foreach ($words as $key => $word){
			if($replaced[$word] == 1){
				continue;
			}
			$string = preg_replace("#".preg_quote($word)."#", $result[$key], $string,1);
			if(strpos($string, $word) !== FALSE){
				$replaced[$word] = 1;
			}
		}
	return $pre.$string;
}
/*
 * $type:1、文件夹 2、文件
 * $path:1、路径
 */
function dirfile_check($dirfile_items) {
	foreach($dirfile_items as $key => $item) {
		$item_path = $item['path'];
		if($item['type'] == 'dir') {
			if(!dir_writeable(FCPATH.$item_path)) {
				if(is_dir(FCPATH.$item_path)) {
					$dirfile_items[$key]['status'] = 0;
					$dirfile_items[$key]['current'] = '+r';
				} else {
					$dirfile_items[$key]['status'] = -1;
					$dirfile_items[$key]['current'] = 'nodir';
				}
			}else {
				$dirfile_items[$key]['status'] = 1;
				$dirfile_items[$key]['current'] = '+r+w';
			}
		} else {
			if(file_exists(FCPATH.$item_path)) {
				if(is_writable(FCPATH.$item_path)) {
					$dirfile_items[$key]['status'] = 1;
					$dirfile_items[$key]['current'] = '+r+w';
				} else {
					$dirfile_items[$key]['status'] = 0;
					$dirfile_items[$key]['current'] = '+r';
				}
			} else {
				if(dir_writeable(dirname(FCPATH.$item_path))) {
					$dirfile_items[$key]['status'] = 1;
					$dirfile_items[$key]['current'] = '+r+w';
				} else {
					$dirfile_items[$key]['status'] = -1;
					$dirfile_items[$key]['current'] = 'nofile';
				}
			}
		}
	}
	return $dirfile_items;
}

function dir_writeable($dir) {
	$writeable = 0;
	if(!is_dir($dir)) {
		@mkdir($dir, 0777);
	}
	if(is_dir($dir)) {
		if($fp = @fopen("$dir/test.txt", 'w')) {
			@fclose($fp);
			@unlink("$dir/test.txt");
			$writeable = 1;
		} else {
			$writeable = 0;
		}
	}
	return $writeable;
}

function get_suffix($str){
	$arr = explode('.',$str);
	$num = count($arr);
	if($num>0){
		$res = $arr[$num-1];
		return $res;
	}else{
		return false;
	}
}

function splitsql($sql) {
	$sql = str_replace("\r", "\n", $sql);
	$ret = array();
	$num = 0;
	$queriesarray = explode(";\n", trim($sql));
	unset($sql);
	foreach($queriesarray as $query) {
		$queries = explode("\n", trim($query));
		$ret[$num] = '';
		foreach($queries as $query) {
			$ret[$num] .= $query[0] == "#" ? NULL : $query;
		}
		$num++;
	}
	return($ret);
}

function mult_to_single($arr,$key='id'){
	$newarr = array();
	foreach($arr as $item){
		$newarr[$item[$key]] = $item;
	}
	return $newarr;
}

function mult_to_idarr($arr,$key='id'){
	$newarr = array();
	foreach($arr as $item){
		$newarr[] = $item[$key];
	}
	return $newarr;
}

function cmp_func($a, $b) {
	global $order;
	if ($a['is_dir'] && !$b['is_dir']) {
		return -1;
	} else if (!$a['is_dir'] && $b['is_dir']) {
		return 1;
	} else {
		if ($order == 'size') {
			if ($a['filesize'] > $b['filesize']) {
				return 1;
			} else if ($a['filesize'] < $b['filesize']) {
				return -1;
			} else {
				return 0;
			}
		} else if ($order == 'type') {
			return strcmp($a['filetype'], $b['filetype']);
		} else {
			return strcmp($a['filename'], $b['filename']);
		}
	}
}

?>
