<?php
/**
 */

namespace execut\menu\controllers;


use execut\actions\Action;
use execut\actions\action\adapter\GridView;
use execut\crudFields\fields\Field;
use execut\menu\models\PagesPage;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

class PagesController extends Controller
{
    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'index' => [
                'class' => Action::class,
                'adapter' => [
                    'class' => GridView::class,
                    'model' => [
                        'class' => PagesPage::class,
                        'scenario' => Field::SCENARIO_GRID,
                    ],
                ],
            ],
        ]);
    }
}