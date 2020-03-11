<?php


namespace Quantox;

use MeekroDB;

class Database
{
    public $connection;

    public function __construct()
    {
        $dbConfig = $this->getConfiguration();
        $this->connection = new MeekroDB(
            $dbConfig['db_host'],
            $dbConfig['db_user'],
            $dbConfig['db_password'],
            $dbConfig['db_name'],
            $dbConfig['db_port'],
            $dbConfig['db_encoding']
        );
    }


    protected function getConfiguration()
    {
        $config = parse_ini_file("config.ini", true);
        if ($config && is_array($config) && !empty($config)) {
            return $config['database'];
        }

        error_log('Bad database config file. Check config.ini');
        exit();
    }
}
