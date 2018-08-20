<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\helpers\Url;
use yiister\gentelella\widgets\Panel;


?>
<style>
    .home-admin{
        /*background-color: red;*/
        /*height: 100%;*/
        /*width: 100%;*/
    }
    .dashboard-header{
        height: 5%;
    }

    .main-con-dashboard{
        height: 40%;
        width: 100%;
    }

    .t-member{
        height:200px;
        width: 30%;
        background-color: #1b95a0;
        float: left;
        margin-right: 3%;
    }
    .t-member:hover{

        background-color: #04899e;
    }
    .content-t-member{
        height:170px;
        width: 100%;
    }
    .content-t-member .left {
        height:170px;
        width: 60%;

        float: left;
    }
    .content-t-member .left  a{
        height:170px;
        width: 60%;

        float: left;
    }


    .content-t-member .right {
        height:140px;
        width: 40%;

        float: left;
    }

    .content-t-member .left h2,h1{

        margin-left: 5%;
        margin-top: 30px;
        color: whitesmoke;
    }
    .content-t-member .right span{

        margin-left: 5%;
        margin-top: 30px;
        color: white;
    }
    .footer-more{
        height:30px;
        width: 100%;
        background-color: #37a4a8;
        text-align: center;
        opacity: 0.7;
    }
    /*end of t-member*/

    .p-member{
        height:200px;
        width: 30%;
        background-color: #eaa123;
        float: left;
        margin-right: 3%;
    }
    .p-member:hover{

        background-color: #d3860a;
    }
    .u-member{
        height:200px;
        width: 30%;
        background-color: #2ba06f;
        float: left;
        margin-right: 3%;
    }
    .u-member:hover{

        background-color: #0c8c54;
    }
    .mat-member{
        height:200px;
        width: 20%;
        background-color: #3c763d;
        float: left;
        margin-right: 3%;
    }
    @media only screen and (max-width: 600px){
        .t-member,.p-member ,.u-member{ width: 100%; margin-top: 5px; }
    }
</style>

<div role="main">
    <div class="x_panel">

        <div class="x_title">
            <h2>Lbms Dashboard</h2>
            <p>

            <span class="pull-right">
                <b><?php echo Yii::$app->user->identity->username ?></b>
                <?= Html::a('Logout', ['site/logout'], ['data' => ['method' => 'post']]) ?>
            </span>  </p>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <div class="row">
                <div class="col-xs-12">

                    <div  class="container-fluid">
                        <div class="container-fluid">

                            <div class="col-lg-12 main-con-dashboard">
                                <div class="t-member">
                                    <div class="content-t-member">

                                        <a href="<?=Url::to(["user/shop"])?>">
                                        <div class="left">

                                            <p><h2>Dukani Mwisenge</h2></p>

                                        </div>
                                        <div class="right">
                                            <span class="glyphicon glyphicon-user" style="font-size: 70px;"></span>

                                        </div> </a>

                                    </div>
                                    <div class="footer-more">
                                        <a href="#">
                                            <p style="color:white">lubasu.com
                                                <span class="glyphicon glyphicon-chevron-right"></span>
                                            </p>
                                        </a>

                                    </div>

                                </div>
                                <div class="p-member">
                                    <div class="content-t-member">
                                        <a href="<?=Url::to(["user/sido"])?>">
                                        <div class="left">

                                            <p><h2>Sido Kiwandani</h2></p>

                                        </div>
                                        <div class="right">
                                            <span class="glyphicon glyphicon-user" style="font-size: 70px;"></span>

                                        </div>
                                        </a>

                                    </div>
                                    <div class="footer-more">
                                        <a href="#">
                                            <p style="color:white">lubasu.com
                                                <span class="glyphicon glyphicon-chevron-right"></span>
                                            </p>
                                        </a>

                                    </div>

                                </div>
                                <div class="u-member">
                                    <a href="<?=Url::to(["user/admin"])?>">
                                    <div class="content-t-member">

                                        <div class="left">
                                            <p><h1></h1></p>
                                            <p><h2>Admin</h2></p>

                                        </div>
                                        <div class="right">
                                            <span class="glyphicon glyphicon-user" style="font-size: 70px;"></span>

                                        </div>


                                    </div>
                                    <div class="footer-more">
                                        <a href="#">
                                            <p style="color:white">lubasu.com
                                                <span class="glyphicon glyphicon-chevron-right"></span>
                                            </p>
                                        </a>

                                    </div>
                                    </a>

                                </div>
                                <!--        <div class="mat-member">-->
                                <!--            unpaid-->
                                <!---->
                                <!--        </div>-->

                            </div>

                        </div>
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
