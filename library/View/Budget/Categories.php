<?php
/**
 * Created by Josh L. Rogers
 * Copyright (c) 2017 All Rights Reserved.
 * 12/17/2017
 *
 * Categories.php
 *
 *
 **/

namespace View\Budget;

class Categories
{
    public function __construct()
    {
    }


    /**
     * @param \View\SmartyLoader $smarty
     * @param $selected_category_id
     * @return string
     */
    public static function selectOptions(\View\SmartyLoader $smarty, $selected_category_id = null)
    {
        $categories = \Data\Budget\Utilities\Category::getCategories();
        $options    = [];

        foreach ($categories as $key => $val) {

            $option['category_id']          = $val['id'];
            $option['category_label']       = $val['category_label'];
            $option['selected_category_id'] = $selected_category_id;

            $options[] = $option;
        }

        $smarty->assign('options', $options);

        return $smarty->fetch('transactions/category_select_options.tpl');
    }
}