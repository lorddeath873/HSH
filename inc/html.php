<div id="dialog-formSel" title="Anonym">
<p class="validateTips">Wollen Sie anonym bleiben?</p>
	<form>
		<fieldset>
			<select name="sel" id="sel" class="text ui-widget-content ui-corner-all">
				<option value="0">Nein</option>
				<option value="1">Ja</option>
			</select>
			<input type="hidden" id="chiff" name="chiff" class="text ui-widget-content ui-corner-all" />
		</fieldset>
	</form>
</div>
<!--Datum Uhrzeit -->
<div id="dialog-formdat" title="Datum und Uhrzeit">
  <p class="validateTips">Ändere hier das Datum und die Uhrzeit</p>
	<form>
		<fieldset>
<?php
$firstDay = time () - 31536000;
$lastDay = time();
$set = "00";
$sete = "24";
$min = "00";
$mine = "60";
?>
			<select name="seldat" id="seldat" class="text ui-widget-content ui-corner-all">
<? 
while ($firstDay<$lastDay) {
    $curDay = date("d.m.Y", $firstDay);
    $return[$curDay] = $curDay;
    $firstDay = $firstDay + 86400 ;
    echo '<option value="'.$return[$curDay].'">'.$return[$curDay].'</option>';
}
?>
			</select>
			<select name="seluhr" id="seluhr" class="text ui-widget-content ui-corner-all">
<? 
while ($set<$sete) {
    echo '<option value="'.str_pad($set, 2 ,'0', STR_PAD_LEFT).'">'.str_pad($set, 2 ,'0', STR_PAD_LEFT).'</option>';
    $set ++;
}
?>
			</select>
            <select name="seluhrm" id="seluhrm" class="text ui-widget-content ui-corner-all">
<? 
while ($min<$mine) {
    echo '<option value="'.str_pad($min, 2 ,'0', STR_PAD_LEFT).'">'.str_pad($min, 2 ,'0', STR_PAD_LEFT).'</option>';
    $min ++;
}
?>
			</select>
			<input type="hidden" id="chiffdat" name="chiff" class="text ui-widget-content ui-corner-all" />
		</fieldset>
	</form>
</div>
<!--Ort -->
<div id="dialog-formort" title="Postleitzahl">
  <p class="validateTips">Postleitzahl</p>
<form>
	<fieldset>
		<select name="selort" id="selort" class="text ui-widget-content ui-corner-all">
<?php
$stmtzi = $mysqli -> prepare("SELECT zipcode FROM zipcode ORDER BY zipcode ASC");
$stmtzi -> execute();
$result = $stmtzi->get_result();
while ($zip = $result->fetch_object()) {
	echo '<option value="'.$zip->zipcode.'">'.$zip->zipcode.'</option>';
}
$stmtzi->close();
?>
        </select>
    	<input type="hidden" id="chiffort" name="chiff" class="text ui-widget-content ui-corner-all" />
	</fieldset>
	</form>
</div>
<!--Text1-->
<div id="dialog-formtxt" title="Text">
<p class="validateTips">Text</p>
	<form>
		<fieldset>
			<textarea name="txt" id="txt" class="text ui-widget-content ui-corner-all" cols="50" rows="10"></textarea>
			<input type="hidden" id="chifftxt" name="chifftxt" class="text ui-widget-content ui-corner-all" />
		</fieldset>
	</form>
</div>
<!--Text4-->
<div id="dialog-formtxtf" title="Was wurde gemacht">
<p class="validateTips">Was hast du/er/sie gemacht?</p>
	<form>
		<fieldset>
			<textarea name="txtf" id="txtf" class="text ui-widget-content ui-corner-all" cols="50" rows="10"></textarea>
			<input type="hidden" id="chifftxtf" name="chifftxtf" class="text ui-widget-content ui-corner-all" />
		</fieldset>
	</form>
</div>
<!--Text3-->
<div id="dialog-formtxtt" title="Wie sah er/sie aus">
<p class="validateTips">Wie sah er/sie aus?</p>
	<form>
		<fieldset>
			<textarea name="txtt" id="txtt" class="text ui-widget-content ui-corner-all" cols="50" rows="10"></textarea>
			<input type="hidden" id="chifftxtt" name="chifftxtt" class="text ui-widget-content ui-corner-all" />
		</fieldset>
	</form>
</div>
<!--Text2-->
<div id="dialog-formtxts" title="Wie sahst du aus">
<p class="validateTips">Wie sahst du aus?</p>
	<form>
		<fieldset>
			<textarea name="txts" id="txts" class="text ui-widget-content ui-corner-all" cols="50" rows="10"></textarea>
			<input type="hidden" id="chifftxts" name="chifftxts" class="text ui-widget-content ui-corner-all" />
		</fieldset>
	</form>
</div>
<!--DEL-->
<div id="dialog-formdel" title="Anzeige löschen">
<p class="validateTips">Anzeige löschen</p>
	<form>
		<fieldset>
        
			<input type="hidden" id="chiffdel" name="chiffdel" class="text ui-widget-content ui-corner-all" />
		</fieldset>
	</form>
</div>
<!-- PMN -->
<div id="dialog-formpnn" title="Nachricht schreiben">
<form>
<fieldset>
<label><? echo $locate['459'] ?></label>
<select name="uids" class="text ui-widget-content ui-corner-all" id="uids">
    <?
	$ano= "0";
	$makt= "1";
    $stmt = $mysqli -> prepare("SELECT ".LO.", ".ID." FROM ".U." WHERE ano = ? AND mailakt = ?");
	$stmt->bind_param('ii', $ano, $makt);
	$stmt->execute();
	$result = $stmt -> get_result();
	while ($uids = $result->fetch_object()) {
		echo '<option value="'.$uids->id.'">'.$uids->login.'</option>';
	}
	$stmt->close();
	?></select>
	<label><? echo $locate['460'] ?></label>
    <input name="pmbetr" class="text ui-widget-content ui-corner-all" id="pmbetr" type="text" size="38" maxlength="100">
	<label><? echo $locate['457'] ?></label>
    <textarea name="pmnn" class="text ui-widget-content ui-corner-all" id="pmnn" cols="38" rows="20"></textarea>
    <input type="hidden" name="userid" id="userid" />
    </fieldset>
</form>
</div>