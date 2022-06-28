<?php

require("header.php");

$username_email_err = $login_pass_err = "";

if (isset($_GET['log_in_error'])) {
    $error = $_GET['log_in_error'];

    if ($error == "empUsername_email")
        $username_email_err = "username or email is empty!!";
    else if ($error == "empPass")
        $login_pass_err = "password is empty!!";
    else if ($error == "empUsername_emailempPass") {
        $username_email_err = "username or email is empty!!";
        $login_pass_err = "password is empty!!";
    } else if ($error == "userNotExist")
        $username_email_err = "This user not exist";
    else if ($error == "err_pass")
        $login_pass_err = "The password is not correct";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/master.css">
    <title>sign up</title>
</head>

<body>
    <section>
        <div class="container">
            <div class="sign_up">
                <form action="include/login.inc.php" method="POST">
                    <h2>Sign up</h2>
                    <div>
                        <input type="text" name="username_email" placeholder="Username / Email">
                        <span><?php echo $username_email_err ?></span>
                    </div>
                    <div>
                        <input type="password" name="pass" id="" placeholder="password">
                        <span><?php echo $login_pass_err ?></span>
                    </div>
                    <input type="submit" value="Sign Up" name="login" class="submit">
                </form>
            </div>
        </div>
    </section>
</body>

</html>