<?php

namespace app\models;
use app\core\BaseModel;

class MagazineModels extends BaseModel
{
    public function addStock($stock)
    {
        $result = false;
        $error_message = '';

        if (empty($_POST['nameStock'])){
            $error_message .= 'Введите название акции';
        }
        if (empty($_POST['shortDesc'])){
            $error_message .= 'Введите краткое описание';
        }
        if (empty($_POST['descrip'])){
            $error_message .= 'Введите описание';
        }
        if (empty($_POST['price'])){
            $error_message .= 'Укажите сумму акции';
        }

        if (empty($error_message)){
            $result = $this->insert('insert into stock (name, shortDesc, descrip, price) values (:name, :shortDesc, :desc, :price)' , [
                'name' => $stock['nameStock'],
                'shortDesc' => $stock['shortDesc'],
                'descrip' => $stock['descrip'],
                'price' => $stock['price'],
                'id' => $_SESSION['user']['id']

            ]);
        }
        return[
            'result' => $result,
            'error_message' => $error_message
    ];
    }

    public function getListStock()
    {
        $result = null;
        $stock = $this->select('select * from stock');
        if (!empty($stock)){
            $result = $stock;
        }
        return $result;
    }

    public function editStock($stock_id, $stocks){
        $result = false;
        $error_message= '';
        if (empty($stock_id)){
            $error_message .='Отсутствиеп идннтификатора записи<br>';

        }
        if (empty($stocks['nameStock'])){
            $error_message.='Введите название акции<br>';
        }
        if (empty($news_data['shortDesc'])){
            $error_message.='Введите краткое описание<br>';
        }
        if (empty($news_data['descrip'])){
            $error_message.='введите описание<br>';
        }
        if (empty($error_message)){
            $result=$this->update(
                'UPDATE stock Set nameStock = :title, shortDesc =  :shortDesc, descrip = :descrip where id = :id',[
                    'title'=>$stocks['nameStock'],
                    'shortDesc'=>$stocks['shortDesc'],
                    'descrip'=>$stocks['descrip'],
                    'id'=>$stock_id,
                ]
            );
        }
        return[
            'result'=>$result,
            'error_message'=>$error_message
        ];
    }

    public function getStockById($stock_id){
        $result = null;
        $stock=$this->select('select * from stock where id= :id', [
            'id'=> $stock_id
        ]);
        if (!empty($stock[0])){
            $result=$stock[0];
        }
        return $result;
    }
    public function deleteById($stock_id){
        $result=null;
        $error_message='';
        if (empty($stock_id)){
            $error_message.='Отсутствует индентификатоr запиsиsiskipiskapopa';
        }
        if (empty($error_message)){
            $result=$this->update('Delete from stock where id = :id',
                [
                    'id'=> $stock_id,
                ]
            );

        }
        return[
            'result'=>$result,
            'error_message'=>$error_message
        ];
    }

}