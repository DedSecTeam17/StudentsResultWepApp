<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registration</title>
    <?php require 'partial/header.php' ?>
</head>
<body>
<?php
session_start();

require('db.php');
require 'DataBase.php';
// If form submitted, insert values into the database.
if (isset($_POST['username'])) {
    $conn = DataBase::getInstance()->connect('register');
    $username = DataBase::getInstance()->SqlSanitizer($conn, $_POST['username']);
    $password = DataBase::getInstance()->SqlSanitizer($conn, $_POST['password']);
    $email = DataBase::getInstance()->SqlSanitizer($conn, $_POST['email']);
    $school_name = DataBase::getInstance()->SqlSanitizer($conn, $_POST['school']);
    $trn_date = date("Y-m-d H:i:s");
    DataBase::getInstance()->Register($conn, $username, $password, $email, $trn_date, $school_name);
} else {
    ?>
    <div class="container-fluid">
        <?php require 'partial/navigation_bar.php' ?>

        <div class="row" style="margin-top: 5%">
            <div class="col-md-4">
                <!--                -->
            </div>
            <div class="col-md-4">
                <div class="card">

                    <div class="card-header">
                        <h3 class="text text-center" style="position: center">تسجيل مؤسسه تعليميه</h3>
                    </div>
                    <div class="card-body">
                        <div class="form">
                            <form name="registration" action="" method="post">

                                <div class="form-group">
                                <div class="text text-right">

                                    <label for="username">اسم المستخدم </label>
                                    </div>
                                        <input type="text" id="username"    class="form-control"
                                               name="username" placeholder="اسم المستخدم" required/>



                                <div class="form-group">
                                <div class="text text-right">

                                    <label for="email">الاميل</label>
                                    </div>
                                        <input type="email" id="email"    class="form-control"
                                               name="email" placeholder="ايميل المستخدم" required/>
                                </div>
                                <div class="form-group">
                                <div class="text text-right">

                                    <label for="school">اسم المدرسه </label>
                                    </div>
                                        <input type="text" id="school"    class="form-control"
                                               name="school" placeholder="اسم المؤسسه التعليميه" required/>
                                </div>
                                <div class="form-group">
                                <div class="text text-right">
                                
                                <label for="password">كلمه السر</label>

                                </div>
                                        <input type="password"    class="form-control" id="password"
                                               name="password" placeholder="كلمه السر" required/>
                                </div>
                                <input type="submit" class="btn btn-primary btn-lg btn-block" name="submit"
                                       value="تسجيل مستخدم جديد"/>
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
<?php } ?>
<?php require 'partial/footer.php'?>

</body>
</html>