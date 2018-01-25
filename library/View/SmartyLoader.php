<?php
/**
 * Created by Josh L. Rogers
 * Copyright (c) 2017 All Rights Reserved.
 * 12/17/2017
 *
 * SmartyLoader.php
 *
 * Load vendor templating library, Smarty
 *
 **/

namespace View;

require_once $_SERVER['WEB_ROOT'] . '/library/Vendor/Smarty/Smarty.class.php';

class SmartyLoader extends \Smarty
{
    public $caching, $cache_dir;

    public function __construct()
    {
        parent::__construct();

        $this->setTemplateDir($_SERVER['WEB_ROOT'] . '/view/smarty');
        $this->cache();
    }


    /**
     * @return bool
     */
    private function cache()
    {
        if (ENABLE_SMARTY_CACHE) {
            $this->caching = true;

            if (!empty(SMARTY_CACHE_DIR))
                $this->cache_dir = SMARTY_CACHE_DIR;
        }

        return true;
    }


    /**
     * @param SmartyLoader $smarty
     * @param array $find_replace
     * @return string
     * @throws \Exception
     * @throws \SmartyException
     */
    public static function displayPage(\View\SmartyLoader $smarty, array $find_replace)
    {
        $page_title     = !empty($find_replace['page_title']) ? $find_replace['page_title'] : 'Unnamed Page';
        $breadcrumbs    = !empty($find_replace['breadcrumbs']) ? $find_replace['breadcrumbs'] : null;
        $nav            = !empty($find_replace['nav']) ? $find_replace['nav'] : \View\Nav::show($smarty);
        $main           = !empty($find_replace['main']) ? $find_replace['main'] : '<h2>This page has no content</h2>';

        $smarty->assign('page_title', $page_title);
        $smarty->assign('breadcrumbs', $breadcrumbs);
        $smarty->assign('nav', $nav);
        $smarty->assign('main', $main);

        ob_start();

        echo $smarty->fetch('common/main.tpl');
        //require_once $_SERVER['WEB_ROOT'] . '/include/dev/debug_footer.php';

        return ob_get_clean();
    }
}