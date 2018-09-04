<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\date\DatePicker;
use kartik\dropdown\DropdownX;
use yii\web\UploadedFile;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Members */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(['id'=>'store-register']); ?>

<div class="row">
    <?php if(Yii::$app->session->hasFlash('success-added-sale')){ ?>
        <div class="alert alert-success" role="alert">
            <?php echo Yii::$app->session->getFlash('success-added-sale'); ?>
        </div>
    <?php } ?>
    <?php if(Yii::$app->session->hasFlash('warning-added')){ ?>
        <div class="alert alert-warning" role="alert">
            <?php echo Yii::$app->session->getFlash('warning-added'); ?>
        </div>
    <?php } ?>
    <div class="col-md-4">
        <?= $form->field($model, 'details')->widget(Select2::classname(), [
            'data'=>ArrayHelper::map(\app\models\Store::find()->all(),'id','item_name'),
            'options' => ['placeholder' => 'Select Item','id'=>'price'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
        <?= $form->field($model, 'quantity')->textInput(['maxlength' => true,'id'=>'quantity'])->label("Quantity",['id'=>'quantity-label']) ?>

        <?= $form->field($model, 'isdiscount')->widget(Select2::classname(), [
            'data'=>['Y'=>'Yes','N'=>'No'],
            'options' => ['placeholder' => 'Select Item','value'=>'N','id'=>'isdiscount'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
        <?= $form->field($model, 'discount_amount')->textInput(['maxlength' => true,'id'=>'discount_amount']) ?>

    </div>

    <div class="col-md-4 col-md-offset-1">
        <?= $form->field($model, 'price')->textInput(['maxlength' => true,'readonly'=>true,'id'=>'item_price']) ?>

        <?= $form->field($model, 'date')->widget(DatePicker::classname(),[ 'options'=>['id'=>'sales-date'],
            'pluginOptions' => ['autoclose' => true,'format' => 'dd/mm/yyyy','todayHighlight' => true ]])
        ?>
        <?= $form->field($model, 'transactionType')->widget(Select2::classname(), [
            'data'=>['c'=>'Cash','b'=>'Bank'],
            'options' => ['placeholder' => 'Select Transaction Type','value'=>'N','id'=>'transactiontype'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
        <div class="form-group">
            <?= Html::submitButton('Save This Sale', ['class' => 'btn btn-success','name'=>'sale-save']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<?php
$script = <<< JS
  
$(document).ready(function(e) {
 
    // disable discount amount field if isdiscount is No.
     $("#discount_amount").prop("readonly",true);

    
    $('#isdiscount').change(function(e) {
      
       var isdiscount = $("#isdiscount").find("option:selected").val();
            
          console.log(isdiscount);
    
    if(isdiscount==="N"){
        
        $("#discount_amount").prop("readonly",true);
   
    } else if(isdiscount==="Y") {
               
             $("#discount_amount").prop("readonly",false);
             

    }
    
    });
    
  
   $('#discount_amount').on('input', function() {
        
       var discount = $("#discount_amount").val();
       var id  = $("#price").find("option:selected").val();
        $.post("discount",{discount:discount,id:id},function(data) {
         
            if(data==="error"){
                console.log(data); 
                 $("#item_price").val("THIS DISCOUNT AMOUNT NOT ALLOWED");
            }
             else {
                
           $("#item_price").val(data);
           console.log(data);
             }
             
       });
      
        });
   
   
    $("#price").change(function( e) {
        
       var price =  $("#price").find("option:selected").val();
       
       console.log(price);
       $.post("price",{price:price},function(data) {
         
           $("#item_price").val(data);
           console.log(data);
       });
       
        $.post("unit",{id:price},function(data) {
          $("#spanid").remove();
            var span  =  "<span id='spanid'>("+data+")</span>";
          $("#quantity-label").append(" "+span);
           console.log(data);
       });
       
      
    })
 
});

if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

JS;
$this->registerJs($script);
?>










