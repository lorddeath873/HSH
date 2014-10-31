<?php
if ($_REQUEST['okw']) {
    $log = $_POST['log'];
    $pww = $_POST['pww'];
    $stmt = $mysqli->prepare("SELECT id, usr_grp, ano FROM ".U." WHERE login = ? AND ".PW."= ? LIMIT 1");
    $stmt->bind_param('ss', $log, $pww);
    $stmt->execute();
    $stmt->bind_result($id, $usr_grp, $ano);
    while ($stmt->fetch()) {
        $usls[]= $id;
        $usls[]= $usr_grp;
        $usls[]= $ano;
        $stmt->close();
    }
    $_SESSION['user_id'] = $usls[0];
    $_SESSION['usr_grp'] = $usls[1];
    $_SESSION['ano'] = $usls[2];
    $_SESSION['php'] = session_id();
    echo "<script language='javascript'>";
    echo "window.location.href=\"index.php?site=prof&user=".$_SESSION['user_id']."&PHPSESSID=".$_SESSION['php']."\"";
    echo "</script>";
}
if (login_check($mysqli) == true) {
 
    $id = $_GET['user'];
$stmt = $mysqli->prepare("SELECT name, vorn, street, plz, ort, district, country, bundes, geb, email, tel, mob, ano, pic FROM ".U." WHERE id = ?");
$stmt->bind_param('s', $id);
$stmt->execute();
$stmt->bind_result($name, $vorn, $street, $plz, $ort, $district, $country, $bundes, $geb, $email, $tel, $mob, $ano, $pic);

    while ($stmt->fetch()) {
        $usr[] = $name;
        $usr[] = $vorn;
        $usr[]= $street;
        $usr[]= $plz;
        $usr[]= $ort;
        $usr[]= $district;
        $usr[]= $country;
        $usr[]= $bundes;
        $usr[]= $geb;
        $usr[]= $email;
        $usr[]= $tel;
        $usr[]= $mob;
        $usr[]= $ano;
		$usr[]= $pic;
    }
$stmt->close();
?>
<div id="profi">
<table>
    <tr>
    <td class="textbox"><? echo $locate ['407'] ?></td>
    <td class="table-body"><? echo $usr[1] ?></td>
    </tr>
    <tr>
    <td class="textbox"><? echo $locate ['406'] ?></td>
    <td class="table-body"><? echo $usr[0] ?></td>
    </tr>
    <tr>
    <td class="textbox"><? echo $locate ['408'] ?></td>
    <td class="table-body"><? echo $usr[2] ?></td>
    </tr>
    <tr>
    <td class="textbox"><? echo $locate ['411'] ?></td>
    <?php 
$zipid = $usr[3];
$stmt = $mysqli->prepare("SELECT zipcode FROM ".ZIP." WHERE id = ?");
$stmt->bind_param('s', $zipid);
$stmt->execute();
$stmt->bind_result($zip);
while ($stmt->fetch()) {
    echo '<td class="table-body">'.$zip.'</td>';
}
$stmt->close();
        ?>
    </tr>
    <tr>
    <td class="textbox"><? echo $locate ['412'] ?></td>
    <?php 
$cid = $usr[4];
$stmt = $mysqli->prepare("SELECT name FROM ".CI." WHERE id = ?");
$stmt->bind_param('s', $cid);
$stmt->execute();
$stmt->bind_result($cit);
while ($stmt->fetch()) {
    echo '<td class="table-body">'.$cit.'</td>';
}
$stmt->close();
        ?>
    </tr>
    <tr>
    <td class="textbox"><? echo $locate ['420'] ?></td>
    <?php 
if ($usr[5] > 0 ) {
    $did = $usr[5];
    $stmt = $mysqli->prepare("SELECT name FROM ".DI." WHERE id = ?");
    $stmt->bind_param('s', $did);
    $stmt->execute();
    $stmt->bind_result($dit);
    while ($stmt->fetch()) {
        echo '<td class="table-body">'.$dit.'</td>';
    }
    $stmt->close();
} else {
    echo '<td class="table-body">Kein Bezirk</td>';
}
        ?>
    </tr>
    <tr>
    <td class="textbox"><? echo $locate ['417'] ?></td>
    <?php
    $cu = $usr[6];
    $stmt = $mysqli->prepare("SELECT name FROM ".CU." WHERE id = ?");
    $stmt->bind_param('s', $cu);
    $stmt->execute();
    $stmt->bind_result($cu);
    while ($stmt->fetch()) {
    echo '<td class="table-body">'.$cu.'</td>';
}
$stmt->close();
        ?>
    </tr>
    <tr>
    <td class="textbox"><? echo $locate ['413'] ?></td>
    <?php
    $st = $usr[7];
    $stmt = $mysqli->prepare("SELECT name FROM ".ST." WHERE id = ?");
    $stmt->bind_param('s', $st);
    $stmt->execute();
    $stmt->bind_result($st);
    while ($stmt->fetch()) {
    echo '<td class="table-body">'.$st.'</td>';
}
$stmt->close();
        ?>
    </tr>
    <tr>
    <td class="textbox"><? echo $locate ['419'] ?></td>
    <td class="table-body"><? echo $usr[8] ?></td>
    </tr>
    <tr>
    <td class="textbox"><? echo $locate ['414'] ?></td>
    <td class="table-body"><a href=mailto:<? echo $usr[9] ?>><? echo $usr[9] ?></a></td>
    </tr>
    <tr>
    <td class="textbox"><? echo $locate ['415'] ?></td>
    <td class="table-body"><? echo $usr[10] ?></td>
    </tr>
    <tr>
    <td class="textbox"><? echo $locate ['416'] ?></td>
    <td class="table-body"><? echo $usr[11] ?></td>
    </tr>
    <tr>
    <td class="textbox"><? echo $locate ['418'] ?></td>
    <? 
 if ($usr[12] == "0") {
     $anony = "Nein";
 } else {
     $anony = "Ja";
 }?>
    <td class="table-body"><? echo $anony ?></td>
    </tr>
  </table>
</div>
    <div id="img">
    <?
	if (empty($usr[13])) 
	{
		echo '<img src="'.USRIMG.'noavatar150.png" alt="Userbild" width="150" height="150" />';
	} else {
     echo '<img src="'.USRIMG.$id.'/'.$usr[13].'" alt="Userbild" width="150" height="150" />';
	}
	?>
    </div>
    <div id="con">
    <div id="upload">
    <form action="./index.php?site=upload" method="post" enctype="multipart/form-data" name="gally">
<input type="file" name="File" /><br>
<input type="submit" class="argbut" value="Hochladen" />
<input type="submit" class="argbut" value="Löschen" name="delete" /><br /><br />
<input type="hidden" value="<? echo $_GET['user']; ?>" id="getid"  />
<input type="button" class="argbut" value="Gallery" onclick="fenster();return false;" />
</form>
    </div>
    </form>
        <div id="stat">
<? 
	$stmt = $mysqli->prepare("SELECT usr_id FROM ".CO." WHERE usr_id = ?");
	$stmt->bind_param('i', $id);
	$stmt->execute();
	$stmt->store_result();
	$row_cnt = $stmt->num_rows;
	$stmt->close();
	$stmt = $mysqli->prepare("SELECT usr_id FROM ".GA." WHERE usr_id = ?");
	$stmt->bind_param('i', $id);
	$stmt->execute();
	$stmt->store_result();
	$row_cntg = $stmt->num_rows;
	$stmt->close();
?>
<table>
    <tr>
    <td class="textbox"><? echo $locate ['451'] ?></td>
    <td class="table-body"><? printf($row_cnt); ?></td>
    </tr>
	<tr>
    <td class="textbox"><? echo $locate ['452'] ?></td>
    <td class="table-body"><? printf($row_cntg); ?></td>
    </tr>
</table>
    </div>
    </div>
<?
    } else {
   echo'<meta http-equiv="refresh" content="0; URL=./index.php?error=2">';
}
