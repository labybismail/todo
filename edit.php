<?php
session_start();

if(isset($_GET['idToEdit'])){


    $listFetch = file_get_contents('array.json');
    $array_fetched = json_decode($listFetch, true);
   
    if(isset($_POST['submitUpdate'])){
    
        if(isset($_POST['titleChange'])&&isset($_POST['completedChange'])){

            foreach ($array_fetched as $key => $value) {
                if ($value['title'] == $_GET['idToEdit']) {
                    $array_fetched[$key]['title'] = $_POST['titleChange'];
                    $array_fetched[$key]['completed'] = $_POST['completedChange'];
                }
            }
            file_put_contents('array.json', json_encode($array_fetched));
            header('Location:index.php');
            
        }else{
            echo 'fields are empty';
            header('Refresh:0');
        }
    }

    foreach($array_fetched as $value){

        if($value['title']==$_GET['idToEdit']){
            echo '
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-7 mx-auto rounder-4 d-flex  justify-content-center align-items-center" style="height:100vh;">
                        <form  method="post" class="d-flex flex-column  justify-content-center align-items-center bg-light" style="height:40%;width:60%;border-radius:10px;">
                            <input type="text" name="titleChange" class="form-control" style="width:50%;" value="'.$value['title'].'"/>
                            <div class="m-3 ">
                                completed : <input type="radio" name="completedChange" value="YES" />
                                 Not yet : <input type="radio" name="completedChange" value="NO" />
                            </div>
                            <button class=" mt-3 btn btn-success btn-rounded btn-md" name="submitUpdate">update</button>
                        </form>
                    </div>
                </div>
            </div>
            
            ';
        }
    }
}
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style>
      .row{
      background: radial-gradient(50% 123.47% at 50% 50%, #00ff94 0%, #720059 100%),
        linear-gradient(121.28deg, #669600 0%, #ff0000 100%),
        linear-gradient(360deg, #0029ff 0%, #8fff00 100%),
        radial-gradient(100% 164.72% at 100% 100%, #6100ff 0%, #00ff57 100%),
        radial-gradient(100% 148.07% at 0% 0%, #fff500 0%, #51d500 100%);
      background-blend-mode: screen, color-dodge, overlay, difference, normal;}
</style>