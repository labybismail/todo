<?php
require 'config.php';
try {
    $conn= new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (PDOException $error) {
    echo $error->getMessage();
}
