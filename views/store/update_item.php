<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\date\DatePicker;
use yii\web\UploadedFile;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

?>
<style>
    @media only screen and (max-width: 600px){
        .t-member,.p-member ,.u-member{ width: 100%; margin-top: 5px; }
    }
</style>

<div role="main">
    <div class="x_panel">

        <div class="x_title">
            <h2>Update Item</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <div class="row">
                <div class="col-xs-12">

                    <?php $form = ActiveForm::begin(['id'=>'store-update']); ?>

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
                        <?php if(Yii::$app->session->hasFlash('success-updated')){ ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo Yii::$app->session->getFlash('success-updated'); ?>
                            </div>
                        <?php } ?>
                        <div class="col-md-10">
                            <?php if (empty($items)){

                            } else {?>
                                <div class="col-md-5">
                                    <?= $form->field($models, 'item_name')->textInput(['maxlength' => true,'value'=>$items['item_name']]) ?>

                                    <?= $form->field($models, 'unit_price')->textInput(['maxlength' => true,'value'=>$items['unit_price']]) ?>

                                    <?= $form->field($models, 'purchasing_price')->textInput(['maxlength' => true,'value'=>$items['purchasing_price']]) ?>
                                    <div class="form-group">
                                        <?= Html::submitButton('Update this item', ['class' => 'btn btn-success','name'=>'update_item']) ?>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <?= $form->field($models, 'quantity')->textInput(['maxlength' => true,'value'=>$items['quantity']]) ?>

                                    <?= $form->field($models, 'unit_type')->widget(Select2::classname(), [
                                        'data'=>ArrayHelper::map(\app\models\unitType::find()->all(),'id','unit_name'),
                                        'options' => ['id'=>'unit_type','value'=>$items['id']],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ]); ?>

                                    <?= $form->field($models, 'cdate')->widget(DatePicker::classname(),[ 'options'=>['id'=>'pstartdate','readonly' => true ,'value'=>$items['cdate']],
                                        'pluginOptions' => ['autoclose' => true,'format' => 'dd/mm/yyyy','todayHighlight' => true]])
                                    ?>
                                </div>


                            <?php }?>

                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>
<?php
$script = <<< JS
  
$(document).ready(function(e) {
 
 
});

JS;
$this->registerJs($script);
?>
