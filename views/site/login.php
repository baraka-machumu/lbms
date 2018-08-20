<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yiister\gentelella\widgets\Panel;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>


        <?php if(Yii::$app->session->hasFlash('expired')){ ?>
        <div class="alert alert-error" role="alert">
        <?php echo Yii::$app->session->getFlash('expired'); ?>
        </div>
        <?php } ?>

      <div class="login_wrapper">
          <div class="row">
              <div class="col-lg-12" style="">
                  <?php if(Yii::$app->session->hasFlash('success-saved')){ ?>
                      <div class="alert alert-success" role="alert">
                          <?php echo Yii::$app->session->getFlash('success-saved'); ?>
                      </div>
                  <?php } ?>
                  <?php if(Yii::$app->session->hasFlash('login-fail')){ ?>
                      <div class="alert alert-warning" role="alert">
                          <?php echo Yii::$app->session->getFlash('login-fail'); ?>
                      </div>
                  <?php } ?>
              </div>

          </div>
       <section class="login_content">
        <img src="../web/images/logo.png" width="40" height="40" />
       <?php $form = ActiveForm::begin([
        'id' => 'login-form',
               
    ]); ?>
    <div style="width:100%">
        <?php
        Panel::begin(
            [
                'header' => 'Login',
                'icon' => 'cog',
            ]
        )
        ?>
        
        <p>
       
       <div>
        <?= $form->field($model, 'username')->textInput(['autofocus' => true,'placeholder' => "username"])->label(false) ?>
       </div>
       <div>
        <?= $form->field($model, 'password')->passwordInput(['placeholder' => "Password"])->label(false) ?>
        </div>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>
        
         <div class="clearfix"></div>

              <div class="separator">
               
                <div class="clearfix"></div>
                <br />

                <div>
                 
                  <p><b>2018 , lbms - Version 1.0 </b></p>
                </div>
              </div>
              </p>
 <?php Panel::end() ?>
    </div>
    <?php ActiveForm::end(); ?>
     </section>
    
       </div>
