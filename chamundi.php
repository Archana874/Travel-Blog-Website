<?php
include 'db.php'; // your DB connection

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM posts WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $post = $result->fetch_assoc();
    } else {
        echo "Post not found!";
        exit;
    }
} else {
    echo "Invalid request!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $post['title']; ?></title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; background: #f0f0f0; }
        h1 { text-align: center; margin-top: 20px; }
        img { display: block; margin: 0 auto; border-radius: 10px; width: 500px; height: 300px; }
        p { width: 80%; margin: 20px auto; font-size: 18px; line-height: 1.6; }
    </style>
</head>
<body>
    <h1><?php echo $post['title']; ?></h1>
    <img src="<?php echo $post['image']; ?>" alt="<?php echo $post['title']; ?>">
    <p><?php echo $post['content']; ?></p>
</body>
</html>
