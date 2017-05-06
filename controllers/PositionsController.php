<?php
/**
 */

namespace execut\menu\controllers;
use execut\crud\params\Crud;
use execut\menu\models\Position;
use yii\web\Controller;

class PositionsController extends Controller
{
    public function actions()
    {
        return \yii::createObject([
            'class' => Crud::class,
            'modelClass' => Position::class,
        ])->actions();
    }
}