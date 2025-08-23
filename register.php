<?php
  
  session_start();
  include 'db.php';

  if($_SERVER['REQUEST_METHOD'] === 'POST')
  {
     $name=$_POST['name'];
     $email=$_POST['email'];
     $password=$_POST['password'];

    
     $sql = "INSERT INTO register(name, email, password) values ('$name', '$email', '$password')";

     if($conn->query($sql) === TRUE)
     {
         echo "<script>alert('New record created successfully'); window.location.href='login.html';</script>";
     }
     else
     {
         echo "Error: " . $sql . "<br>" . $conn->error;
     }

    }
?>