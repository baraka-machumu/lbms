
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
            <h2 style="color: black">Ordered Items</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <div class="row">
                <div class="col-xs-12">
                    <?php if(Yii::$app->session->hasFlash('success-order')){ ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo Yii::$app->session->getFlash('success-order-created'); ?>
                        </div>
                    <?php } ?>
                    <?php if(Yii::$app->session->hasFlash('purchased-order-created')){ ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo Yii::$app->session->getFlash('purchased-order-created'); ?>
                        </div>
                    <?php } ?>

                    <?php if(Yii::$app->session->hasFlash('purchased-order-failed')){ ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo Yii::$app->session->getFlash('purchased-order-failed'); ?>
                        </div>
                    <?php } ?>
        <table class="table table-striped table-bordered">
            <tr> <td><?php  echo $tbdata; ?></td> </tr>

        </table>




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

