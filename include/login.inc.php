<?php
if (isset($_POST['login'])) {

    require_once('function.inc.php');
    require_once('db.inc.php');

    $username_email = test_input($_POST['username_email']);
    $pass = test_input($_POST['pass']);

    if ($whoIsEmpty = loginEmpty($username_email, $pass)) {
        header("location: ../login.php?log_in_error=$whoIsEmpty");
        exit();
    } else if (!userExist($connect_db, $username_email) && !emailExist($connect_db, $username_email)) {
        header("location: ../login.php?log_in_error=userNotExist");
        exit();
    } else if (!checkPass($connect_db, $username_email, $pass)) {
        header("location: ../login.php?log_in_error=err_pass");
        exit();
    } else {
        initSession($connect_db, $username_email);
        header("location: ../index.php");
        exit();
    }
} else {
    header("location: ../index.php");
    exit();
}
