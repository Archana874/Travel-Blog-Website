<?php
include 'db.php';

$title   = $_POST['title'];
$content = $_POST['content'];
$id      = $_POST['id'];

// Handle image upload
$image = null;
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $targetDir = "uploads/"; // folder where images will be saved
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true); // create folder if not exists
    }

    $fileName = time() . "_" . basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $fileName;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
        $image = $fileName; // store only filename in DB
    } else {
        echo "Error uploading image.";
        exit;
    }
}

// If no new image uploaded, keep old image
if ($image === null) {
    $sql = "SELECT image FROM posts WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($oldImage);
    $stmt->fetch();
    $stmt->close();
    $image = $oldImage;
}

// Update query
$stmt = $conn->prepare("UPDATE posts SET title = ?, image = ?, content = ? WHERE id = ?");
$stmt->bind_param("sssi", $title, $image, $content, $id);

if ($stmt->execute()) {
    echo "<script>alert('Post updated successfully!'); window.location.href='dashboard.php';</script>";
} else {
    echo "Error updating record: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
