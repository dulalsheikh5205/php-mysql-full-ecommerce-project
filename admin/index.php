<?php
  include_once './php_files/config.php';
  session_start();

  if(isset($_SESSION['adminName'])){
    header("location: $base_url/admin/dashboard.php");
  }
  

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- google font roboto cnd link -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="./../css/bootstrap.min.css">
    <link rel="stylesheet" href="./../css/fontawesome.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    
    <div class="container">
      <div class="row">
        <form method="POST" autocomplete="off" id="full-form" class="w-25 mx-auto mt-5">
            <h2>Online Shop</h2>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">User Name</label>
            <input type="text" class="form-control username" name="username" id="exampleInputEmail1" aria-describedby="emailHelp">
          </div>
      
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control password" name="password" id="exampleInputPassword1">
        </div>

        <button type="submit" name="btn" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>




 <!--all js file here -->
 <script src="./js/jquery.min.js"></script>
 <script src="./js/admin_action.js"></script>
 <script src="./../js/fontawesome.js"></script>
 


</body>
</html>