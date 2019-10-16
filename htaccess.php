<?php
# Difine
define("_DIR",str_replace('\\', '/', dirname(__FILE__)));
# Function
function cleanArray($arr){
	$size = sizeof($arr);
	$r = array();
	for($i=0;$i<$size;$i++){
		$thum = trim($arr[$i]);
		if($thum != ""){
			$r[] = $thum;
		}
	}
	return $r;
}
$LAYOUT = "home";		//default layout
$template = array("administrator", "auth", "api");		//list template
$ASSETS_URL="";

# SERVER_URI
$GURI = str_replace(_DIR . '/','', $_SERVER['REQUEST_URI']);
$GURI = str_replace("//", "/", $GURI);
$splitGURI  = explode($FORDER."/", $GURI);
$GURI = $splitGURI[1];
$dir = substr($GURI, -1)=="/" ? 0 : 1;
$URIALL = explode('?',$GURI);

$uri_past = cleanArray(explode('/',$URIALL[0]));
$uri_frist = isset($URIALL[1]) ? (explode('&',$URIALL[1])) : array();
if (isset($uri_past[0]) && in_array($uri_past[0], $template) &&  count($uri_past)<3){	$dir+=1; }

$uri = array();
if(is_array($uri_frist)){
	foreach($uri_frist as $xuri){
		$thum = explode('=',$xuri,2);
		if(count($thum) == 2 and trim($thum[0]) != "") { $uri[trim($thum[0])] = trim($thum[1]);  }
	}
}
$dir-= count($uri) ? 1 : 0;
$_SESSION['PARAMS'] = $uri;

for($i=0;$i<count($uri_past)-$dir;$i++){ $ASSETS_URL.="../"; }

$LINK_URL = $ASSETS_URL;

if (isset($uri_past[0]) && in_array($uri_past[0], $template)){
	$tmp = $LAYOUT;
	$LAYOUT = $uri_past[0];
	unset($uri_past[0]);
	$uri_past = implode("/", $uri_past);
	$uri_past = explode("/", $uri_past);
	$ASSETS_URL.= count($uri_past) > 1 ? "" : "../";
	$LINK_URL = $uri_past[0]!=$tmp ? $ASSETS_URL.$LAYOUT."/" : $ASSETS_URL;
}

$_SESSION['LAYOUT'] = $LAYOUT;
$_SESSION['ASSETS_URL'] = $ASSETS_URL;
$_SESSION['LINK_URL'] = $LINK_URL;
?>