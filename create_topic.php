<?php
require 'classes/Database.php';
require 'classes/Topic.php';
require 'functions.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $user_id = generateUniqueId('User_');

    $topic = new Topic();
    $topic_id = $topic->create($title, $user_id);

    header("Location: view_topic.php?id=$topic_id");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Buat Topik Baru</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Buat Topik Baru</h1>
        <form method="POST" class="card p-4">
            <div class="mb-3">
                <label for="title" class="form-label">Judul:</label>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Buat</button>
        </form>
    </div>
</body>
</html>