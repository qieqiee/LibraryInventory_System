<?php
session_start();
include("connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>ADD STAFF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }

          /* Nav ------------------------------------------- */

          .nav {
            position: relative;
            display: flex;
            align-items: center;
            width: 100%;
            z-index: 2;
        }
        .nav-3 {
            justify-content: space-between;
            border-bottom: 1px solid var(--color-flag);
        }

        div {
            background-color: #fff;
            width: 50%;
            margin: 2rem auto;
            padding: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }
        h2 {
            color: #333;
        }
        label {
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 0.5rem;
            margin: 0.5rem 0;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        input[type="submit"] {
            background-color: red;
            color: #fff;
            border: none;
            padding: 0.5rem 1rem;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div>
<?php
    if(isset($_POST['submitbutton'])){
      $staffId = $_POST["staffId"];
      $password = $_POST["password"];
      $sql = "INSERT INTO lecturers (staffId, password) VALUES ('$staffId', '$password');";
      $result = mysqli_query($conn,$sql);
      
      header("Location: adminlecturer.php");      
    }
?>

<div>
<nav class="nav nav-3">
    <a href="adminlecturer.php" class="btn-home">
        <i class="fa fa-chevron-left" aria-hidden="true"></i>
    </a>
</nav>
    <!-- Create (Add) Form -->
    <h2>Create (Add) Record</h2>
    <form action="add_staff.php" method="post">
        <label>Staff ID</label>
        <input type="text"name="staffId" required>
        <br>
        <label>password</label>
        <input  type="password" name="password" required>
        <br>
        <input type="submit" name="submitbutton" value="Add Record">
    </form>
</div>
</body>
</html>