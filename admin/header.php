<?php

  include './php_files/config.php';
//   include './php_files/database.php';

    if(!session_id()){
        session_start();
    }
 
  if(!isset($_SESSION['adminName'])){
    header("location: $base_url/admin/index.php");
  }  
  
  $db = new Database();
  $db->select('options','site_name,site_logo,site_title,currency_format');
  $result = $db->getResult();
  $currency_format = $result[0]['currency_format'];
//   print_r($currency_format);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>