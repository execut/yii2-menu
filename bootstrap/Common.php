<?php
/**
 */

namespace execut\menu\bootstrap;
use execut\menu\Component;
use execut\menu\Module;
use execut\yii\Bootstrap;
use yii\helpers\ArrayHelper;
use yii\i18n\PhpMessageSource;

class Common extends Bootstrap
{
    protected $isBootstrapI18n = true;
    public function getDefaultDepends() {
        return [
            'modules' => [
                'menu' => [
                    'class' => Module::class,
                ],
            ],
        ];
    }
    /**
     * @param \yii\base\Application $app
     */
    public function bootstrap($app)
    {
        parent::bootstrap($app);
    }
}