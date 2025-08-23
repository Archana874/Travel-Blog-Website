<?php
session_start();
include 'db.php';

// Block access if not logged in
if (!isset($_SESSION['userid'])) {
    header("Location: login.html");
    exit;
}

$message = '';
$error   = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title   = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $userid  = $_SESSION['userid'];

    // Handle file upload
    $imageName = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = "uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $tmpName   = $_FILES['image']['tmp_name'];
        $fileName  = time() . "_" . basename($_FILES['image']['name']);
        $target    = $uploadDir . $fileName;

        if (move_uploaded_file($tmpName, $target)) {
            $imageName = $fileName; // only storing the filename in DB
        } else {
            $error = "Failed to upload image.";
        }
    }

    if ($title === '' || $content === '') {
        $error = 'Please fill in both Title and Content.';
    } else {
        // Insert with prepared statement
        $stmt = $conn->prepare("INSERT INTO posts (userid, title, content, image) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $userid, $title, $content, $imageName);

        if ($stmt->execute()) {
            echo "<script>alert('Post added successfully!'); window.location.href='dashboard.php';</script>";
            exit;
        } else {
            $error = 'Database error: ' . $conn->error;
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Post</title>
  <style>
    body { font-family: Arial, sans-serif; background:#f7f7f7; margin:0; padding:24px; }
    .wrap { max-width: 700px; margin: 0 auto; background:#fff; padding:24px; border-radius:12px; box-shadow:0 6px 18px rgba(0,0,0,.08);}
    h1 { margin-top:0; }
    .msg { padding:10px 12px; border-radius:8px; margin-bottom:14px; }
    .msg.error { background:#ffe7e7; color:#8a1f1f; }
    .msg.ok { background:#e8ffe8; color:#1f7d1f; }
    label { display:block; font-weight:bold; margin:12px 0 6px; }
    input[type="text"], textarea { width:100%; padding:10px; border:1px solid #ccc; border-radius:8px; }
    textarea { min-height:150px; resize:vertical; }
    .actions { margin-top:16px; display:flex; gap:10px; }
    button, a.button { background:#1a73e8; color:#fff; border:none; padding:10px 16px; border-radius:8px; cursor:pointer; text-decoration:none; display:inline-block; }
  </style>
</head>
<body>
  <div class="wrap">
    <h1>Add a New Post</h1>

    <?php if (!empty($error)): ?>
      <div class="msg error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <?php if (!empty($message)): ?>
      <div class="msg ok"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <!-- IMPORTANT: add enctype for file upload -->
    <form method="post" action="add_post.php" enctype="multipart/form-data">
      <label for="title">Title</label>
      <input type="text" id="title" name="title" placeholder="Enter post title" required>

      <label for="image">Image</label>
      <input type="file" id="image" name="image" accept="image/*">

      <label for="content">Content</label>
      <textarea id="content" name="content" placeholder="Write your post..." required></textarea>

      <div class="actions">
        <button type="submit">Publish</button>
        <a class="button" href="dashboard.php">Back to Dashboard</a>
      </div>
    </form>
  </div>
</body>
</html>
