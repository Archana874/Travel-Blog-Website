<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = strtolower(trim($_POST['email']));
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM register WHERE LOWER(email) = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if ($password === $row['password']) {
    $_SESSION['userid'] = $row['id'];
    $_SESSION['email']  = $row['email'];

    echo "<script>
            alert('Login Successful!');
            window.location.href='dashboard.php';
          </script>";
    exit;
}

     else {
            // ❌ Wrong password
            echo "<script>
                    alert('Invalid password');
                    window.location.href='login.html';
                  </script>";
            exit;
        }
    }else {
        // ❌ No such email
        echo "<script>
                alert('Email not found');
                window.location.href='login.html';
              </script>";
        exit;
    }
}
?>
