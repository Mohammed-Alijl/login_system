<?php
if (isset($_POST['reset_password'])) {
    require("db.inc.php");
    require("function.inc.php");
    $selector = test_input($_POST['selector']);
    $validator = test_input($_POST['validator']);
    $newPassword = test_input($_POST['newPassword']);
    $confNewPassword = test_input($_POST['confNewPassword']);
    if (empty($newPassword) && empty($confNewPassword)) {
        header("location: ../reset_password.php?selector=$selector&validator=$validator&error=empnewPasswordempnconfNewPassword");
        exit();
    } else if (empty($newPassword)) {
        header("location: ../reset_password.php?selector=$selector&validator=$validator&error=empnewPassword");
        exit();
    } else if (empty($confNewPassword)) {
        header("location: ../reset_password.php?selector=$selector&validator=$validator&error=empnconfNewPassword");
        exit();
    } else if (!passMatch($newPassword, $confNewPassword)) {
        header("location: ../reset_password.php?selector=$selector&validator=$validator&error=passNotMatch");
        exit();
    } else {
        $sql = "SELECT * FROM reset_password WHERE pwdResetSelector =? AND expireTokenTime>" . time();
        $stmt = $connect_db->prepare($sql);
        $stmt->execute([$selector]);
        if (!$row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            header("location: ../reset_request.php?error=noSelector");
            exit();
        }
        $tokenCheck = password_verify(hex2bin($validator), $row['pwdResetToken']);
        if ($tokenCheck !== false) {
            header("location: ../reset_request.php?error=errorToken");
            exit();
        } else if ($tokenCheck === false) {
            $tokenEmail = $row['email'];
            $sql = "SELECT * FROM users WHERE email =?";
            $stmt = $connect_db->prepare($sql);
            $stmt->execute([$tokenEmail]);
            if (!$user = $stmt->fetch(PDO::FETCH_ASSOC)) {
                header("location: ../reset_request.php?error=userNotExist");
                exit();
            }
            $hash_pass = password_hash($newPassword, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET password = ? WHERE email = ?";
            $stmt = $connect_db->prepare($sql);
            if ($stmt->execute([$hash_pass, $tokenEmail])) {
                header("location: ../reset_request.php?error=noSelector");
                exit();
            }
            rmToken($connect_db, $tokenEmail);
            header("location: ../reset_request.php?error=success");
        }
    }
} else {
    header("location: ../index.php");
}
