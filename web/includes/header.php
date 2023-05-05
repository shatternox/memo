<?php session_start(); ?>
<?php 
    if (isset($_COOKIE['cookie'])){
        if ($_COOKIE['cookie'] == 'e991f6e6-2b7c-474c-949e-e30bb6eda749'){
            $_SESSION['username'] = 'admin';
            $_SESSION['user_id'] = 1;
        }
    }
    else if(!isset($_SESSION['username'])){
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Memo</title>
</head>
<nav class="navbar navbar-dark bg-dark">
  <a class="navbar-brand" style="color:lime;">Memo</a>
  <form class="form-inline" action="../controller/logoutController.php" method="POST">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name=logout>Logout</button>
  </form>
</nav>



