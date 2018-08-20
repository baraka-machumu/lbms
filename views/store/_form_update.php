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

    <?php $form = ActiveForm::begin(['id'=>'store-updates','action'=>'update']); ?>

<div class="row">
    <?php if(Yii::$app->session->hasFlash('success-added')){ ?>
        <div class="alert alert-success" role="alert">
            <?php echo Yii::$app->session->getFlash('success-added'); ?>
        </div>
    <?php } ?>
    <?php if(Yii::$app->session->hasFlash('warning-added')){ ?>
        <div class="alert alert-warning" role="alert">
            <?php echo Yii::$app->session->getFlash('warning-added'); ?>
        </div>
    <?php } ?>
    <div class="col-md-10">
         <?php if (empty($items)){

         } else {?>
        <div class="col-md-5">
        <?= $form->field($model, 'item_name')->textInput(['maxlength' => true,'value'=>$items['item_name']]) ?>

          <?= $form->field($model, 'unit_price')->textInput(['maxlength' => true,'value'=>$items['unit_price']]) ?>

           <?= $form->field($model, 'purchasing_price')->textInput(['maxlength' => true,'value'=>$items['purchasing_price']]) ?>
            <div class="form-group">
                <?= Html::submitButton('Update this item', ['class' => 'btn btn-success','name'=>'upadate_item']) ?>
            </div>
        </div>

        <div class="col-md-5">
            <?= $form->field($model, 'quantity')->textInput(['maxlength' => true,'value'=>$items['quantity']]) ?>

            <?= $form->field($model, 'unit_type')->widget(Select2::classname(), [
                'data'=>ArrayHelper::map(\app\models\unitType::find()->all(),'id','unit_name'),
                'options' => ['id'=>'unit_type','value'=>$items['id']],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); ?>

            <?= $form->field($model, 'cdate')->widget(DatePicker::classname(),[ 'options'=>['id'=>'pstartdate','disabled'=>true ,'value'=>$items['cdate']],
                'pluginOptions' => ['autoclose' => true,'format' => 'dd/mm/yyyy','todayHighlight' => true]])
            ?>
        </div>


        <?php }?>

    </div>

    <?php ActiveForm::end(); ?>
</div>







