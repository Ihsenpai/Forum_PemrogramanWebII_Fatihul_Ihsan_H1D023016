<?php
class Vote {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    public function add($comment_id, $user_id, $vote_type) {
        $id = generateUniqueId('vote_'); 
        $stmt = $this->db->prepare("INSERT INTO votes (id, comment_id, user_id, vote_type) VALUES (:id, :comment_id, :user_id, :vote_type)");
        $stmt->execute([
            ':id' => $id,
            ':comment_id' => $comment_id,
            ':user_id' => $user_id,
            ':vote_type' => $vote_type
        ]);
    }

    public function getVotesByCommentId($comment_id) {

        $stmt = $this->db->prepare("
            SELECT 
                SUM(vote_type = 'up') AS up_votes,
                SUM(vote_type = 'down') AS down_votes
            FROM votes 
            WHERE comment_id = :comment_id
        ");
        $stmt->execute([':comment_id' => $comment_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>