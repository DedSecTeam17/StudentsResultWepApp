
<?php
//include auth.php file on all secure pages
include("auth.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Welcome Home</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>

<!--add new school system data   -->





<div class="form">
    <p>Welcome <?php echo $_SESSION['username']; ?>!</p>
    <p>This is secure area.</p>
    <p><a href="dashboard.php">Dashboard</a></p>
    <a href="logout.php">Logout</a>
</div>
<?php require 'partial/footer.php'?>

</body>
</html>