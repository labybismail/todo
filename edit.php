<?php
session_start();

if(isset($_GET['idToEdit'])){

    
    $listFetch = file_get_contents('array.json');
    $array_fetched = json_decode($listFetch, true);
   
    if(isset($_POST['submitUpdate'])){
    
        if(isset($_POST['titleChange'])){

            foreach ($array_fetched as $key => $value) {
                if ($value['title'] == $_GET['idToEdit']) {
                    $array_fetched[$key]['title'] = $_POST['titleChange'];
                    $array_fetched[$key]['completed'] = $_POST['completedChange'];
                }
            }
            file_put_contents('array.json', json_encode($array_fetched));
            header('Location:index.php');
            
        }else{echo'var not found';}
    }

    foreach($array_fetched as $value){

        if($value['title']==$_GET['idToEdit']){
            echo '
            <form  method="post">
                <input type="text" name="titleChange" value="'.$value['title'].'"/>
                <input type="text" name="completedChange" value="'.$value['completed'].'" />
                <button name="submitUpdate">update</button>
            </form>
            
            ';
        }
    }
}
if($_GET['idToEdit']!=$_SESSION['check']){
    header('Location :index.php');
}