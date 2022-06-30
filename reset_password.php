<?php
$pass_err = $conf_pass_err = "";
if (isset($_GET['error'])) {
    $error = $_GET['error'];
    if ($error == "empnewPasswordempnconfNewPassword") {
        $pass_err = "password is empty!!";
        $conf_pass_err = "confirm password is empty!!";
    } else if ($error == "empnewPassword")
        $pass_err = "password is empty!!";
    else if ($error == "empnconfNewPassword")
        $conf_pass_err = "confirm password is empty!!";
    else if ($error == "passNotMatch")
        $conf_pass_err = "confirm password is not match with password!!";
}
if (isset($_GET['selector']) && isset($_GET['validator'])) {
    $selector = $_GET['selector'];
    $validator = $_GET['validator'];
    if (empty($selector) || empty($validator)) {
        echo 'you could not validate your email';
    } elseif (ctype_xdigit($selector) === true && ctype_xdigit($validator) === true) {
?>
        <form action="include/reset_password.inc.php" method="POST">
            <input type="hidden" name="selector" value="<?php $selector ?>">
            <input type="hidden" name="validator" value="<?php $validator ?>">
            <div>
                <input type="password" name="newPassword" id="" placeholder="New Password">
                <span><?php echo $pass_err ?></span>
            </div>
            <div>
                <input type="password" name="confNewPassword" id="" placeholder="Confirm New Password">
                <span><?php echo $conf_pass_err ?></span>
            </div>
            <input type="submit" value="Reset Password" name="reset_password">
        </form>
<?php
    }
} else (header("location: ../login.php"));
