<?php include('../Repository/PostsCRUD.php');
if (!isset($_SESSION['onlineUser'])) {
    header('Location: login.php');
    exit;
} else {
    ?>
    <!DOCTYPE html>
    <html lang="fa" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.5.3/css/bootstrap.min.css"
              integrity="sha384-JvExCACAZcHNJEc7156QaHXTnQL3hQBixvj5RV5buE7vgnNEzzskDtx9NQ4p6BJe"
              crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
                integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
                crossorigin="anonymous"></script>
        <script src="https://cdn.rtlcss.com/bootstrap/v4.5.3/js/bootstrap.bundle.min.js"
                integrity="sha384-40ix5a3dj6/qaC7tfz0Yr+p9fqWLzzAXiwxVLt9dw7UjQzGYw6rWRhFAnRapuQyK"
                crossorigin="anonymous"></script>
        <title>dashboard</title>
    </head>
    <body>
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand">پروژه CRUD</a>
        <form class="form-inline">
            <a href="../Repository/UsersCRUD.php?exit">
                <button class="btn btn-outline-danger my-2 my-sm-0" type="button">خروج</button>
            </a>
        </form>
    </nav>
    <div class="row p-2 justify-content-center">
        <div class="col-10">
            <?php if (isset($_SESSION["loginMessage"])) {
                echo "<div class=\"alert alert-success\">";
                echo $_SESSION['loginMessage'];
                unset($_SESSION['loginMessage']);
                echo "</div>";
            } ?>
        </div>
    </div>
    <div class="row p-2 justify-content-center">
        <div class="col-4 p-4 ">
            <div class="p-4 border"><a href="AddPost.php">
                    <button class="btn btn-outline-dark">اضافه کردن پست</button>
                </a></div>
        </div>
        <div class="col-4 p-4 ">
            <div class="p-4 border"><a href="AddCategory.php">
                    <button class="btn btn-outline-dark">اضافه کردن دسته بندی</button>
                </a></div>
        </div>
    </div>
    </body>
    </html>
<?php } ?>