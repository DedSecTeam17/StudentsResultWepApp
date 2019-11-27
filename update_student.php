<?php
//include auth.php file on all secure pages
session_start();
if (!isset($_SESSION["username"])) {
header("Location: login.php");
exit();
}
?>
<?php
?>
<!--validation go here -->
<?php
require 'DataBase.php';
$conn = DataBase::getInstance()->connect('register');
if (isset($_GET['student_num']) && is_numeric($_GET['student_num'])) {
$id = $_GET['student_num'];
$_fullname = $_stdnum = $_quran = $_arabic = $_english = $_sin = $_tech = $_history = $_fegh = $_math = "";
$queru = "SELECT * FROM students where student_num ='$id'";
$reuslt = $conn->query($queru);
$rows = $reuslt->num_rows;
for ($i = 0; $i < $rows; $i++) {
$reuslt->data_seek($i);
$row = $reuslt->fetch_array(MYSQLI_NUM);
$_fullname = $row[0];
$_stdnum = $row[1];
$_quran = $row[2];
$_arabic = $row[3];
$_english = $row[4];
$_sin = $row[5];
$_tech = $row[6];
$_history = $row[7];
$_fegh = $row[8];
$_math = $row[9];
}
}
if (isset($_POST['submit'])) {
$fullname = DataBase::getInstance()->SqlSanitizer($conn, $_POST['full_name']);
$stdnum = $_GET['student_num'];
$quran = DataBase::getInstance()->SqlSanitizer($conn, $_POST['quran']);
$arabic = DataBase::getInstance()->SqlSanitizer($conn, $_POST['arabic']);
$english = DataBase::getInstance()->SqlSanitizer($conn, $_POST['english']);
$math = DataBase::getInstance()->SqlSanitizer($conn, $_POST['math']);
$fegh = DataBase::getInstance()->SqlSanitizer($conn, $_POST['fegh']);
$tech = DataBase::getInstance()->SqlSanitizer($conn, $_POST['tech']);
$history = DataBase::getInstance()->SqlSanitizer($conn, $_POST['history']);
$science = DataBase::getInstance()->SqlSanitizer($conn, $_POST['science']);
DataBase::getInstance()->updateStudent($fullname, $stdnum, $quran, $arabic, $english, $science, $tech, $history, $fegh, $math);
}
?>
<!--submit go here -->
<?php
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Welcome Home</title>
        <link rel="stylesheet" href="css/style.css"/>
        <?php require 'partial/header.php' ?>
    </head>
    <body>
        <div class="container-fluid">
            <?php require 'partial/navigation_bar.php' ?>
            <div class="row" style="margin-top: 5%">
                <div class="col-md-2">
                    <!--                -->
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="text text-center" style="position: center">تعديل الطالب</h3>
                        </div>
                        <div class="card-body">
                            <div class="form">
                                <form name="registration" action="" method="post">
                                    <div class="form-group">
                                        <div class="text text-right">
                                        </div>
                                        <input type="text" id="full_name" class="form-control"
                                        name="full_name" placeholder="الاسم رباعي" value="<?php echo $_fullname ?>"
                                        required/>
                                    </div>
                                    <div class="form-group">
                                        <div class="text text-right">
                                        </div>
                                        <input type="number" id="std_num" class="form-control"
                                        name="std_num" placeholder="رقم الجلوس" value="<?php echo $_stdnum ?>" required/>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <div class="text text-right">
                                            <input type="number" id="quran" class="form-control"
                                            name="quran" placeholder="القران الكريم" value="<?php echo $_quran ?>"
                                            required/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="text text-right">
                                            <input type="number" id="arabic" class="form-control"
                                            name="arabic" placeholder="الغه العربيه" value="<?php echo $_arabic ?>"
                                            required/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="text text-right">
                                            <input type="number" id="english" class="form-control"
                                            name="english" placeholder="اللغه الانجليزيه" value="<?php echo $_english ?>"
                                            required/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="text text-right">
                                            <input type="number" id="fegh" class="form-control"
                                            name="fegh" placeholder="الفقه والعقيده" value="<?php echo $_fegh ?>"
                                            required/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="text text-right">
                                            <input type="number" id="science" class="form-control"
                                            name="science" placeholder="العلوم" value="<?php echo $_sin ?>" required/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="text text-right">
                                            <input type="number" id="history" class="form-control"
                                            name="history" placeholder="نحن والعالم المعاصر"
                                            value="<?php echo $_history ?>" required/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="text text-right">
                                            <input type="number" id="tech" class="form-control"
                                            name="tech" placeholder="التربيه التغنيه" value="<?php echo $_tech ?>"
                                            required/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="math" id="math" class="form-control"
                                        name="math" placeholder="الرياضيات" value="<?php echo $_math ?>" required/>
                                    </div>
                                    <input type="submit" class="btn btn-primary btn-lg btn-block" name="submit"
                                    value=" احفظ التعديل "/>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <!---->
                </div>
            </div>
        </div>
        <?php require 'partial/footer.php' ?>
    </body>
</html>