<? 
include (DIR_H_INC."html.php");
if (login_check($mysqli) == true) {
	if ($_GET['user'] == $_SESSION['user_id']) {
		$id = $_SESSION['user_id'];
	} else {
		echo "Hab dich erwischt!!";
		exit;
	}
	$id = $_SESSION['user_id'];
if ($_REQUEST['pmpap'])
{
	
	?>
    <form method="post" action="<? $_SERVER['PHP_SELF'] ?>">
    <table>
    <tr>
    <td><input class="argbut" type="button" value="Zurück" onclick="history.back();"></td>
    </tr>
    </table>
    <table class="outer-border" id="main">
	<tr>
	<td class="table-body"><? echo $locate ['455'] ?></td>
	<td class="table-body"><? echo $locate ['456'] ?></td>
	<td class="table-body"><? echo $locate ['457'] ?></td>
	<td class="table-body"><? echo $locate ['458'] ?></td>
	</tr>
	<?
	$delk = "1";
	$stmt= $mysqli->prepare ('SELECT id, pmbetr, pm, uids, readma FROM '.PMA.' WHERE del=?');
	$stmt->bind_param('i', $delk);
	$stmt->execute();
	$result = $stmt->get_result();
	while ($uds = $result -> fetch_object()) {
		$raa = $uds ->readma;
		$uids = $uds ->uids;
		if($stmtu = $mysqli->prepare("SELECT ".LO." FROM ".U." WHERE id = ? ")){
		$stmtu->bind_param('i', $uids);
		$stmtu->execute();
		$resultu = $stmtu -> get_result();
		while ($uidsp = $resultu ->fetch_object()) {
		if ($raa == "0"){ $img= "<img src=".DIR_H_IMG."ungel.gif />"; } else { $img= "<img src=".DIR_H_IMG."gel.gif />"; }
		echo '<tr>';
		echo '<td class="textbox" width="50px">'.$img.'</td>';
		echo '<td class="textbox" >'.$uidsp->login.'</td>';
		$pm = $uds->pmbetr;
		if ($pm == "") { $pm = "Kein Betreff"; }
		echo '<td class="textbox" width="700px"><a href="./index.php?site=pmz&user='.$id.'&pm='.$uds->id.'">'.$pm.'</a></td>';
		echo '<td class="textbox" width="50px"><input id="del" name="del[]" type="checkbox" value="'.$uds->id.'"></td>';
		echo '</tr>';
	}
	}
	$stmt->close();
	$stmtu->close();
	}
?>
</table>
<table>
<tr>
<td><input name="pmdel" class="argbut" type="submit" value="Löschen"></td>
<td><input type="button" class="argbut" value=" alle auswählen "onClick="this.value=check(this.form.del)"></td>
</tr>
</table>
</form>
<?
exit;
	}
?>
<!-- Sent -->
<?
if ($_REQUEST['pmvers'])
{
	
	?>
    <form method="post" action="<? $_SERVER['PHP_SELF'] ?>">
        <table>
    <tr>
    <td><input class="argbut" type="button" value="Zurück" onclick="history.back();"></td>
    </tr>
    </table>
    <table class="outer-border" id="main">
	<tr>
	<td class="table-body"><? echo $locate ['455'] ?></td>
	<td class="table-body"><? echo $locate ['456'] ?></td>
	<td class="table-body"><? echo $locate ['457'] ?></td>
	<td class="table-body"><? echo $locate ['458'] ?></td>
	</tr>
	<?
	$delk = "1";
	$stmt= $mysqli->prepare ('SELECT id, pmbetr, pm, uids, readma FROM '.PMA.' WHERE sent=?');
	$stmt->bind_param('i', $delk);
	$stmt->execute();
	$result = $stmt->get_result();
	while ($uds = $result -> fetch_object()) {
		$raa = $uds ->readma;
		$uids = $uds ->uids;
		if($stmtu = $mysqli->prepare("SELECT ".LO." FROM ".U." WHERE id = ? ")){
		$stmtu->bind_param('i', $uids);
		$stmtu->execute();
		$resultu = $stmtu -> get_result();
		while ($uidsp = $resultu ->fetch_object()) {
		if ($raa == "0"){ $img= "<img src=".DIR_H_IMG."ungel.gif />"; } else { $img= "<img src=".DIR_H_IMG."gel.gif />"; }
		echo '<tr>';
		echo '<td class="textbox" width="50px">'.$img.'</td>';
		echo '<td class="textbox" >'.$uidsp->login.'</td>';
		$pm = $uds->pmbetr;
		if ($pm == "") { $pm = "Kein Betreff"; }
		echo '<td class="textbox" width="700px"><a href="./index.php?site=pmz&user='.$id.'&pm='.$uds->id.'">'.$pm.'</a></td>';
		echo '<td class="textbox" width="50px"><input id="del" name="del[]" type="checkbox" value="'.$uds->id.'"></td>';
		echo '</tr>';
	}
	}
	$stmt->close();
	$stmtu->close();
}
?>
</table>
<table>
<tr>
<td><input name="pmdel" class="argbut" type="submit" value="Löschen"></td>
<td><input type="button" class="argbut" value=" alle auswählen "onClick="this.value=check(this.form.del)"></td>
</tr>
</table>
</form>
<?
exit;
	}
	if ($_REQUEST['pmdel']) {
	$delna= $_POST['del'];
	if (isset($_POST['del'])) {
		foreach($delna as $value) {
			$stmt = $mysqli->prepare ("DELETE FROM ".PMA." WHERE id= ? ");
			$stmt->bind_param('i', $value);
			$stmt->execute();
			if($stmt->errno) 
			{ 
                trigger_error(' Fehlermeldung: '.$stmt->error,E_USER_ERROR); 
                return false; 
			}
			if ($stmt->affected_rows ==1)
	{
		$ret = "<tr><td class=\"failure\">Nachricht/en wurden erfolgreich gelöscht</td></tr>";
		echo'<meta http-equiv="refresh" content="2; URL=./index.php?site=pm&user='.$id.'">';
	} else {
		$ret = "<tr><td class=\"failure\">Nachricht/en konnten nicht gelöscht werden</td></tr>";
	}
	echo $ret;
		}
	}
	}
?>
<form method="post" action="<? $_SERVER['PHP_SELF'] ?>">
<table>
<tr>
<input type="hidden" value="<? echo $id ?>" id="pmid"  />
<td><? echo '<input id="anony" class="buttonpnn argbut" type="button" value="Neu" onclick="document.getElementById(\'userid\').value=\''.$id.'\'; "/>'; ?></td>
<td><input name="pmpap" class="argbut" type="submit" value="Papierkorb"></td>
<td><input name="pmvers" class="argbut" type="submit" value="Versendet"></td>
</tr>
</table>
<table class="outer-border" id="main">
<tr>
<td class="table-body"><? echo $locate ['455'] ?></td>
<td class="table-body"><? echo $locate ['456'] ?></td>
<td class="table-body"><? echo $locate ['457'] ?></td>
<td class="table-body"><? echo $locate ['458'] ?></td>
</tr>
<?
$delpm= "0";
$stmt = $mysqli->prepare("SELECT id, pmbetr, pm, uids, readma FROM ".PMA." WHERE uid = ? AND del = ?");
$stmt -> bind_param('ii', $id, $delpm);
$stmt -> execute();
$result = $stmt -> get_result();
	while ($uid = $result->fetch_object()) {
		$uids = $uid ->uids;
		$raa = $uid ->readma;
		if ($stmtu = $mysqli->prepare("SELECT ".LO.", id FROM ".U." WHERE id = ? ")){
		$stmtu->bind_param('i', $uids);
		$stmtu->execute();
		$resultu = $stmtu -> get_result();
		while ($uidsp = $resultu ->fetch_object()) {
		if ($raa == "0"){ $img= "<img src=".DIR_H_IMG."ungel.gif />"; } else { $img= "<img src=".DIR_H_IMG."gel.gif />"; }
		echo '<tr>';
		echo '<td class="textbox" width="50px">'.$img.'</td>';
		echo '<td class="textbox" ><a href= "./index.php?site=prof&user='.$uidsp->id.'">'.$uidsp->login.'</td>';
		$pm = $uid->pmbetr;
		if ($pm == "") { $pm = "Kein Betreff"; }
		echo '<td class="textbox" width="700px"><a href="./index.php?site=pmz&user='.$id.'&pm='.$uid->id.'">'.$pm.'</a></td>';
		echo '<td class="textbox" width="50px"><input id="del" name="del[]" type="checkbox" value="'.$uid->id.'"></td>';
		echo '</tr>';
	}
		}
	$stmt->close();
	$stmtu->close();
	}
?>
</table>
<table>
<tr>
<td><input type="button" class="argbut" value=" alle auswählen "onClick="this.value=check(this.form.del)"></td>
<td><input name="pmdelet" class="argbut" type="submit" value="Löschen"></td><td><input name="pmgel" class="argbut" type="submit" value="Gelesen"></td><td><input name="pmungel" class="argbut" type="submit" value="Ungelesen"></td>
</tr>
</table>
</form>
<? 
if ($_REQUEST['pmdelet']) {
	$delpma = "1";
	$delna = $_POST['del'];
	if (isset($_POST['del'])) {
		foreach($delna as $value){
		$stmt = $mysqli->prepare ("UPDATE ".PMA." SET del= ? WHERE id= ?");
		$stmt->bind_param('ii', $delpma, $value);
		$stmt->execute();
		if($stmt->errno) 
			{ 
                trigger_error(' Fehlermeldung: '.$stmt->error,E_USER_ERROR); 
                return false; 
			}
			if ($stmt->affected_rows ==1)
	{
		$ret = "<tr><td class=\"failure\">Nachricht/en wurden in den Papierkorb verschoben</td></tr>";
		echo'<meta http-equiv="refresh" content="2; URL=./index.php?site=pm&user='.$id.'">';
	} else {
		$ret = "<tr><td class=\"failure\">Nachricht/en konnten nicht verschoben werden</td></tr>";
	}
	echo $ret;
		}
	}
	}
if ($_REQUEST['pmgel']) {
	$delpma= "1";
	$delna= $_POST['del'];
	if (isset($_POST['del'])) {
		foreach($delna as $value) {
			$stmt = $mysqli->prepare ("UPDATE ".PMA." SET readma= ? WHERE id= ? ");
			$stmt->bind_param('ii', $delpma, $value);
			$stmt->execute();
			if($stmt->errno) 
			{ 
                trigger_error(' Fehlermeldung: '.$stmt->error,E_USER_ERROR); 
                return false; 
			}
			if ($stmt->affected_rows ==1)
	{
		$ret = "<tr><td class=\"failure\">Nachricht/en wurden als Gelesen makiert</td></tr>";
		echo'<meta http-equiv="refresh" content="2; URL=./index.php?site=pm&user='.$id.'">';
	} else {
		$ret = "<tr><td class=\"failure\">Nachricht/en konnten nicht als Gelesen Makiert werden</td></tr>";
	}
	echo $ret;
		}
	}
	}
if ($_REQUEST['pmungel']) {
	$delpma= "0";
	$delna= $_POST['del'];
	if (isset($_POST['del'])) {
		foreach($delna as $value) {
			$stmt = $mysqli->prepare ("UPDATE ".PMA." SET readma= ? WHERE id= ? ");
			$stmt->bind_param('ii', $delpma, $value);
			$stmt->execute();
			if($stmt->errno) 
			{ 
                trigger_error(' Fehlermeldung: '.$stmt->error,E_USER_ERROR); 
                return false; 
			}
			if ($stmt->affected_rows ==1)
	{
		$ret = "<tr><td class=\"failure\">Nachricht/en wurden als Ungelesen makiert</td></tr>";
		echo'<meta http-equiv="refresh" content="2; URL=./index.php?site=pm&user='.$id.'">';
	} else {
		$ret = "<tr><td class=\"failure\">Nachricht/en konnten nicht als Ungelesen makiert werden</td></tr>";
	}
	echo $ret;
		}
	}
	}
} else {
    echo'<meta http-equiv="refresh" content="0; URL=./index.php?error=2">';
}