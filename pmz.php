<?
if (login_check($mysqli) == true) {
	if ($_GET['user'] == $_SESSION['user_id']) {
		$id = $_SESSION['user_id'];
	} else {
		echo "Hab dich erwischt!!";
		exit;
	}
	$id = $_SESSION['user_id'];
	$pmid= $_GET['pm'];
	$stmt = $mysqli -> prepare('SELECT pmbetr, pm FROM '.PMA.' WHERE id = ? LIMIT 1');
	$stmt -> bind_param('i', $pmid);
	$stmt -> execute();
	$result = $stmt -> get_result();
	while ($pm = $result -> fetch_object()) {
	?>

    <table>
    <tr>
    <td class="table-body"> Betreff </td>
    <td class="textbox"><? echo $pm->pmbetr ?></td>
    </tr>
    <tr>
    <td class="table-body"> Nachricht </td>
    <td class="textbox"><div class="pmnew"><? echo $pm->pm ?></div></td>
    </tr>
    <tr>
    <td><input type="button" class="argbut" value="Zurück" onclick="history.back();"/></td>
    </tr>
    </table>
    <?
	}
	$stmt -> close();
	$read = "1";
	$stmt = $mysqli -> prepare('UPDATE '.PMA.' SET readma = ? WHERE id = ? LIMIT 1');
	$stmt -> bind_param('ii', $read, $pmid);
	$stmt -> execute();
	$stmt -> close();
	} else {
    echo'<meta http-equiv="refresh" content="0; URL=./index.php?error=2">';
}