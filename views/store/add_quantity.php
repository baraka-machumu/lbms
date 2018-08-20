<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use yiister\gentelella\widgets\Panel;
use yii\helpers\Html;
use kartik\typeahead\Typeahead;


?>
<style>
    @media only screen and (max-width: 600px){
        .t-member,.p-member ,.u-member{ width: 100%; margin-top: 5px; }
    }
</style>

<div role="main">
    <div class="x_panel">

        <div class="x_title">
            <h2>Add Quantity Item</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <?php if(Yii::$app->session->hasFlash('success-added-quantity')){ ?>
                <div class="alert alert-success" role="alert">
                    <?php echo Yii::$app->session->getFlash('success-added-quantity'); ?>
                </div>
            <?php } ?>
            <div class="col-md-6">
           <p>Adding item</p>
            </div>

            <div class="col-md-6">

                <?php echo $tbdata_add; ?>
            </div>
            <div class="row">
                <div class="col-xs-12">

                    <div class="col-md-4">
                        <?php $form = ActiveForm::begin(['id'=>'store-add']); ?>

                        <?= $form->field($model, 'quantity')->textInput(['maxlength' => true]) ?>

                        <div class="form-group">
                            <?= Html::submitButton('Add '.$item_name, ['class' => 'btn btn-success','name'=>'add_item']) ?>
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
