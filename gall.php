<?
if (login_check($mysqli) == true) {
	if ($_GET['user'] == $_SESSION['user_id']) { $us = true; } else { $us = false; }
	$id = $_GET['user'];
	
	$stmt = $mysqli->prepare("SELECT picg FROM ".GA." WHERE usr_id = ?");
	$stmt->bind_param('i', $id);
	$stmt->execute();
	$result = $stmt->get_result();
	echo '<div class="highslide-gallery">';
	while ($pic = $result->fetch_array()) {
		?>
        <ul>
	<li>
	<a href="<? echo './usr/'.$id.'/gall/'.$pic['picg'].''?>" class="highslide" 
			onclick="return hs.expand(this, config1 )">
		<img src="<? echo './usr/'.$id.'/gall/'.$pic['picg'].''?>" width="100px" height="100px"  alt=""/>
	</a>
    <br />
    <? if ($us == true) {
    echo '<form method="post" action="./index.php?site=galdel"><input type="submit" value="Löschen" name="galdel"  />';
    echo '<input type="hidden" value="'.$_SESSION['user_id'].'" name="uidgal"  />';
	echo '<input type="hidden" value="'.$pic['picg'].'" name="galpic" /></form>';
    }?>
	</li>
    </ul>
        <?
	}
	echo '<div style="clear:both"></div></div>';
	$stmt->close();
	if ($us == true) {
		?>
        <input type="hidden" value="<? echo $_SESSION['user_id']?>" id="usrid" >
		<input type="file" name="fileElem[]" id="fileElem" multiple="true"
	    accept="image/*" onchange="handleFiles(this.files)">
        

    <div id="auswahl"></div>
	
    <input type="button" onclick="sendFiles();" value="Hochladen">
        <?
	}
	
} else {
   echo'<meta http-equiv="refresh" content="0; URL=./index.php?error=2">';
}