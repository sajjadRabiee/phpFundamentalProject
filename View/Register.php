<?php  include('../Repository/UsersCRUD.php'); ?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.3/css/bootstrap.min.css"
          integrity="sha384-JvExCACAZcHNJEc7156QaHXTnQL3hQBixvj5RV5buE7vgnNEzzskDtx9NQ4p6BJe" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.rtlcss.com/bootstrap/v4.5.3/js/bootstrap.bundle.min.js"
            integrity="sha384-40ix5a3dj6/qaC7tfz0Yr+p9fqWLzzAXiwxVLt9dw7UjQzGYw6rWRhFAnRapuQyK"
            crossorigin="anonymous"></script>
    <title>register</title>
</head>
<body class="container">
<div class="row justify-content-center p-2">
    <div class="col-6 border p-2">
        <form action="../Repository/UsersCRUD.php" method="post">
            <div class="input-group p-1">
                <label class="col" for="name">نام : </label>
                <input class="form-control col" type="text" name="name" value="">
                <span class="font-weight-normal h6 col text-danger"><?php if (isset($_SESSION["nameErr"])) {
                        echo $_SESSION["nameErr"];
                        unset($_SESSION["nameErr"]);
                    } ?></span>
            </div>
            <div class="input-group p-1">
                <label class="col" for="username">نام کاربری : </label>
                <input class="form-control col" type="text" name="username" value="">
                <span class="font-weight-normal h6 col text-danger"><?php if (isset($_SESSION["usernameErr"])){
                    echo $_SESSION["usernameErr"];
                    unset($_SESSION["usernameErr"]);
                    } ?></span>
            </div>
            <div class="input-group p-1">
                <label class="col" for="email">ایمیل : </label>
                <input class="form-control col " type="email" name="email" value="">
                <span class="font-weight-normal h6 col text-danger"><?php if (isset($_SESSION["emailErr"])){
                        echo $_SESSION["emailErr"];
                        unset($_SESSION["emailErr"]);
                    } ?></span>
            </div>
            <div class="input-group p-1">
                <label class="col" for="password">رمز عبور : </label>
                <input class="form-control col" type="password" name="password" value="">
                <span class="font-weight-normal h6 col text-danger"><?php if (isset($_SESSION["passwordErr"])){
                        echo $_SESSION["passwordErr"];
                        unset($_SESSION["passwordErr"]);
                    } ?></span>
            </div>
            <div class="input-group p-5 justify-content-center">
                <button class="btn btn-primary btn-block col-6" type="submit" name="register">ثبت نام</button>
            </div>
            <?php if(isset($_SESSION["message"])){
                echo "<div class=\"alert alert-success\">";
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                    echo "<a href='login.php'>  بازگشت به صفحه ورود  </a>";
               echo"</div>";
            } ?>
        </form>
    </div>
</div>
</body>
</html>