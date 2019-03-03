<?php

class Db
{
    protected $dbh;
    protected $config;

    /**
     * Db constructor.
     *
     * establishes a connection to the database
     */
    public function __construct()
    {
        $this->config = require __DIR__ . '/../config/db.php';
        $this->dbh = new PDO('mysql:host=' . $this->config['host'] . ';dbname=' . $this->config['name'],
            $this->config['user'], $this->config['password']);
    }


    /**
     * @param $sql
     * @param array $params
     *
     * executes request
     */
    public function execute($sql, $params = [])
    {
        $sth = $this->dbh->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                $sth->bindValue(':' . $key, $val);
            }
        }
        $sth->execute();
    }

    /**
     * @param $sql
     * @param array $params
     * @return bool|PDOStatement
     *
     * executes the query, returns the query result
     */
    public function query($sql, $params = [])
    {
        $sth = $this->dbh->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                $sth->bindValue(':' . $key, $val);
            }
        }
        $sth->execute();
        return $sth;
    }

}