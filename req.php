<?php
   include (DIR_H_INC."html.php");
if (login_check($mysqli) == true) {
    $id = $_SESSION['user_id'];
    $stmt = $mysqli->prepare("SELECT txt, ano, kontakt, chiff, dat, time, zip, ort, txts, txtse, txwh, land FROM ".CO." WHERE usr_id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($txt, $ano, $kontakt, $chiff, $dat, $time, $zip, $ort, $txts, $txtse, $txwh, $land);
    $stmt->store_result();
	if ($stmt -> affected_rows == "0") {
		echo'<meta http-equiv="refresh" content="0; URL=./index.php?error=5">';
		exit;
	}
    echo '<form name="reqed" method="get" action ="./save.php">';
    echo '<table class="outer-border" id="main">';
    while ($stmt->fetch()) {
	if ($land == "1") { $land="DE";}
	if ($land == "2") { $land="FL";}
	if ($land == "3") { $land="Schweiz";}
	if ($land == "4") { $land="AT";}
        echo '<tr>';
        echo '<td class="textbox">Dein Kontakt</td>';
        echo '</tr><tr>';
        echo '<td class="table-body"><a href=mailto:'.$kontakt.'>'.$kontakt.'</a><input type="button" id="anony" class="button argbut" value="Ändern" onclick="document.getElementById(\'chiff\').value=\''.$chiff.'\'; "/></td>';
        echo '</tr><tr>';
        echo '<td class="textbox">Deine Chiffre</td>';
        echo '</tr><tr>';
        echo '<td class="table-body">'.$chiff.'</td>';
        echo '</tr><tr>';
        echo '<td class="textbox">Wann gesehen? Datum - Uhrzeit?</td>';
        echo '</tr><tr>';
        echo '<td class="table-body">'.$dat.' - '.$time.'<input type="button" id="anony" class="buttondat argbut" value="Ändern" onclick="document.getElementById(\'chiffdat\').value=\''.$chiff.'\'; "/></td>';
        echo '</tr><tr>';
        echo '<td class="textbox">Wo gesehen? PLZ - Ort?</td>';
        echo '</tr><tr>';
        echo '<td class="table-body">'.$land.' - '.$zip.' - '.$ort.'<input type="button" id="anony" class="buttonort argbut" value="Ändern" onclick="document.getElementById(\'chiffort\').value=\''.$chiff.'\'; "/></td>';
        echo '</tr><tr>';
        echo '<td class="textbox">Wo genau?</td>';
        echo '</tr><tr>';
        echo '<td class="table-body">'.$txt.'<input type="button" id="anony" class="buttontxt argbut" value="Ändern" onclick="document.getElementById(\'chifftxt\').value=\''.$chiff.'\'; "/></td>';
        echo '</tr><tr>';
        echo '<td class="textbox">Wie sahst du aus?</td>';
        echo '</tr><tr>';
        echo '<td class="table-body">'.$txts.'<input type="button" id="anony" class="buttonsecond argbut" value="Ändern" onclick="document.getElementById(\'chifftxts\').value=\''.$chiff.'\'; "/></td>';
        echo '</tr><tr>';
        echo '<td class="textbox">Wie sah er aus?</td>';
        echo '</tr><tr>';
        echo '<td class="table-body">'.$txtse.'<input type="button" id="anony" class="buttonthird argbut" value="Ändern" onclick="document.getElementById(\'chifftxtt\').value=\''.$chiff.'\'; "/></td>';
        echo '</tr><tr>';
        echo '<td class="textbox">Was hast du/er/sie gemacht?</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td class="table-body">'.$txwh.'<input type="button" id="anony" class="buttonfour argbut" value="Ändern" onclick="document.getElementById(\'chifftxtf\').value=\''.$chiff.'\'; "/></td>';
        echo '</tr>';
        if ($ano == "1") {
            echo '<tr><td class="failure">Du möchtest anonym sein</td></tr>';
        } else {
            echo '<tr><td class="failure">Deine Kontaktadresse ist sichtbar</td></tr>';
        }
        echo '<tr><td class="table-body"><input type="button" class="buttondel argbut" value="Löschen" onclick="document.getElementById(\'chiffdel\').value=\''.$chiff.'\';"/></td><tr><td><hr class="capmain" /></td></tr>';
    }
    $stmt->close();
    echo '<br><br></table></form>';
} else {
    echo'<meta http-equiv="refresh" content="0; URL=./index.php?error=2">';
}
