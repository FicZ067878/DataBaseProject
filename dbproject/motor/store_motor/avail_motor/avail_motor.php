<?php
print_r($_POST);
?>
<html>


<head>
    <title>Motorcycle</title>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f1f1f1;
        }

        .box {
            width: 1270px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 25px;
            box-sizing: border-box;
        }
    </style>
</head>

<body>
    <div class="container box">
        <h1 align="center">Edit motorcycle information of store</h1>
        <br />
        <div class="table-responsive">
            <br />
            <div align="right">
                <button type="button" name="add" id="add" class="btn btn-info">Add</button>
                <button type="button" name="back" id="back" class="btn btn-info">Back</button>
            </div>
            <br />
            <div id="alert_message"></div>
            <table id="user_data" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Displacement</th>
                        <th>StoreID</th>
                        <th>Description</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</body>

</html>

<script type="text/javascript" language="javascript">
    $(document).ready(function() {

        fetch_avail_motor();

        function fetch_avail_motor() {
            var storeID = <?php echo $_POST['storeID']; ?>;
            console.log(storeID);

            var dataTable = $('#user_data').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "fetch_avail_motor.php",
                    type: "POST",
                    data: {
                        storeID: storeID
                    }
                }
            });


        }


        function update_data(id, column_name, value) {
            $.ajax({
                url: "../update.php",
                method: "POST",
                data: {
                    id: id,
                    column_name: column_name,
                    value: value
                },
                success: function(data) {
                    $('#alert_message').html('<div class="alert alert-success">' + data + '</div>');
                    $('#user_data').DataTable().destroy();
                    fetch_avail_motor();
                }
            });
            setInterval(function() {
                $('#alert_message').html('');
            }, 5000);
        }

        $(document).on('blur', '.update', function() {
            var id = $(this).data("id");
            var column_name = $(this).data("column");
            var value = $(this).text();
            update_data(id, column_name, value);
        });

        $('#add').click(function() {
            var html = '<tr>';
            html += '<td contenteditable id="data1"></td>';
            html += '<td contenteditable id="data2"></td>';
            html += '<td contenteditable id="data3"></td>';
            html += '<td contenteditable id="data4"></td>';
            html += '<td contenteditable id="data5"></td>';
            html += '<td contenteditable id="data6"></td>';
            html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
            html += '</tr>';
            $('#user_data tbody').prepend(html);
        });

        $(document).on('click', '#insert', function() {
            var ID = $('#data1').text();
            var name = $('#data2').text();
            var price = $('#data3').text();
            var disp = $('#data4').text();
            var SID = $('#data5').text();
            var des = $('#data6').text();
            if (ID != '' && name != '' && price != '' && disp != '' && SID != '') {
                $.ajax({
                    url: "../insert.php",
                    method: "POST",
                    data: {
                        ID: ID,
                        Name: name,
                        Price: price,
                        Displacement: disp,
                        StoreID: SID,
                        Description: des
                    },
                    success: function(data) {
                        $('#alert_message').html('<div class="alert alert-success">' + data + '</div>');
                        $('#user_data').DataTable().destroy();
                        fetch_avail_motor();
                    }
                });
                setInterval(function() {
                    $('#alert_message').html('');
                }, 5000);
            } else {
                alert("All Fields is required");
            }
        });

        $(document).on('click', '.rent', function() {
            var UserID = <?php echo $_POST['userID']; ?>;
            var RentMotorID = $(this).attr("id");
            if (confirm("Are you sure you want to rent this?")) {

                $.ajax({
                    url: "rent.php",
                    method: "POST",
                    data: {
                        UserID: UserID,
                        RentMotorID: RentMotorID
                    },
                    success: function(data) {
                        $('#alert_message').html('<div class="alert alert-success">' + data + '</div>');
                        $('#user_data').DataTable().destroy();
                        fetch_avail_motor();
                    }
                });
                setInterval(function() {
                    $('#alert_message').html('');
                }, 5000);

            }
        });

        $('#back').click(function() {
            window.history.back();
        });
    });
</script>