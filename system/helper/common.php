<?php

function create_guid() {
	$charid = strtoupper(md5(uniqid(mt_rand(), true)));
	$hyphen = chr(45);// "-"
	$uuid = chr(123)// "{"
	.substr($charid, 0, 8).$hyphen
	.substr($charid, 8, 4).$hyphen
	.substr($charid,12, 4).$hyphen
	.substr($charid,16, 4).$hyphen
	.substr($charid,20,12)
	.chr(125);// "}"
	return $uuid;
}

function rand_str($length = 8){
	$charid = strtoupper(md5(uniqid(mt_rand(), true)));
	return substr($charid, 0, $length);
}

function datetime(){
	return date('Y-m-d H:i:s');
}

function strip_html($str){
	$str= htmlspecialchars_decode($str); 
	$str = preg_replace( "@<script(.*?)</script>@is", "", $str );
	$str = preg_replace( "@<iframe(.*?)</iframe>@is", "", $str );
	$str = preg_replace( "@<style(.*?)</style>@is", "", $str );
	$str = preg_replace( "@<(.*?)>@is", "", $str );
	return $str;
}

?>