<?php

namespace app\controllers;

use app\models\Store;
use yii;
class StoreController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionRegister(){

        $this->layout ="main-dukani";
        $model =  new Store();
        $tbd = "";

        if ($model->load(yii::$app->request->post())){

            $item  =  $model->item_name;
            $cby  =  yii::$app->user->identity->getId();

            $quantity= $model->quantity;
            $unit_price =  $model->unit_price;
            $purchasing_price = $model->purchasing_price;
            $unit_type  = $model->unit_type;

            $cdate =  date('Y-m-d',  strtotime(str_replace('/','-',$model->cdate)));

            $q = "insert into store (item_name,quantity,unit_price,purchasing_price,unit_type,cby,cdate) values(:item,:quantity,:unit_price,:purchasing_price,:unit_type,:cby,:cdate)";
            $save= yii::$app->db->createCommand($q);
            $save->bindValue(":item",$item);
            $save->bindValue(":quantity",$quantity);
            $save->bindValue(":unit_price",$unit_price);
            $save->bindValue(":purchasing_price",$purchasing_price);
            $save->bindValue(":unit_type",$unit_type);
            $save->bindValue(":cby",$cby);
            $save->bindValue(":cdate",$cdate);

            $exist =  yii::$app->db->createCommand("select item_name from store where item_name ='$item'")->queryScalar();

            if (!empty($exist)){
                $tbd =  $this->getItems();

                Yii::$app->session->setFlash('warning-added', $item." Already Added");
                $model->cdate ='';
                $model->item_name='';
                return $this->render('register',['model'=>$model,'tbd'=>$tbd]);

            }

            if($save->execute()){

                $tbd =  $this->getItems();
                Yii::$app->session->setFlash('success-added', $item." Imeongezwa kiusahihi");
                $model->cdate ='';
                $model->item_name='';
                return $this->render('register',['model'=>$model,'tbd'=>$tbd]);

            }

        }
        $model->cdate ='';
        $model->item_name='';
        $tbd =  $this->getItems();
        return $this->render('register',['model'=>$model,'tbd'=>$tbd]);
    }

    public function  getItems(){
        $this->layout ="main-dukani";
        $items =  yii::$app->db->createCommand("select item_name,quantity,unit_price,purchasing_price,unit_name from store  inner join unit_type on  unit_type.id =  store.unit_type order by store.id desc")->queryAll(false);

        if (!empty($items)){
            $tbd ="<table class='table table-striped table-condensed'><tr><th>No</th><th>Item name</th><th>Quantity</th>";
            $tbd .="<th>Unit Price</th><th>Purchasing Price</th><th>Unit</th></tr>";

            $i =1;
            foreach ($items as $item) {
                $tbd .= "<tr><td>$i</td><td>$item[0]</td><td>$item[1]</td><td>$item[2]</td><td>$item[3]</td><td>$item[4]</td></tr>";
                $i++;
            }
            $tbd .="</table>";
        }
        else {
            $tbd  =  "<table class='table table-striped'><tr><td>No Data Found</td></tr></table>";
        }
        return $tbd;
    }

    public function  actionAdd(){
        $this->layout ="main-dukani";

        $model = new Store();

        $tbdata_add = "";
        $item_name= "";

        if (isset($_POST['btnSearch_add'])){

            $model->load(yii::$app->request->post());

            $item_name =  $model->item_name;

            $items =  yii::$app->db->createCommand("select id,quantity,item_name,unit_price from store where item_name='$item_name'")->queryOne(false);

            $id  =  $items['id'];
            $item_name =  $items['item_name'];
            $quantity =  $items['quantity'];
            $unit_price =  $items['unit_price'];

            $tbdata_add ="<table class='table table-striped table-condensed'>
                            <tr><td>Item Name</td><td>Unit Price</td><td>Quantity Present</td></tr>
                            <tr><td>$item_name</td><td>$unit_price</td><td>$quantity</td></tr>
                            </table>";

            if(empty($items)){

                $tbdata_add ="";
            }

            $_SESSION['item_id'] =$id;
            $_SESSION['quantity'] =$quantity;
            $_SESSION['item_name'] =$item_name;

            return $this->render('add_quantity',['model'=>$model,'tbdata_add'=>$tbdata_add,'item_name'=>$item_name]);
        }

        if (isset($_POST['add_item'])){

            $model->load(yii::$app->request->post());
            $id = $_SESSION['item_id'];

            $quantity_previous =  yii::$app->db->createCommand("select quantity from store where id='$id'")->queryOne(false);

            $quantity_previous= $quantity_previous['quantity'];

            $item_name =  $_SESSION['item_name'];

            $quantity_added =  $model->quantity;

            $new_quantity =  $quantity_previous+$quantity_added;


            $q = "update store set  quantity =:quantity where id= '$id'";
            $save= yii::$app->db->createCommand($q);

            $success =  $save->bindValue(":quantity",$new_quantity)->execute();


            if ($success){

                Yii::$app->session->setFlash('success-added-quantity', $quantity_added." ".$item_name." Added Successful");

                $items =  yii::$app->db->createCommand("select id,quantity,item_name,unit_price from store where item_name='$item_name'")->queryOne(false);

                $id  =  $items['id'];
                $item_name =  $items['item_name'];
                $quantity =  $items['quantity'];
                $unit_price =  $items['unit_price'];

                $tbdata_add ="<table class='table table-striped table-condensed'>
                            <tr><td>Item Name</td><td>Unit Price</td><td>Quantity Present</td></tr>
                            <tr><td>$item_name</td><td>$unit_price</td><td>$quantity</td></tr>
                            </table>";

                if(empty($items)){

                    $tbdata_add ="";
                }
                return $this->render('add_quantity',['model'=>$model,'tbdata_add'=>$tbdata_add,'item_name'=>$item_name]);

            }

        }

        return $this->render('add_quantity',['model'=>$model,'tbdata_add'=>$tbdata_add,'item_name'=>$item_name]);

    }

    public function   getItemDetails($name){

        $items = $this->getAllItems($name);

        $id  =  $items['id'];
        $item_name =  $items['item_name'];
        $quantity =  $items['quantity'];
        $unit_price =  $items['unit_price'];
        $unit_type =  $items['unit_name'];
        $purchasing_price =  $items['purchasing_price'];

        $_SESSION['id']=  $id;

        $status =  $items['status'];
        if ($status==1){
            $status = "Active";
        } else {
            $status = "Not Available";
        }

        $alert ="";
        if ($quantity<=2){

            $alert  = "Item(s) remain very few in store";
        }
        else {
            $alert = "Item(s) are still there in store";
        }


        $tbdata_details ="<table class='table table-striped table-condensed table-bordered'>
                            <tr><th>Item Name</th><td>$item_name</td></tr>
                            <tr><th>Unit Price</th><td>$unit_price</td></tr>
                            <tr><th>Quantity Present</th><td>$quantity</td></tr>
                            <tr><th>Unit Type</th><td>$unit_type</td></tr>
                            </table>";

        return $tbdata_details;
    }
    public function  getAllItems($name){
        $items =  yii::$app->db->createCommand("SELECT s.id,s.status,s.quantity,s.item_name,s.unit_price,s.cdate,s.purchasing_price,u.unit_name FROM store AS s
                                                      INNER JOIN unit_type AS u ON u.id = s.unit_type  WHERE item_name='$name'")->queryOne(false);
        return $items;
    }
    public function  getItemStatus($name){

        $items =  $this->getAllItems($name);
        $quantity =  $items['quantity'];

        $status =  $items['status'];
        if ($status==1){
            $status = "Active";
        } else {
            $status = "Not Available";
        }

        $alert ="";
        if ($quantity<=2){

            $alert  = "Item(s) remain very few in store";
        }
        else {
            $alert = "Item(s) are still there in store";
        }
        $item_status = "<table class='table table-condensed table-striped'>
                             <tr><th>Status</th><th>Alert</th></tr>
                             <tr><td>$status</td><td>$alert</td></tr>
                             
                           </table>";

        return $item_status;

    }


    public function actionView(){
        $this->layout ="main-dukani";
        $models =   new Store();
        $tab1 =  true;
        $tab2= $tab3  =  false;
        $tbdata_details = "";
        $item_status ="";
        $tbdata_add = "";
        $item_name = "";
        $items = [];

        if (isset($_POST['btnSearch_item'])){

            $models->load(yii::$app->request->post());

             $name =  $models->item_name;

             $items =  $this->getAllItems($name);


            $tbdata_details =  $this->getItemDetails($name);
            $item_status =  $this->getItemStatus($name);

            if (empty($items)){
                $tbdata_details ="";
                $item_status ="";

                Yii::$app->session->setFlash('item-fail', "<strong>".$name."</strong> Item Does Not exists");

            }

        }

        //update item

        if (isset($_POST['update_item'])){

            $tab =2;
            $tab1 = $tab2 = $tab3= false;
            if ($tab == 1) {
                $tab2 = $tab3 = false;
                $tab1 = true;
            } elseif ($tab == 2) {
                $tab1 = $tab3 = false;
                $tab2 = true;
            } elseif ($tab == 3) {
                $tab1 = $tab2 =false;
                $tab3 = true;
            }

                $models->load(yii::$app->request->post());

                $id = $_SESSION['id'];
                $item  =  $models->item_name;
                $cby  =  yii::$app->user->identity->getId();

                $quantity= $models->quantity;
                $unit_price =  $models->unit_price;
                $purchasing_price = $models->purchasing_price;
                $unit_type  = $models->unit_type;
                $cdate =  $models->cdate;

                $q = "update  store set item_name =:item_name,quantity=:quantity,unit_price=:unit_price,purchasing_price=:purchasing_price,unit_type=:unit_type,cby=:cby,cdate=:cdate where id =:id";
                $save= yii::$app->db->createCommand($q);
                $save->bindValue(":item_name",$item);
                $save->bindValue(":quantity",$quantity);
                $save->bindValue(":unit_price",$unit_price);
                $save->bindValue(":purchasing_price",$purchasing_price);
                $save->bindValue(":unit_type",$unit_type);
                $save->bindValue(":cby",$cby);
                $save->bindValue(":cdate",$cdate);
                $save->bindValue(":id",$id);

                if ($save->execute()){

                    $tbdata_details =  $this->getItemDetails($item);
                    $item_status =  $this->getItemStatus($item);
                    $items =  $this->getAllItems($item);

                    Yii::$app->session->setFlash('success-updated', "<strong>".$item."</strong> has been Updated successful.");

                }

        }

        if (isset($_POST['add_item'])){

            $models->load(yii::$app->request->post());
            $id = $_SESSION['item_id'];

            $quantity_previous =  yii::$app->db->createCommand("select quantity from store where id='$id'")->queryOne(false);

            $quantity_previous= $quantity_previous['quantity'];

            $item_name =  $_SESSION['item_name'];

            $quantity_added =  $models->quantity;

            $new_quantity =  $quantity_previous+$quantity_added;



            $q = "update store set  quantity =:quantity where id= '$id'";
            $save= yii::$app->db->createCommand($q);

            $success =  $save->bindValue(":quantity",$new_quantity)->execute();


            if ($success){

                Yii::$app->session->setFlash('success-added-quantity', $quantity_added." ".$item_name." has been added Successful");

                $items =  yii::$app->db->createCommand("select id,quantity,item_name,unit_price from store where item_name='$item_name'")->queryOne(false);

                $id  =  $items['id'];
                $item_name =  $items['item_name'];
                $quantity =  $items['quantity'];
                $unit_price =  $items['unit_price'];

                $tbdata_add ="<table class='table table-striped table-condensed'>
                            <tr><td>Item Name</td><td>Unit Price</td><td>Quantity Present</td></tr>
                            <tr><td>$item_name</td><td>$unit_price</td><td>$quantity</td></tr>
                            </table>";

                if(empty($items)){

                    $tbdata_add ="";
                }
            }

        }

        if (isset($_POST['add-item-btn'])){

        }

        return $this->render('tab',
            ['models'=>$models,'tab1'=>$tab1,'tab2'=>$tab2,'tab3'=>$tab3,'tbdata_details'=>$tbdata_details,
                'tbdata_add'=>$tbdata_add,'item_name'=>$item_name,'item_status'=>$item_status,'items'=>$items]);
    }

    public function  getPurchasedItemDetails(){



    }


}
