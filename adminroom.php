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
    <title>Room Database</title>
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
</head>
<body>
    <nav class="nav nav-3">
      <a href="">
        <img class="logo" src="https://seeklogo.com/images/K/kolej-profesional-mara-logo-18EC62113B-seeklogo.com.png" alt="" />
      </a>
      <a href="adminmenu.html" class="btn-home">
        <i class="fa fa-home" aria-hidden="true"></i>
    </a>
    </nav>
    <h1>ROOM MANAGEMENT</h1>

    <!-- Check if a message is present in the URL parameters and show an alert -->
    <?php
    if (isset($_GET['message'])) {
        echo '<script>alert("' . htmlspecialchars($_GET['message']) . '")</script>';
    }
    ?>

    <!-- Display a list of products with links to update and delete them -->
    <table>
        <tr>
            <th>ROOM ID</th>
            <th>name</th>
            <th>capacity</th>
            <th>action</th>
        </tr>

        <?php
        // Connect to the database
        $conn = new mysqli("localhost", "root", "", "library_inventory");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch product records from the database
        $sql = "SELECT * FROM rooms";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['roomid'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['capacity'] . "</td>";
                echo "<td>";
                echo "<form action='adminroom.php' method='post'><input type='hidden' value='".$row['roomid']."' name='roomid'/> <button class='btn-update' type='submit' name='update'>Update</button></form>";
                echo "<form action='adminroom.php' method='post'><input type='hidden' value='".$row['roomid']."' name='roomid'/> <button class='btn-delete' type='submit' name='delete'>Delete</button></form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No room found.</td></tr>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </table>

   <form action="add_room.php" method="get">
        <button class="btn-add" type="submit">Add Room</button>
    </form>
    
    <h1>ROOM BOOKING MANAGEMENT (STUDENT)</h1>

<!-- Check if a message is present in the URL parameters and show an alert -->
<?php
if (isset($_GET['message'])) {
    echo '<script>alert("' . htmlspecialchars($_GET['message']) . '")</script>';
}
?>

<!-- Display a list of products with links to update and delete them -->
<table>
    <tr>
        <th>Booking ID</th>
        <th>Student No</th>
        <th>Room no</th>
        <th>date</th>
        <th>check-in time</th>
        <th>check-out time</th>
        <th>action</th>
    </tr>

    <?php
    // Connect to the database
    $conn = new mysqli("localhost", "root", "", "library_inventory");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch product records from the database
    $sql = "SELECT * FROM roombook_stud";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['bookingid'] . "</td>";
            echo "<td>" . $row['studNo'] . "</td>";
            echo "<td>" . $row['roomid'] . "</td>";
            echo "<td>" . $row['date'] . "</td>";
            echo "<td>" . $row['checkin_time'] . "</td>";
            echo "<td>" . $row['checkout_time'] . "</td>";
            echo "<td>";
            echo "<form action='adminroom.php' method='post'><input type='hidden' value='".$row['bookingid']."' name='bookingid'/> <button class='btn-delete' type='submit' name='delete'>Delete</button></form>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No booking found.</td></tr>";
    }

    // Close the database connection
    $conn->close();
    ?>
</table>
<h1>ROOM BOOKING MANAGEMENT (LECTURER)</h1>

<!-- Check if a message is present in the URL parameters and show an alert -->
<?php
if (isset($_GET['message'])) {
    echo '<script>alert("' . htmlspecialchars($_GET['message']) . '")</script>';
}
?>

<!-- Display a list of products with links to update and delete them -->
<table>
    <tr>
        <th>Booking ID</th>
        <th>Staff ID</th>
        <th>Room no</th>
        <th>date</th>
        <th>check-in time</th>
        <th>check-out time</th>
        <th>action</th>
    </tr>

    <?php
    // Connect to the database
    $conn = new mysqli("localhost", "root", "", "library_inventory");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch product records from the database
    $sql = "SELECT * FROM roombook_lect";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['bookingid'] . "</td>";
            echo "<td>" . $row['staffId'] . "</td>";
            echo "<td>" . $row['roomid'] . "</td>";
            echo "<td>" . $row['date'] . "</td>";
            echo "<td>" . $row['checkin_time'] . "</td>";
            echo "<td>" . $row['checkout_time'] . "</td>";
            echo "<td>";
            echo "<form action='adminroom.php' method='post'><input type='hidden' value='".$row['bookingid']."' name='bookingid'/> <button class='btn-delete' type='submit' name='delete'>Delete</button></form>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No booking found.</td></tr>";
    }

    // Close the database connection
    $conn->close();
    ?>
</table>

</body>
<?php 

if(isset($_POST['update']))
{
    
    $roomid=$_POST['roomid'];
    $_SESSION['roomid_new']=$roomid;

    echo '<script>window.location.href = "updateroom.php";</script>';
   
}


if(isset($_POST['delete']))
{
    include("connect.php");
    $roomid=$_POST['roomid'];

   $sql= "DELETE FROM `rooms` where roomid = '$roomid' ";

   $result=mysqli_query($conn,$sql);
   echo '<script>alert("Room Deleted successfully.");</script>';
 echo '<script>window.location.href = "adminroom.php";</script>';
   
}


if(isset($_POST['delete']))
{
    include("connect.php");
    $bookingid=$_POST['bookingid'];

   $sql= "DELETE FROM `roombook_stud` where bookingid = '$bookingid' ";

   $result=mysqli_query($conn,$sql);
   echo '<script>alert("Booking Deleted successfully.");</script>';
 echo '<script>window.location.href = "adminroom.php";</script>';
   
}

if(isset($_POST['delete']))
{
    include("connect.php");
    $bookingid=$_POST['bookingid'];

   $sql= "DELETE FROM `roombook_lect` where bookingid = '$bookingid' ";

   $result=mysqli_query($conn,$sql);
   echo '<script>alert("Booking Deleted successfully.");</script>';
 echo '<script>window.location.href = "adminroom.php";</script>';
   
}

?>


</html>
 
</body>

