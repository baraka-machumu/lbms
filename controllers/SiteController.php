<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\widgets\ActiveForm;
use app\models\Store;
use yii\db\Query;



class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
   public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['logout','login','create'],
                        'allow' => true,
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */

   
 public function actionIndex()
    {
        $model = new User();
       if(Yii::$app->user->isGuest)
       {
           $this->redirect(['site/login']);
       }
    
           return $this->render('index',['model'=>$model]);
        
    }

public function actionCreate(){

  $model = new User();

  if ($model->load(Yii::$app->request->post())) {

      $model->setPassword($model->password);
      $model->generateAuthKey();
      $model->generatePasswordResetToken();
      if ($model->save()) {

          return "saved";
      }
  }
  return $this->render('index',['model'=>$model]);
        

}



    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {

     $this->layout = 'main_login';
if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        

        if ($model->load(Yii::$app->request->post()) && $model->login()) {


            return $this->redirect('dashboard');
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model, ]);
        
    }

    public function actionLogout()
    {

        Yii::$app->user->logout();

        return $this->redirect(['site/login']);
    }

    public function actionDashboard(){

         $this->layout =  'main-dashboard';
        return $this->render('dashboard');
    }


    public function actionTest(){

       $model = new Store();
         return $this->render('error',['model'=>$model]);

    }


public function actionJson(){


    $t =  $_POST['data'];

    $data =array();
    if ($t==2) {
        
        $arrears =10;

        $desc = "UNAZO";

    array_push($data, $arrears);
    array_push($data, $desc);
                       
     header('Content-Type: application/json');
    echo json_encode($data);

    }  else {

        echo "wrong choice";
    }
 

  
}

}
