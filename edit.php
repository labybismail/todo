<?php
if(isset($_GET['idToEdit'])){
$listFetch = file_get_contents('array.json');
$array_fetched = json_decode($listFetch, true);
if($_POST['submitUpdate']){
  
    if(isset($_POST['title'])&&isset($_POST['completed'])){
        foreach ($array_fetched as $key => $value) {
            if ($value['title'] == $_GET['idToEdit']) {
                $array_fetched[$key] = array('title'=>$_POST['title'],'completed'=> $_POST['completed']);
            }
        }
        file_put_contents('array.json', json_encode($array_fetched));
        header('Location :index.php');
    }
}
foreach($array_fetched as $value){

    if($value['title']==$_GET['idToEdit']){
        echo '
        <form method="post">
            <input type="text" name="title" value="'.$value['title'].'"/>
            <input type="text" name="completed" value="'.$value['completed'].'" />
            <button name="submitUpdate">update</button>
        </form>
        
        ';
    }
}


}

?>


