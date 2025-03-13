<?php
class Topic {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function create($title, $user_id) {
        $id = generateUniqueId('topic_'); 
        $stmt = $this->db->prepare("INSERT INTO topics (id, title, user_id, created_at) VALUES (:id, :title, :user_id, NOW())");
        $stmt->execute([
            ':id' => $id, 
            ':title' => $title,
            ':user_id' => $user_id
        ]);
        return $id;
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM topics ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM topics WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>