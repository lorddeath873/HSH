<?php
function check_data($nl_sql_check)
{
    $db_erg = mysql_query($nl_sql_check);
    if (!$db_erg) {
        die('Ungültige Abfrage: ' . mysql_error());
    }
    return ($db_erg);
}
