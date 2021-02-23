<?php
include 'Config.php';
$name = "";
$userId = test_input($_SESSION['onlineUser']['id']);
$allEntities = mysqli_query($db,"SELECT * FROM categories WHERE fk_user = '$userId'");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["save"])) {
        #check name of category that valid
        if (empty($_POST["name"])) {
            $_SESSION["nameErr"] = "نام دسته بندی باید پر شود";
        } else {
            $name = test_input($_POST["name"]);
            mysqli_query($db, "INSERT INTO categories (name , fk_user) VALUES ('$name','$userId')");
            $_SESSION["message"] = "دسته بندی جدید به سیستم اضافه شد";
        }
        header('location: ../View/AddCategory.php');
    }
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        mysqli_query($db, "DELETE FROM categories WHERE id=$id");
        $_SESSION['message'] = "دسته بندی مورد نظر حذف شد";
        header('location: ../View/AddCategory.php');
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}