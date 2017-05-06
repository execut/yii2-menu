<?php
/**
 */

namespace execut\menu\controllers;


use execut\crud\params\Crud;
use execut\menu\models\Menu;
use yii\web\Controller;

class MenusController extends Controller
{
    public function actions()
    {
        return \yii::createObject([
            'class' => Crud::class,
            'modelClass' => Menu::class,
        ])->actions();
    }
}