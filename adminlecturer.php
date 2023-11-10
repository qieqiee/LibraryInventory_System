<?php
session_start();
include("connect.php");
unset($_SESSION['roomid_new']);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
</head>
<style>
     body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
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

        /* Logo ------------------------------------------ */

        .logo {
            margin-top: 0.4rem;
            width: 8rem;
        }

        h1 {
            font-size: 24px;
        }
        table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 80%;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        table th {
            background-color: #f2f2f2;
        }
        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        table tr:hover {
            background-color: #ddd;
        }
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
        }
        .btn-update {
            background-color: black;
            color: white;
        }
        .btn-delete {
            background-color: #e50914;
            color: white;
        }
        .btn-add {
            align-items: center;
            justify-content: center;
            text-align: center;
            cursor: pointer;
            font-size: 1.1em;
            font-family: inherit;
            font-weight: inherit;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #e50914;
            color: white;
            height: 3.2rem;
            max-width: 100%;
        }
        .btn-home {
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            color: black;
            padding: 10px 20px;
        }
        .btn-home i {
            margin-right: 5px;
        }
</style>
<body>
<nav class="nav nav-3">
      <a href="">
        <img class="logo" src="https://seeklogo.com/images/K/kolej-profesional-mara-logo-18EC62113B-seeklogo.com.png" alt="" />
      </a>
      <a href="adminmenu.html" class="btn-home">
        <i class="fa fa-home" aria-hidden="true"></i>
    </a>
    </nav>
    <h1>LECTURER DATABASE</h1>

       <!-- Check if a message is present in the URL parameters and show an alert -->
       <?php
        if (isset($_GET['message'])) {
        echo '<script>alert("' . htmlspecialchars($_GET['message']) . '")</script>';
    }
    ?>

    <!-- Display a list of products with links to update and delete them -->
    <table>
        <tr>
            <th>STAFF ID</th>
            <th>password</th>
            <th>action</th>
        </tr>

        
        <?php
        // Connect to the database
        $conn = new mysqli("localhost", "root", "", "library_inventory");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch product records from the database
        $sql = "SELECT * FROM lecturers";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['staffId'] . "</td>";
                echo "<td>" . $row['password'] . "</td>";
                echo "<td>";
                echo "<form action='adminlecturer.php' method='post'><input type='hidden' value='".$row['staffId']."' name='staffId'/> <button class='btn-update' type='submit' name='update'>Update</button></form>";
                echo "<form action='adminlecturer.php' method='post'><input type='hidden' value='".$row['staffId']."' name='staffId'/> <button class='btn-delete' type='submit' name='delete'>Delete</button></form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No staff found.</td></tr>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </table>

    <form action="add_staff.php" method="get">
        <button class="btn-add" type="submit">Add Lecturer</button>
    </form>

    <?php 

if(isset($_POST['update']))
{
    
    $staffId=$_POST['staffId'];
    $_SESSION['staffId_new']=$staffId;

    echo '<script>window.location.href = "updatestaff.php";</script>';
   
}


if(isset($_POST['delete']))
{
    include("connect.php");
    $staffId=$_POST['staffId'];

   $sql= "DELETE FROM `lecturers` where staffId = '$staffId' ";

   $result=mysqli_query($conn,$sql);
   echo '<script>alert("StaffId Deleted successfully.");</script>';
 echo '<script>window.location.href = "adminlecturer.php";</script>';
   
}

?>
</html>
</body>
