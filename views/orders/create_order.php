
<?php use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$form = ActiveForm::begin(['id'=>'create-order']); ?>
<style>
    @media only screen and (max-width: 600px){
        .t-member,.p-member ,.u-member{ width: 100%; margin-top: 5px; }
    }
</style>

<div role="main">
    <div class="x_panel">

        <div class="x_title">
            <h2 style="color: black">Make an order</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <div class="row">
                <div class="col-xs-12">


                    <?php if(Yii::$app->session->hasFlash('success-order-created')){ ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo Yii::$app->session->getFlash('success-order-created'); ?>
                        </div>
                    <?php } ?>
                    <?php if (Yii::$app->session->hasFlash('success-order-fail')){?>
                        <div class="alert alert-warning" role="alert">
                            <?php  echo Yii::$app->session->getFlash('success-order-fail'); ?>
                        </div>

                    <?php } ?>
                    <?php if (Yii::$app->session->hasFlash('order-exist')){?>
                        <div class="alert alert-warning" role="alert">
                            <?php  echo Yii::$app->session->getFlash('order-exist'); ?>
                        </div>

                    <?php } ?>

                    <div class="col-md-4">
                        <?= $form->field($model, 'supplier')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($model, 'order_date')->widget(DatePicker::classname(),[ 'options'=>['id'=>'pstartdate'],
                            'pluginOptions' => ['autoclose' => true,'format' => 'dd/mm/yyyy','todayHighlight' => true ]])
                        ?>
                        <?= $form->field($model, 'delivery_date')->widget(DatePicker::classname(),[ 'options'=>['id'=>'delivery'],
                            'pluginOptions' => ['autoclose' => true,'format' => 'dd/mm/yyyy','todayHighlight' => true ]])

                        ?>
                        <?= $form->field($model, 'itemid')->widget(Select2::classname(), [
                            'data'=>ArrayHelper::map(\app\models\Store::find()->all(),'id','item_name'),
                            'options' => ['placeholder' => 'Select Product'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]); ?>
                        <div class="form-group">
                            <?= Html::submitButton('Order this item', ['class' => 'btn btn-success','name'=>'order-save']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>

                    </div>
                    <div class="col-md-4">
                        <?=$form->field($model, 'seller_address')->textInput(['maxlength'=>true]) ?>
                        <?=$form->field($model, 'quantity')->textInput(['maxlength'=>true]) ?>
                        <?=$form->field($model, 'seller_tel_number')->textInput(['maxlength'=>true])?>
                        <?=$form->field($model,'email')->textInput(['maxlength'=>true])?>


                    </div>

                    <br>
                    <br>
                    <div class="col-md-12">
                        <table class="table table-striped table-bordered">
                            <tr><td style="color: black">Saved Data</td></tr>
                            <tr> <td><?php  echo $tborder; ?></td> </tr>
                        </table>
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

