<?php
// session_start();

// if(!isset($_SESSION['isLogged'])||$_SESSION['isLogged']=="NO"){
//     header('Location:account/login.php');
    
// }else{ -->

//     // echo 'you are logged <form method="post"><button type="submit" name="signout">signOut</button></form>'; -->
//     // if(isset($_POST['signout'])){
//     //     session_destroy();
//     //     header('Location:account/login.php');
//     // }
function fileWriteAppend(){
  $current_data = file_get_contents('array.json');
  $array_data = json_decode($current_data, true);
  $extra = array(
    'title'              =>     $_POST['addTask'],
    'completed'          =>     'NO'

  );
  $array_data[] = $extra;
  $final_data = json_encode($array_data);
  return $final_data;
}
function fileCreateWrite(){
  $file=fopen("array.json","w");
  $array_data=array();
  $extra = array(
    'title'               =>     $_POST['addTask'],
    'completed'          =>     'NO'
  );
  $array_data[] = $extra;
  $final_data = json_encode($array_data);
  fclose($file);
  return $final_data;
}
    if(isset($_POST['addBtn'])){
        
        if(isset($_POST['addTask'])){
          if(file_exists('array.json')){
            $final_data=fileWriteAppend();
            if(file_put_contents('array.json', $final_data)){
                  $message = "<label class='text-success'>Data added Success fully</p>";
            }
            }else{
                $final_data=fileCreateWrite();
                if(file_put_contents('array.json', $final_data))
                {
                      $message = "<label class='text-success'>File createed and  data added Success fully</p>";
                }
            }
        }else{
          echo 'field cannot be empty';
        }
          
    }

   

$listFetch = file_get_contents('array.json');
$array_fetched = json_decode($listFetch, true);






?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        .gradient-custom {
      background: radial-gradient(50% 123.47% at 50% 50%, #00ff94 0%, #720059 100%),
        linear-gradient(121.28deg, #669600 0%, #ff0000 100%),
        linear-gradient(360deg, #0029ff 0%, #8fff00 100%),
        radial-gradient(100% 164.72% at 100% 100%, #6100ff 0%, #00ff57 100%),
        radial-gradient(100% 148.07% at 0% 0%, #fff500 0%, #51d500 100%);
      background-blend-mode: screen, color-dodge, overlay, difference, normal;}
    </style>
</head>
<body>
<section class=" gradient-custom" style="height:100vh;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">

        <div class="card">
          <div class="card-body p-5">

                    <!-- form -->
            <form method='POST' class="d-flex justify-content-center align-items-center mb-4">
              <div class="form-outline flex-fill">
                <input type="text" id="addTask" class="form-control" name='addTask'  />
                <label class="form-label" for="form2">New task...</label>
              </div>
              <button type="submit" class="btn btn-info ms-2" id="addBtn" name='addBtn' >Add</button>
            </form> 
                    <!-- form -->

            <!-- Tabs navs -->
            <?php
            if(isset($_POST['notDoneTasks'])){$currentState="NO";}
            else if(isset($_POST['doneTasks'])){$currentState="YES";}
            else{$currentState="";} 
            ?>
            <form method="post">
              <ul class="nav nav-tabs mb-4 pb-2 d-flex" id="ex1" role="tablist">
              
                <li class="nav-item" role="presentation">
                <button class="btn btn-primary m-1" name="allTasks">All</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="btn btn-primary m-1" name="notDoneTasks">Active</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="btn btn-primary m-1" name='doneTasks'>Completed</button>
                </li>

              </ul>
            </form>
            <!-- Tabs navs -->

            <!-- Tabs content -->
            <div class="tab-content" id="ex1-content">
              <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel"
                aria-labelledby="ex1-tab-1">
                <ul class="list-group mb-0">

                    <?php
                      foreach($array_fetched as $value){
                       if($value['completed']==$currentState){continue;}
                       else{
                        echo '
                        <li class="list-group-item d-flex align-items-center justify-content-center border-0 mb-1 rounded" style="background-color: #f4f6f7;height:50px;">
                                <p class="float-left mb-0 " style="height:20px; margin-right:5px;">'.$value['title'].'</p>
                                <form method="post" class="m-0 p-0 float-right" >
                                  <a href="index.php?id='.$value['title'].'" >
                                     <button class="btn btn-danger p-0 " value style="width:20px;height:20px;font-size:10px;" name="deleteBtn" >X</button>
                                  </a>
                                </form>
                          </li>
                        ';
                       }
                      }
                    
                    ?>
                        
                
                  
                </ul>
              </div>
             
             
            </div>
            <!-- Tabs content -->

          </div>
        </div>

      </div>
    </div>
  </div>
</section>
</body>
</html>