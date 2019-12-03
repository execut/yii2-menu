<?php
/**
 */

namespace execut\menu\controllers;
use execut\crud\params\Crud;
use execut\menu\models\Position;
use yii\filters\AccessControl;
use yii\web\Controller;

class PositionsController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => [$this->module->adminRole],
                    ],
                ],
            ],
        ];
    }

    public function actions()
    {

        return \yii::createObject([
            'class' => Crud::class,
            'modelClass' => Position::class,
            'module' => 'menu',
            'moduleName' => 'Menus',
            'modelName' => Position::MODEL_NAME,
        ])->actions();
    }
}