<?php
/**
 * Created by PhpStorm.
 * User: Mohammed Elamin
 * Date: 8/1/2018
 * Time: 8:08 PM
 */
require 'DataBase.php';
if (isset($_GET['student_num']) && is_numeric($_GET['student_num'])) {
    $conn = DataBase::getInstance()->connect('register');
    $student_num = $_GET['student_num'];
    DataBase::getInstance()->deleteStudent($conn, $student_num);
} else // if the 'id' variable isn't set, redirect the user
{
    header("Location: admin_dashboard.php");
}
