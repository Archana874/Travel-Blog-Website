<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM posts WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Record deleted successfully.'); window.location.href='dashboard.php';</script>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "No posts are provided.";
}

$conn->close();
?>
