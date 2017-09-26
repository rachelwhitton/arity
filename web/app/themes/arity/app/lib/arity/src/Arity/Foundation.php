<?php

declare(strict_types=1);

namespace Arity;

use Arity\Theme;

class Foundation
{
    public static function init($config = array())
    {

        if (function_exists('\App\Theme\config')) {
            $config = \App\Theme\config();
        }

        if (class_exists('Arity\PageTemplates')) {
            new \Arity\PageTemplates($config);
        }

        if (class_exists('\ModuleBuilder\ModuleBuilder')) {
            global $module_builder;
            $module_builder = new \ModuleBuilder\ModuleBuilder($config);
            $module_builder->init();
        }
    }
}
