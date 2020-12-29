<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body {
            font: 14px sans-serif;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    </div>
    <p>
        <form id="theForm" method="post" action="./store/store.php">
            <a href="./customer/customer.php" class="btn btn-primary" style="display:<?php if ($_SESSION["id"] != "1") echo 'none'; ?>">編輯客戶資料</a>
            <a href="./motor/motor.php" class="btn btn-success" style="display:<?php if ($_SESSION["id"] != "1") echo 'none'; ?>">編輯機車列表</a>
            <input type="button" class="btn btn-info" value="<?php if ($_SESSION["id"] == "1") echo '編輯分行列表';
                                                                else echo '可租機車查詢'; ?>">
            <input type="hidden" name="userID" id="userID">
            <a href="reset.php" class="btn btn-warning">重設密碼</a>
            <a href="logout.php" class="btn btn-danger">登出</a>
        </form>



    </p>

</body>

</html>
<script type="text/javascript" language="javascript">
    $(document).on('click', '.btn-info', function() {

        var UserID = <?php echo $_SESSION["id"]; ?>;
        console.log(UserID);
        //Session['StoreID'] = id;


        var content = document.getElementById('userID');
        var form = document.getElementById('theForm');
        content.value = UserID; // based on your example, obviously you need a value based on the click

        console.log(UserID);

        form.submit();
    });
    /*
        $(document).ready(function() {
            $(document).on('click', '.btn-info', function() {
                var UserID = <?php echo $_SESSION["id"]; ?>;
                console.log(UserID);
                
                $.ajax({
                    url: "./store/store.php",
                    method: "POST",
                    data: {
                        UserID: UserID
                    },
                    success: function(data) {
                        
                    }
                });
                
            });
        });
    */
</script>