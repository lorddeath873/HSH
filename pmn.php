<?
include ('./inc/config.php');
include (DIR_H_INC.'data.inc.php');
	$id = $_POST['uid'];
	$uide = $_POST['uids'];
	$pmbetr = $_POST['betre'];
	$pmnn = $_POST['chif'];
	$sent = "1";
	$rma = "0";
	$del = "0";
	$stmt = $mysqli -> prepare("INSERT INTO pm (uid, pmbetr, pm, uids, readma, del, sent) VALUES (?,?,?,?,?,?,?)");
	$stmt->bind_param('issiiii', $uide, $pmbetr, $pmnn, $id, $rma, $del, $sent);
	$stmt->execute();
	if ($stmt->affected_rows == 1) { echo 'Nachricht erfolgreich verschickt'; } else { echo 'Nachricht konnte nicht verschickt werden'; }
	$stmt->close();
