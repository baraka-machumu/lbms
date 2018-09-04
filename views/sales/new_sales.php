<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Url;
use yiister\gentelella\widgets\Panel;


?>
<style>
    @media only screen and (max-width: 600px){
        .t-member,.p-member ,.u-member{ width: 100%; margin-top: 5px; }
    }
</style>

<div role="main">
    <div class="x_panel">

        <div class="x_title">
            <h2>New Sale(s)</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <div class="row">
                <div class="col-xs-12">

                       <?= $this->render('_form_sales',['model'=>$model]) ?>


                </div>
                <div class="col-md-12">
                    <?php echo $tbdata_add; ?>
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
