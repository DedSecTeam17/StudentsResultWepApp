<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Welcome Home</title>
    <link rel="stylesheet" href="css/style.css"/>
    <?php require 'partial/header.php' ?>


</head>
<body>
<?php require 'partial/navigation_bar.php' ?>

<div class="container">
    <div class="row" style="margin-top: 10%">
        <div class="col-md-12">

            <div class="card">
                <div class="card-body">
                    <form action="" method="post">
                        <div class="input-group mb-3">

                            <?php
                            require 'DataBase.php';
                            $conn = DataBase::getInstance()->connect('register');
                            $err = DataBase::getInstance()->getAllSchoolsNames($conn);
                            echo '<select name="school" class="custom-select" id="inputGroupSelect01">';
                            for ($i=0; $i<sizeof($err); $i++){
                                echo '<option value="'.$err[$i].'" >';
                                echo  $err[$i];
                                echo '</option>';
                            }
                            echo ' </select>';
                            ?>
                        </div>
                        <div class="form-group">
                            <input type="number" name="std_num" class="form-control">
                        </div>
                        <button name="submit" type="submit" class="btn btn-primary btn-lg btn-block">get result</button>


                    </form>

                </div>

                <div class="card-footer">
                    <?php

                    if (isset($_POST['submit'])) {
                        $std_num = DataBase::getInstance()->SqlSanitizer($conn, $_POST['std_num']);
                        $school_name=DataBase::getInstance()->SqlSanitizer($conn,$_POST['school']);
                        $user_name=DataBase::getInstance()->getUserNameFromSchoolName($conn,$school_name);
                        DataBase::getInstance()->getStudentResultWihtStudentNumerAndHisSchool($conn, $std_num,$user_name);
                    }
                    ?>

                </div>

            </div>


            <p>this is student result page </p>
        </div>
    </div>
</div>
<?php require 'partial/footer.php'?>
</body>
</html>
