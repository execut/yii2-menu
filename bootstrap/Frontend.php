<?php
/**
 */

namespace execut\menu\bootstrap;
use execut\menu\Component;
use execut\menu\Module;
use execut\yii\Bootstrap;
use yii\helpers\ArrayHelper;

class Frontend extends Bootstrap
{
    public function getDefaultDepends() {
        return [
            'components' => [
                'navigation' => [
                    'class' => \execut\navigation\Component::class,
                ],
                'menu' => [
                    'class' => Component::class,
                ],
            ],
            'modules' => [
                'menu' => [
                    'class' => Module::class,
                ],
            ],
        ];
    }
}