<?php



namespace Data\Budget\Utilities;

class Item
{
    public function __construct()
    {
    }


    /**
     * @param $item
     * @return array|bool
     */
    public static function getItemIdFromItem($item)
    {
        $sql = '
            SELECT __id AS id FROM item WHERE item = ?;
        ';

        $db = new \Data\PdoMySql($sql, [$item]);

        return $db->fetch();
    }
}