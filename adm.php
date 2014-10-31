<?php
if (login_check($mysqli) == true) {
    if ($_SESSION['usr'] != "0") {
        echo '<tr><td class="failure">Du bist kein Admin, RAUS!!!</td></tr>';
        exit;
    }
    echo '<ul><li><a href="./index.php?site=adusr">Userliste</a></li></ul>';
} else {
    header('Location: ./index.php?error=2');
}
?>