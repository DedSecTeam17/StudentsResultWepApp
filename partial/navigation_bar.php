<nav class="navbar navbar-expand-md bg-info navbar-dark fixed-top">

    <a href="#" class="navbar-brand"><img src="img/nafee.jpg" width="50" height="50"></a>

    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#myitem">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="myitem">
        <ul class="navbar-nav">


            <?php

            if (isset($_SESSION['username'])) {
                echo '
       <li class="nav-item">
                <a href=" register_student.php" class="nav-link">تسجيل الطلاب<i class="fas fa-address-book" style="font-size: large"></i></a>
            </li>
            <li class="nav-item">
                <a href=" admin_dashboard.php" class="nav-link">محتوي الادمن<i class="fas fa-tachometer-alt" style="font-size: large"></i></a>

            </li>

                   <li class="nav-item">
                <a href="logout.php" class="nav-link">تسجيل الخروج<i class="fas fa-sign-out-alt" style="font-size: large"></i></a>
            </li>
                ';

            } else {
                echo '
                
                   <li class="nav-item">
                <a href=" home.php" class="nav-link">الصفحه الرئيسيه<i class="fas fa-home" style="font-size: large"></i></a>
            </li>
            <li class="nav-item">
                <a href=" student_result.php" class="nav-link">لستخراج نتيجه الطالب<i class="fas fa-user-graduate" style="font-size: large"></i></a>
            </li>
            
             <li class="nav-item">
                <a href=" login.php" class="nav-link">تسجيل الدخوب<i class="fas fa-sign-in-alt" style="font-size: large"></i></a>
            </li>
            
            
            
            
                ';
            }


            ?>

        </ul>

    </div>


</nav>