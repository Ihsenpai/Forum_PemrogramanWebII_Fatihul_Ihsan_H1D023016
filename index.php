<?php
require 'classes/Database.php';
require 'classes/Topic.php';

$topic = new Topic();
$topics = $topic->getAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forum Diskusi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Forum Diskusi<br> Dibuat Oleh: <br><br><u>Fatihul Ihsan Al Ghoni</u></h1>
        <a href="create_topic.php" class="btn btn-primary mb-3">Buat Topik Baru</a>
        <table id="topicsTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID Topik</th>
                    <th>Judul</th>
                    <th>ID User</th>
                    <th>Dibuat Pada</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($topics as $topic): ?>
                <tr>
                    <td><?php echo $topic['id']; ?></td>
                    <td><a href="view_topic.php?id=<?php echo $topic['id']; ?>"><?php echo $topic['title']; ?></a></td>
                    <td><?php echo $topic['user_id']; ?></td>
                    <td><?php echo $topic['created_at']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#topicsTable').DataTable();
        });
    </script>
</body>
</html>