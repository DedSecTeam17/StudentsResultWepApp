<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <?php require 'partial/header.php' ?>
</head>
<body>
<?php
require('db.php');
require 'DataBase.php';
//connection
// connect with table
$connection = DataBase::getInstance()->connect('register');
session_start();
// If form submitted, insert values into the database.
if (isset($_POST['username'])) {
//    sanitizer string from xss and sql injections
    $username = DataBase::getInstance()->SqlSanitizer($connection, $_POST['username']);
    $password = DataBase::getInstance()->SqlSanitizer($connection, $_POST['password']);
//    login and check user
    DataBase::getInstance()->LogIn($connection, $username, $password);
} else {
    ?>
    <div class="container-fluid">
        <?php require 'partial/navigation_bar.php' ?>

    </div>
    <div class="container-fluid">
        <div class="row" style="margin-top: 5%">
            <div class="col-md-4">
                <!--                -->
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text text-center" style="position: center">Login</h3>
                    </div>
                    <div class="card-body">
                        <div class="form">
                            <form action="" method="post" name="login">

                                <div class="form-group ">
                                    <input type="text" id="username" class="form-control "
                                           name="username"
                                           placeholder="اسم المستخدم" required/>


                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password"
                                           name="password"
                                           placeholder="كلمه السر" required/>
                                </div>
                                <input name="submit" class="btn btn-primary btn-lg btn-block btn-outline " type="submit"
                                       value="تسجيل الدخول"/>
                            </form>
                            <p>لم تسجل مدرستك؟ <a href='registration.php'> سجل من هنا</a></p>
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
<?php require 'partial/footer.php' ?>

</body>
</html>
