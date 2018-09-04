<?php

/**
 * @var string $content
 * @var \yii\web\View $this
 */

use yii\helpers\Html;

$bundle = yiister\gentelella\assets\Asset::register($this);

?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta charset="<?= Yii::$app->charset ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

</head>
<body class="nav-<?= !empty($_COOKIE['menuIsCollapsed']) && $_COOKIE['menuIsCollapsed'] == 'true' ? 'sm' : 'md' ?>" >
<?php $this->beginBody(); ?>
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">

                <div class="navbar nav_title" style="border: 0;">
                    <a href="<?php \yii\helpers\Url::to(['member/index']) ?>" class="site_title">
                         <img src="../web/images/logo.png" width="40" height="40" />
                        <span>LBMS</span></a>
                </div>
                <div class="clearfix"></div>
                <br />

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                    <div class="menu_section">
                                                <?=
                        \yiister\gentelella\widgets\Menu::widget(
                            [
                                "items" => [
                                    ["label" => "Nyumbani", "url" => ["site/dashboard"], "icon" => "home"],

                                      [
                                        "label" => "Store",
                                        "url" => "#",
                                        "icon" => "table",
                                        "items" => [
                                            [
                                                "label" => "Register New Item",
                                                "url" => ["store/register"],

                                            ],
                                            [
                                                "label" => "View Store Items",
                                                "url" => ["store/view"],
                                                "badge" => "123",
                                            ],

                                            [
                                                "label" => "Add Item",
                                                "url" => ["store/add"],

                                            ],
                                        
                                        ],

                                    ],
                                
                                    [
                                        "label" => "Mauzo",
                                        "url" => "#",
                                        "icon" => "table",
                                        "items" => [
                                            [
                                                "label" => "Record new sales",
                                                "url" => ["sales/create"],
                                                "badge" => "new",
                                                "badgeOptions" => ["class" => "label-success"],
                                            ],
                                            [
                                                "label" => "View sales per day",
                                                "url" => ["leader/viewl"],


                                            ],
                                        
                                        ],

                                    ],

                                    [
                                        "label" => "Manunuzi",
                                        "url" => "#",
                                        "icon" => "table",
                                        "items" => [
                                            [
                                                "label" => "Record new purchase",
                                                "url" => ["leader/create"],
                                                "badge" => "new",
                                                "badgeOptions" => ["class" => "label-success"],
                                            ],
                                            [
                                                "label" => "View purchase per day",
                                                "url" => ["leader/viewl"],


                                            ],

                                        ],

                                    ],
                                    [
                                        "label" => "Ripoti",
                                        "url" => "#",
                                        "icon" => "table",
                                        "items" => [
                                            [
                                                "label" => "view purchases by date",
                                                "url" => ["leader/create"],
                                                "badge" => "new",
                                                "badgeOptions" => ["class" => "label-success"],
                                            ],
                                            [
                                                "label" => "View sales by date",
                                                "url" => ["leader/viewl"],


                                            ],

                                        ],

                                    ],



                                ],
                            ]
                        )
                        ?>
                    </div>

                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">
                    <a data-toggle="tooltip" data-placement="top" title="Settings">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Lock">
                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Logout">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                    </a>
                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">

            <div class="nav_menu">
                <nav class="" role="navigation">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                              
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="">  Profile</a>
                                </li>
                              
                                <li>
                                    <a href="">Help</a>
                                </li>
                                <li>
                               <?= Html::a('Logout', ['site/logout'], ['data' => ['method' => 'post']]) ?>
                           </li>
                            </ul>
                        </li>

                       
                    </ul>
                </nav>
            </div>

        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <?php if (isset($this->params['h1'])): ?>
                <div class="page-title">
                    <div class="title_left">
                        <h1><?= $this->params['h1'] ?></h1>
                    </div>
                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">Go!</button>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="clearfix"></div>

            <?= $content ?>
        </div>
        <!-- /page content -->
        <!-- footer content -->
        <footer>
            <div class="pull-right">
                Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com" rel="nofollow" target="_blank">Colorlib</a><br />
                Extension for Yii framework 2 by <a href="http://yiister.ru" rel="nofollow" target="_blank">Yiister</a>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>

</div>

<div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
</div>
<!-- /footer content -->
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
