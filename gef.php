<?php
if (login_check($mysqli) == true) {
    $stmt = $mysqli->prepare("SELECT kontakt, chiff, dat, time, zip, ort, txt, txts, txtse, txwh, land, ano, usr_id FROM ".CO." ");
    $stmt->execute();
    $stmt->bind_result($konn, $chiff, $dat, $tim, $zip, $ort, $txt, $txts, $txtse, $txwh, $land, $ano, $uid);
    $stmt->store_result();
	if ($stmt -> affected_rows == "0") {
		echo'<meta http-equiv="refresh" content="0; URL=./index.php?error=6">';
		exit;
	}
    echo '<table class="outer-border" id="main">';
    while ($stmt->fetch()) {
        $stmtn = $mysqli->prepare("SELECT login FROM ".U." WHERE id= ?");
        echo $mysqli->error;
        $stmtn->bind_param('s', $uid);
        $stmtn->execute();
        $stmtn->bind_result($login);
        while ($stmtn->fetch()) {
			if ($ano == "1") {
				$li = "Verborgen";
			} else {
				$li = '<a href="./index.php?site=prof&user='.$uid.'">'.$login.'</a>';
			}
            echo '<tr>';
            echo '<td class="textbox">Nutzername</td>';
            echo '</tr><tr>';
            echo '<td class="table-body">'.$li.'</td>';
            echo '</tr>';
            if ($ano == "0") {
				echo '<tr>';
            	echo '<td class="textbox">Dein Kontakt</td>';
            	echo '</tr><tr>';
            	echo '<td class="table-body"><a href=mailto:'.$konn.'>'.$konn.'</a></td>';
            	echo '</tr>';
			}
			echo '<tr>';
            echo '<td class="textbox">Deine Chiffre</td>';
            echo '</tr><tr>';
            echo '<td class="table-body">'.$chiff.'</td>';
            echo '</tr><tr>';
            echo '<td class="textbox">Wann gesehen? Datum - Uhrzeit?</td>';
            echo '</tr><tr>';
	if ($land == "1") { $land="DE";}
	if ($land == "2") { $land="FL";}
	if ($land == "3") { $land="Schweiz";}
	if ($land == "4") { $land="AT";}
            echo '<td class="table-body">'.$dat.' - '.$tim.'</td>';
            echo '</tr><tr>';
            echo '<td class="textbox">Wo gesehen?Ort?</td>';
            echo '</tr><tr>';
            echo '<td class="table-body">'.$land.' - '.$zip.' - '.$ort.'</td>';
            echo '</tr><tr>';
            echo '<td class="textbox">Wo genau?</td>';
            echo '</tr><tr>';
            echo '<td class="table-body">'.$txt.'</td>';
            echo '</tr><tr>';
            echo '<td class="textbox">Wie sahst du aus?</td>';
            echo '</tr><tr>';
            echo '<td class="table-body">'.$txts.'</td>';
            echo '</tr><tr>';
            echo '<td class="textbox">Wie sah er aus?</td>';
            echo '</tr><tr>';
            echo '<td class="table-body">'.$txtse.'</td>';
            echo '</tr><tr>';
            echo '<td class="textbox">Was hast du/er/sie gemacht?</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td class="table-body">'.$txwh.'</td>';
            echo '</tr>';
            if ($ano == "1") {
                echo '<tr><td class="failure">Kontakt möchte Anonym bleiben, wir bitten dich, dass du dich mit der Chiffre: '.$chiff.' bei uns Meldest <a href="mailto:hsh@nolimitgerman.de?subject=Kontakt%20gefunden%20'.$chiff.'">Kontakt</a></td></tr>';
            } else {
                echo '<tr><td class="failure">Die Kontaktadresse ist sichtbar</td></tr>';
            }
            echo '<tr><td><hr class="capmain" /></td></tr>';
        }
    }
    echo '<br><br></table></form>';
    $stmt->close();
    $stmtn->close();
} else {
    echo'<meta http-equiv="refresh" content="0; URL=./index.php?error=2">';
}
