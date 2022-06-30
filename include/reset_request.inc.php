<?php
if (isset($_POST['reset_request'])) {
    require("function.inc.php");
    require("db.inc.php");
    $email = test_input($_POST['email']);
    if ($emp = emptyEmail($email)) {
        header("location: ../reset_request.php?msg=$emp");
        exit();
    } elseif (invalidEmail($email)) {
        header("location: ../reset_request.php?msg=invalidEmail");
        exit();
    }
    $selector = bin2hex(random_bytes(8));
    $token = random_bytes(32);
    $url = "http://localhost:8080/php_projects/login_system/include/reset_password.inc.php?selector=$selector&validator=" . bin2hex($token);
    $expireTime = time() + 1200;
    rmToken($connect_db, $email);
    addToken($connect_db, $email, $selector, $token, $expireTime);
    $connect_db = null;
    $subject = "Reset The Password For Mohammed Alijl Website";
    $message = "<p>Here is your reset password email:</p>\r\n $url\r\n <p>if you did'nt made this request just ignore it please</p>";
    $headers = "From: Mohammed Alijl <moh.wa.2035@gmail.com>\r\n";
    $headers .= "Replay-To: moh.wa.2035@gmail.com\r\n";
    $headers .= "Content-type: text/html\r\n";
    if (mail($email, $subject, $message, $headers))
        header("location: ../reset_request.php?msg=success");
    else
        header("location: ../reset_request.php?msg=failed");
} else {
    header("location: ../index.php");
}
