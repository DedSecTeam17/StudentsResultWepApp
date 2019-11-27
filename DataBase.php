<?php
/**
 * Created by PhpStorm.
 * User: Mohammed Elamin
 * Date: 7/31/2018
 * Time: 8:36 PM
 */

class DataBase
{
    private static $instance = null;
    private $get_username_from_school = "";

    private function __construct()
    {
        // The expensive process (e.g.,db connection) goes here.
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new DataBase();
        }

        return self::$instance;
    }

    public function connect($db_name)
    {
        $db = new mysqli('localhost', 'root', '', $db_name);
        return $db;
    }

    public function StringSanitizer($data)
    {
        $data = stripslashes($data);
        $data = htmlentities($data);
        $data = strip_tags($data);
        return $data;
    }

    public function SqlSanitizer($conn, $data)
    {
        $data = $conn->real_escape_string($data);
        $data = self::StringSanitizer($data);
        return $data;
    }

    private function getNumOfSelectedRows($con, $username, $password)
    {
        $query = "SELECT * FROM    users    WHERE username='$username'
        and password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);


        return $rows;
    }

    public function LogIn($con, $username, $password)
    {
        if ((new DataBase)->getNumOfSelectedRows($con, $username, $password) == 1) {
            $_SESSION['username'] = $username;
            // Redirect user to index.php
            header("Location: admin_dashboard.php");
        } else {
            echo "
 <div class='container-fluid' style='margin-top: 10%'>
 
 <div class='row'>
 <div class='col-md-4'>
// 
</div>
 <div class='col-md-4'>
 <div class='form m-5'>
<h3 class='alert alert-danger'>Username/password is incorrect.

<br/><a class='btn btn-success btn-lg btn-block mt-3' href='login.php'>Login</a></div>

</h3>
</div>
 <div class='col-md-4'>
</div>
</div>
</div>
";


        }

    }

    private function insert($conn, $query)
    {
        $result = mysqli_query($conn, $query);
        return $result;
    }

    public function Register($conn, $username, $password, $email, $trn_date, $school_name)
    {

        if (self::insert($conn, "INSERT into   users   (username, password, email, trn_date,school_name)
VALUES ('$username', '" . md5($password) . "', '$email', '$trn_date','$school_name')")) {
            $_SESSION['username'] = $username;
            header("Location: admin_dashboard.php");
        }
    }

    public function RegisterStudent($conn, $fullname, $student_num, $quran, $arabic, $english, $sin, $tech, $history, $fegh, $math, $admin_name)
    {
        $final_result = ($quran + $arabic + $english + $sin + $tech + $fegh + $history + $math);
        if (self::insert($conn, "INSERT into   students   VALUES ('$fullname','$student_num', '$quran', '$arabic', '$english','$sin','$tech','$history','$fegh','$math','$final_result','$admin_name')")) {
            header("Location: admin_dashboard.php");
        } else {
            echo '

 <div class="row mt-5" >
 <div class="col-md-4">
 
</div>
  <div class="col-md-4">
  <div class="alert alert-danger">
            <p>'.
                $conn->error.
                '</p></div>
</div>
<div class="col-md-4">
 
</div>

</div>



           ';
        }
    }

    public function getAllStudentWithView($conn, $admin_name)
    {
        $queru = "SELECT * FROM students where admin_name = '$admin_name' ORDER BY final_result desc  ";
        $reuslt = $conn->query($queru);
        $rows = $reuslt->num_rows;
        echo '<div class="col-md-12">';
        echo "<table class='table table-dark table-striped table-bordered table-responsive'>
<tr><th>رقم الجلوس</th>
<th>الاسم رباعي</th>
<th>القران الكريم</th>
<th>الغه العربيه</th>
<th>الغه الانجليزيه</th>
<th>العلوم</th>
<th>التربيه التغنيه</th>
<th>نخن والعالم المعاصر</th>
<th>الفقه</th>
<th>الرياضيات</th>
<th>المجموع</th>
</th
><th>مسح  بيانات الطالب</th>
</th>
<th>تعديل  بيانات الطالب</th></tr>";
        for ($i = 0; $i < $rows; $i++) {
            $reuslt->data_seek($i);
            $row = $reuslt->fetch_array(MYSQLI_NUM);
            echo "<tr><td>" . $row[1] . "</td><td>" . $row[0] . "</td><td>" . $row[2] . "</td>
<td>" . $row[3] . "</td>
<td>" . $row[4] . "</td>
<td>" . $row[5] . "</td>
<td>" . $row[6] . "</td>
<td>" . $row[7] . "</td>
<td>" . $row[8] . "</td>
<td>" . $row[9] . "</td>
<td>" . $row[10] . "</td>
 <td><a class='btn btn-danger' href='delete_student.php?student_num=" . $row[1] . "'>مسح</a></td>
 <td><a class='btn btn-info'  href='update_student.php?student_num=" . $row[1] . "'>تعديل</a></td>
        </td>
        </tr>";
        }
        echo "</table>";
        echo '</div>';


    }

    public function deleteStudent($conn, $id)
    {

// get the 'id' variable from the URL

// delete record from database
        if ($stmt = $conn->prepare("DELETE FROM students WHERE student_num = ? LIMIT 1")) {
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "ERROR: could not prepare SQL statement.";
        }
        $conn->close();

// redirect user after delete is successful
        header("Location: admin_dashboard.php");


    }

    public function updateStudent($fullname, $student_num, $quran, $arabic, $english, $sin, $tech, $history, $fegh, $math)
    {
        $conn = DataBase::getInstance()->connect('register');
        $final_result = ($quran + $arabic + $english + $sin + $tech + $fegh + $history + $math);

        $stmt = $conn->prepare("UPDATE students SET fullname = ?,quran =? ,arabic =? ,english =?,sin =?,tech =?,history =?,fegh =?,math =?,final_result =?
WHERE student_num=?");
        $stmt->bind_param("siiiiiiiiii", $fullname, $quran, $arabic, $english, $sin, $tech, $history, $fegh, $math, $final_result, $student_num);
        $stmt->execute();
        $stmt->close();
        header("Location: admin_dashboard.php");
    }

    public function getUserNameFromSchoolName($conn, $sn)
    {
        $sc_conn = DataBase::getInstance()->connect('register');
        $school_query = "SELECT username from users WHERE  school_name = '$sn' ";
        $school_result = $conn->query($school_query);
        $school_rows = $school_result->num_rows;
        for ($x = 0; $x < $school_rows; $x++) {
            $school_result->data_seek($x);
            $row_school = $school_result->fetch_array(MYSQLI_NUM);
            $this->get_username_from_school = $row_school[0];
        }
        $sc_conn->close();
        return $this->get_username_from_school;
    }

    public function getStudentResultWihtStudentNumerAndHisSchool($conn, $student_num, $user_name)
    {


        $query = "SELECT * FROM students where student_num = '$student_num' and admin_name = '$user_name' ";
        $reuslt = $conn->query($query);
        $rows = $reuslt->num_rows;
        if ($rows > 0) {


            echo '<div class="col-md-12">';
            echo "<table class='table table-dark table-striped table-bordered table-responsive'>
<tr><th>رقم الجلوس</th>
<th>الاسم رباعي</th>
<th>القران الكريم</th>
<th>الغه العربيه</th>
<th>الغه الانجليزيه</th>
<th>العلوم</th>
<th>التربيه التغنيه</th>
<th>نخن والعالم المعاصر</th>
<th>الفقه</th>
<th>الرياضيات</th>
<th>المجموع</th>
</th>
</tr>";
            for ($i = 0; $i < $rows; $i++) {
                $reuslt->data_seek($i);
                $row = $reuslt->fetch_array(MYSQLI_NUM);
                echo "<tr><td>" . $row[1] . "</td><td>" . $row[0] . "</td><td>" . $row[2] . "</td>
<td>" . $row[3] . "</td>
<td>" . $row[4] . "</td>
<td>" . $row[5] . "</td>
<td>" . $row[6] . "</td>
<td>" . $row[7] . "</td>
<td>" . $row[8] . "</td>
<td>" . $row[9] . "</td>
<td>" . $row[10] . "</td>

        </td>
        </tr>";
            }
            echo "</table>";
            echo '</div>';
        } else {
            echo $this->get_username_from_school;

            echo '
            <div class="alert alert-warning" role="alert"> 
            لاتوجد نتيجه لرقم الجلوس المدخل  او ان المدرسه المختاره غير متوافقه مع رقم الجلوس
</div>
            <table class="table table-dark table-striped table-bordered table-responsive mt-5">
            <tr><th>رقم الجلوس</th>
<th>الاسم رباعي</th>
<th>القران الكريم</th>
<th>الغه العربيه</th>
<th>الغه الانجليزيه</th>
<th>العلوم</th>
<th>التربيه التغنيه</th>
<th>نخن والعالم المعاصر</th>
<th>الفقه</th>
<th>الرياضيات</th>
<th>المجموع</th>
</th
>

<tr>
<td>_</td>
<td>_</td>
<td>_</td>
<td>_</td>
<td>_</td>
<td>_</td>
<td>_</td>
<td>_</td>
<td>_</td>
<td>_</td>
<td>_</td>

</tr>
            
            
            
            
            
</table>
            
            ';
        }
    }

    public function getAllSchoolsNames($conn)
    {
        $query = "SELECT school_name FROM users";
        $result = $conn->query($query);
        $rows = $result->num_rows;

        $allstudents = array();
        for ($i = 0; $i < $rows; $i++) {
            $result->data_seek($i);
            $row = $result->fetch_array(MYSQLI_NUM);

            $allstudents[$i] = $row[0];
        }
        return $allstudents;
    }
}