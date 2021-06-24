<?php
session_start();
require_once 'connection.php';
if (isset($_POST['submit'])){
    $firstname = ucfirst($_POST['fn']);
    $lastname = $_POST['ln'];
    $password = $_POST['pwd'];
    $cpassword = $_POST['cpwd'];
    $gender = $_POST['gender'];
    $des = $_POST['selection'];

    $hostel = $_POST['hostel'];
    $email = $_POST['email'];
    $mobile = $_POST['number'];
    $securityQues = $_POST['security'];
    $securityAns = $_POST['answer'];

    $firstname = mysqli_real_escape_string($db,$firstname);
    $lastname = mysqli_real_escape_string($db,$lastname);
    $password = mysqli_real_escape_string($db,$password);
    $cpassword = mysqli_real_escape_string($db,$cpassword);
    $gender = mysqli_real_escape_string($db,$gender);
    $des = mysqli_real_escape_string($db,$des);
    $hostel = mysqli_real_escape_string($db,$hostel);
    $email = mysqli_real_escape_string($db,$email);
    $mobile = mysqli_real_escape_string($db,$mobile);
    $securityQues = mysqli_real_escape_string($db,$securityQues);
    $securityAns = mysqli_real_escape_string($db,$securityAns);

    if($password==$cpassword){
        $password=md5($password);
        if(!preg_match('/^[a-zA-Z\s]+$/', $firstname))

        {
            $_SESSION['error']="firstname should be only letters and spaces";
        }
        else{
                if(!preg_match('/^[a-zA-Z\s]+$/', $lastname))
                {
                    $_SESSION['error']="Lastname should be only letters and space";
                }
                else
                {

                    $sql = mysqli_query($db,"SELECT * from users where Email='$email'");
                    $row = mysqli_fetch_array($sql);
                    if ($row){
                        $_SESSION['error']="Already Registred, Please Login";
                        header("location:index.php");
                    }else{
                        $sql = "INSERT INTO users(Email,FirstName,LastName,Gender,Mobile,Hostel,designation,PassWord, SecQuestion, SecAnswer) values
                        ('$email','$firstname','$lastname','$gender','$mobile','$hostel','$des','$password','$securityQues','$securityAns')";
                        if(mysqli_query($db,$sql)){
                            $_SESSION['error']="Registration Completed, Please Login";
                            header("location:index.php");
                        }
                        else{
                            $_SESSION['error']="Error found";
                            header("location:registration.php");
                        }
                    }
                }
        }
    }
    else{
        $_SESSION['error']="Passwords doesn't match";
        header("location:registration.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Registration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="register.css">
  <script type="text/javascript" language="javascript">
      
      function check(input)
      {
            if(input.value !=document.getElementById('password').value)
            {
                input.setCustomValidity("Password must match");
            }
            else
            {
                input.setCustomValidity('');
            }
      }

      function email()
      {
        var email=document.f1.email.value;
        var reg3=/[A-z0-9]+@[A-z]{5,7}.[A-z]{2,3}/;
        var check5=email.match(reg3);
        if(check5==null)
        {
            alert("Invalid e-mail");
            return false;
        }
      }

      function firstname()
      {
        var fname=document.f1.fn.value;
        var reg1=/[A-z\s]{3,}/;
        var check1=fname.match(reg1);
        if(check1!=fname)
        {
            return false;
        }
      }

      function lastname()
      {
        var lname=document.f1.ln.value; 
        var reg2=/[A-z\W]{6,15}/
        var check2=lname.match(reg2);
        if(check2!=lname)
        {
            return false;
        }

      }
  </script>
</head>
<body style="background: linear-gradient(-135deg,#4158d0,#c850c0)">
  <div class="container register">
  	<div class="row">
                    <div class="col-md-3 register-left">
                        <h3>Welcome</h3>
                        <a href="index.php"><button >Login</button></a><br/>
                      </div>
                    <div class="col-md-9 register-right">
                                     <p style="text-align: center;font-weight: bold;">   <?php if(isset($_SESSION['error'])){echo "<br><span>".$_SESSION['error']."</span>";} ?> </p>
                                <div class="row register-form">
                                    <div class="col-md-6">
                                        <form action="registration.php" method="post" name="f1">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="First Name *" value="" name="fn" required oninput="firstname(this)" />
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Last Name *" value="" name="ln" required oninput="lastname(this)" />
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control" placeholder="Password *" value="" name="pwd" id="password" required />
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control"  placeholder="Confirm Password *" value="" name="cpwd" id="confirm" required oninput="check(this)" />
                                            </div>
                                            <div class="form-group">
                                                <div class="maxl">
                                                    <label class="radio inline"> 
                                                        <input type="radio" name="gender" value="male">
                                                        <span style="font-weight: bold;"> Male </span> 
                                                    </label>
                                                    <label class="radio inline"> 
                                                        <input type="radio" name="gender" value="female">
                                                        <span style="font-weight: bold;">Female </span> 
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control" name="selection" required>
                                                    <option class="hidden"  selected disabled>Select type</option>
                                                    <option name="caretaker" value="caretaker">Care Taker</option>
                                                    <option name="warden" value="warden">Warden</option>
                                                    <option name="chiefwarden" value="chiefwarden">Chief-Warden</option>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="col-md-6"> 
                                          <div class="form-group">
                                                <select class="form-control" name="hostel" required>
                                                    <option class="hidden"  selected disabled>Hostel</option>
                                                    <option name="i2" value="i2">I2</option>
                                                    <option name="i3" value="i3">I3</option>
                                                </select>
                                              </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control" placeholder="Your Email *" value="" name="email" required oninput="email(this)" />
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Phone Number" value="" name="number" required />
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control" name="security" required>
                                                    <option class="hidden"  selected disabled>Please select your Sequrity Question</option>
                                                    <option name="What is your Birthdate" value="What is your Birthdate">What is your Birthdate?</option>
                                                    <option name="What is Your Phone Number" value="What is Your Phone Number">What is Your Phone Number</option>
                                                    <option name="What is your Pet Name?" value="What is your Pet Name?">What is your Pet Name?</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Enter Your Answer " value="" name="answer" required />
                                            </div>
                                            <button class="btn btnRegister btn-success" name="submit">Register</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                    </div>
  <script src="bootstrap/jquery/3.5.1/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
