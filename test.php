<?php
  if( isset( $_POST['name'] ) )
  {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $con = mysqli_connect("localhost","root"," ","my_db");
    $insert = " INSERT INTO user VALUES( '$name','$age' ) ";
    mysqli_query($con, $insert); 
  }
?>