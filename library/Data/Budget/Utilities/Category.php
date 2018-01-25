<?php
/**
 * Created by Josh L. Rogers
 * Copyright (c) 2017 All Rights Reserved.
 * 12/17/2017
 *
 * Category.php
 *
 * Helper methods for categories
 *
 * -- STATIC METHODS --
 *
 **/

namespace Data\Budget\Utilities;

class Category
{
    public function __construct()
    {
    }


    /**
     * @param $category_label
     * @return array|bool
     */
    public static function getCategoryIdByLabel($category_label)
    {
        $sql = '
            SELECT __id AS id FROM category WHERE label = ?; 
        ';

        $bind   = [$category_label];
        $db     = new \Data\PdoMySql($sql, $bind);

        return $db->fetch();
    }


    /**
     * @param $category_url
     * @return array|bool
     */
    public static function getCategoryIdByUrl($category_url)
    {
        $sql = '
            SELECT __id AS id, label AS category_label FROM category;
        ';

        $db         = new \Data\PdoMySql($sql);
        $categories = $db->fetchAllAssoc();

        foreach ($categories as $category) {

            if (\View\Formatting\Url::transform($category['category_label']) == $category_url)
                return $category['id'];
        }

        return null;
    }


    /**
     * @param $id
     * @return array|bool
     */
    public static function getCategoryLabelById($id)
    {
        $sql = '
            SELECT label FROM category WHERE __id = ?; 
        ';

        $bind       = [$id];
        $db         = new \Data\PdoMySql($sql, $bind);

        return $db->fetch();
    }


    /**
     * @param $category_url
     * @return array|bool
     */
    public static function getCategoryLabelByUrl($category_url)
    {
        $category_id_by_url = self::getCategoryIdByUrl($category_url);

        return self::getCategoryLabelById($category_id_by_url);

    }


    /**
     * @return array|bool
     */
    public static function getCategories($equity_type = false)
    {
        $sql = '
            SELECT
              __id AS id,
              label AS category_label,
              description,
              equity_type
            FROM category
        ';

        $bind = [];

        if (!empty($equity_type)) {

            $sql    .= ' WHERE equity_type = ?';
            $bind[] = $equity_type;
        }

        $db = new \Data\PdoMySql($sql, $bind);

        return $db->fetchAllAssoc();
    }
}