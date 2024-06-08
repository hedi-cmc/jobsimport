<?php 

namespace Domain\Import;

use Config\Config;

class ImportStrategy {

    protected \PDO $db;

    public function __construct()
    {
        global $cleaned;

        $config = new Config();

        /* connect to DB */
        try {
            $this->db = new \PDO('mysql:host=' . $config->sql_host . ';dbname=' . $config->sql_db, $config->sql_user, $config->sql_pwd);
        } catch (\Exception $e) {
            die('DB error: ' . $e->getMessage() . "\n");
        }

        /* remove existing items */
        if (!$cleaned) {
            $this->db->exec('DELETE FROM job');
        }
        
        $cleaned = 1;
    }
}