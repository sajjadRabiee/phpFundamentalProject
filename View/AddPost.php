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
        <title>add post</title>
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
            <form action="../Repository/PostsCRUD.php" method="post" enctype="multipart/form-data">
                <div class="input-group p-1">
                    <input class="form-control" type="file" name="image" value="">
                </div>
                <div class="input-group p-1">
                    <label class="col-2" for="name">نام پست : </label>
                    <input class="form-control col-7" type="text" name="name" value="">
                    <span class="font-weight-normal h6 col-3 text-danger"><?php if (isset($_SESSION["nameErr"])) {
                            echo $_SESSION["nameErr"];
                            unset($_SESSION["nameErr"]);
                        } ?></span>
                </div>
                <div class="input-group p-1">
                    <label class="col-2" for="categories">موضوعات</label>
                    <select class="col-7" name="categories[]" id="categories" size="2" multiple>
                        <?php while ($row1 = mysqli_fetch_array($allCategories)) { ?>
                            <option value="<?php echo $row1['id']; ?>"><?php echo $row1['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="input-group p-1">
                    <label class="col-2" for="text">متن پست : </label>
                    <textarea class="form-control col-7" type="text" name="text" value=""></textarea>
                    <span class="font-weight-normal h6 col-3 text-danger"><?php if (isset($_SESSION["textErr"])) {
                            echo $_SESSION["textErr"];
                            unset($_SESSION["textErr"]);
                        } ?></span>
                </div>
                <div class="input-group p-5 justify-content-center">
                    <button class="btn btn-info btn-block col-8" type="submit" name="save">ارسال و ثبت پست</button>
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
                    <th>تصویر</th>
                    <th>نام</th>
                    <th>متن</th>
                    <th colspan="2"> عملیات ها</th>
                </tr>
                </thead>

                <?php while ($row2 = mysqli_fetch_array($allEntities)) { ?>
                    <tr>
                        <td><?php echo "<img src='../images/" . $row2['image'] . "' width='auto' height='30'>"; ?></td>
                        <td><?php echo $row2['name']; ?></td>
                        <td><?php echo $row2['text']; ?></td>
                        <td>
                            <a href="../Repository/PostsCRUD.php?edit=<?php echo $row2['id']; ?>"
                               class="btn btn-primary">ویرایش</a>
                        </td>
                        <td>
                            <a href="../Repository/PostsCRUD.php?del=<?php echo $row2['id']; ?>"
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