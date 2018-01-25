<?php
/**
 * Created by Josh L. Rogers
 * Copyright (c) 2017 All Rights Reserved.
 * 12/17/2017
 *
 * Projection.php
 *
 * Projection deleting
 *
 **/

namespace Data\Budget\Db\Delete;

class Projection extends \Data\Budget\Db\Delete
{
    public function __construct()
    {
        $this->table = 'item_projection';
    }


    /**
     * @param $id
     * @return bool|string
     * @throws \Exception
     */
    public function item($id)
    {
        return parent::itemRecord($id);
    }
}