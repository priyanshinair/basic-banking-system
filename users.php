<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TSB | View all Customers</title>
    <style>
        html{
            background-color:rgb(78, 140, 182);
            font-family:cursive;
        }
        body{
            text-align: center;
        }
        table, th, td {
            border: 3px solid black;
            background-color:white;
            text-align: left;
        }
        th{
            padding:1%;
            background-color:white;
        }
        td{
            padding: .5%;
            text-transform: capitalize;
            background-color:white;
            color: black;
           
        }
        input{
            text-transform: capitalize;
            color:black;
            border-color: transparent;
            background-color: transparent;
        }
    </style>
</head>
<body>
    <h1 style="color: white;">OUR CUSTOMERS</h1>
    <p style="color:white; text-align:left;">To view user details, click on username....</p>
    <form action="login.php" method="POST">
    <table style="width:100%">
        <tr>
            <th>Id no.</th>
            <th>Name</th>
            <th>Balance</th>
        </tr>
        <?php
        $servername="localhost";
        $username="root";
        $password="";
        $database_name="mydb";
    
        $conn=mysqli_connect($servername,$username,$password,$database_name);
        if(!$conn){
            die("connection failed:".mysqli_connect_error());
        }

        $name = "";//for stiring username which is selected

        if(isset($_POST['save'])){
            $name = $_POST['name'];//to take username if give while calling
        }
        $sql_query = "select * from customer where Name != '$name'";
        $result = mysqli_query($conn,$sql_query);
        $nr= mysqli_num_rows($result);//no of rows in result
        for ($i=0; $i < $nr; $i++) { 
            $element =mysqli_fetch_assoc($result);
            echo "<tr><td>".$element['id']."</td>";
            echo "<td><input type=\"submit\" name=\"save\" value=".$element['Name']."></td>";
            echo "<td>".$element['balance']." Rs</td></tr>";
        }
        mysqli_close($conn);
        ?>
    </form>
    </table>
    <a href="index.html" style="position:relative; top: 30px; right: 44%; color:rgb(70, 194, 152) ; background-color: white;padding: 1%; text-decoration: solid; "> HOME</a>
</body>
</html>