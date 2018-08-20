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
    <div class="col-md-3">
        <?= $form->field($model, 'item_name')->textInput(['maxlength' => true]) ?>

          <?= $form->field($model, 'unit_price')->textInput(['maxlength' => true]) ?>

           <?= $form->field($model, 'purchasing_price')->textInput(['maxlength' => true]) ?>

             <?= $form->field($model, 'quantity')->textInput(['maxlength' => true]) ?>
             
        <?= $form->field($model, 'unit_type')->widget(Select2::classname(), [
            'data'=>ArrayHelper::map(\app\models\unitType::find()->all(),'id','unit_name'),
            'options' => ['placeholder' => 'Select payment status','id'=>'unit_type'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

        <?= $form->field($model, 'cdate')->widget(DatePicker::classname(),[ 'options'=>['id'=>'pstartdate'],
            'pluginOptions' => ['autoclose' => true,'format' => 'dd/mm/yyyy','todayHighlight' => true ]])
        ?>
        <div class="form-group">
            <?= Html::submitButton('Register this item', ['class' => 'btn btn-success']) ?>
        </div>
        <?php ActiveForm::end(); ?>

    </div>

<div class="col-md-8 col-md-offset-1">
    <label>Vitu Vyote</label>
    <?php echo $tbd; ?>

</div>
</div>







