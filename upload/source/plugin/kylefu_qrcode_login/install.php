<?php
/**
 *  [kylefu_qrcode_login] 2013
 *	install.inc.php kylefu
 */
 
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
if(!DB::fetch_first("SHOW TABLES LIKE '".DB::table('pre_kylefu_wechat_bind')."'")) {
}
$sql =<<<EOF
CREATE TABLE IF NOT EXISTS `pre_kylefu_wechat_bind` (
  `id` int(11) NOT NULL auto_increment,
  `fake_id` int(15) NOT NULL,
  `nick_name` varchar(255) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `wechat_id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `uid` int(11) NOT NULL,
  `authcode` varchar(255) NOT NULL,
  `notification` text NOT NULL,
  `createtime` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=0 ;
EOF;

runquery($sql);

$finish = true;
?>