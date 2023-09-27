<?php
namespace app\controllers;
use app\core\InitController;
use app\lib\UserOperation;

class MainController extends InitController{
    public function actionIndex(){
        $this->render('index', [
            'sidebar'=>UserOperation::getMenuLinks()

        ]);
    }
}