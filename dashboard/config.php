<?php

class Config {
    private const DBHOST = "localhost";
    private const DBUSER = "beger_crm_user";
    private const DBPASS = "Dkimeiyd13#";
    private const DBNAME = "BG_CSR";

    private $dsn = "mysql:host=" . self::DBHOST . ";dbname=" . self::DBNAME . ";charset=utf8mb4";
    protected $conn = null;

    public function __construct() {
        try {
            $this->conn = new PDO($this->dsn, self::DBUSER, self::DBPASS);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error0: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}

?>
