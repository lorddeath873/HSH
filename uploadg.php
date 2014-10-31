<?php
if ($_REQUEST['galdel']) {
	$id = $_POST['uidgal'];
	$pic = $_POST['galpic'];
	$stmt = $mysqli->prepare("DELETE FROM ".GA." WHERE usr_id= ? AND picg= ?");
	$stmt->bind_param('is', $id, $pic);
	$stmt->execute();
	$num = $stmt->affected_rows;
	if ($num >0) {
		echo'<meta http-equiv="refresh" content="0; URL=./index.php?site=gall&user='.$id.'&er=1">';
	} else {
		echo'<meta http-equiv="refresh" content="0; URL=./index.php?site=gall&user='.$id.'&er=2">';
	}
	$stmt->close();
	$dat="./usr/".$id."/gall/".$pic;
	unlink($dat);
	exit;
}


$tempname = $_FILES['File']['tmp_name'];  
$name = $_FILES['File']['name'];  
$type = $_FILES['File']['type'];  


if($type != "image/gif" && $type != "image/jpeg" && $type !="image/png") {  
    $content .= "Nur gif, png und jpeg Dateien dürfen hochgeladen werden.<br>"; 
    $err=1;  

}  


$original_name = $name; 


$imgtype =getimagesize($tempname); 


switch($imgtype[2]){ 

case "1": 
    $endung = "gif"; 
    $uniqid = uniqid(); 
    $name = $uniqid.".gif"; 
    break; 

case "2": 
     
    $endung = "jpg"; 
    $uniqid = uniqid(); 
    $name = $uniqid.".jpg"; 
    break; 

case "3": 
    $endung = "png"; 
    $uniqid = uniqid(); 
    $name = $uniqid.".png"; 
    break; 

}  


if(empty($err)) {  

$id = $_POST['id'];
$dir = "usr/".$id."/gall/";
if (!is_dir($dir)) {
	mkdir($dir);
}
$ziel = $dir.$name;
include ('inc/data.inc.php');
	$stmt = $mysqli->prepare("INSERT INTO gall (usr_id, picg) VALUES (?,?)");
	$stmt->bind_param('is', $id, $name);
	$stmt->execute();
	$stmt->close();


move_uploaded_file  ( $tempname  , $ziel ); 
$content .= "Upload erfolgreich"; 

} 

echo $content;
echo'<meta http-equiv="refresh" content="0; URL=./index.php?site=gall&user='.$id.'">'; 
?>