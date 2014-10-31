<?php
function sec_session_start()
{
        $session_name = 'sec_session_id'; // Set a custom session name
        $secure = false; // Set to true if using https.
        $httponly = true; // This stops javascript being able to access the session id.
 
        ini_set('session.use_only_cookies', 1); // Forces sessions to only use cookies.
        $cookieParams = session_get_cookie_params(); // Gets current cookies params.
        session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
        session_name($session_name); // Sets the session name to the one set above.
        session_start(); // Start the php session
        session_regenerate_id(); // regenerated the session, delete the old one.
}

function login($email, $password, $mysqli)
{
    // Using prepared Statements means that SQL injection is not possible.
    if ($stmt = $mysqli->prepare("SELECT id, login, usr_grp, pw, salt, mailakt FROM usr WHERE login = ? LIMIT 1")) {
        $stmt->bind_param('s', $email); // Bind "$email" to parameter.
        $stmt->execute(); // Execute the prepared query.
        $stmt->store_result();
        $stmt->bind_result($user_id, $username, $usr, $db_password, $salt, $mali ); // get variables from result.
        $stmt->fetch();
        $password = hash('sha512', $password.$salt); // hash the password with the unique salt.
 
        if ($stmt->num_rows == 1) { // If the user exists
            // We check if the account is locked from too many login attempts
            if (checkbrute($user_id, $mysqli) == true) {
                echo '<tr><td class="failure">Dein Account wurde gesperrt, bitte wende dich an den <a href="support.nolimitgerman.de">Support</a></td></tr>';
                // Account is locked
                // Send an email to user saying their account is locked
                return false;
            } else {
                if ($db_password == $password) { // Check if the password in the database matches the password the user submitted.
                    // Password is correct!
 
                    if ($mali == "0") {
                        echo '<tr><td class="failure">Deine E-Mail wurde noch nicht Aktiviert</td></tr>';
                        return false;
                    }
                    $stmtl = $mysqli->prepare("SELECT locked FROM locked WHERE user_id = ?");
                    $stmtl->bind_param('i', $user_id);
                    $stmtl->execute();
                    $stmtl->bind_result($lock);
                    $stmtl->fetch();
                    if ($lock =="1") {
                        echo '<tr><td class="failure">Dein Account wurde gesperrt, bitte wende dich an den <a href="support.nolimitgerman.de">Support</a></td></tr>';
                        return false;
                        $stmtl->close();
                    }
                    $stmtl->close();
                    $user_browser = $_SERVER['HTTP_USER_AGENT']; // Get the user-agent string of the user.
 
                    $user_id = preg_replace("/[^0-9]+/", "", $user_id); // XSS protection as we might print this value
                    $_SESSION['user_id'] = $user_id;
                    $usr = preg_replace("/[^0-9]+/", "", $usr);
                    $_SESSION['usr'] = $usr;
                    $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username); // XSS protection as we might print this value
                    $_SESSION['username'] = $username;
                    $_SESSION['login_string'] = hash('sha512', $password.$user_browser);
                    // Login successful.
                    return true;
                } else {
                    // Password is not correct
                    // We record this attempt in the database
                    $now = time();
                    $mysqli->query("INSERT INTO login_attempts (user_id, time) VALUES ('$user_id', '$now')");
                    echo '<tr><td class="failure">Dein Passwort ist falsch</td></tr>';
                    return false;
                }
            }
        } else {
            echo '<tr><td class="failure">Dich gibt es nicht, Sorry</td></tr>';
            return false;
        }
    }
}

function checkbrute($user_id, $mysqli)
{
    // Get timestamp of current time
    $now = time();
    // All login attempts are counted from the past 2 hours.
    $valid_attempts = $now - (2 * 60 * 60);
 
    if ($stmt = $mysqli->prepare("SELECT time FROM login_attempts WHERE user_id = ? AND time > '$valid_attempts'")) {
        $stmt->bind_param('i', $user_id);
        // Execute the prepared query.
        $stmt->execute();
        $stmt->store_result();
        // If there has been more than 5 failed logins
        if ($stmt->num_rows > 5) {
            return true;
        } else {
            return false;
        }
    }
}

function login_check($mysqli)
{
    // Check if all session variables are set
    if (isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];
        $username = $_SESSION['username'];
 
        $user_browser = $_SERVER['HTTP_USER_AGENT']; // Get the user-agent string of the user.
 
        if ($stmt = $mysqli->prepare("SELECT pw FROM usr WHERE id = ? LIMIT 1")) {
            $stmt->bind_param('i', $user_id); // Bind "$user_id" to parameter.
            $stmt->execute(); // Execute the prepared query.
            $stmt->store_result();
 
            if ($stmt->num_rows == 1) { // If the user exists
                $stmt->bind_result($password); // get variables from result.
                $stmt->fetch();
                $login_check = hash('sha512', $password.$user_browser);
                if ($login_check == $login_string) {
                    // Logged In!!!!
                    return true;
                } else {
                    // Not logged in
                    return false;
                }
            } else {
                // Not logged in
                return false;
            }
        } else {
            // Not logged in
            return false;
        }
    } else {
        // Not logged in
        return false;
    }
}
function stmt_bind_assoc (&$stmt, &$out)
{
    $data = mysqli_stmt_result_metadata($stmt);
    $fields = array();
    $out = array();

    $fields[0] = $stmt;
    $count = 1;

    while($field = mysqli_fetch_field($data))
    {
        $fields[$count] = &$out[$field->name];
        $count++;
    }    
    call_user_func_array(mysqli_stmt_bind_result, $fields);
}

function spare($mysqli)
{
	$stmt = $mysqli->prepare("SELECT id, land FROM land ORDER BY land ASC");
	$stmt->execute();
	$result = $stmt->get_result();

	  while($ll = $result->fetch_array()) 
  
		{
		   echo '<option value="'.$ll['id'].'">'.$ll['land'].'</option>';
		}
		$stmt->close();

}

//**************************************
//     First selection results     //
//**************************************
if($_GET['func'] == "drop_1" && isset($_GET['func'])) { 
   drop_1($_GET['drop_var']); 
}

function drop_1($drop_var)
{ 
include_once ('../inc/data.inc.php');
	$stmt = $mysqli->prepare("SELECT id, name FROM state WHERE land_id= ? ORDER BY name ASC"); 
	$stmt->bind_param('i',$drop_var);
	$stmt->execute();
	$result = $stmt->get_result();
	
	echo '<select name="drop_2" id="drop_2">
	      <option value=" " disabled="disabled" selected="selected">Bitte wählen</option>';

		   while($drop_2 = $result->fetch_array()) 
			{
			  echo '<option value="'.$drop_2['id'].'">'.$drop_2['name'].'</option>';
			}
	
	echo '</select> ';
	echo "<script type=\"text/javascript\">
$('#wait_2').hide();
	$('#drop_2').change(function(){
	  $('#wait_2').show();
	  $('#result_2').hide();
      $.get(\"./funktion/func.php\", {
		func: \"drop_2\",
		drop_var: $('#drop_2').val()
      }, function(response){
        $('#result_2').fadeOut();
        setTimeout(\"finishAjax_tier_three('result_2', '\"+escape(response)+\"')\", 400);
      });
    	return false;
	});
</script>";
$stmt->close();

}
if($_GET['func'] == "drop_2" && isset($_GET['func'])) { 
   drop_2($_GET['drop_var']); 
}

function drop_2($drop_var)
{  
include_once ('../inc/data.inc.php');
	$stmt = $mysqli->prepare("SELECT id, name FROM city WHERE state_id= ? ORDER BY name ASC"); 
	$stmt->bind_param('i',$drop_var);
	$stmt->execute();
	$result = $stmt->get_result();
	
	echo '<select name="drop_3" id="drop_3">
	      <option value=" " disabled="disabled" selected="selected">Bitte wählen</option>';

		   while($drop_3 = $result->fetch_array()) 
			{
			  echo '<option value="'.$drop_3['id'].'">'.$drop_3['name'].'</option>';
			}
	
	echo '</select> ';
}
?>