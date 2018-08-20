<?php

/* @var $this yii\web\View */


use yii\helpers\Html;
//use yii\bootstrap\Tabs;
use kartik\tabs\TabsX;

?>

<?php echo TabsX::widget(['items' => [
    [
        'label' =>'<i class="glyphicon glyphicon-eye-open"></i> 1.View Basic Details',
        'content' => $this->render('view_item',['models'=>$models,'tbdata_details'=>$tbdata_details,'item_status'=>$item_status]),
        'active'=> $tab1
    ],

    [
        'label' =>'<i class="glyphicon glyphicon-check"></i> 1.Update',
        'content' => $this->render('update_item',['models'=>$models,'items'=>$items]),
        'active'=> $tab2
    ],
    [
        'label' =>'<i class="glyphicon glyphicon-pencil"></i> 3.Add Item',
        'content' => $this->render('add_item',['models'=>$models, 'tbdata_add'=>$tbdata_add,'item_name'=>$item_name]),
        'active'=> $tab3
    ],
    [
        'label' =>'<i class="glyphicon glyphicon-trash"></i> 3.Remove Item',
        'content' => $this->render('delete_item',['models'=>$models]),
        'active'=> $tab3
    ],




],
    'bordered'=>true,'encodeLabels'=>false]); ?>


