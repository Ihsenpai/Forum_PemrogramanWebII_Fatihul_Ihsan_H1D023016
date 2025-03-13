<?php
require 'classes/Database.php';
require 'classes/Comment.php';
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $topic_id = $_POST['topic_id'];
    $user_id = generateUniqueId('Id_');
    $content = $_POST['content'];

    $comment = new Comment();
    $comment->add($topic_id, $user_id, $content);

    header("Location: view_topic.php?id=$topic_id");
    exit;
}
?>