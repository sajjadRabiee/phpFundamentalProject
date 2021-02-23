<?php
include 'Config.php';
$name = $username = $password = $email = "";
$counter = 0;
$allEntities = mysqli_query($db,"SELECT * FROM users");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["register"])) {
        #check name validation
        if (empty($_POST["name"])) {
            $_SESSION["nameErr"] = "نام باید پر شود";
        } else {
            $name = test_input($_POST["name"]);
            $counter += 1;
        }
        #check email validation
        if (empty($_POST["email"])) {
            $_SESSION["emailErr"] = "ایمیل باید پر شود";
        } else {
            $email = test_input($_POST["email"]);
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $counter += 1;
            }else{
                $_SESSION["emailErr"] = "فرمت ایمیل نادرست می باشد";
            }
        }
        #check password validation
        if (empty($_POST["password"])) {
            $_SESSION["passwordErr"] = "رمز عبور باید پر شود";
        } else {
            $password = test_input($_POST["password"]);
            $counter += 1;
        }
        #check username validation
        if (empty($_POST["username"])) {
            $_SESSION["usernameErr"] = "نام کاربری باید پر شود";
        } else {
            $username = test_input($_POST["username"]);
            if (preg_match("/^[a-zA-Z-' ]*$/",$username)) {
                $counter += 1;
            }else{
                $_SESSION["usernameErr"] = "نام کاربری انگلیسی مورد قبول می باشد";
            }
        }
        if($counter == 4){
            mysqli_query($db, "INSERT INTO users (name, username, password, mail) VALUES ('$name', '$username', '$password', '$email')");
            $_SESSION["message"] = "ثبت نام با موفقیت انجام شد";
        }
        header('location: ../View/Register.php');
    }
    if (isset($_POST["login"])){
        if (empty($_POST["username"])) {
            $_SESSION["usernameErr"] = "نام کاربری باید پر شود";
        } else {
            $username = test_input($_POST["username"]);
            if (preg_match("/^[a-zA-Z-' ]*$/",$username)) {
                $counter += 1;
            }else{
                $_SESSION["usernameErr"] = "نام کاربری انگلیسی مورد قبول می باشد";
            }
        }
        if (empty($_POST["password"])) {
            $_SESSION["passwordErr"] = "رمز عبور باید پر شود";
        } else {
            $password = test_input($_POST["password"]);
            $counter += 1;
        }
        if($counter == 2){
            $result = mysqli_query($db,"SELECT * FROM users WHERE username = '$username'");
            $user = mysqli_fetch_array($result);
            if($user["password"] == $password){
                $_SESSION["loginMessage"] = "با موفقیت وارد شدید";
                $_SESSION["onlineUser"] = $user;
                header('location: ../View/dashboard.php');
                exit;
            }else{
                $_SESSION["message"] = "نام کاربری یا رمز ورود اشتباه است";
            }
        }
        header('location: ../View/login.php');
    }
}
elseif ($_SERVER["REQUEST_METHOD"] == "GET"){
    if (isset($_GET['exit'])){
        if(isset($_SESSION['onlineUser'])) {
            session_destroy();
            header("Location: ../View/login.php");
        }
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}