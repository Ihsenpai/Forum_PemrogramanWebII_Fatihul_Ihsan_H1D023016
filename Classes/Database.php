<?php
class Database {
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $conn;

    public function __construct() {
        $config = include('config/database.php');
        $this->host = $config['host'];
        $this->dbname = $config['dbname'];
        $this->username = $config['username'];
        $this->password = $config['password'];
    }

    public function connect() {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->dbname}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            // Tampilkan pesan error jika koneksi gagal
            die("Connection failed: " . $e->getMessage());
        }
    }
}
?>