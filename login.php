<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <style>
    html{
        background-color:rgb(78, 140, 182);
        font-family:cursive;
        text-align: center;
    }
    h1{
        font-size: 50px;
        color:white;
        text-transform: capitalize;
    }
    p{
        font-size: 30px;
        color: whitesmoke;
    }
    .form{
        padding: 5px;
        text-align: center;
        border: 3px solid white;

    }
    </style>
    
</head>
<body>
    <?php
    $servername="localhost";
    $username="root";
    $password="";
    $database_name="mydb";

    $conn=mysqli_connect($servername,$username,$password,$database_name);

    //now check for connection
    if(!$conn){
        die("connection failed:".mysqli_connect_error());
    }

    $name="";

    if(isset($_POST['save'])){
        $name = $_POST['save'];
    }
    $sql_query = "select * from customer where Name = '$name'";
    $result = mysqli_query($conn,$sql_query);
    $element =mysqli_fetch_assoc($result);
    ?>
    <h1>USER DETAILS</h1>
    <p><b>Id : </b><?php echo $element['id'] ?></p>
    <p><b>Name : </b><?php echo $element['Name'] ?></p>
    <p><b>Balance : </b><?php echo $element['balance'] ?> Rs</p>
    <hr>
    <h1>Transfer Money</h1>
    <div class="form" id="form">
        <script>
            function check_amount(){
                if (parseInt(document.getElementById('amt').value) > parseInt("<?php echo $element['balance'];?>")){
                    alert('You don\'t have enough amount');
                    return false;
                }
                if (document.getElementById('amt').value =='0' ){
                    alert('Please enter a valid amount');
                    return false;
                }
            }
        </script>
        <form action="transfer.php" method ="post" onsubmit="return check_amount()">
            <br>
            <input type="text" name="u1" id='u1' value="<?php echo $element['Name'] ?>" style="display: none;">
            <label style="color: whitesmoke; margin: 20px;">Transfer to :</label>
            <select name="u2" id="u2" required>
                <option value="">--Select a user--</option>
                <?php
                $sql_query2 = "select * from customer where Name != '$name'";
                $result2 = mysqli_query($conn,$sql_query2);
                $noRow= mysqli_num_rows($result2);
                for ($i=0; $i < $noRow; $i++) {
                    $element2 =mysqli_fetch_assoc($result2);
                    echo "<option value=".$element2['Name'].">".$element2['Name']."</option>";
                }
                ?>
            </select>
            <br>
            <br>
            <label style="color: whitesmoke; padding: 20px;">Amount : </label>
            <input type="number" name="amount" id="amt" required>
            <br>
            <label style="position: relative; margin:10px; top:50px;"><input type="submit" value="Transfer" name="save"></label>
        </form>
    </div>
    
</body>
</html>