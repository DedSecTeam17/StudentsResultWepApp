<?php
//include auth.php file on all secure pages
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

require 'DataBase.php';
$conn = DataBase::getInstance()->connect('register');

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>محتوي الادمن</title>
    <link rel="stylesheet" href="css/style.css"/>
    <?php require 'partial/header.php' ?>
</head>
<body>

<div class="container">
</div>
<div class="container">
    <?php require 'partial/navigation_bar.php' ?>


    <div class="row" style="margin-top: 10%">
<!--        <div class="col-md-2">-->
<!---->
<!--        </div>-->
<!--        <div class="col-md-12">-->
<!--            <div class="row text text-center" style="font-size: xx-large">-->
<!--                <div class="card col-md-3 m-2 bg-success " style="color: white;   background: linear-gradient(to bottom right, #89C4F4, #1BBC9B);">-->
<!--                    <div class="card-body">-->
<!--                        <p>القران 80%</p>-->
<!---->
<!--                    </div>-->
<!---->
<!--                </div>-->
<!--                <div class="card col-md-3 m-2 bg-success " style="color: white;   background: linear-gradient(to bottom right, #89C4F4, #1BBC9B);">-->
<!--                    <div class="card-body">-->
<!--                        <p>القران 80%</p>-->
<!---->
<!--                    </div>-->
<!---->
<!--                </div>-->
<!--                <div class="card col-md-3 m-2 bg-success " style="color: white;   background: linear-gradient(to bottom right, #89C4F4, #1BBC9B);">-->
<!--                    <div class="card-body">-->
<!--                        <p>القران 80%</p>-->
<!---->
<!--                    </div>-->
<!---->
<!--                </div>-->
<!--                <div class="card col-md-3 m-2 bg-success " style="color: white;   background: linear-gradient(to bottom right, #89C4F4, #1BBC9B);">-->
<!--                    <div class="card-body">-->
<!--                        <p>القران 80%</p>-->
<!---->
<!--                    </div>-->
<!---->
<!--                </div>-->
<!--                <div class="card col-md-3 m-2 bg-success " style="color: white;   background: linear-gradient(to bottom right, #89C4F4, #1BBC9B);">-->
<!--                    <div class="card-body">-->
<!--                        <p>القران 80%</p>-->
<!---->
<!--                    </div>-->
<!---->
<!--                </div>-->
<!--                <div class="card col-md-3 m-2 bg-success " style="color: white;   background: linear-gradient(to bottom right, #89C4F4, #1BBC9B);">-->
<!--                    <div class="card-body">-->
<!--                        <p>القران 80%</p>-->
<!---->
<!--                    </div>-->
<!---->
<!--                </div>-->
<!--                <div class="card col-md-3 m-2 bg-success " style="color: white;   background: linear-gradient(to bottom right, #89C4F4, #1BBC9B);">-->
<!--                    <div class="card-body">-->
<!--                        <p>القران 80%</p>-->
<!---->
<!--                    </div>-->
<!---->
<!--                </div>-->
<!--                <div class="card col-md-3 m-2 bg-success " style="color: white;   background: linear-gradient(to bottom right, #89C4F4, #1BBC9B);">-->
<!--                    <div class="card-body">-->
<!--                        <p>القران 80%</p>-->
<!---->
<!--                    </div>-->
<!---->
<!--                </div>-->
<!---->
<!---->
<!---->
<!---->
<!--            </div>-->
<!---->
<!---->
<!---->
<!--        </div>-->
        <div class="col-md-2">

        </div>

    </div>



    <div class="row" style="margin-top: 10%">
        <?php
        DataBase::getInstance()->getAllStudentWithView($conn, $_SESSION['username']);
        ?>
    </div>

</div>

</body>
<?php require 'partial/footer.php' ?>

</html>
