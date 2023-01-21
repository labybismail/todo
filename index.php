<?php
session_start();
if(!isset($_SESSION['isLogged'])){
    header('Location:./account/login.php');
    
}else{

    echo 'you are logged <form method="post"><button type="submit" name="signout">signOut</button></form>';

    if(isset($_POST['signout'])){
        session_destroy();
        header('Location:account/login.php');
    }
    
}