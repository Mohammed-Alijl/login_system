<?php
require("header.php");
$username_err = $email_err = $pass_err = $conf_pass_err = "";
if (isset($_GET['error'])) {
    $error = $_GET['error'];
    if ($error == "empUsername")
        $username_err = "username is empty!!";

    else if ($error == "empUsernameempEmail") {
        $username_err = "username is empty!!";
        $email_err = "email is empty!!";

    } else if ($error == "empUsernameempEmailempPass") {
        $username_err = "username is empty!!";
        $email_err = "email is empty!!";
        $pass_err = "password is empty!!";

    } else if ($error == "empUsernameempEmailempPassempConf_pass") {
        $email_err = "email is empty!!";      
        $username_err = "username is empty!!";
        $pass_err = "password is empty!!";
        $conf_pass_err = "password confirm is empty";

    } else if ($error == "empEmail")
        $email_err = "email is empty!!";

    else if ($error == "empEmailempPass") {
        $email_err = "email is empty!!";
        $pass_err = "password is empty!!";
    } else if ($error == "empEmailempPassempConf_pass") {
        $email_err = "email is empty!!";
        $pass_err = "password is empty!!";
        $conf_pass_err = "password confirm is empty";

    } else if ($error == "empPass")
        $pass_err = "password is empty!!";

    else if ($error == "empPassempConf_pass") {
        $pass_err = "password is empty!!";
        $conf_pass_err = "password confirm is empty";
    } else if ($error == "empConf_pass")
        $conf_pass_err = "password confirm is empty";

    else if ($error == "empUsernameempPassempConf_pass") {
        $username_err = "username is empty!!";
        $pass_err = "password is empty!!";
        $conf_pass_err = "password confirm is empty";

    } else if ($error == "empUsernameempConf_pass") {
        $username_err = "username is empty!!";
        $conf_pass_err = "password confirm is empty";

    } else if ($error == "empUsernameempPass") {
        $username_err = "username is empty!!";
        $pass_err = "password is empty";

    } 

    else if ($error == "userExist")
        $username_err = "sorry, username is already taken";

    else if ($error == "emailExist")
        $email_err = "sorry, email is already taken";
        
    else if ($error == "invalidUsername")
        $username_err = "username should start with latter and greeter than 6 letter";

    else if ($error == "invalidEmail")
        $email_err = "please enter a validate email";
        
    else if ($error == "invalidPass")
        $pass_err = "please enter a validate password";

    else if ($error == "err_conf_pass")
        $conf_pass_err = "not match";

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
                <form action="include/signup.inc.php" method="POST">
                    <h2>Sign up</h2>
                    <div>
                        <input type="text" name="username" placeholder="Username">
                        <span><?php echo $username_err ?></span>
                    </div>
                    <div>
                        <input type="email" name="email" placeholder="Email">
                        <span><?php echo $email_err ?></span>
                    </div>
                    <div>
                        <input type="password" name="pass" id="" placeholder="Password">
                        <span><?php echo $pass_err ?></span>
                    </div>
                    <div>
                        <input type="password" name="conf_pass" id="" placeholder="Confirm Password">
                        <span><?php echo $conf_pass_err ?></span>
                    </div>
                    <input type="submit" value="Sign Up" name="signup" class="submit">
                </form>
            </div>
        </div>
    </section>
</body>

</html>