
<?php
session_start();
if(!isset($_SESSION["username"])){
    header("Location: login.php");
    exit(); }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Welcome Home</title>
    <link rel="stylesheet" href="css/style.css" />
    <?php require 'partial/header.php'?>
</head>
<body>

<div class="container">
    <?php require  'partial/navigation_bar.php'?>
</div>
<div class="container-fluid mt-5">

    <div class="row">

    </div>

</div>



<div class="form">
    <p>Welcome <?php echo $_SESSION['username']; ?>!</p>
    <p>This is secure area.</p>
    <p><a href="dashboard.php">Dashboard</a></p>
    <a href="logout.php">Logout</a>
</div>
</body>
<?php require 'partial/footer.php'?>

</html>