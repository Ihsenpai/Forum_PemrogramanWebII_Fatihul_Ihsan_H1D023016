<?php
require 'classes/Database.php';
require 'classes/Topic.php';
require 'classes/Comment.php';
require 'classes/Vote.php';

$topic_id = $_GET['id'];

$topic = new Topic();
$comment = new Comment();
$vote = new Vote();

$topic_data = $topic->getById($topic_id);
$comments = $comment->getByTopicId($topic_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $topic_data['title']; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1><?php echo $topic_data['title']; ?></h1>
        <p class="text-muted">Dibuat pada: <?php echo $topic_data['created_at']; ?></p>

        <h2>Komentar</h2>
        <form method="POST" action="add_comment.php" class="mb-4">
            <input type="hidden" name="topic_id" value="<?php echo $topic_id; ?>">
            <div class="mb-3">
                <textarea name="content" class="form-control" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Kirim Komentar</button>
        </form>

        <?php foreach ($comments as $comment): ?>
        <div class="card mb-3">
            <div class="card-body">
                <p><?php echo $comment['content']; ?></p>
                <p class="text-muted">
                    Dikirim oleh: <?php echo $comment['user_id']; ?> <br>
                    ID Komentar: <?php echo $comment['id']; ?> <br>
                    Dikirim pada: <?php echo $comment['created_at']; ?>
                </p>
                <button class="btn btn-success btn-sm upvote" data-comment-id="<?php echo $comment['id']; ?>">Upvote</button>
                <button class="btn btn-danger btn-sm downvote" data-comment-id="<?php echo $comment['id']; ?>">Downvote</button>
                <span class="badge bg-success">Upvotes: <?php echo $vote->getVotesByCommentId($comment['id'])['up_votes']; ?></span>
                <span class="badge bg-danger">Downvotes: <?php echo $vote->getVotesByCommentId($comment['id'])['down_votes']; ?></span>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="mt-3">
        <a href="index.php" class="btn btn-secondary">Kembali ke Halaman Utama</a>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.upvote, .downvote').click(function() {
                var comment_id = $(this).data('comment-id');
                var vote_type = $(this).hasClass('upvote') ? 'up' : 'down';

                $.post('vote_comment.php', { comment_id: comment_id, vote_type: vote_type }, function(response) {
                    location.reload();
                });
            });
        });
    </script>
</body>
</html>