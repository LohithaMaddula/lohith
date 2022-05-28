<?php
if (isset($_POST['update']))
{
    exec("C:/Users/lohit/AppData/Local/Programs/Python/Python310/python.exe c:/Users/lohit/OneDrive/Documents/GitHub/LohithaMaddula.github.io/Attendace_management_system-master/AMS_Run.py");

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/Applications/XAMPP/xamppfiles/htdocs/FaceDetaction/home.css" rel="stylesheet">
    <title>Home</title>
</head>
<style>
    body {
    background-color: powderblue;
    }
    .Name{
        font: optional;
        font-family: Arial, Helvetica, sans-serif;
        align-content: center;
        background-color:darkgrey;
        color: aliceblue;
        align-items: center;
        align-self:end;
        margin-left: 30%;
        margin-right: 30%;
        padding:2%;
        float: inline-start;
    } 
    .takeAttendance{
        float: left;
        width: 40%;
        padding: 1%;
        padding-top: 5%;
        margin-left:8%;
    }
    .Teacherslogin{
        float: left;
        width: 36.5%;
        padding:1%; 
        padding-top: 5%;
    }
</style>
<body>
    <div class="Name">
    <h1>Attendance Management System</h1>
    </div>
    <div class="takeAttendance">
    <form method="post">
    <button type="submit" id="update" name="update">
        <img src="https://lh3.googleusercontent.com/CDtNdJO2JIbO2pk_5w4dEE_QxFIpm5VgOAdD7iWOVOnapAbf0N2ZyEYdZShax9QtZFwi" width="100%" height="100%">
        <h3>Take Your Attendance Here</h3>
    </button>
</form>
    </div>
    <div class="Teacherslogin">
        <a href="authentication.php">
        <button type="button" >
            <img src="https://images.squarespace-cdn.com/content/v1/5f7f7eb5889cb36dd8c93bd1/1609716547396-QGOO4L1P3CTLV83J95HO/Avatar.png" width="100%" height="100%">
            <h3>Teacher's login</h3>
        </button>
        </a>
    </div>
</body>
</html>
