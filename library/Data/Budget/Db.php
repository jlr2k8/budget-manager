<?php
/**
 * Created by Josh L. Rogers
 * Copyright (c) 2017 All Rights Reserved.
 * 12/17/2017
 *
 * DB.php
 *
 * Database management for CRUD checkbook and projection operations
 *
 **/

namespace Data\Budget;

class Db
{
    public function __construct()
    {
    }


    /**
     * @param array $data
     * @return array
     * @throws \Exception
     */
    public static function validate(array $data)
    {
        foreach ($data as $key => $val)
        {
            if ($val === false) {
                throw new \Exception('Invalid ' . $key);
            }
        }

        return $data;
    }
}