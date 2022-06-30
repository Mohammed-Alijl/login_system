<?php
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['signup'])) {
    require_once("db.inc.php"); //file have connect to database
    require_once("function.inc.php"); //file have function to handel error form

    $username = test_input($_POST['username']);
    $email = test_input($_POST['email']);
    $pass = test_input($_POST['pass']);
    $conf_pass = test_input($_POST['conf_pass']);

    if ($whoEmpty = isEntryEmpty($username, $email, $pass, $conf_pass)) {
        header("location: ../signup.php?error=$whoEmpty");
        exit();
    } elseif (userExist($connect_db, $username)) {
        header("location: ../signup.php?error=userExist");
        exit();
    } elseif (invalidUsername($username)) {
        header("location: ../signup.php?error=invalidUsername");
        exit();
    } elseif (emailExist($connect_db, $email)) {
        header("location: ../signup.php?error=emailExist");
        exit();
    } elseif (invalidEmail($email)) {
        exit();
        header("location: ../signup.php?error=invalidEmail");
        exit();
    } elseif (invalidpass($pass)) {
        header("location: ../signup.php?error=invalidPass");
        exit();
    } elseif (!passMatch($pass, $conf_pass)) {
        header("location: ../signup.php?error=err_conf_pass");
        exit();
    } else {
        createUser($connect_db, $username, $email, $pass);
        initSession($connect_db, $username);
        header("location: ../index.php");
    }
} else {
    header("location: ../index.php");
}
