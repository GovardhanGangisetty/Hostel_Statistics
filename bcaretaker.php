<?php
session_start();
if(!isset($_SESSION['login_check_bcare'])){
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

  $sql = "INSERT INTO student_details(total,incampus,onleave,onouting,insick,dateofday,designation)values
                              ('$total','$incampus','$onleave','$onouting','$insick','$dateofday','$desig')";
  if(mysqli_query($db,$sql)){
      $_SESSION['error']="Data Submitted Successfully";
      header("location:bcaretaker.php");  
  }
  else{
      $_SESSION['error']="Error found";
      header("location:bcaretaker.php");
  }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Boys CareTaker</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <meta http-equiv="X-UA-Compatible" content="IE-edge"> 
  <script src="bootstrap/jquery/3.5.1/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <style type="text/css">
  	.background
  	{
  		/*background: -webkit-linear-gradient(left, #00c6ff, #3931af);*/
  		height: 650px;
  		margin-top: 10px;
  		border-radius: 20px;
      text-align: center;
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
      margin-top: 50px;
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

/*ol{background-color:seagreen;
   width:100%;
   list-style-type:none;
   padding:0px;
   margin:0px;
   positon:fixed;
   top:0%;
   overflow:auto;}
li{display:inline-block;
  padding:20px;
  border-right:2px solid white
  }
li last-child{border-right:none;}
li a{text-decoration:none;
   color:pink;
   text-align:center;
   margin:1px 50px;
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

<body style="background: -webkit-linear-gradient(left, #00c6ff, #3931af);">
                              <div class="topnav" id="myTopnav">
                                <a style="cursor: default;color: white">Home</a>
                                <a href="about.html">Contact</a>
                                <a href="logout.php" >Logout</a>
                                <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
                              </div>
 
	<div class="container background">
		<div class="row text">
						<div class="col-md-6 offset-md-3 col-sm-6 offset-sm-3 col-xs-6 right">
              <?php if(isset($_SESSION['error'])){echo "<br><span>".$_SESSION['error']."</span>";} ?>
							<form method="post" action="bcaretaker.php" >
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
										<option name="Nagaraju" value="Nagaraju">P.V.Nagaraju</option>
										<option name="Koteswara Rao" value="Koteswara Rao">CH.Koteswara Rao</option>
                    <option name="Srinu Naik" value="Srinu Naik">M.Srinu Naik</option>
                    <option name="Ratna Kishore" value="Ratna Kishore">G.Ratna Kishore</option>
										
									</select>
								</div><br>
								<button class="btn btn-success btn-lg float-right" name="submit">Submit</button>
							</form>
						</div>
		</div>
		
	</div>
</body>
</html>