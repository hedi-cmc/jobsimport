<?php

namespace Config;

class Config
{
    const ENV_FILE_PATH = __DIR__.'/../../.env';

    public $sql_host;
    public $sql_user;
    public $sql_pwd;
    public $sql_db;
    public $ressources_dir;

    public function __construct()
    {
        $this->sql_host = getenv('SQL_HOST');
        $this->sql_user = getenv('SQL_USER');
        $this->sql_pwd = getenv('SQL_PWD');
        $this->sql_db = getenv('SQL_DB');
        $this->ressources_dir = __DIR__ . '/../../resources/';
    }
}
