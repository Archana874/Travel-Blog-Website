<?php

  $host="localhost";
  $user="root";
  $password="root";
  $dbname="blog";

  $conn = new mysqli($host, $user, $password, $dbname);

  if($conn -> connect_error)                                                                                                                                                                                                                                                                                                                      
  {
    die("connection failed" . $conn-> connect_error);
  }
  ?>