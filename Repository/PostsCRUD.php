<?php
include 'Config.php';
$id = $name = $text = "";
$counter = 0;
$userId = test_input($_SESSION['onlineUser']['id']);
$allEntities = mysqli_query($db, "SELECT * FROM posts WHERE fk_user = '$userId'");
$allCategories = mysqli_query($db, "SELECT * FROM categories");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["save"])) {
        #check name of post that valid
        if (empty($_POST["name"])) {
            $_SESSION["nameErr"] = "نام باید پر شود";
        } else {
            $name = test_input($_POST["name"]);
            $counter += 1;
        }
        #check text of post that valid
        if (empty($_POST["text"])) {
            $_SESSION["textErr"] = "پست بدون متن که پست نیست :)";
        } else {
            $text = test_input($_POST["text"]);
            $counter += 1;
        }
        if (!empty($_FILES['image'])) {
            $image = test_input($_FILES['image']['name']);
            $target = "../images/" . basename($image);
        }

        if ($counter == 2) {
            mysqli_query($db, "INSERT INTO posts (name, text , image, fk_user) VALUES ('$name', '$text' , '$image', '$userId')");
            $last_id = $db->insert_id;
            foreach ($_POST["categories"] as $item) {
                mysqli_query($db, "INSERT INTO categories_posts (id_category, id_post) VALUES ('$item','$last_id')");
            }
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $_SESSION["message"] = "پست شما به همراه عکس با موفقیت در سیستممون ثبت شد";
            } else {
                $_SESSION["message"] = "متاسفانه عکس را نتونستیم آپلود کنیم";
            }
        }
        header('location: ../View/AddPost.php');
    }
    elseif (isset($_POST["update"])) {
        #check name of post that valid
        if (empty($_POST["name"])) {
            $_SESSION["nameErr"] = "نام باید پر شود";
        } else {
            $name = test_input($_POST["name"]);
            $counter += 1;
        }
        #check text of post that valid
        if (empty($_POST["text"])) {
            $_SESSION["textErr"] = "پست بدون متن که پست نیست :)";
        } else {
            $text = test_input($_POST["text"]);
            $counter += 1;
        }
        $id = test_input($_POST['id']);
        if (!empty($_FILES['image'])) {
            unlink("../images/" . basename(test_input($_SESSION['image'])));
            $image = test_input($_FILES['image']['name']);
            $target = "../images/" . basename($image);
        }else{
            $image = test_input($_SESSION['image']);
        }
        if ($counter == 2) {
            mysqli_query($db, "UPDATE posts SET name='$name', text='$text' , image='$image' WHERE id=$id");
            mysqli_query($db, "DELETE FROM categories_posts WHERE id_post = '$id'");
            foreach ($_POST["categories"] as $item) {
                mysqli_query($db, "INSERT INTO categories_posts (id_category, id_post) VALUES ('$item','$id')");
            }
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $_SESSION["message"] = "پست شما با موفقیت ویرایش شد .";
            } else {
                $_SESSION["message"] = "متاسفانه عکس را نتونستیم آپلود کنیم";
            }

        }
        $_SESSION['image'] = $image;
        $_SESSION['name'] = $name;
        $_SESSION['text'] = $text;
        header('location: ../View/UpdatePost.php');
    }
}
elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        mysqli_query($db, "DELETE FROM categories_posts WHERE id_post = '$id'");
        mysqli_query($db, "DELETE FROM posts WHERE id='$id'");
        $_SESSION['message'] = "پست مورد نظر حذف شد";
        header('location: ../View/AddPost.php');
    } elseif (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $result = mysqli_query($db, "SELECT * FROM posts WHERE id=$id");
        $post = mysqli_fetch_array($result);
        $_SESSION['id'] = $post['id'];
        $_SESSION['image'] = $post['image'];
        $_SESSION['name'] = $post['name'];
        $_SESSION['text'] = $post['text'];
        header('location: ../View/UpdatePost.php');
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}