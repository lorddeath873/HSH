<?php
include ('./inc/config.php');
include (DIR_H_INC.'data.inc.php');
include (DIR_H_INC.'tables.php');
require (DIR_H_LANG);
require (DIR_H_FU."mysql.php");
include (DIR_H_FU.'func.php');
sec_session_start();
$chiff = $_POST['chiff'];
$bez = $_POST['field'];
if ($bez == "kon") {
    $uid = $_SESSION['user_id'];
    $post = $_POST['value'];
    $stmt = $mysqli->prepare("SELECT email FROM ".U." WHERE id= ? LIMIT 1");
    $stmt->bind_param('i', $uid);
    $stmt->execute();
    $stmt->bind_result($amil);
    $stmt->store_result();
    while ($stmt->fetch()) {
        if ($stmt->affected_rows != "0") {
            if ($post == "1") {
                $amil = "Verborgen";
            }
                $stmtu = $mysqli->prepare("UPDATE ".CO." SET kontakt= ?, ano= ? WHERE chiff= ?");
                $stmtu->bind_param('sis', $amil, $post, $chiff);
                $stmtu->execute();
            if ($stmtu->affected_rows != "0") {
                echo $amil;
            } else {
                echo "Fehler!";
            }
        }
    }
    $stmt->close();
    $stmtu->close();
}
if ($bez == "dat") {
    $dat = $_POST['value'];
    $datu = $_POST['datu'];
    $min = $_POST['mini'];
    $mini = $datu.":".$min;
    $stmt = $mysqli->prepare("UPDATE ".CO." SET dat= ?, time= ? WHERE chiff= ?");
    $stmt->bind_param('sss', $dat, $mini, $chiff);
    $stmt->execute();
    $stmt->close();
}
if ($bez == "port") {
	$plz = $_POST['value'];
    $stmt = $mysqli->prepare("UPDATE ".CO." SET zip= ? WHERE chiff= ?");
    $stmt->bind_param('is', $plz, $chiff);
    $stmt->execute();
	$stmt->close();
	$stmt = $mysqli->prepare("SELECT city_id FROM ".ZIP." WHERE zipcode= ? LIMIT 1");
	$stmt->bind_param('i', $plz);
	$stmt->execute();
	$result = $stmt -> get_result();
	while ($plz = $result->fetch_object()) {
		$oid = $plz->city_id;
	}
	$stmt->close();
	$stmt = $mysqli->prepare("SELECT name FROM ".CI." WHERE id= ? LIMIT 1");
	$stmt->bind_param('i', $oid);
	$stmt->execute();
	$result = $stmt ->get_result();
	while ($ortd = $result->fetch_object()) {
		$ort = $ortd->name;
	}
	$stmt->close();
	$stmt = $mysqli->prepare("UPDATE ".CO." SET ort= ? WHERE chiff= ?");
    $stmt->bind_param('ss', $ort, $chiff);
    $stmt->execute();
	$stmt->close();
}
if ($bez == "wo") {
	$txt = $_POST['value'];
    $stmt = $mysqli->prepare("UPDATE ".CO." SET txt= ? WHERE chiff= ?");
    $stmt -> bind_param ('ss', $txt, $chiff);
	$stmt->execute();
	$stmt->close();
}
if ($bez == "ws") {
	$txt = $_POST['value'];
    $stmt = $mysqli->prepare("UPDATE ".CO." SET txts= ? WHERE chiff= ?");
    $stmt -> bind_param ('ss', $txt, $chiff);
	$stmt->execute();
	$stmt->close();
}
if ($bez == "wse") {
	$txt = $_POST['value'];
    $stmt = $mysqli->prepare("UPDATE ".CO." SET txtse= ? WHERE chiff= ?");
    $stmt -> bind_param ('ss', $txt, $chiff);
	$stmt->execute();
	$stmt->close();
}
if ($bez == "wh") {
	$txt = $_POST['value'];
    $stmt = $mysqli->prepare("UPDATE ".CO." SET txwh= ? WHERE chiff= ?");
    $stmt -> bind_param ('ss', $txt, $chiff);
	$stmt->execute();
	$stmt->close();
}
if ($bez == "del") {
    $stmt = $mysqli->prepare("DELETE FROM ".CO." WHERE chiff= ?");
    $stmt->bind_param('s', $chiff);
	$stmt->execute();
	$stmt->close();
	echo'<meta http-equiv="refresh" content="0; URL=./index.php?site=req">';
}