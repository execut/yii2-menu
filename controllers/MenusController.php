<?php
/**
 */

namespace execut\menu\controllers;


use execut\crud\params\Crud;
use execut\menu\models\Menu;
use yii\filters\AccessControl;
use yii\web\Controller;

class MenusController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
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
            'modelClass' => Menu::class,
            'module' => 'menu',
            'moduleName' => 'Menus',
            'modelName' => Menu::MODEL_NAME,
        ])->actions();
    }
}