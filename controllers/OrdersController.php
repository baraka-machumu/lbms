<?php

namespace app\controllers;

use app\models\Orders;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

class OrdersController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreate()
    {
        $this->layout ="main-dukani";
        $model = new Orders();
        $tborder = "";

        if (isset($_POST['order-save'])) {

            $model->load(yii::$app->request->post());

            $supplier = $model->supplier;
            $itemid = $model->itemid;
            $seller_address=$model->seller_address;
            $quantity=$model->quantity;
            $seller_tel_number=$model->seller_tel_number;
            $email=$model->email;

            $order_date = date('Y-m-d', strtotime(str_replace('/', '-', $model->order_date)));
            $delivery_date = date('Y-m-d', strtotime(str_replace('/', '-', $model->delivery_date)));

            $sql = "insert into orders(supplier, order_date, delivery_date, itemid, seller_address, quantity,seller_tel_number, email) values(:supplier, :order_date, :delivery_date, :itemid, :seller_address, :quantity, :seller_tel_number, :email)";
            $save = yii::$app->db->createCommand($sql);
            $save->bindValue(":supplier", $supplier);
            $save->bindValue(":order_date", $order_date);
            $save->bindValue(':delivery_date', $delivery_date);
            $save->bindValue(':itemid', $itemid);
            $save->bindValue(':seller_address', $seller_address);
            $save->bindValue(':quantity', $quantity);
            $save->bindValue(':seller_tel_number', $seller_tel_number);
            $save->bindValue(':email', $email);

            //check if order has been placed.....
            $sqlcheck = "SELECT supplier, order_date, delivery_date, itemid, seller_address, quantity, seller_tel_number, email FROM orders where supplier='$supplier' and  order_date='$order_date'and delivery_date='$delivery_date' and  itemid='$itemid' and seller_address='$seller_address' and quantity='$quantity' and seller_tel_number='$seller_tel_number' and email='$email' ";
            $check = Yii::$app->db->createCommand($sqlcheck)->queryOne(false);
            if (!empty($check)) {
                Yii::$app->session->setFlash('order-exist', "Order Already exists");

            } else {

                $success = $save->execute();
                if ($success){
                    $id = Yii::$app->db->getLastInsertID();

                    $sqldata =  "select s.item_name, o.order_date, o.delivery_date, o.supplier, o.seller_address, o.quantity, o.seller_tel_number, o.email 
                          from orders as o inner join store as s on s.id=o.itemid where o.id = '$id'";
                    $data = yii::$app->db->createCommand($sqldata)->queryOne(false);
                    $item_name = $data['item_name'];
                    $order_date=$data['order_date'];
                    $delivery_date=$data['delivery_date'];
                    $supplier=$data['supplier'];
                    $seller_address=$data['seller_address'];
                    $quantity=$data['quantity'];
                    $seller_tel_number=$data['seller_tel_number'];
                    $email=$data['email'];

                    $tborder = "<table class='table table-striped table-condensed table-bordered'>
                            <tr> <th>Supplier</th><th>Order Date</th><th>Delivery Date</th><th>Item Name</th>
                                 <th>Seller Address</th><th>Quantity</th><th>Seller Telephone Number</th><th>Email</th>
                            </tr>
                            <tr> <td>$supplier</td><td>$order_date</td><td>$delivery_date</td><td>$item_name</td>
                                <td>$seller_address</td><td>$quantity</td><td>$seller_tel_number</td><td>$email</td>
                            </tr>
                        </table>";
                    Yii::$app->session->setFlash('success-order-created', "Order has been added Successful placed");
                }
                else {
                    Yii::$app->session->setFlash('success-order-fail', "Order could not be placed");
                }
            }
            }

            $model->supplier="";
            $model->order_date="";
            $model->delivery_date="";
            $model->itemid="";
            $model->seller_address="";
            $model->quantity="";
            $model->seller_tel_number="";
            $model->email="";
            return $this->render('create_order', ['model' => $model, 'tborder' => $tborder]);
        }

        public function actionOrdered(){

             $this->layout ="main-dukani";
             $query = "SELECT o.id, o.supplier, o.order_date, o.delivery_date, s.item_name, o.seller_address, o.quantity, o.seller_tel_number, o.email, o.status FROM orders AS o
                        INNER JOIN store AS s ON s.id =  o.itemid  WHERE o.status = 0";
             $data  = yii::$app->db->createCommand($query)->queryAll(false);


             $tbdata =  "<table class='table table-striped table-bordered'><tr style='color: black'><th>Supplier</th><th>Order Date</th><th>Delivery Date</th>";
             $tbdata .="<th>Item Name</th><th>Seller Address</th><th>Quantity</th> <th> Telephone Number</th>";
             $tbdata .="<th>Email Address</th> <th>Status</th><th>Action</th></tr>";

             foreach ($data as $orders){
                 $id=$orders['id'];
                 $supplier = $orders['supplier'];
                 $order_date=$orders['order_date'];
                 $delivery_date=$orders['delivery_date'];
                 $item_name=$orders['item_name'];
                 $seller_address=$orders['seller_address'];
                 $quantity=$orders['quantity'];
                 $seller_tel_number=$orders['seller_tel_number'];
                 $email=$orders['email'];
                $status=$orders['status'];


                 $tbdata .="<tr style='color: black'><td>$supplier</td><td>$order_date</td><td>$delivery_date</td>";
                 $tbdata.="<td>$item_name</td><td>$seller_address</td><td>$quantity</td>";
                 $tbdata.="<td>$seller_tel_number</td><td>$email</td><td>$status</td><td>".Html::a('<b style="color: yellow">Received</b>',
                         ['orders/received', 'id' =>$id],
                         ['class' => 'profile-link'])."</td></tr>";




             }

             $tbdata.="</table>";

        return $this->render('ordered_item',['tbdata'=> $tbdata]);




        }

      public function actionReceived($id){


          $query = Yii::$app->db->createCommand("call selectAllOrders(:id)")
              ->bindValue(':id' , $id);
          $success =$query->execute();

          if($success){
              Yii::$app->session->setFlash('purchased-order-created', "Purchase Successful placed");
          }
          else{
              Yii::$app->session->setFlash('purchased-order-failed', 'Purchased Failed');
          }

          return $this->redirect(['orders/ordered']);
      }


}
