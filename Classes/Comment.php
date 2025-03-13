<?php
class Comment {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function add($topic_id, $user_id, $content) {
        $id = generateUniqueId('comment_');
        $stmt = $this->db->prepare("INSERT INTO comments (id, topic_id, user_id, content, created_at) VALUES (:id, :topic_id, :user_id, :content, NOW())");
        $stmt->execute([
            ':id' => $id, 
            ':topic_id' => $topic_id,
            ':user_id' => $user_id,
            ':content' => $content
        ]);
    }

    public function getByTopicId($topic_id) {
        $stmt = $this->db->prepare("SELECT * FROM comments WHERE topic_id = :topic_id ORDER BY created_at ASC");
        $stmt->execute([':topic_id' => $topic_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
