<?php

if ($_REQUEST['okr']) {
    $ngcvalidation = file_get_contents(str_replace(" ", "", "http://www.kostenloses-captcha.de/validation.php?ngid=".$_POST['ngidtransfer']."&secr=".$_POST['SecR']."&secb=".$_POST['SecB']."&secg=".$_POST['SecG'].""));
    if ($ngcvalidation == "false") {
  // Reaktion der Website, falls der Code falsch war
  header('Location: ./index.php?site=reg&error=3');
  exit;
}
    $data_ma =$_POST['ma'];
    $data_pw =$_POST['p'];
    $data_plz =$_POST['plz'];
    $data_geb =$_POST['geb'];
    $data_email =$_POST['email'];
    $data_na =$_POST['na'];
    $data_vna =$_POST['vna'];
    $data_tel =$_POST['tel'];
    $data_mob =$_POST['mob'];
    $data_str =$_POST['str'];
    if (isset($_POST['ano'])) {
        $data_ano =$_POST['ano'];
    } else {
        $data_ano = "0";
    }
    $data_str =$_POST['str'];
    $stmt = $mysqli->prepare("SELECT city_id, district_id, zipcode FROM ".ZIP." WHERE id= ? LIMIT 1");
    $stmt->bind_param('s', $data_plz);
    $stmt->execute();
    $stmt->bind_result($cid, $did, $zid);
    while ($stmt->fetch()) {
        $data_zip = $zid;
        $data_dis = $did;
        $data_ci = $cid;
    }
    $stmt->close();
    $stmt = $mysqli->prepare("SELECT id, county_id, name FROM ".CI." WHERE id= ? LIMIT 1");
    $stmt->bind_param('s', $data_ci);
    $stmt->execute();
    $stmt->bind_result($id, $cid, $name);
    while ($stmt->fetch()) {
        $data_ort = $name;
        $data_id_ort = $id;
        $data_cu = $cid;
    }
    $stmt->close();
    if (!isset($data_dis)) {
        $data_dis = "";
    }
    $stmt = $mysqli->prepare("SELECT id, state_id, name FROM ".CU." WHERE id = ? LIMIT 1");
    $stmt->bind_param('s', $data_cu);
    $stmt->execute();
    $stmt->bind_result($id, $sid, $name);
    while ($stmt->fetch()) {
        $data_county = $name;
        $data_st = $sid;
        $data_id_county = $id;
    }
    $stmt->close();
    $sql = "SELECT * FROM ".ST." WHERE id =".$data_st." LIMIT 1";
    $stmt = $mysqli->prepare("SELECT id, name FROM ".ST." WHERE id = ? LIMIT 1");
    $stmt->bind_param('s', $data_st);
    $stmt->execute();
    $stmt->bind_result($id, $name);
    while ($stmt->fetch()) {
        $data_state = $name;
        $data_id_state = $id;
    }
    if ($data_ano == "1") {
        $data_ano_t="Ja";
    } else {
        $data_ano_t="Nein";
    }
    // The hashed password from the form
    $password = $data_pw;
    // Create a random salt
    $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
    // Create salted password (Careful not to over season)
    $password = hash('sha512', $password.$random_salt);
 
    // Add your insert to database script here.
    // Make sure you use prepared statements!
    $db_dg = '1';
    $mail_eeg = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
    $mail_akt ='0';
    if ($insert_stmt = $mysqli->prepare("INSERT INTO ".U." (name, vorn, login, pw, street, plz, ort, bundes, email, tel, mob, country, district, usr_grp, ano, geb, salt, maileeg, mailakt) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
        $insert_stmt->bind_param('sssssssssssssssssss', $data_na, $data_vna, $data_ma, $password, $data_str, $data_plz, $data_id_ort, $data_id_state, $data_email, $data_tel, $data_mob, $data_id_county, $data_dis, $db_dg, $data_ano, $data_geb, $random_salt, $mail_eeg, $mail_akt);
        // Execute the prepared query.
        $insert_stmt->execute();
        $insert_stmt->close();
        $mailtext = "<html>
<head>
    <title>Hamster sucht Heimtrainer</title>
</head>
 
<body>
 
<h1>Hamster sucht Heimtrainer Aktivierungs Mail</h1>
 
<p>E-Mail Aktivierung</p>
<b>Herzlich Willkommen, $data_vna</b> <br><br>
Hier folgt nun dein Aktivierungslink, um auf unserer Seite : <a href=\"hsh.nolimitgerman.de/index.php\">Hamster sucht Heimtrainer</a> die vollen Funktionen nutzen zu k&ouml;nnen. <br><br>
<br>
Bitte hier klicken: <a href=\"hsh.nolimitgerman.de/index.php?site=mailakt&user=$data_ma&mailreg=$mail_eeg\">Aktivierung</a> <br><br>
Solltes du den Link nicht anklicken k&ouml;nnen, so nutze bitte folgendes:
<ul>
<li> Gehe auf http://hsh.nolimitgerman.de?site=akti </li>
<li> Trage dort unter \"Benutzername\", deinen Registrierten Benutzernamen ein: $data_ma </li>
<li> Trage unter \"Aktivierungscode\" folgenden Code ein: $mail_eeg (Am besten Kopie&Paste) </li>
<li> Dann nur noch Best&auml;tigen und wenn alles richtig ist kann es losgehen :) </li>
</ul>
 
</body>
</html>
";
 
$empfaenger = $data_email; //Mailadresse
$absender   = "hsh@nolimitgerman.de";
$betreff    = "Hamster sucht Heimtrainer Aktivierungs Mail";
 
$header  = "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html; charset=iso-8859-1\r\n";
 
$header .= "From: $absender\r\n";
// $header .= "Cc: $cc\r\n";  // falls an CC gesendet werden soll
$header .= "X-Mailer: PHP ". phpversion();
 
mail( $empfaenger,
      $betreff,
      $mailtext,
      $header);
        ?>
    <div align="center">
    <h1>Aktivierungsmail wurde Versandt! Bitte schaue in dein Postfach</h1>
    </div>
    <div align="center">
    <h1>Deine Daten wurden wie folgt gespeichert!</h1>
    </div>
    <form name="erf" method="post" action="index.php?site=prof">
    <table class='outer-border' id='main'>
        <input type="hidden" name="log" value="<? echo $data_ma; ?>">
        <input type="hidden" name="pww" value="<? echo $password; ?>">	
    <tr>
    <td class="textbox"><? echo $locate ['409']; ?></td>
    <td class="table-body"><? echo $data_ma; ?></td>
    </tr>
    <tr>
    <td class="textbox"><? echo $locate ['411']; ?></td>
    <td class="table-body"><? echo $data_zip; ?></td>
    </tr>
        <tr>
    <td class="textbox"><? echo $locate ['420']; ?></td>
    <td class="table-body"><? echo $data_dis; ?></td>
    </tr>
            <tr>
    <td class="textbox"><? echo $locate ['412']; ?></td>
    <td class="table-body"><? echo $data_ort; ?></td>
    </tr>
            <tr>
    <td class="textbox"><? echo $locate ['417']; ?></td>
    <td class="table-body"><? echo $data_county; ?></td>
    </tr>
            <tr>
    <td class="textbox"><? echo $locate ['413']; ?></td>
    <td class="table-body"><? echo $data_state; ?></td>
    </tr>
    <tr>
    <td class="textbox"><? echo $locate ['419']; ?></td>
    <td class="table-body"><? echo $data_geb; ?></td>
    </tr>
    <tr>
    <td class="textbox"><? echo $locate ['414']; ?></td>
    <td class="table-body"><? echo $data_email; ?></td>
    </tr>
    <tr>
    <td class="textbox"><? echo $locate ['406']; ?></td>
    <td class="table-body"><? echo $data_na; ?></td>
    </tr>
    <tr>
    <td class="textbox"><? echo $locate ['407']; ?></td>
    <td class="table-body"><? echo $data_vna; ?></td>
    </tr>
    <tr>
    <td class="textbox"><? echo $locate ['415']; ?></td>
    <td class="table-body"><? echo $data_tel; ?></td>
    </tr>
    <tr>
    <td class="textbox"><? echo $locate ['416']; ?></td>
    <td class="table-body"><? echo $data_mob; ?></td>
    </tr>
    <tr>
    <td class="textbox"><? echo $locate ['418']; ?></td>
    <td class="table-body"><? echo $data_ano_t; ?></td>
    </tr>
    <tr>
    <td class="textbox"><? echo $locate ['408']; ?></td>
    <td class="table-body"><? echo $data_str; ?></td>
    </tr>
        <tr>
        <td class="table-body"><input type="submit" name="okw" class="argbut" value="Weiter"></td></tr>
    </table>
        </form>
    <?
    }
    }
?>