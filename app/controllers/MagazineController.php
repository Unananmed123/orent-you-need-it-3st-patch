<?php

namespace app\controllers;

use app\core\InitController;
use app\lib\UserOperation;
use app\models\MagazineModels;

class MagazineController extends InitController
{
    public function behaviors()
    {
        return [
            'access' => [
                'rules' => [
                    [
                        'actions' => ['buyandsell'],
                        'roles' => [UserOperation::RoleUser, UserOperation::RoleAdmin, UserOperation::RoleSeller],
                        'matchCallBack' => function () {
                            $this->redirect('/user/profile');
                        }
                    ]
                ]
            ]
        ];
    }


    public function actionListStock()
    {
        $this->view->title = 'Акции';
        $stockModel = new MagazineModels();
        $stockList = $stockModel->getListStock();
        $this->render('listStock', [
            'sidebar' => UserOperation::getMenuLinks(),
            'stock' => $stockList,
            'role' => UserOperation::getRoleUser()
        ]);
    }


    public function actionCreateStock()
    {
        $this->view->title = 'Создать акцию';
        $error_message = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btnAddStock'])) {
            $stock = (!empty($_POST['stock']) ? $_POST['stock'] : null);
            if (!empty($stock)) {
                $MagazineModel = new MagazineModels();
                $result_add = $MagazineModel->addStock($stock);
                if ($result_add['result']) {
                    $this->redirect('/magazine/listStock');
                } else {
                    $error_message = $result_add['error_message'];
                }
            }
        }
        $this->render('addStock', [
            'sidebar' => UserOperation::getMenuLinks(),
            'error_message' => $error_message
        ]);
    }

    public function actionEditStock()
    {
        $this->view->title = 'Изменение акции';
        $error_message = '';
        $stock_id = !empty($_GET['stock_id']) ? $_GET['stock_id'] : null;
        $stock = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['btnEditStock'])) {
            $stocks = !empty($_GET['stock']) ? $_GET['stock'] : null;

            if (!empty($news_data)) {
                $stockModel = new MagazineModels();
                $result_edit = $stockModel->editStock($stock_id, $stocks);
                if ($result_edit['result']) {
                    $this->redirect('/magazine/listStock');
                } else {
                    $error_message = $result_edit['error_message'];
                }
            }
        }
        if (!empty($stock_id)) {
            $stock_model = new MagazineModels();
            $stock = $stock_model->getStockById($stock_id);
            if (empty($news)) {
                $error_message = 'Акция не найдена';
            }
        } else {
            $error_message = 'Отсутствует идентификатор записи';
        }
        $this->render('editStock', [
            'sidebar' => UserOperation::getMenuLinks(),
            'stock' => $stock,
            'error_message' => $error_message
        ]);
    }

    public function actionDeleteStock()
    {
        $this->view->title = 'Удаление акции';
        $stock_id = !empty($_GET['stock_id']) ? $_GET['stock_id'] : null;
        $stock = null;
        $error_message = '';

        if (!empty($stock_id)) {
            $stock_model = new MagazineModels();
            $stock = $stock_model->getStockById($stock_id);
            if (!empty($stock)) {
                $result_delete = $stock_model->deleteById($stock_id);
                if ($result_delete['result']) {
                    $this->redirect('/magazine/listStock');
                } else {
                    $error_message = $result_delete['error_message'];
                }
            } else {
                $error_message = 'Акция не найдена';
            }
        } else {
            $error_message = 'Отсутствие индентификатора записи';
        }
        $this->render('deleteStock', [
            'sidebar' => UserOperation::getMenuLinks(),
            'stock' => $stock,
            'error_massage' => $error_message
        ]);
    }

    public function actionBuyandsell()
    {
        $this->view->title = 'Магазин';
        $this->render('buyandsell', [
            'sidebar' => UserOperation::getMenuLinks()

        ]);
    }
}