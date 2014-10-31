<?
    if(login_check($mysqli) == true) {
 
?>
<form name="erfan" method="post" action="<? $_SERVER['PHP_SELF']; ?>" onsubmit="return checkerfan();">
    <table class='outer-border' id='main'>
        <tr>
            <td class="textbox">Wann gesehen? Datum - Uhrzeit?</td>
            <td class="table-body"><input name="dat" type="text" class="tcal">
            <select name="std">
            <option value="00">00</option>
            <option value="00">00</option>
            <option value="01">01</option>
            <option value="02">02</option>
            <option value="03">03</option>
            <option value="04">04</option>
            <option value="05">05</option>
            <option value="06">06</option>
            <option value="07">07</option>
            <option value="08">08</option>
            <option value="09">09</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
            </select>
            <select name="min">
            <option value="00">00</option>
            <option value="01">01</option>
            <option value="02">02</option>
            <option value="03">03</option>
            <option value="04">04</option>
            <option value="05">05</option>
            <option value="06">06</option>
            <option value="07">07</option>
            <option value="08">08</option>
            <option value="09">09</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
            <option value="24">24</option>
            <option value="25">25</option>
            <option value="26">26</option>
            <option value="27">27</option>
            <option value="28">28</option>
            <option value="29">29</option>
            <option value="30">30</option>
            <option value="31">31</option>
            <option value="32">32</option>
            <option value="33">33</option>
            <option value="34">34</option>
            <option value="35">35</option>
            <option value="36">36</option>
            <option value="37">37</option>
            <option value="38">38</option>
            <option value="39">39</option>
            <option value="40">40</option>
            <option value="41">41</option>
            <option value="42">42</option>
            <option value="43">43</option>
            <option value="44">44</option>
            <option value="45">45</option>
            <option value="46">46</option>
            <option value="47">47</option>
            <option value="48">48</option>
            <option value="49">49</option>
            <option value="50">50</option>
            <option value="51">51</option>
            <option value="52">52</option>
            <option value="53">53</option>
            <option value="54">54</option>
            <option value="55">55</option>
            <option value="56">56</option>
            <option value="57">57</option>
            <option value="58">58</option>
            <option value="59">59</option>
            </select></td>
        </tr>
             <tr>
            <td class="textbox">Wo gesehen? Land</td>
            <td class="table-body">
<select name="drop_1" id="drop_1">
    
      <option value="" selected="selected" disabled="disabled">Bitte wählen</option>
      
      <? spare($mysqli); ?>
    
    </select>
    <span id="wait_1" style="display: none;">
    <img alt="Bitte Warten" src="./template/img/ajax-loader.gif"/>
    </span> 
 
            </td>
            </tr>
                    <tr>
            <td class="textbox">Wo gesehen? Bundesland (Kanton)</td>
            <td class="table-body">
            <span id="result_1" style="display: none;"></span>
                <span id="wait_2" style="display: none;">
    <img alt="Bitte Warten" src="./template/img/ajax-loader.gif"/>
    </span> 
            </td>
            </tr>
        <tr>
            <td class="textbox">Wo gesehen? Ort</td>
            <td class="table-body">
            <span id="result_2" style="display: none;"></span>
            </td>
            </tr>
        <tr>
            <td class="textbox">Wo genau? <br> Detailierte Beschreibung</td>
            <td class="table-body"><textarea name="wg" cols="50" rows="10"></textarea></td>
        </tr>
        <tr>
            <td class="textbox">Wie sahst du aus? <br> Detailierte Beschreibung</td>
            <td class="table-body"><textarea name="ws" cols="50" rows="10"></textarea></td>
        </tr>
        <tr>
            <td class="textbox">Wie sah er aus? <br> Detailierte Beschreibung</td>
            <td class="table-body"><textarea name="wse" cols="50" rows="10"></textarea></td>
        </tr>
        <tr>
            <td class="textbox">Was hast du/er/sie gemacht?  <br> Detailierte Beschreibung</td>
            <td class="table-body"><textarea name="wdes" cols="50" rows="10"></textarea></td>
        </tr>
        <tr>
            <td class="textbox">Ich möchte den Kontakt über NoLimitGerman herstellen lassen!</td>
            <td class="table-body"><input type="checkbox" name="mail" value="1"/></td>
        </tr>
        <tr>
        <td class="table-body"><?php echo file_get_contents("http://www.kostenloses-captcha.de/image.php?ref=".$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']."&rem=".$_SERVER['REMOTE_ADDR']."&format=0&bg=18&csscolor=30addc&cssborder=0e4357&cssfont=000000"); ?></td>
        </tr>
        <tr>
            <td class="table-body"><input type="submit" class="argbut" name="weit" value="Weiter"/></td>
        </tr>
        </table>
    </form>


<?php
if ($_REQUEST['weit']) {
    $ngcvalidation = file_get_contents(str_replace(" ", "", "http://www.kostenloses-captcha.de/validation.php?ngid=".$_POST['ngidtransfer']."&secr=".$_POST['SecR']."&secb=".$_POST['SecB']."&secg=".$_POST['SecG'].""));
if ($ngcvalidation == "false") {
    echo '<tr><td class="failure">'.$locate['424'].'</td></tr>';
    exit;
}

    $id = $_SESSION['user_id'];
    $date = $_POST['dat'];
    $std = $_POST['std'];
    $min = $_POST['min'];
    $drop_l = $_POST['drop_1'];
	$drop_s = $_POST['drop_2'];
	$drop_c = $_POST['drop_3'];
    $wg = $_POST['wg'];
    $ws = $_POST['ws'];
    $wse = $_POST['wse'];
    $wdes = $_POST['wdes'];
    $mail = $_POST['mail'];
    $chiff = uniqid();
    $time = $std.":".$min;
	$stmt = $mysqli->prepare("SELECT zipcode FROM zipcode WHERE city_id = ? LIMIT 1");
	$stmt->bind_param('i', $drop_c);
	$stmt->execute();
	$result = $stmt->get_result();
	while ($zipid = $result->fetch_object()) {
		$zip = $zipid->zipcode;
	}
	echo $mysqli->error;
	$stmt->close();
	$stmt = $mysqli->prepare("SELECT name FROM city WHERE id = ? LIMIT 1");
	$stmt->bind_param('i', $drop_c);
	$stmt->execute();
	$result = $stmt->get_result();
	while ($cid = $result->fetch_object()) {
		$ci = $cid->name;
	}
	echo $mysqli->error;
	$stmt->close();
    if ($mail == "1") {
        $ano = "1";
        $mail = "Verborgen";
    } else {
        $stmt = $mysqli->prepare("SELECT email FROM ".U." WHERE id = ? LIMIT 1");
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $stmt->bind_result($email);
        while ($stmt->fetch()) {
            $mail = $email;
            $ano = "0";
        }
        $stmt->close();
    }
    $stmt = $mysqli->prepare("INSERT INTO ".CO." (usr_id, txt, txts, txtse, txwh, ano, kontakt, chiff, dat, time, ort, zip, state, land) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('ssssssssssssss', $id, $wg, $ws, $wse, $wdes, $ano, $mail, $chiff, $date, $time, $ci, $zip, $drop_s, $drop_l);
    $stmt->execute();
    if ($stmt->insert_id != "0") {
    ?> 
        <meta http-equiv="refresh" content="0; URL=./index.php?site=req&user=<? $_SESSION['user_id'] ?>">
<?
        $stmt->close();
    } else {
        echo ' <div align="center"> <h1>Fehler beim Speichern</h1> </div>';
        $stmt->close();
    }
}
} else {
   echo'<meta http-equiv="refresh" content="0; URL=./index.php?error=2">';
}
?>