<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use yiister\gentelella\widgets\Panel;
use yii\helpers\Html;
use kartik\typeahead\Typeahead;

$data = Yii::$app->db->createCommand("select item_name from store")->queryAll(false);
$r = [];
foreach ($data as $datar){

    array_push($r,$datar[0]);

}

if (empty($r)){
    $r =["No data Found"];
}

?>
<style>
    @media only screen and (max-width: 600px){
        .t-member,.p-member ,.u-member{ width: 100%; margin-top: 5px; }
    }
</style>

<div role="main">
    <div class="x_panel">

        <div class="x_title">

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <?php if(Yii::$app->session->hasFlash('success-added-quantity')){ ?>
                <div class="alert alert-success" role="alert">
                    <?php echo Yii::$app->session->getFlash('success-added-quantity'); ?>
                </div>
            <?php } ?>
            <?php if(Yii::$app->session->hasFlash('item-fail')){ ?>
                <div class="alert alert-warning" role="alert">
                    <?php echo Yii::$app->session->getFlash('item-fail'); ?>
                </div>
            <?php } ?>
            <div class="col-md-6">
                <?php $form = ActiveForm::begin(['id'=>'store-add-search']); ?>

                <?php echo $form->field($models, 'item_name',['addon' => ['append' => [
                    'content' => Html::submitButton('Item Search', ['name'=>'btnSearch_item','class'=>'btn btn-success','id'=> 'btn-search-item']), 'asButton' => true]]])->widget(Typeahead::classname(), [
                    'options' => ['placeholder' => 'Search by Item Name'],
                    'pluginOptions' => ['highlight'=>true],
                    'dataset' => [
                        [
                            'local' => $r,
                            'limit'=>10
                        ]
                    ]
                ])->label("Search");  ?>
                <?php ActiveForm::end(); ?>
            </div>

            <div class="row">
                <div class="col-xs-12">

                    <div class="col-md-12">

                        <?php echo $tbdata_details; ?>

                    </div>
                    <div class="col-md-12">
                        <?php echo $item_status;?>
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
