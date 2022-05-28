<?php
// Initialize the session
session_start();

if (isset($_SESSION['username'])){
    $username=$_SESSION['username'];
}
// Check if the user is logged in, if not then redirect him to login page
?>

 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .attendancesheet{float:left;
        width: 30%;
        padding: 1%;
        padding-top: 5%;
        margin-left:2%;}
        .btn{
            margin: 5%;
        }
        table{
            margin:3%;
            float:right;

        }
    </style>
</head>
<body>
    <h1 class="my-5">Hi, <b>admin</b>. Welcome to our site.</h1>
    <form method="post" action=""> 
    <button class="attendancesheet" type="submit" name="submit">
        <img src="https://icon-library.com/images/attendance-icon/attendance-icon-13.jpg" width="100%" height="100%">
        <h3>Check the Attendance</h3>
    </button>
    </form>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="HomePage.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>
    
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <table width="50%" border="1" cellspacing="0" cellpadding="3">
    <thead>
    <th>Id</th>
    <th>Enrolment</th>
    <th>NAME</th>
    <th>Date</th>
    <th>time</th>
    </thead>
<?php
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'face_reco_fill');
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    $sql="SELECT * FROM wost_2022_05_24_time_12_05_27 WHERE 1";
    if(isset($_POST['submit'])){
    $result=mysqli_query($link,$sql);
// Start looping rows in mysql database.
    while($rows=mysqli_fetch_array($result)){
    ?>
    <tr>
    <td width ="15%"><?php echo $rows['ID'] ?></td>
    <td width="15%"><?php echo $rows['ENROLLMENT']; ?></td>
    <td width="25%"><?php echo $rows['NAME']; ?> </td>
    <td width="31%"><?php echo $rows['DATE']; ?> </td>
    <td width="13%"><?php echo $rows['TIME']; ?> </td>
    </tr>

    <?php
    // close while loops
    }

    // close connection
    mysqli_close($link);
}
    ?>
    </table>
</body>
</html>