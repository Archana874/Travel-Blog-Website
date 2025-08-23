<?php
include 'db.php';

// Step 1: Check if id is provided
if (!isset($_GET['id'])) {
    echo "No ID provided.";
    exit;
}

$id = $_GET['id'];

// Step 2: Fetch post info
$sql = "SELECT * FROM posts WHERE id = '$id'";
$result = $conn->query($sql);

if (!$result || $result->num_rows == 0) {
    echo "Post not found.";
    exit;
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <h2>Edit Post</h2>
    <form action="update.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        <label for="title">Title</label>
      <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($row['title']); ?>">

      <label for="image">Image</label>
    <input type="file" id="image" name="image" accept="image/*" value="<?php echo htmlspecialchars($row['image']); ?>">

      <label for="content">Content</label>
      <textarea id="content" name="content"><?php echo htmlspecialchars($row['content']); ?></textarea>

        <input type="submit" value="Update">
    </form>
</div>
</body>
</html>
