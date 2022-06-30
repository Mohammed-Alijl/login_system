<?php
//=====================================================
//==FILE HAVE ALL FUNCTION TO HANDEL ERRORS IN FORMS===
//=====================================================


/**
 * function to filter data
 * @param string $data the data want to filter
 * @return string filter data
 */
function test_input($data): string
{
    htmlspecialchars($data);
    trim($data);
    stripslashes($data);
    return $data;
}

/**
 * function to make sure if the data is empty or not
 * @param string $username make sure the username is empty or not
 * @param string $email make sure the email is empty or not
 * @param string $pass make sure the password is empty or not
 * @param string $conf_pass make sure the confirm password is empty or not
 * @return string return who is empty
 */
function isEntryEmpty($username, $email, $pass, $conf_pass): string
{
    $result = "";
    if (empty($username))
        $result .= "empUsername";
    if (empty($email))
        $result .= "empEmail";
    if (empty($pass))
        $result .= "empPass";
    if (empty($conf_pass))
        $result .= "empConf_pass";
    return $result;
}

/**
 * function to check valid and invalid username
 * @param string $username the username to check is valid or not
 * @return bool valid or invalid username
 */
function invalidUsername($username): bool
{
    if (!preg_match("/^[A-Za-z]{1}[A-Za-z0-9_\s]{5,25}/", $username))
        return true;
    else
        return false;
}

/**
 * function to check valid and invalid email
 * @param string $email the email to check is valid or not
 * @return bool valid or invalid email
 */
function invalidEmail($email): bool
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        return true;
    else
        return false;
}

/**
 * function to check valid and invalid password
 * @param string $pass the password to check is valid or not
 * @return bool valid or invalid password
 */
function invalidpass($pass): bool
{
    if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/", $pass))
        return true;
    else return false;
}

/**
 * function to check if email is exist on database or not
 * @param object $connect_db the database connection
 * @param string $email the email to check is exist in database or not
 * @return bool exist or not
 */
function emailExist($connect_db, $email)
{
    $sql = "SELECT email FROM users WHERE email=?";
    $stmt = $connect_db->prepare($sql);
    $stmt->execute([$email]);
    if ($stmt->fetch(PDO::FETCH_ASSOC))
        return true;
    else
        return false;
}

/**
 * function to check username is exist on database or not
 * @param object $connect_db the database connection
 * @param string $username the username to check is exist in database or not
 * @return bool exist or not
 **/
function userExist($connect_db, $username)
{
    $sql = "SELECT username FROM users WHERE username=?";
    $stmt = $connect_db->prepare($sql);
    $stmt->execute([$username]);
    if ($stmt->fetch(PDO::FETCH_ASSOC))
        return true;
    else return false;
}

/**
 * function to check if password and his confirm is equal or not
 * @param string $pass the main password
 * @param string $conf_pass the confirm password
 * @return bool equal or not
 **/
function passMatch($pass, $conf_pass)
{
    if ($pass === $conf_pass)
        return true;
    else return false;
}

/**
 * function to create new user
 * @param object $connect_db the database connection
 * @param string $username the username for new user
 * @param string $email the email for new user
 * @param string $pass the password for new user
 */
function createUser($connect_db, $username, $email, $pass)
{
    $hash_pass = password_hash($pass, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users(username, email, password) VALUES (?, ?, ?)";
    $stmt = $connect_db->prepare($sql);
    $stmt->execute([$username, $email, $hash_pass]);
}

/**
 * function to check if username or password is empty
 * @param string $username_email check if username and email filed is empty
 * @param string $pass check if password filed is empty
 * @return string who empty
 */
function loginEmpty($username_email, $pass): string
{
    $result = "";
    if (empty($username_email))
        $result .= "empUsername_email";
    if (empty($pass))
        $result .= "empPass";
    return $result;
}

/**
 * function to check is password is true or not
 * @param object $connect_db the database connection
 * @param string $username_email the username or email that will check the password for him
 * @param string $pass the password will check is true or not
 * @return bool the password is true or not
 */
function checkPass($connect_db, $username_email, $pass): bool
{
    $sql = "SELECT password FROM users WHERE username=? OR email=?";
    $stmt = $connect_db->prepare($sql);
    $stmt->execute([$username_email, $username_email]);
    $user_pass = $stmt->fetch(PDO::FETCH_ASSOC);
    $checkPwd = password_verify($pass, $user_pass['password']);
    return $checkPwd;
}

/**
 * function to initialize session
 * @param object $connect_db the database connection
 * @param string $username_email the name or email to user that will initialize session for him
 */
function initSession($connect_db, $username_email)
{
    session_start();
    $sql = "SELECT user_id FROM users WHERE username=? or email=?";
    $stmt = $connect_db->prepare($sql);
    $stmt->execute([$username_email, $username_email]);
    $id = $stmt->fetch(PDO::FETCH_ASSOC);
    $_SESSION['id'] = $id['user_id'];
}

/**
 * function to remove token if exist
 * @param object $connect_db the database connection
 * @param string $email the email for user that will remove token for him
 */
function rmToken($connect_db, $email)
{
    $sql = "DELETE FROM reset_password WHERE email=?";
    $stmt = $connect_db->prepare($sql);
    if (!$stmt) {
        header("location: ../index.php?errormsg=errorDeleteToken");
        exit();
    } else
        $stmt->execute([$email]);
}

/**
 * function to insert Token to database
 * @param object $connect_db the database connection
 * @param string $email the email to insert
 * @param string $selector the selector to insert
 * @param string $token the token to insert
 * @param string $expire time for token
 */
function addToken($connect_db, $email, $selector, $token, $expire_time)
{
    $hash_token = password_hash($token, PASSWORD_DEFAULT);
    $sql = "INSERT INTO reset_password(email, pwdResetSelector, pwdResetToken, expireTokenTime) VALUES (?,?,?,?)";
    $stmt = $connect_db->prepare($sql);
    if (!$stmt) {
        header("location: ../index.php?errormsg=errorAddToken");
        exit();
    } else {
        $stmt->execute([$email, $selector, $hash_token, $expire_time]);
    }
}
/**
 * function to check if email is empty or not
 * @param string $email the email will check is empty or not
 * @return string if empty return empEmail else return empty string
 */
function emptyEmail($email)
{
    if (empty($email))
        return "empEmail";
    else
        return null;
}
