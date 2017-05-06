<?php
/**
 */

namespace execut\menu\dependencies;


use execut\menu\models\PagesPage;

class Outer extends \execut\dependencies\Outer
{
    public $defaultTablesConfig = [
        PagesPage::class => [
            'route' => '/pages/backend',
            'tableName' => 'pages_pages',
        ],
    ];
}