<?php
session_start();
if($_SESSION['isLogged']=='YES'){
    echo 'you are logged <form method="post"><button type="submit" name="signout">signOut</button></form>';
}else{
    header('Location:account/login.php');
}

if(isset($_POST['signout'])){
    session_destroy();
    header('Location:account/login.php');
}