<?php
session_start();
if(!isset($_SESSION['login_check_gcare'])){
   header("location:index.php");
}
if(isset($_POST['submit'])){
  require_once 'connection.php';
  $total = $_POST['Total_students'];
  $incampus  = $_POST['students_in_campus'];
  $onleave = $_POST['students_on_leave'];
  $onouting = $_POST['students_on_outing'];
  $insick = $_POST['students_in_sickroom'];
  $dateofday = strval($_POST['dateofday']);
  $desig = $_POST['desig'];

  $total = mysqli_real_escape_string($db,$total);
  $incampus = mysqli_real_escape_string($db,$incampus);
  $onleave = mysqli_real_escape_string($db,$onleave);
  $onouting = mysqli_real_escape_string($db,$onouting);
  $insick = mysqli_real_escape_string($db,$insick);
  $dateofday = mysqli_real_escape_string($db,$dateofday);
  $desig = mysqli_real_escape_string($db,$desig);

  $sql = "INSERT INTO gstudent_details(total,incampus,onleave,onouting,insick,dateofday,designation)values
                              ('$total','$incampus','$onleave','$onouting','$insick','$dateofday','$desig')";
  if(mysqli_query($db,$sql)){
      $_SESSION['error']="Data Submitted Successfully";
      header("location:gcaretaker.php");  
  }
  else{
      $_SESSION['error']="Error found";
      header("location:gcaretaker.php");
  }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Girls CareTaker</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="bootstrap/jquery/3.5.1/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

  <script type="text/javascript">
    
     /* $(document).ready(function(){
          $(".dropdown").hover(function(){
              var dropdownMenu = $(this).children(".dropdown-menu");
              if(dropdownMenu.is(":visible")){
                  dropdownMenu.parent().toggleClass("open");
              }
          });
      });*/
  </script>
                              <script>
                              function myFunction() {
                                var x = document.getElementById("myTopnav");
                                if (x.className === "topnav") {
                                  x.className += " responsive";-
                                } else {
                                  x.className = "topnav";
                                }
                              }
                              </script>

  <style type="text/css">
  	.background
  	{
  		/*background: -webkit-linear-gradient(left, #00c6ff, #3931af);*/
  		height: 650px;
  		margin-top: 10px;
  		border-radius: 20px;
  	}
  	.form
  	{
  		margin-top: 50px;
  	}
  	.left
  	{
  		height: 650px;
  		text-align: right;
  		padding-top: 50px;
  	}
  	.right
  	{
  		height: 650px;
  		padding-top: 50px;
  	}

  	.row .left p
  	{
  		margin-top: 20px;
  		padding-bottom: 8px;
  		font-weight: bold;
  	}
  	.row .right input
  	{
  		border-radius: 20px;
      font-weight: bold;
  	}
  	.row .right button
  	{
  		border-radius: 10px;
  		margin-right: 50px;
  	}
    .row .right select
    {
      border-radius: 20px;
    }


    /*.dropdown:hover .dropdown-menu{
        display: block;
    }
    .dropdown-menu{
        margin-top: 0;
    }*/

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

  </style>
</head>

<body style="background: -webkit-linear-gradient(left, #00c6ff, #3931af);">

                              <div class="topnav" id="myTopnav">
                                <a style="cursor: default;color: white">Home</a>
                                <a href="about.html">Contact</a>
                                <a href="logout.php">Logout</a>
                                <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
                              </div>
	<div class="container background">
                  <!--<nav class="navbar navbar-expand-sm navbar-dark">
                  <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                      <span class="navbar-toggler-icon"></span>
                  </button>

                  <div class="collapse navbar-collapse" id="navbarCollapse">
                      <div class="navbar-nav">
                          <a href="" class="nav-item nav-link active">Home</a>
                          <a href="about.html" class="nav-item nav-link active">Contact</a>
                          <div class="nav-item dropdown ">
                              <a href="#" class="nav-link dropdown-toggle active" data-toggle="dropdown">Profile</a>
                              <div class="dropdown-menu">
                                  <a href="index.html" class="dropdown-item">Logout</a>
                              </div>
                          </div>
                      </div>
                  </div>
              </nav>-->


		<div class="row">

						<div class="col-md-6 offset-md-3 col-sm-6 offset-sm-3 col-xs-6 right">
              <?php if(isset($_SESSION['error'])){echo "<br><span>".$_SESSION['error']."</span>";} ?>
							<form method="POST" action="gcaretaker.php">
                <div class="form-group">
                  <input class="form-control" type="number" name="Total_students" required placeholder="Total no.of students">
                </div>
                <div class="form-group">
                  <input class="form-control" type="number" name="students_in_campus" style="margin-top: 20px;" required placeholder="Students In Campus">
                </div>
                <div class="form-group">
                  <input class="form-control" type="number" name="students_on_leave" required placeholder="Students On Leave">
                </div>
                <div class="form-group">
                  <input class="form-control" type="number" name="students_on_outing" required placeholder="Students On Outing">
                </div>
                <div class="form-group">
                  <input class="form-control" type="number" name="students_in_sickroom" required placeholder="Students in SickRoom">
                </div>
                <input class="form-control" type="date" name="dateofday" value="" required><br>
                <div class="form-group">
                  <select class="form-control" name="desig"  required>
                    <option class="hidden" selected disabled>Designation</option>
                    <option name="Susnna" value="Susnna">Mrs.Susnna</option>
                    <option name="Divya Vani" value="Divya Vani">Mrs.Divya Vani</option>
                    <option name="Kavitha" value="Kavitha">Ms.Kavitha</option>
                    <option name="Rathna Kumari" value="Rathna Kumari">Ms.Rathna Kumari</option>
                    
                  </select>
                </div><br>
								<button class="btn btn-success btn-lg float-right" name="submit">Submit</button>
							</form>
						
						</div>
		</div>
		
	</div>
</body>
</html>