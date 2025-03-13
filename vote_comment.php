<?php
require 'classes/Database.php';
require 'classes/Vote.php';
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $comment_id = $_POST['comment_id'];
    $user_id = generateUniqueId('Id_');
    $vote_type = $_POST['vote_type'];

    $vote = new Vote();
    $vote->add($comment_id, $user_id, $vote_type);

    echo json_encode(['status' => 'success']);
    exit;
}
?>