<?php

namespace app\controllers;

class UserController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function  actionShop(){
        $this->layout ="main-dukani";
         return $this->render('shop');
    }

    public function  actionSido(){

        $this->layout ="main-sido";
        return $this->render('sido');
    }
    public function  actionAdmin(){
        return $this->render('admin');
    }

}
