<?php
require("header.php");
if (isset($_SESSION['id'])) {
    require("include/db.inc.php");
    $sql = "SELECT username FROM users WHERE user_id=?";
    $stmt = $connect_db->prepare($sql);
    $stmt->execute([$_SESSION['id']]);
    $username = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my profile</title>
</head>

<body>
    <div class="container">
        <div class="profile">
            <h2>Welcome back <?php echo $username['username'] ?></h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis ratione cupiditate deleniti doloremque aperiam quasi sed, excepturi repellat, pariatur dolor quam voluptas quo ex sit delectus error eligendi veritatis iure.</p>
            <br>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis ratione cupiditate deleniti doloremque aperiam quasi sed, excepturi repellat, pariatur dolor quam voluptas quo ex sit delectus error eligendi veritatis iure.</p>
            <br>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis ratione cupiditate deleniti doloremque aperiam quasi sed, excepturi repellat, pariatur dolor quam voluptas quo ex sit delectus error eligendi veritatis iure.</p>
            <br>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis ratione cupiditate deleniti doloremque aperiam quasi sed, excepturi repellat, pariatur dolor quam voluptas quo ex sit delectus error eligendi veritatis iure.</p>
        </div>
    </div>
</body>

</html>