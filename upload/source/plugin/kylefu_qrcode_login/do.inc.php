<?php
/**
 *  [kylefu_qrcode_login] 2013
 *	do.inc.php kylefu $
 *	http://www.kylefu.com 
*/
require_once DISCUZ_ROOT.'./source/plugin/kylefu_qrcode_login/function/function.qrcode.login.php';
if(!defined('IN_DISCUZ')) {exit('Access Denied');}
$data = dhtmlspecialchars($_GET['data']);
dsetcookie('kylefu_qrcode_login_data',serialize($data));
if(!empty($data) || !empty($data['fakeid']) || !empty($data['nickname']) || !empty($data['username']) || !empty($data['gender']) || !empty($_G['uid'])){
	$bind = C::t('#kylefu_qrcode_login#bind')->fetch_by_fake_id($data['fakeid']);
	require libfile('function/member');
	require libfile('class/member');
	$_GET['loginsubmit'] = $_GET['infloat'] = 'yes'; 
	if($bind){
		//dreferer("forum.php");
		if(!$_G['uid']){
			dsetcookie('kylefu_qrcode_login_data','');
			$_GET['username'] = $bind['username'];
			$_GET['password'] = authcode($bind['authcode'],'DECODE',WECHAT_KEY);
			$ctl_obj = new logging_ctl();
			$_G['setting']['seccodestatus'] = 0;
			$ctl_obj->setting = $_G['setting'];
			$ctl_obj->on_login();
		}else{
			showmessage($_lang['yes_wechat'],'forum.php');
		}
	}else{
		if(!submitcheck('submit')){
			if(C::t('#kylefu_qrcode_login#bind')->fetch_by_uid($_G['uid'])){
				showmessage($_lang['yes_bind']);
			}else include template("kylefu_qrcode_login:bind");
		}else{
			if(empty($_GET['username']))showmessage($_lang['username_empty']);
			if(empty($_GET['password']))showmessage($_lang['password_empty']);
			$result = userlogin($_GET['username'], $_GET['password'], $_GET['questionid'], $_GET['answer'], $_G['setting']['autoidselect'] ? 'auto' : $_GET['loginfield'], $_G['clientip']);
			if($result['ucresult']['uid'] <= 0) {
				showmessage($_lang['no_user']);
			}else{
				dsetcookie('kylefu_qrcode_login_data','');
				$data_new['fake_id']	= dhtmlspecialchars($data['fakeid']);
				$data_new['nick_name']	= dhtmlspecialchars($data['nickname']);
				$data_new['user_name']	= dhtmlspecialchars($data['username']);
				$data_new['gender']		= $data['gender'];
				$data_new['username']	= $result['ucresult']['username'];
				$data_new['uid']		= $result['ucresult']['uid'];
				$data_new['authcode']	= authcode($_GET['password'],'ENCODE',WECHAT_KEY);
				$data_new['createtime'] = time();
				C::t('#kylefu_qrcode_login#bind')->insert($data_new);
				if(!$_G['uid']){
					$_GET['username'] = $data_new['username'];
					$_GET['password'] = $_GET['password'];
					$ctl_obj = new logging_ctl();
					$_G['setting']['seccodestatus'] = 0;
					$ctl_obj->setting = $_G['setting'];
					$ctl_obj->on_login();
				}else{
					showmessage($_lang['success'].$_lang['bind'],'forum.php');
				}
			}
		}
	}
}else showmessage($_lang['no_exists']);
?>