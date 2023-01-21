<?php
session_start();
$_SESSION['isLogged']="NO";
require '../db/connectdb.php';
if(isset($_POST['submitLogin'])){
    $emailLogin = $_POST['emailLogin'];
    $passwordLogin = $_POST['passwordLogin'];

    $uppercase = preg_match('@[A-Z]@', $passwordLogin);
    $lowercase = preg_match('@[a-z]@', $passwordLogin);
    $number    = preg_match('@[0-9]@', $passwordLogin);

    if(empty($emailLogin)){
        echo '<script>alert("mail cannot be empty")</script>';    
    }else{
        if (!filter_var($emailLogin, FILTER_VALIDATE_EMAIL)) {
            echo '<script>alert("email not valid")</script>';
        }
    }
    if(empty($passwordLogin)){
        echo '<script>alert("password cannot be empty")</script>';
    }else{
        if(!$uppercase || !$lowercase || !$number || strlen($passwordLogin) < 8) {
            echo '<script>alert("password should contain 8 characters no special chars")</script>';
        }
    }
    if(filter_var($emailLogin, FILTER_VALIDATE_EMAIL) &&$uppercase ==true && $lowercase ==true && $number ==true && strlen($passwordLogin) > 8){

        $stmt = $conn->prepare( "SELECT 1 FROM users WHERE `email` = :mail");
        $stmt->execute(array('mail'=>$emailLogin));
        $foundMail = $stmt->fetchColumn();
        
        if( $foundMail ) {
            
            
            $stmt = $conn->prepare( "SELECT password FROM users WHERE `email` = :mail");
            $stmt->execute(array('mail'=>$emailLogin));
            $foundPass = $stmt->fetchColumn();
            if($foundPass == $passwordLogin){
                $_SESSION['isLogged']="YES";
                $_SESSION['emailLogged']=$emailLogin;
                header('Location:../index.php');
            }else{
                echo '<script>alert("password incorrect")</script>';

            }


        } else {
            echo '<script>alert("email not found")</script>';
        }

    }

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <style></style>
</head>
<body>
    
<section class="vh-100">
  <div class="container-fluid">
    <div class="row vh-100">
      <div class="col-lg-4 my-lg-auto mx-lg-auto col-sm-6 text-black">


        <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">

          <form  method="post">

            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>

            <div class="form-outline mb-4">
              <input type="email" id="" name="emailLogin" class="form-control form-control-lg" />
              <label class="form-label" for="email">Email address</label>
            </div>

            <div class="form-outline mb-4">
              <input type="password" id="" name="passwordLogin" class="form-control form-control-lg" />
              <label class="form-label" for="password">Password</label>
            </div>

            <div class="pt-1 mb-4">
              <button class="btn btn-info btn-lg btn-block" name="submitLogin" type="submit">Login</button>
            </div>

            <p>Don't have an account? <a href="register.php" class="link-info">Register here</a></p>

          </form>

        </div>

      </div>
 
    </div>
  </div>
</section>

</body>
</html>