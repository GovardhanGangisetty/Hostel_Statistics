<?php 
$err="";
session_start();
require_once"connection.php";
if(isset($_POST['login'])){
  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $des = $_POST['type'];
    $email = stripslashes($email);
    $password = stripslashes($password);
       
    $email = mysqli_real_escape_string($db,$email);
    $password = mysqli_real_escape_string($db,$password);

    $sql = mysqli_query($db,"SELECT * from users WHERE Email='$email' AND designation='$des'");
    $row = mysqli_fetch_array($sql);
    if($row){
      if($row['PassWord'] == $password){
        $_SESSION['error']="Login Successfull";
        
        // header("location:bcaretaker.php");
        if($row['designation'] =='chiefwarden' || $row['designation']=='warden'){
            header("location:chiefwarden.php");
            $_SESSION['login_check_warden'] = $email;
        }
        else{
          if($row['Gender']=='male'){
            header("location:bcaretaker.php");
            $_SESSION['login_check_bcare'] = $email;
          }
          else{
            header("location:gcaretaker.php");
            $_SESSION['login_check_gcare'] = $email;
          }
        }
      }
      else{
        header("location:index.php");
        $_SESSION['error']="Invalid Credentails";
      }
    }
    else{
      $_SESSION['error']="Account Not Found";
      header("location:index.php");
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>index</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="Customstyles.css">

  <!-- <script type="text/javascript">
    
    function validate()
    {
      var b;
      var a=document.f.type.value;
      alert(a);
    }
  </script> -->


</head>
<body style="background: -webkit-linear-gradient(left, #00c6ff, #3931af);">
  
  <div class="container login">
  	<div class="row">
  		  <div class="col-md-3 login-left">
            <img src="images/login_image.jpg" id="zoom" />
        </div>
        <div class="col-md-9">
          <div class="row login-form">
            <div class="col-md-6 offset-md-6">
              <form method="post" name="f" action="index.php" >
                    <div class="from-group">
                          <p>Welcome</p>
                          <?php 
                            if(isset($_SESSION['error'])){
                              echo "<br><span>".$_SESSION['error']."</span>"; 
                            }
                          ?>
                    </div>
                    
                    <div class="from-group">
                          <input type="text" name="email" placeholder="Email" required>
                    </div><br>
                    <div class="from-group">
                          <input type="password" name="password" placeholder="Password" required>
                    </div><br>
                    <div class="from-group">
                          <select class="form-control" name="type" required id="new">
                            <option class="hidden"  selected disabled>Select type</option>
                            <option name="caretaker" value="caretaker">Care Taker</option>
                            <option name="warden" value="warden">Warden</option>
                            <option name="chiefwarden" value="chiefwarden">Chief-Warden</option>
                          </select>
                    </div><br>
                    <button class="btn btn-success" formaction="index.php" name="login" id="gi"><strong>Login</strong></button>
                    <br><br>
                    <span class="account"><a href="registration.php">Create an account</a></span>
              </form>
            </div>
           
          </div>
        </div>
  		</div>
  </div>
  <script src="bootstrap/jquery/3.5.1/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>




</body>
</html>



