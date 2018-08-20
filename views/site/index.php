<?php
use yii\widgets\ActiveForm;
use yii\helpers\html;

?>


        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'contact-form-two']); ?>

                    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'password') ?>

                    <?= $form->field($model, 'auth_key') ?>

                    <?= $form->field($model, 'password_reset_token')->textarea(['rows' => 6]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'save-user']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>