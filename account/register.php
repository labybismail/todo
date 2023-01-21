<?php
session_start();
require '../db/connectdb.php';
if($_SESSION['isLogged']=='YES'){
    header('Location:../index.php');
}else{

if(isset($_POST['submitBtn'])){
    $emailRegister    =$_POST['emailRegister'];
    $usernameRegister =$_POST['usernameRegister'];
    $passwordRegister =$_POST['passwordRegister'];

    $uppercase = preg_match('@[A-Z]@', $passwordRegister);
    $lowercase = preg_match('@[a-z]@', $passwordRegister);
    $number    = preg_match('@[0-9]@', $passwordRegister);

    if(empty($emailRegister)){
        echo '<script>alert("mail cannot be empty")</script>';    
    }else{
        if (!filter_var($emailRegister, FILTER_VALIDATE_EMAIL)) {
            echo '<script>alert("email not available")</script>';
        }
    }
    if(empty($usernameRegister)){
        echo '<script>alert("username cannot be empty")</script>';    
    }else{
        if (!preg_match("/^[a-zA-Z-' ]*$/",$usernameRegister)) {
            echo '<script>alert("username not available")</script>';
        }
    }
    if(empty($passwordRegister)){
        echo '<script>alert("password cannot be empty")</script>';
    }else{
        if(!$uppercase || !$lowercase || !$number || strlen($passwordRegister) < 8) {
            echo '<script>alert("password should contain 8 characters no special chars")</script>';
        }
    }

    if(filter_var($emailRegister, FILTER_VALIDATE_EMAIL) && preg_match("/^[a-zA-Z-' ]*$/",$usernameRegister) && $uppercase ==true && $lowercase ==true && $number ==true && strlen($passwordRegister) > 8){

        $sql="INSERT INTO users (username,email,password) 
            VALUES (:user,:mail,:pass)";
        $stmt= $conn->prepare($sql);
        $stmt->execute(array(
            'mail'=> $emailRegister,
            'user'=> $usernameRegister,
            'pass'=> $passwordRegister
        ));
        header('Location:login.php');
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
    <title>Register</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>body {
  background: #C5E1A5;
    }form {
    width: 60%;
    margin: 60px auto;
    background: #efefef;
    padding: 60px 120px 80px 120px;
    text-align: center;
    -webkit-box-shadow: 2px 2px 3px rgba(0,0,0,0.1);
    box-shadow: 2px 2px 3px rgba(0,0,0,0.1);
    }label {
    display: block;
    position: relative;
    margin: 40px 0px;
    }.label-txt {
    position: absolute;
    top: -1.6em;
    padding: 10px;
    font-family: sans-serif;
    font-size: .8em;
    letter-spacing: 1px;
    color: rgb(120,120,120);
    transition: ease .3s;
    }.input {
    width: 70%;
    padding: 10px;
    background: transparent;
    border: none;
    outline: none;
    }.line-box {
    position: relative;
    width: 100%;
    height: 2px;
    background: #BCBCBC;
    }.line {
    position: absolute;
    width: 0%;
    height: 2px;
    top: 0px;
    left: 50%;
    transform: translateX(-50%);
    background: #8BC34A;
    transition: ease .6s;
    }.input:focus + .line-box .line {
    width: 100%;
    }.label-active {
    top: -3em;
    }button {
    display: inline-block;
    padding: 12px 24px;
    background: rgb(220,220,220);
    font-weight: bold;
    color: rgb(120,120,120);
    border: none;
    outline: none;
    border-radius: 3px;
    cursor: pointer;
    transition: ease .3s;
    }button:hover {
    background: #8BC34A;
    color: #ffffff;
    }</style>   
</head>
<body>
    

    <form action='' method='POST'>
        <label>
            <p class="label-txt">EMAIL</p>
                <input type="text" class="input" name="emailRegister">
            <div class="line-box">
            <div class="line"></div>
            </div>
        </label>
        <label>
            <p class="label-txt">USERNAME</p>
                <input type="text" class="input" name="usernameRegister">
            <div class="line-box">
            <div class="line"></div>
            <span style="opacity:0.6;font-size:15px;">username contain only letters</span>
            </div>
        </label>
        <label>
            <p class="label-txt">PASSWORD</p>
                <input type="text" class="input" name="passwordRegister">
            <div class="line-box">
            <div class="line"></div>
            <span style="opacity:0.6;font-size:15px;">password contain 8 chars and at least 1 capital</span>
            </div>
        </label>
        <button type="submit" name="submitBtn">submit</button>
    </form>
</body>
</html>