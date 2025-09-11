A simple **Travel Blog Website** built using PHP, MySQL, HTML, CSS, and JavaScript. This project allows users to **register, log in, add, edit, and delete blog posts** with images. It also includes a dashboard for managing posts and static pages about different travel destinations. --- ## 🚀 Features - 🔐 User **Registration & Login** (with session handling) - 📝 Add, Edit, and Delete blog posts - 🖼️ Upload images from your PC (stored in /uploads/) - 📑 View individual posts (post.php) - 📂 Dashboard to manage posts - 🌍 Static travel pages: Chamundi, Halebidu, Shanthi Sagara, Travelling - 🎨 Simple & responsive UI using HTML & CSS --- ## 📂 Project Structure C:\xampp\htdocs\blog │── uploads/ # Stores uploaded images │── about.css # Styles for about page │── about.html # About page │── add_post.php # Add new blog post │── chamundi.php # Static page for Chamundi Hills │── dashboard.php # Dashboard for managing posts │── db.php # Database connection │── delete_post.php # Delete post │── edit_post.php # Edit post │── halebidu.php # Static page for Halebidu │── home.html # Home page │── login.html # Login form │── login.php # Login handler │── logout.php # Logout functionality │── post.php # Display individual post │── register.html # Registration form │── register.php # Registration handler │── shanthisagara.php # Static page for Shanthi Sagara │── style.css # Main CSS file │── travelling.php # Static travelling page │── update.php # Update post data 

Installation & Setup 
1. Install [XAMPP](https://www.apachefriends.org/) and start **Apache** & **MySQL**.
2. Clone or copy this project into your htdocs folder:
3. Create a MySQL database:
sql
CREATE DATABASE blog;
USE blog;

CREATE TABLE register (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  email VARCHAR(100) UNIQUE,
  password VARCHAR(100)
);

CREATE TABLE posts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(100),
  image VARCHAR(255),
  content TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

4. Update db.php with your MySQL credentials:

$conn = new mysqli("localhost", "root", "", "blog");


5. Open browser and visit:

http://localhost/blog/home.html
