<?php
/**
 */

namespace execut\menu\controllers;
use execut\crud\params\Crud;
use execut\menu\models\Item;
use yii\web\Controller;

class ItemsController extends Controller
{
    public function actions()
    {
        return \yii::createObject([
            'class' => Crud::class,
            'modelClass' => Item::class,
        ])->actions();
    }
}