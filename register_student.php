<?php
//include auth.php file on all secure pages
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

?>

<!--validation go here -->
<?php
require 'DataBase.php';
if (isset($_POST['submit'])) {
    $conn = DataBase::getInstance()->connect('register');
    $fullname = DataBase::getInstance()->SqlSanitizer($conn, $_POST['full_name']);
    $stdnum = DataBase::getInstance()->SqlSanitizer($conn, $_POST['std_num']);
    $quran = DataBase::getInstance()->SqlSanitizer($conn, $_POST['quran']);
    $arabic = DataBase::getInstance()->SqlSanitizer($conn, $_POST['arabic']);
    $english = DataBase::getInstance()->SqlSanitizer($conn, $_POST['english']);
    $math = DataBase::getInstance()->SqlSanitizer($conn, $_POST['math']);
    $fegh = DataBase::getInstance()->SqlSanitizer($conn, $_POST['fegh']);
    $tech = DataBase::getInstance()->SqlSanitizer($conn, $_POST['tech']);
    $history = DataBase::getInstance()->SqlSanitizer($conn, $_POST['history']);
    $science = DataBase::getInstance()->SqlSanitizer($conn, $_POST['science']);
    $admin_name=$_SESSION['username'];


    DataBase::getInstance()->RegisterStudent($conn, $fullname, $stdnum, $quran, $arabic, $english, $science, $tech, $history, $fegh, $math,$admin_name);
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
        <div class="col-md-3">
            <!--                -->
        </div>
        <div class="col-md-6">
            <div class="card">

                <div class="card-header">
                    <h3 class="text text-center" style="position: center">تسجيل الطالب</h3>
                </div>
                <div class="card-body">
                    <div class="form">
                        <form name="registration" action="" method="post">
                            <div class="form-group">
                                <div class="text text-right">
                                </div>
                                    <input type="text" id="full_name"     class="form-control"
                                           name="full_name" placeholder="الاسم رباعي" required/>


                            </div>

                            <div class="form-group">
                                <div class="text text-right">
                                </div>
                                    <input type="number" id="std_num"     class="form-control"
                                           name="std_num" placeholder="رقم الجلوس" required/>

                            </div>
                            <hr>

                            <div class="form-group">
                                <div class="text text-right">
                                        <input type="number" id="quran"     class="form-control"
                                               name="quran" placeholder="القران الكريم" required/>

                  </div>
                            </div>

                            <div class="form-group">
                                <div class="text text-right">
                                        <input type="number" id="arabic"     class="form-control"
                                               name="arabic" placeholder="الغه العربيه" required/>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="text text-right">
                                        <input type="number" id="english"     class="form-control"
                                               name="english" placeholder="اللغه الانجليزيه" required/>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="text text-right">
                                        <input type="number" id="fegh"     class="form-control"
                                               name="fegh" placeholder="الفقه والعقيده" required/>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="text text-right">
                                        <input type="number" id="science"     class="form-control"
                                               name="science" placeholder="العلوم" required/>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="text text-right">
                                        <input type="number" id="history"     class="form-control"
                                               name="history" placeholder="نحن والعالم المعاصر" required/>

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="text text-right">
                                        <input type="number" id="tech"     class="form-control"
                                               name="tech" placeholder="التربيه التغنيه" required/>
                                </div>
                            </div>

                            <div class="form-group">
                                        <input type="math" id="math"     class="form-control"
                                               name="math" placeholder="الرياضيات" required/>
                                
                            </div>


                            <input type="submit" class="btn btn-primary btn-lg btn-block" name="submit"
                                   value="اضف الطالب"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <!---->
        </div>
    </div>
</div>
<?php require 'partial/footer.php'?>


</body>
</html>
