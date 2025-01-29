<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "blog";
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $sql = "INSERT INTO posts (title, content) VALUES ('$title', '$content')";
    $conn->query($sql);
}

$posts = $conn->query("SELECT * FROM posts");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple Blog CMS</title>
</head>
<body>
    <h1>Blog Posts</h1>
    <form method="POST">
        <input type="text" name="title" placeholder="Title" required><br>
        <textarea name="content" placeholder="Content" required></textarea><br>
        <button type="submit">Add Post</button>
    </form>
    <h2>All Posts</h2>
    <ul>
        <?php while ($post = $posts->fetch_assoc()): ?>
            <li>
                <h3><?= $post['title'] ?></h3>
                <p><?= $post['content'] ?></p>
            </li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
