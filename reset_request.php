<?php
require("header.php");
$username_err = "";
$success_failed = "";
$color = "red";
if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
    if ($msg == "empEmail") {
        $username_err = "Email is empty!!";
    } else if ($msg == "invalidEmail")
        $username_err = "please enter a valid email";
    else if ($msg == "success") {
        $success_failed = "Check Your Email";
        $color = "green";
    } else if ($msg == "failed")
        $success_failed = "There Is Some Thing Wrong Please Try Again";
}
if (isset($_GET['error'])) {
    $error = $_GET['error'];
    if ($error == "userNotExist") {
        $success_failed = "This User is not Exist";
    } else if ($error == "noSelector") {
        $success_failed = "something wrong you should try do reset password again";
    } else if ($error == "success") {
        $color = "green";
        $success_failed = "The password is updated successfully";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>

<body>
    <section>
        <div class="sign_up">
            <div class="container">
                <form action="include/reset_request.inc.php" method="POST">
                    <h2>Reset Your Password</h2>
                    <p>An email will send for you with instructions on how to reset your password</p>
                    <div>
                        <input type="text" name="email" placeholder="Username/Email">
                        <span><?php echo $username_err ?></span>
                    </div>
                    <input type="submit" class="submit" value="Reset Password" name="reset_request">
                    <p style="color:<?php echo $color ?> ;"><?php echo $success_failed ?></p>
                </form>
            </div>
        </div>
    </section>
</body>

</html>