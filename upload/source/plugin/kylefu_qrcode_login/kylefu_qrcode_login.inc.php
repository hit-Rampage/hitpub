<?php
/**
 *  [kylefu_qrcode_login] 2013
 *	kylefu_qrcode_login.inc.php kylefu $
 *	http://www.kylefu.com 
*/
require_once DISCUZ_ROOT.'./source/plugin/kylefu_qrcode_login/function/function.qrcode.login.php';
$qrcode = json_decode(file_get_contents(QRCODE_API_URL.'api.php'));
$logincode =  $qrcode->code;
$qrimg = $qrcode->img;
if (isset($_POST['code'])) {
	$result = file_get_contents(QRCODE_API_URL.'api.php?mod=login&code='.$_POST['code']);
	die($result);
}
include template("kylefu_qrcode_login:index");
?>