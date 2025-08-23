<?php 
session_start(); 
include 'db.php'; 

// Check login
if (!isset($_SESSION['userid'])) { 
    header("Location: login.php"); 
    exit(); 
} 

$userid = $_SESSION['userid']; 
$email = $_SESSION['email']; 

// Fetch ALL posts
$sql = "SELECT posts.id, posts.title, posts.content, posts.image, posts.created_at, register.email 
        FROM posts 
        JOIN register ON posts.userid = register.id 
        ORDER BY posts.created_at DESC";


$result = $conn->query($sql);

// Debug if query fails
if (!$result) {
    die("SQL Error: " . $conn->error);
}
?> 

<!DOCTYPE html>
<html> 
<head> 
    <title>Dashboard</title> 
    <style>
        body { font-family: "Times New Roman", Times, serif; background: #f9f9f9; padding: 20px; }
        .post { background: white; padding: 15px; margin-bottom: 20px; border-radius: 8px; }
        .post h2 { margin: 0; color: #333; }
        .post small { color: #777; }
        .header { margin-bottom: 20px; }
        nav{
            background: #636262ff;
            padding: 12px 16px;
        }
       .logout {
           float: right;
           color: white;
           padding: 0px;
           border-radius: 5px;
           text-decoration: none;
          
       }
        nav a {
            color: white;
            text-decoration: none;
            margin-right: 15px;
        }
        nav a:hover {
            color: #010101ff;
        }
    </style>
</head> 
<body> 
    
        <h1>Welcome, <?php echo htmlspecialchars($email); ?> 🎉</h1> 
        <nav>
        <a href="home.html"> <b>Home</b></a>
        <a href="add_post.php"> <b>Add New Post</b></a>  
        <a href="logout.php" class="logout"> <b>Logout</b></a>
    </nav>
    <hr> 

    <h2>All Posts</h2> 
    <?php 
    if ($result && $result->num_rows > 0) { 
    while ($row = $result->fetch_assoc()) {
    echo "<div class='post'>";
    echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";

    if (!empty($row['image'])) {
        echo "<img src='uploads/" . htmlspecialchars($row['image']) . "' 
                 alt='Post Image' 
                 style='display:block; margin:10px auto; max-width:500px; height: 300px;; border-radius:8px; margin-left: 0px; margin-right: 500px;'>";
    } else {
        echo "<p style='text-align:center; color:gray;'>📷 No image uploaded</p>";
    }

    echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";
    echo "<small>✍️ Posted by " . htmlspecialchars($row['email']) . " on " . $row['created_at'] . "</small><br>";

    echo "<a href='edit_post.php?id=" . $row['id'] . "'> Edit</a> | ";
    echo "<a href='delete_post.php?id=" . $row['id'] . "' onclick=\"return confirm('Are you sure you want to delete this post?');\">Delete</a>";

    echo "</div>";
}

} else { 
    echo "<p>No posts available yet. Start by adding one!</p>"; 
}
    ?> 
</body> 
</html>
