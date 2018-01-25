<?php
/**
 * Created by Josh L. Rogers
 * Copyright (c) 2017 All Rights Reserved.
 * 12/17/2017
 *
 * PdoMySql.php
 *
 * PDO/MySql wrapper
 *
 **/

namespace Data;

class PdoMySql
{
    public $query, $con;
    private $debug_pdo = false;


    /**
     * @param $sql
     * @param array $bind_array
     * @throws \PDOException
     */
    public function __construct($sql, $bind_array = array())
    {
        try {
            $this->con = new \PDO(
                'mysql:host=' . MYSQL_SERVER . ';port=' . MYSQL_PORT . ';dbname=' . MYSQL_DB,
                MYSQL_USER,
                MYSQL_PASSWORD
            );

            $this->sql = $sql ? (string)$sql : false;
            $this->bind_array = is_array($bind_array) && !empty($bind_array) ? (array)$bind_array : false;

        } catch (\PDOException $e) {

            throw $e;
        }

        if ($this->debug_pdo) {

            $this->con->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
    }


    /**
     * @return \PDOStatement
     * @throws \PDOException
     */
    private function runQuery()
    {
        try {
            if ($this->bind_array) {

                $query = $this->con->prepare($this->sql);

                $query->execute($this->bind_array);

            } else {

                $query = $this->con->query($this->sql);
            }

            return $query;

        } catch (\PDOException $e) {

            throw $e;
        }
    }


    /**
     * @return array|bool
     * @throws \PDOException
     */
    public function fetchAssoc()
    {
        try {
            $this->query = $this->runQuery();
            return $this->query->fetch(\PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {

            throw $e;
        }
    }


    /**
     * @return array|bool
     * @throws \PDOException
     */
    public function fetchAllAssoc()
    {
        try {
            $this->query = $this->runQuery();
            return $this->query->fetchAll(\PDO::FETCH_ASSOC);

        } catch (\PDOException $e) {

            throw $e;
        }
    }


    /**
     * @return array|bool
     * @throws \PDOException
     */
    public function fetch()
    {
        try {
            $this->query = $this->runQuery();
            return $this->query->fetch(\PDO::FETCH_COLUMN);

        } catch (\PDOException $e) {

            throw $e;
        }
    }


    /**
     * @return array|bool
     * @throws \PDOException
     */
    public function fetchAll()
    {
        try {
            $this->query = $this->runQuery();
            return $this->query->fetchAll(\PDO::FETCH_COLUMN);

        } catch (\PDOException $e) {

            throw $e;
        }
    }


    /**
     * @return bool
     * @throws \PDOException
     */
    public function run()
    {
        try {
            $this->query = $this->runQuery();
            return ($this->con->errorCode() == \PDO::ERR_NONE);

        } catch (\PDOException $e) {

            throw $e;
        }
    }
}