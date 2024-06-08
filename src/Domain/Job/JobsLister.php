<?php

declare(strict_types=1);

namespace Domain\Job;

use Config\Config;

final class JobsLister
{
    private \PDO $db;

    public function __construct()
    {
        /* connect to DB */
        $config = new Config();

        /* connect to DB */
        try {
            $this->db = new \PDO('mysql:host=' . $config->sql_host . ';dbname=' . $config->sql_db, $config->sql_user, $config->sql_pwd);
        } catch (\Exception $e) {
            die('DB error: ' . $e->getMessage() . "\n");
        }
    }

    public function listJobs(): array
    {
        return $this->db->query('SELECT id, reference, title, description, url, company_name, publication FROM job')->fetchAll(\PDO::FETCH_ASSOC);
    }
}
