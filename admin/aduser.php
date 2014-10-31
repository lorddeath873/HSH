<?php
if (login_check($mysqli) == true) {
    if ($_SESSION['usr'] != "0") {
        echo '<tr><td class="failure">Du bist kein Admin, RAUS!!!</td></tr>';
        exit;
    }
	$arr = range('A', 'Z');
	echo "<div>";
	echo "<a class=sss href = ./index.php?site=adusr>Alle</a>&nbsp;";
foreach($arr as $zeichen) { 
  echo "<a class=sss href = ./index.php?site=adusr&sort=$zeichen>$zeichen</a>&nbsp;"; 
}  
echo "</div>";
echo "<div align=center>";
if ($_GET['sort'] != "") {
	$top = "Seite:<br>";
}
echo "<span class=sss>".$top.$_GET['sort']."<br></span>";
echo "</div>";
	if ($_GET['sort'] == "") {
		$stmt = $mysqli->prepare("SELECT id, name, vorn, login, street, plz, ort, bundes, email, tel, mob, country, district, usr_grp, ano, geb, mailakt FROM ".U."");
	}else{
		$sort = $_GET['sort'].'%';
		$stmt = $mysqli->prepare("SELECT id, name, vorn, login, street, plz, ort, bundes, email, tel, mob, country, district, usr_grp, ano, geb, mailakt FROM ".U." WHERE name LIKE CONCAT( ?, '%')");
		$stmt->bind_param('s', $sort);
	}
    $stmt->execute();
    $stmt->bind_result($id, $name, $vorn, $login, $street, $plz, $ort, $bundes, $email, $tel, $mob, $country, $district, $usr_grp, $ano, $geb, $mailakt);
    $stmt->store_result();
	    while ($stmt->fetch()) {
		echo '<div class="c1">
		<form action="'.$_SERVER['PHP_SELF'].'?site=adusr&sort='.$_GET['sort'].'" method="post" name="udsrdel" onSubmit="return senden();">';
        echo '<span class="textboxdiv">'.$locate['406'].'</span>
		<input type="hidden" name="id" value="'.$id.'">';
        echo '<span class="table-bodydiv"><input type="hidden" name="name" value="'.$name.'">'.$name.'</span>';
        echo '<span class="textboxdiv">'.$locate['407'].'</span>';
        echo '<span class="table-bodydiv">'.$vorn.'</span>';
        echo '<span class="textboxdiv">'.$locate['421'].'</span>';
        echo '<span class="table-bodydiv">'.$login.'</span>';
        echo '<span class="textboxdiv">'.$locate['414'].'</span>';
        echo '<span class="table-bodydiv">'.$email.'</span>';
        echo '<span class="textboxdiv">'.$locate['422'].'</span>';
        echo '<span class="table-bodydiv">'.$usr_grp.'</span>';
        echo '<span class="textboxdiv">'.$locate['418'].'</span>';
        echo '<span class="table-bodydiv">'.$ano.'</span>';
        echo '<span class="textboxdiv">'.$locate['419'].'</span>';
        echo '<span class="table-bodydiv">'.$geb.'</span>';
        echo '<span class="textboxdiv">'.$locate['423'].'</span>';
        echo '<span class="table-bodydiv">'.$mailakt.'</span>';
		echo '<span class="textboxdiv">'.$locate['461'].'</span>';
		echo '<input type="submit" class="argbut" name="edit" value="Ändern">
		<input type="submit" class="argbut" name="delete" value="Löschen">
		</span></form>';
		echo '</div>';
    }
	$stmt->close();
		if ($_REQUEST['delete']) {
		$id = $_POST['id'];
		$stmt = $mysqli->prepare("DELETE FROM usr WHERE id = ?");
		$stmt->bind_param('i', $id);
		$stmt->execute();
		if ($stmt->affected_rows == 1) {
			echo '<tr><td class="failure">'.$_POST['name'].' erfolgreich gelöscht</td></tr>';
		}else{
			echo '<tr><td class="failure">'.$_POST['name'].' konnte nicht gelöscht werden</td></tr>';
		}
	}
		if ($_REQUEST['edit']) {
		echo "ääääääääääänder";
	}
} else {
    header('Location: ./index.php?error=2');
}
?>

