<form action="<? $_SERVER['PHP_SELF'] ?>" method="post" name="login_form">
    <table class="outer-border">
        <tr>
    <td class="textbox">Benutzername:</td>
    <td class="table-body"><input type="text" name="login" /></td>
            </tr><tr>
    <td class="textbox">Password:</td>
    <td class="table-body"><input type="password" name="p" id="password"/></td>
        </tr><tr>
    <td class="table-body"><input type="button" class="argbut" value="Login" onclick="formhash(this.form, this.form.password);" /></td></tr>
        </table>
</form>
<?php
    if (isset($_POST['login'], $_POST['p'])) {
    $lo = $_POST['login'];
    $password = $_POST['p'];
    if (login($lo, $password, $mysqli) == true) {
        echo'<meta http-equiv="refresh" content="0; URL=./index.php?site=prof&user='.$_SESSION['user_id'].'">';
    } else {

    }
}
?>