<?php
/*
 * �����޸ı�ҳ�κ����ݣ��������Ը���
 * ���� ���������� �˹�����ʵ���� ��Ʒ��Made By Nimba, Team From AiLab.cn)
 */
$info=array();
$info['name']='nimba_weather';
$info['version']='v1.5.1';
require_once DISCUZ_ROOT.'./source/discuz_version.php';
$info['siteversion']=DISCUZ_VERSION;
$info['siterelease']=DISCUZ_RELEASE;
$info['timestamp']=TIMESTAMP;
$info['nowurl']=$_G['siteurl'];
$info['siteurl']='http://localhost/upload/';
$info['clienturl']='http://localhost/upload/';
$info['siteid']='4E76D6FB-5744-F3C7-349E-C75590D47DCB';
$info['sn']='2013122021p3QT9p8ZPW';
$info['adminemail']=$_G['setting']['adminemail'];
$infobase=base64_encode(serialize($info));
?>