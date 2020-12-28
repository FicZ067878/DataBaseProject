<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    </div>
    <p>
        <a href="./customer/customer.html" class="btn btn-primary" style="display:<?php if($_SESSION["id"] != "1") echo 'none'; ?>">編輯客戶資料</a>
        <a href="./motor/motor.html" class="btn btn-success" style="display:<?php if($_SESSION["id"] != "1") echo 'none'; ?>">編輯機車列表</a>
        <a href="./store/store.html" class="btn btn-info" style="display:<?php if($_SESSION["id"] != "1") echo 'none'; ?>">編輯分行列表</a>
        <a href="reset.php" class="btn btn-warning">重設密碼</a>
        <a href="logout.php" class="btn btn-danger">登出</a>
    </p>
    
</body>
</html>