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
                <li><a href="signup.php">sign up</a></li>
                <li><a href="login.php">login</a></li>
                <?php if(isset($_SESSION['id'])) {?>
                <li><a href="logout.php">logout</a></li>
                <li><a href="profile.php">profile</a></li>
                <?php } ?>
            </ul>
        </div>
    </section>
</body>
</html>