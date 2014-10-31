<?php
define("DIR_H_BASE", $_SERVER['DOCUMENT_ROOT']."/");
define("DIR_H_INC", DIR_H_BASE."inc/");
define("DIR_H_TEMP", DIR_H_BASE."template/");
define("DIR_H_HTML", DIR_H_BASE."template/html/");
define("DIR_H_FU", DIR_H_BASE."funktion/");
define("DIR_H_AA", DIR_H_BASE."admin/");
define("DIR_H_IMG", "./template/img/");
define("USRIMG", "./usr/");
$heimg = "header.gif";
require_once (DIR_H_FU.'lang.php');
$allowed_langs = array ('de', 'en');
$lang = lang_getfrombrowser($allowed_langs, 'de', null, false);
$lng=$lang;
define("DIR_H_LANG", DIR_H_BASE."lang/".$lang.".php");
