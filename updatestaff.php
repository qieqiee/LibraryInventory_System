<?php
session_start();
include("connect.php");




$staffId_new = $_SESSION["staffId_new"];

$sql = "SELECT * FROM `lecturers` WHERE  `staffId` = '$staffId_new'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$staffId= $row['staffId'];
$password = $row['password'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Update lecturer</title>
</head>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 50px;
            width: 45%;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }
        input {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        button {
            background-color:red;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        .btn-home {
            background-color: red;
            border: 1px solid #ddd;
            color: white;
            padding: 10px 20px;
        }
        .btn-home i {
            margin-right: 5px;
        }
    </style>
<body>
    <a href="adminlecturer.php" class="btn-home">
        <i class="fa fa-chevron-left" aria-hidden="true"></i> 
    </a>

    <form action="updatestaff.php" method="post">
        <input type="text" value="<?php echo isset ($password) ? $password: ''; ?>" name="password">
        <button type="submit" name="save">save</button>
    </form>
    
</body>
<?php 
    if(isset($_POST['save'])){
        $staffId_new = $_SESSION["staffId_new"];
        $password = $_POST['password'];
        
        $sql2= "UPDATE  `lecturers` SET `password`= '$password' WHERE `lecturers`. `staffId` = '$staffId_new' ";
    
        $result2=mysqli_query($conn,$sql2);

        if ($result2) {
           
            echo '<script>alert("Data saved successfully.");</script>';
            echo '<script>window.location.href = "adminlecturer.php";</script>';

        
            // Success, data saved
           
        } else {
            // Error in SQL query
            echo '<script>alert("Error: ' . mysqli_error($conn) . '");</script>';
        }
    }

?>

</html>