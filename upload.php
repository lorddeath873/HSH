<?php 
if ($_REQUEST['delete']) {
	$id = $_SESSION['user_id'];
	$name = "";
	$stmt = $mysqli->prepare("UPDATE usr SET pic= ? WHERE id= ?");
	$stmt->bind_param("ss", $name, $id);
	$stmt->execute();
	$stmt->close();
	echo '<meta http-equiv="refresh" content="0; URL=./index.php?site=prof&user='.$_SESSION['user_id'].'">';
}
$tempname = $_FILES['File']['tmp_name'];  
$name = $_FILES['File']['name'];  
$type = $_FILES['File']['type'];  


if($type != "image/gif" && $type != "image/jpeg" && $type !="image/png") {  
    $content .= "Nur gif, png und jpeg Dateien dürfen hochgeladen werden.<br>"; 
    $err=1;  

}  
$id = $_SESSION['user_id'];
$dir = "usr/".$id."/";
if (!is_dir($dir)) {
	mkdir($dir);
}
if ($dh = opendir($dir)) {
	while (($file = readdir($dh)) !== false) {
		if ($file!="." AND $file !="..") {
			unlink($dir."$file");
		}
	}
	closedir($dh);
}
if(is_array($_FILES)) {
$file = $_FILES['File']['tmp_name']; 
$source_properties = getimagesize($file);
switch($source_properties[2]){ 

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
$image_type = $source_properties[2]; 
if( $image_type == IMAGETYPE_JPEG ) {   
	$image_resource_id = imagecreatefromjpeg($file);  
	$target_layer = fn_resize($image_resource_id,$source_properties[0],$source_properties[1]);
	imagejpeg($target_layer,$dir.$name);
}
elseif( $image_type == IMAGETYPE_GIF )  {  
	$image_resource_id = imagecreatefromgif($file);
	$target_layer = fn_resize($image_resource_id,$source_properties[0],$source_properties[1]);
	imagegif($target_layer,$dir.$name);
}
elseif( $image_type == IMAGETYPE_PNG ) {
	$image_resource_id = imagecreatefrompng($file); 
	$target_layer = fn_resize($image_resource_id,$source_properties[0],$source_properties[1]);
	imagepng($target_layer,$dir.$name);
}
}
function fn_resize($image_resource_id,$width,$height) {
	$target_width =150;
	$target_height =150;
	$target_layer=imagecreatetruecolor($target_width,$target_height);
	imagecopyresampled($target_layer,$image_resource_id,0,0,0,0,$target_width,$target_height, $width,$height);
	return $target_layer;
}
$stmt = $mysqli->prepare("UPDATE usr SET pic= ? WHERE id= ?");
$stmt->bind_param("ss", $name, $id);
$stmt->execute();
$stmt->close();
echo '<meta http-equiv="refresh" content="0; URL=./index.php?site=prof&user='.$_SESSION['user_id'].'">';
?>