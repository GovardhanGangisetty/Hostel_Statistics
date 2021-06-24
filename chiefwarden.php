<?php
session_start();
error_reporting(0);
require_once 'connection.php';
if(!isset($_SESSION['login_check_warden'])){
  header("location:index.php");
}
if(isset($_POST['submit'])){
  $dateofday = $_POST['dateofday'];
  $dateofday = mysqli_real_escape_string($db,$dateofday);

}
?>

<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<title>Chief Warden</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <script src="bootstrap/jquery/3.5.1/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style type="text/css">
    .body
    {
      height: 650px;
      margin-top: 20px;
      text-align: center;
      /*background: -webkit-linear-gradient(left, #00c6ff, #3931af);*/
      border-radius: 50px;
    }
    .date
    {
      border-radius: 10px;
      margin-top: 100px;
      width: 150px;
    }
    .submit
    {
      width: 250px;
      padding: 10px;
      border-radius: 25px;
      justify-content: center;
      font-weight: bold;
      font-size: 15px;
      color: #000;

    }


    body {margin:0;font-family:Arial}

    .topnav {
      overflow: hidden;
      background-color: #333;
    }

    .topnav a {
      float: left;
      display: block;
      color: #f2f2f2;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
      font-size: 17px;
    }

    .active {
      background-color: #04AA6D;
      color: white;
    }

    .topnav .icon {
      display: none;
    }

    .dropdown {
      float: left;
      overflow: hidden;
    }

    .dropdown .dropbtn {
      font-size: 17px;    
      border: none;
      outline: none;
      color: white;
      padding: 14px 16px;
      background-color: inherit;
      font-family: inherit;
      margin: 0;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
    }

    .dropdown-content a {
      float: none;
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
      text-align: left;
    }

    .topnav a:hover, .dropdown:hover .dropbtn {
      background-color: #555;
      color: white;
    }

    .dropdown-content a:hover {
      background-color: #ddd;
      color: black;
    }

    .dropdown:hover .dropdown-content {
      display: block;
    }

    @media screen and (max-width: 600px) {
      .topnav a:not(:first-child), .dropdown .dropbtn {
        display: none;
      }
      .topnav a.icon {
        float: right;
        display: block;
      }
    }

    @media screen and (max-width: 600px) {
      .topnav.responsive {position: relative;}
      .topnav.responsive .icon {
        position: absolute;
        right: 0;
        top: 0;
      }
      .topnav.responsive a {
        float: none;
        display: block;
        text-align: left;
      }
      .topnav.responsive .dropdown {float: none;}
      .topnav.responsive .dropdown-content {position: relative;}
      .topnav.responsive .dropdown .dropbtn {
        display: block;
        width: 100%;
        text-align: left;
      }
    }

    table,th,td{
      border: 1px solid white;
    }
    
  </style>

    <script>
        function myFunction() {
              var x = document.getElementById("myTopnav");
              if (x.className === "topnav") {
                        x.className += " responsive";
                  }
              else {
                    x.className = "topnav";
                   }
                  }
  </script>
</head>

<body style="background: -webkit-linear-gradient(left, #3931af,#00c6ff);">
                              <div class="topnav" id="myTopnav">
                                <a style="cursor: default;color: white">Home</a>
                                <a href="about.html">Contact</a>
                                <a href="logout.php">Logout</a>
                                <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
                              </div>

  <div class="container">
    <div class="row body">
      <div class="col-md-12">
        <form method="post" action="chiefwarden.php">
          <div class="form-group">
            <input type="date" name="dateofday" class="date">
          </div>
          <div class="form-group">
            <input type="submit" name="submit" class="submit" target="_self">
          </div>
        </form>

        <div>
        <table style="position: relative; margin-left: 250px;">
          <tr>
            <th>S.NO</th>
            <th>Total Students</th>
            <th>InCampus</th>  
            <th>Outing</th>
            <th>Onleave</th>
            <th>InSick</th>
            <th>Date</th>
            <th>Caretaker</th>
          </tr>
          <?php 
              $sql ="SELECT * FROM student_details WHERE dateofday='$dateofday'";
              $sql = mysqli_query($db,$sql);
              if(mysqli_num_rows($sql)>0){
                $c=1;
                while($row = mysqli_fetch_array($sql)){
                  echo'<tr><td style="padding-left:50px">'.$c++.'</td><td>'.$row['total'].'</td><td>'.$row['incampus'].'</td><td>'.$row['onleave'].'</td><td>'.$row['onouting'].'</td><td>'.$row['insick'].'</td><td>'.$row['dateofday'].'</td><td>'.$row['designation'].'</td></tr>';
                }

                   $sql ="SELECT * FROM gstudent_details WHERE dateofday='$dateofday'";
                  $sql = mysqli_query($db,$sql);
                  if(mysqli_num_rows($sql)>0){
                    $c=1;
                    while($row = mysqli_fetch_array($sql)){
                      echo'<tr><td style="padding-left:50px">'.$c++.'</td><td>'.$row['total'].'</td><td>'.$row['incampus'].'</td><td>'.$row['onleave'].'</td><td>'  .$row['onouting'].'</td><td>'.$row['insick'].'</td><td>'.$row['dateofday'].'</td><td>'.$row['designation'].'</td></tr>';
                    }
                  }
            }
              else{
                echo '<tr><td colspan=7>No Data Found on '.$dateofday.'</td></tr>';
              }

          ?>
        </table>
      </div>
    </div>
      </div>
   </div>
  </div>
</body>
</html>