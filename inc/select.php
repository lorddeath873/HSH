<?php
    
include ("data.inc.php");
$array['0'] =  'Anzeigen';
$array['1'] =  'Verborgen';

$firstDay = time () - 31536000;
$lastDay = time();

while ($firstDay<$lastDay) {
    $curDay = date("d.m.Y", $firstDay);
    $return[$curDay] = $curDay;
    $firstDay = $firstDay + 86400 ;
}
$zeit = mktime(0, 0, 0, 0, 0, 0);
$rechne_zeit = $zeit + 86340;
while ($zeit<=$rechne_zeit) {
    $curtime = date("H:i", $zeit);
    $regtime[$curtime] = $curtime;
    $zeit = $zeit + 1;
}
$stmt = $mysqli->prepare("SELECT city_id, zipcode FROM zipcode ORDER by zipcode ASC");
$stmt->execute();
$stmt->bind_result($cid, $zip);
while ($stmt->fetch()) {
    $cid = "$cid";
    $res[$cid] = $zip;
}

$stmt->close();
