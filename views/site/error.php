<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\date\DatePicker;
use kartik\dropdown\DropdownX;
use yii\web\UploadedFile;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

?>
<div class="site-error">

    <?php $form = ActiveForm::begin(['id'=>'store-register']); ?>

   <?= $form->field($model, 'unit_type')->widget(Select2::classname(), [
            'data'=>ArrayHelper::map(\app\models\unitType::find()->all(),'id','unit_name'),
            'options' => ['placeholder' => 'Select payment status','id'=>'unit_type'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>
   <?php ActiveForm::end(); ?>


</div>

<?php
$script = <<< JS
  
$(document).ready(function(e) {


$("#unit_type").change(function(e){


      var data =  $("#unit_type").val();

        console.log(data);
      $.post('json',{data:data}, function(data){

        console.log(data);
        no  = JSON.parse(data);
        console.log(no[1]);
        });  
    });

    
});
JS;
$this->registerJs($script);
?>

