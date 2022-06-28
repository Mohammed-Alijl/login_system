<?php
require_once("header.php");
if (isset($_SESSION['id'])) {
?>
    <section>
        <div class="container">
            <h2>you are log in you can:</h2>
            <ul>
                <li><a href="profile.php">go to your profile</a></li>
                <li><a href="include/logout.inc.php">log out from your account</a></li>
            </ul>
        </div>
    </section>

<?php } else { ?>
    <section>
        <div class="container">
        <h2>you are not log in you can:</h2>
            <ul>
                <li><a href="signup.php">sign up</a></li>
                <li><a href="login.php">login to your account</a></li>
            </ul>
        </div>
    </section>

<?php } ?>