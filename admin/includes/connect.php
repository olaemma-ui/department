<?php
  $con = mysqli_connect("localhost", "root", "", "department_fee");
  if (!$con) {
    die( mysqli_error($con));
  }
?>