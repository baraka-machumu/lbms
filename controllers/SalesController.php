<?php

namespace app\controllers;

use app\models\Sales;
use Yii;

class SalesController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function  actionCreate(){
        $this->layout ="main-dukani";
        $model =  new Sales();

        $tbdata_add ="";

        if (isset($_POST['sale-save'])){
            $model->load(yii::$app->request->post());
            $cby  =  yii::$app->user->identity->getId();

            $details= $model->details;
            $price =  $model->price;
            $isdiscount = $model->isdiscount;
            $discount_amount  = $model->discount_amount;
            $transactiontype =  $model->transactionType;
            $quantity = $model->quantity;
            $cash = null;
            $bank = null;

            $date =  date('Y-m-d',  strtotime(str_replace('/','-',$model->date)));

            if ($transactiontype=="c"){
                $cash =  $price;
                $bank = null;

            } else if($transactiontype=="b"){
                $cash =  null;
                $bank = $price;
            }


            $q = "insert into sales(details,cash,bank,isdiscount,date,discount_amount,quantity,cby) values(:details,:cash,:bank,:isdiscount,:date,:discount_amount,:quantity,:cby)";
            $save= yii::$app->db->createCommand($q);
            $save->bindValue(":details",$details);
            $save->bindValue(":cash",$cash);
            $save->bindValue(":bank",$bank);
            $save->bindValue(":isdiscount",$isdiscount);
            $save->bindValue(":date",$date);
            $save->bindValue(":discount_amount",$discount_amount);
            $save->bindValue(":quantity",$quantity);
            $save->bindValue(":cby",$cby);

            $success =  $save->execute();
            if ($success){
                $id=  $details;
                $item =  yii::$app->db->createCommand("select item_name from store where id='$id'")->queryScalar();

                $model->details="";
                $model->price="";
                $model->isdiscount="";
                $model->discount_amount="";
                $model->transactionType="";
                Yii::$app->session->setFlash('success-added-sale', "sale Successful saved");




                $tbdata_add ="<table class='table table-striped table-condensed table-bordered'>
                            <tr><th>Date</th><th>Details</th><th>Discount Amount</th><th>Cash</th><th>Bank</th></tr>
                            <tr><td>$date</td><td>$item</td><td>$discount_amount</td><td>$cash</td><td>$bank</td></tr>
                            </table>";
            }


        }
        return $this->render('new_sales',['model'=>$model,'tbdata_add'=>$tbdata_add]);
    }



    public function  actionPrice(){

        $id  =  $_POST['price'];

        $price = yii::$app->db->createCommand("select unit_price from store where id='$id'")->queryScalar();

        echo $price;



    }

    public function  actionDiscount(){

        $discount  =  $_POST['discount'];
        $id  =  $_POST['id'];
        $price = yii::$app->db->createCommand("select unit_price from store where id='$id'")->queryScalar();

        $real_price=  $price-$discount;

        if ($real_price<($price/2))
        {
            echo "error";
        }  else {

            echo $real_price;
        }


    }

    public function actionUnit(){

        $id  =  $_POST['id'];

        $data =  yii::$app->db->createCommand("select unit_name from store inner join unit_type on store.unit_type=unit_type.id where store.id = '$id'")->queryScalar();
        echo $data;
    }


}
