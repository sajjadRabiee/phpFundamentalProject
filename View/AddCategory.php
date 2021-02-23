<?php include('../Repository/CategoriesCRUD.php');
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
        <title>add category</title>
    </head>
    <body class="container">
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand">پروژه CRUD</a>
        <form class="form-inline">
            <a href="dashboard.php" class="px-1">
                <button class="btn btn-secondary my-2 my-sm-0" type="button">داشبورد</button>
            </a>
            <a href="../Repository/UsersCRUD.php?exit">
                <button class="btn btn-outline-danger my-2 my-sm-0" type="button">خروج</button>
            </a>
        </form>
    </nav>
    <div class="row justify-content-center p-2">
        <div class="col-8 border p-2">
            <form action="../Repository/CategoriesCRUD.php" method="post">
                <div class="input-group p-1">
                    <label class="col-3" for="name">نام دسته بندی : </label>
                    <input class="form-control col-6" type="text" name="name" value="">
                    <span class="font-weight-normal h6 col-3 text-danger"><?php if (isset($_SESSION["nameErr"])) {
                            echo $_SESSION["nameErr"];
                            unset($_SESSION["nameErr"]);
                        } ?></span>
                </div>
                <div class="input-group p-5 justify-content-center">
                    <button class="btn btn-success btn-warning col-6" type="submit" name="save">اضافه کردن دسته بندی
                        جدید
                    </button>
                </div>
                <?php if (isset($_SESSION["message"])) {
                    echo "<div class=\"alert alert-success\">";
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                    echo "<a href='dashboard.php'>  بازگشت به داشبورد  </a>";
                    echo "</div>";
                } ?>
            </form>
        </div>
    </div>
    <div class="row justify-content-center p-2">
        <div class="col-10 p-1">
            <table class="table">
                <thead>
                <tr>
                    <th>نام</th>
                    <th>حذف دسته بندی</th>
                </tr>
                </thead>

                <?php while ($row = mysqli_fetch_array($allEntities)) { ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td>
                            <a href="../Repository/CategoriesCRUD.php?del=<?php echo $row['id']; ?>"
                               class="btn btn-danger">حذف</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>


    </body>
    </html>
<?php } ?>