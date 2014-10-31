<?php
$lo = $_GET['user'];
$akt = $_GET['mailreg'];
$aktt = '1';
$stmt = $mysqli->prepare("SELECT login, maileeg, mailakt FROM ".U." WHERE login = ? LIMIT 1");
$mysqli->error;
$stmt->bind_param('s', $lo);
$stmt->execute();
$stmt->bind_result($lo, $maileeg, $mailakt);
$stmt->fetch();
$stmt->close();
if ($lo != $_GET['user']) {
    echo '<tr><td class="failure">'.$locate['436'].'</td></tr>';
    exit;
}
if ($maileeg != $_GET['mailreg']) {
    echo '<tr><td class="failure">'.$locate['437'].'</td></tr>';
    exit;
}
if ($mailakt == "1" ) {
    echo '<tr><td class="failure">'.$locate['438'].'</td></tr>';
    exit;
}
$stmt = $mysqli->prepare("UPDATE ".U." SET mailakt= ? WHERE maileeg = ?");
$stmt->bind_param('ss', $aktt, $akt);
$stmt->execute();
$stmt->close();
header('Location: ./index.php?akt=1');

?>

