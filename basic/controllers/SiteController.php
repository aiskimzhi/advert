<?php

namespace app\controllers;

use app\models\Advert;
use app\models\ContactAuthor;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\SignupForm;
use app\models\User;
use Yii;
use yii\base\InvalidParamException;
use yii\filters\AccessControl;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\SendEmailForm;


class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

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

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSendEmail()
    {
        $model = new SendEmailForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                Yii::$app->getSession()->setFlash('warning', 'Check email');
//                var_dump($model->sendEmail()); die;
                $model->sendEmail();
                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Cannot send email');
            }
        }

        return $this->render('sendEmail', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword()
    {
        $model = new ResetPasswordForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $model->resetPassword();
                Yii::$app->getSession()->setFlash('error', 'Your password was changed successfully.');
                return $this->goHome();
            }
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionContactAuthor($id)
    {
        $model = new ContactAuthor();
        $receiver = Advert::findOne(['id' => $id]);
        $sender = User::findOne(['id' => Yii::$app->user->identity->getId()]);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->sendEmail(
                $sender->email,
                $receiver->user->email,
                $model->subject,
                $receiver,
                $model
            )) {
                Yii::$app->getSession()->setFlash('success', 'Your email was sent successfully');
                return $this->redirect(['advert/view?id=' . $id]);
            }
        }

        return $this->render('contact', [
            'model' => $model,
            'receiver' => $receiver,
            'sender' => $sender,
        ]);
    }
}
