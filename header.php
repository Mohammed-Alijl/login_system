<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/master.css">
</head>

<body>
    <section>
        <div class="container">
            <ul class="header">
                <li><a href="index.php">Home page</a></li>
                <?php if (isset($_SESSION['id'])) { ?>
                    <li><a href="profile.php">profile</a></li>
                    <li><a href="include/logout.inc.php">log out</a></li>
                <?php } else { ?>
                    <li><a href="signup.php">sign up</a></li>
                    <li><a href="login.php">log in</a></li>
                <?php } ?>
            </ul>
        </div>
    </section>
</body>

</html>