<?
include (DIR_H_INC.'data.inc.php');
include (DIR_H_INC.'tables.php');
require (DIR_H_LANG);
require (DIR_H_FU."mysql.php");
require (DIR_H_FU.'func.php');
//include (DIR_H_FU.'classes.php');
sec_session_start();
?>
<!DOCTYPE html>
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Hamster sucht Heimtrainer</title>
<link rel='shortcut icon' href='./template/img/favicon.ico' type='image/x-icon' />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<!--Eigene CSS-->
<link href="./template/css/style.css" rel="stylesheet" type="text/css" />
<link href="./template/css/tcal.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="./template/css/highslide.css" />
<!--Fremde JS include()-->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>-->
<!--Eigene JS-->
<script src="./template/js/tcal.js" type="text/javascript"></script>
<script src="./template/js/img.js" type="text/javascript"></script>
<script type="text/javascript" src="./template/js/sha512.js"></script>
<script type="text/javascript" src="./template/js/forms.js"></script>
<script type="text/javascript" src="./template/js/formcheck.js"></script>
<script type="text/javascript" src="./template/js/highslide-with-gallery.js"></script>
<script type="text/javascript" src="./template/js/highslide.config.js" charset="utf-8"></script>
<script type="text/javascript" language="JavaScript">
var checkflag = "false"; 
	function check(field) { 
		if (checkflag == "false") { 
			for (i = 0; i < field.length; i++) { 
				field[i].checked = true;} checkflag = "true"; 
				return " keine "; 
			} else { 
				for (i = 0; i < field.length; i++) { 
				field[i].checked = false;
			} 
			checkflag = "false"; 
			return " alle "; 
		} 
	}
</script>
<script type="text/javascript">
function fenster()
{
	var id = document.getElementById('getid').value,
neu = window.open("./index.php?site=gall&user="+id,"Gallery","");
}
</script>
<script type="text/javascript">
function pmf()
{
	var id = document.getElementById('pmid').value,
neu = window.open("./index.php?site=pmn&user="+id,"PM","");
}
function senden() {
Check = confirm("Wollen Sie das wirklich?");
if(Check == false){
return false;
}
else{
return true;
}

}

</script>
<style>
    body { font-size: 62.5%; }
    label, input { display:block; }
    input.text { margin-bottom:12px; width:95%; padding: .4em; }
    fieldset { padding:0; border:0; margin-top:25px; }
    h1 { font-size: 1.2em; margin: .6em 0; }
    div#users-contain { width: 350px; margin: 20px 0; }
    div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
    div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
    .ui-dialog .ui-state-error { padding: .3em; }
    .validateTips { border: 1px solid transparent; padding: 0.3em; }
  </style>
<script type="text/javascript" src="./template/js/inline.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#wait_1').hide();
	$('#drop_1').change(function(){
	  $('#wait_1').show();
	  $('#result_1').hide();
      $.get("./funktion/func.php", {
		func: "drop_1",
		drop_var: $('#drop_1').val()
      }, function(response){
        $('#result_1').fadeOut();
        setTimeout("finishAjax('result_1', '"+escape(response)+"')", 400);
      });
    	return false;
	});
});

function finishAjax(id, response) {
  $('#wait_1').hide();
  $('#'+id).html(unescape(response));
  $('#'+id).fadeIn();
}
function finishAjax_tier_three(id, response) {
  $('#wait_2').hide();
  $('#'+id).html(unescape(response));
  $('#'+id).fadeIn();
}
</script>
</head>

<body>
<?php
if (isset($_SESSION['user_id'])) {
        $stat = "?site=prof&user=".$_SESSION['user_id'];
} else {
    $stat = "";
} 
if(login_check($mysqli) == false) {
	$hea = "Login";
}
if ($_GET['site'] =="prof") {
    $hea = "Profil";
}
if ($_GET['site'] == "anz") {
    $hea = "Gesuch Aufgeben";
}
if ($_GET['site'] == "editi") {
    $hea = "Aktivierung";
}
if ($_GET['site'] == "reg") {
    $hea = "Registrierung";
}
if ($_GET['site'] == "req") {
    $hea = "Eigene Anzeigen";
}
if ($_GET['site'] == "gef") {
    $hea = "Alle Anzeigen";
}
if ($_GET['site'] == "mailakt") {
    $hea = "Aktivierung";
}
if ($_GET['site'] == "akti") {
    $hea = "Aktivierung";
}
if ($_GET['site'] == "adm") {
    $hea = "Adminbereich";
}
if ($_GET['site'] == "adusr") {
    $hea = "Adminbereich";
}
if ($_GET['site'] == "imp") {
    $hea = "Impressum";
}
if ($_GET['site'] == "agb") {
    $hea = "AGB";
}
if ($_GET['site'] == "gall") {
    $hea = "Gallery";
}

if ($_GET['error'] == "1") {
    $hea = "Fehler";
}
if ($_GET['error'] == "2") {
    $hea = "Fehler";
}
if ($_GET['error'] == "3") {
    $hea = "Fehler";
}
if ($_GET['error'] == "4") {
    $hea = "Meldung";
}
if ($_GET['error'] == "5") {
    $hea = "Fehler";
}
if ($_GET['error'] == "6") {
    $hea = "Fehler";
}
if ($_GET['site'] == "pm") {
    $hea = "Nachrichtensystem";
}
if ($_REQUEST['pmpap']) {
	$hea = "Papierkorb";
}
if ($_REQUEST['pmvers']) {
	$hea = "Versendete Nachrichten";
}
if ($_GET['site'] == "pmz") {
    $hea = "Nachricht";
}
echo "<table class='outer-border' id='main'><tr><td><table width='100%'><tr><td class='full-header'><table width='100%'><tr><td><img src='".DIR_H_IMG.$heimg."'></td></tr></table></td></tr></table><table width='100%'><tr><td class='sub-header'></td></tr></table>\n";
echo "<table width='100%'><tr>\n";
echo'<table width="100%"><tr><td class="side-border-left" valign="top"><table width="100%" class="border tablebreak"><tr><td class="scapmain">'.$locate['401'].'</td></tr><tr><td colspan="2" class="side-body"><div id="navigation"><ul><li class="first-link"><a href="index.php'.$stat.'" class="side"><img src="'.DIR_H_IMG.'bullet.gif" border="0" /><span>Startseite</span></a></li>';
if (isset($_SESSION['user_id'])) {
    echo '<li><a href="index.php?site=req&user='.$_SESSION['user_id'].'" class="side"><img src="'.DIR_H_IMG.'bullet.gif" border="0" /><span>Eigene Anzeigen</span></a></li>';
    echo '<li><a href="index.php?site=lout&user='.$_SESSION['user_id'].'" class="side"><img src="'.DIR_H_IMG.'bullet.gif" border="0" /><span>Logout</span></a></li>';
    echo '<li><a href="index.php?site=anz" class="side"><img src="'.DIR_H_IMG.'bullet.gif" border="0" /><span>Gesuch Aufgeben</span></a></li>';
    echo '<li><a href="index.php?site=gef" class="side"><img src="'.DIR_H_IMG.'bullet.gif" border="0" /><span>Alle Anzeigen</span></a></li>';
	echo '<li><a href="index.php?site=pm&user='.$_SESSION['user_id'].'" class="side"><img src="'.DIR_H_IMG.'bullet.gif" border="0" /><span>Nachrichten</span></a></li>';

} else {
    echo '<li><a href="index.php?site=reg" class="side"><img src="'.DIR_H_IMG.'bullet.gif" border="0" /><span>Registrieren</span></a></li>';
}
if ($_SESSION['usr'] =="0") {
    echo '<li><a href="index.php?site=adm" class="side"><img src="'.DIR_H_IMG.'bullet.gif" border="0" /><span>Administrator</span></a></li>';
}
echo'<li><a href="index.php?site=agb" class="side"><img src="'.DIR_H_IMG.'bullet.gif" border="0" /><span>AGB</span></a></li>';
echo'<li><a href="index.php?site=imp" class="side"><img src="'.DIR_H_IMG.'bullet.gif" border="0" /><span>Impressum</span></a></li>';
echo '</ul></div></td></tr></table>
</td><td class="main-bg" valign="top"><noscript><div class="noscript-message admin-message">Du hast in deinem Browser kein <strong>Javascript</strong> aktiviert.<br />
Um diese Seite korrekt anzuzeigen ist Javascript jedoch zwingend n&ouml;tig.<br />
Bitte aktiviere Javascript in den Einstellungen deines Browser beziehungswei&szlig;e besorge dir einen Browser, der diesen unterst&uuml;tzt.<br />
<a href="http://www.firefox.com/" rel="nofollow" title="Mozilla Firefox">Mozilla Firefox</a>&nbsp;|&nbsp;
<a href="http://www.apple.com/safari/" rel="nofollow" title="Safari">Safari</a>&nbsp;|&nbsp;
<a href="http://www.opera.com/" rel="nofollow" title="Opera">Opera</a>&nbsp;|&nbsp;
<a href="http://www.google.com/chrome/" rel="nofollow" title="Google Chrome">Google Chrome</a>&nbsp;|&nbsp;
<a href="http://www.microsoft.com/windows/internet-explorer/" rel="nofollow" title="Internet Explorer">Internet Explorer h&ouml;her Version 6</a>
</div></noscript><!--error_handler--><table width="100%" class="border tablebreak"><tr><td class="capmain">'.$hea.'</td></tr><tr><td class="main-body">';
if(login_check($mysqli) == false) {
	include (DIR_H_HTML.'login.html');
	include (DIR_H_TEMP.'login.php');
 }
if ($_GET['site'] =="lout") {
    include DIR_H_BASE."logout.php";
}
if ($_GET['site'] =="prof") {
    include DIR_H_BASE."prof.php";
}
if ($_GET['site'] == "anz") {
    include DIR_H_BASE."edit.php";
}
if ($_GET['site'] == "editi") {
    include DIR_H_BASE."editi.php";
}
if ($_GET['site'] == "reg") {
	include (DIR_H_HTML.'reg.html');
    include DIR_H_BASE."reg.php";
}
if ($_GET['site'] == "reg2") {
    include DIR_H_BASE."reg2.php";
}
if ($_GET['site'] == "req") {
    include DIR_H_BASE."req.php";
}
if ($_GET['site'] == "gef") {
    include DIR_H_BASE."gef.php";
}
if ($_GET['site'] == "mailakt") {
    include DIR_H_BASE."maakt.php";
}
if ($_GET['site'] == "akti") {
    include DIR_H_BASE."editi.php";
}
if ($_GET['site'] == "adm") {
    include DIR_H_BASE."adm.php";
}
if ($_GET['site'] == "adusr") {
    include DIR_H_AA."aduser.php";
}
if ($_GET['site'] == "imp") {
    include DIR_H_BASE."imp.php";
}
if ($_GET['site'] == "agb") {
    include DIR_H_BASE."agb.html";
}
if ($_GET['site'] == "upload") {
    include DIR_H_BASE."upload.php";
}
if ($_GET['site'] == "pm") {
    include DIR_H_BASE."pm.php";
}
if ($_GET['site'] == "pmn") {
    include DIR_H_BASE."pmn.php";
}
if ($_GET['site'] == "pmz") {
    include DIR_H_BASE."pmz.php";
}
if ($_GET['site'] == "gall") {
	include (DIR_H_HTML.'gall.html');
    include DIR_H_BASE."gall.php";
}
if ($_GET['site'] == "galdel") {
    include DIR_H_BASE."uploadg.php";
}
if ($_GET['error'] == "1") {
    echo '<tr><td class="failure">'.$locate['434'].'</td></tr>';
}
if ($_GET['error'] == "2") {
    echo '<tr><td class="failure">'.$locate['435'].'</td></tr>';
}
if ($_GET['error'] == "3") {
    echo '<tr><td class="failure">'.$locate['424'].'</td></tr>';
}
if ($_GET['error'] == "4") {
    echo '<tr><td class="failure">'.$locate['446'].'</td></tr>';
}
if ($_GET['akt'] == "1") {
    echo '<tr><td class="failure">'.$locate['439'].'</td></tr>';
}
if ($_GET['error'] == "5") {
    echo '<tr><td class="failure">'.$locate['447'].'</td></tr>';
}
if ($_GET['error'] == "6") {
    echo '<tr><td class="failure">'.$locate['448'].'</td></tr>';
}
if ($_GET['er'] == "1") {
    echo '<tr><td class="failure">'.$locate['453'].'</td></tr>';
}
if ($_GET['er'] == "2") {
    echo '<tr><td class="failure">'.$locate['454'].'</td></tr>';
}