<?php

namespace app\controllers;

use app\models\AccountActivation;
use app\models\Goods;
use app\models\GoodsSearch;
use app\models\RegForm;
use app\models\ResetPasswordForm;
use app\models\SendEmailForm;
use app\models\User;
use Yii;
use yii\base\InvalidArgumentException;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index', 'login', 'reg', 'send-email', 'reset-password'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
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
        $searchModel = new GoodsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index',[ 'dataProvider' => $dataProvider, 'searchModel' => $searchModel,]);
    }

    public function actionReg()
    {
        $emailActivation = Yii::$app->params['emailActivation'];
        $model = $emailActivation ? new RegForm(['scenario' => 'emailActivation']) : new RegForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()):
            if ($user = $model->reg()):
                if ($user->status === User::STATUS_ACTIVE):
                    if (Yii::$app->getUser()->login($user)):
                        return $this->goHome();
                    endif;
                else:
                    if($model->sendActivationEmail($user)):
                        Yii::$app->session->setFlash('success', 'Activation link send on your email <strong>'.Html::encode($user->email).'</strong> (check spam folder).');
                    else:
                        Yii::$app->session->setFlash('error', 'Error. Email not send.');
                        Yii::error('Email not send.');
                    endif;
                    return $this->refresh();
                endif;
            else:
                Yii::$app->session->setFlash('error', 'Oops some registration error. Please contact with us support. ');
                Yii::error('Some registration error');
                return $this->refresh();
            endif;
        endif;
        return $this->render(
            'reg',
            [
                'model' => $model
            ]
        );
    }

    public function actionActivateAccount($key)
    {
        try {
            $user = new AccountActivation($key);
        }
        catch(InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if($user->activateAccount()):
            Yii::$app->session->setFlash('success', 'Activation successful. <strong>'.Html::encode($user->username).'</strong> ');
        else:
            Yii::$app->session->setFlash('error', 'Error activation.');
            Yii::error('Error activation.');
        endif;
        return $this->redirect(Url::to(['/site/login']));
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(['/site/index']);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest):
            return $this->goHome();
        endif;
        $loginWithEmail = Yii::$app->params['loginWithEmail'];
        $model = $loginWithEmail ? new LoginForm(['scenario' => 'loginWithEmail']) : new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()):
            return $this->goBack();
        endif;
        return $this->render(
            'login',
            [
                'model' => $model
            ]
        );
    }

    public function actionSendEmail()
    {
        $model = new SendEmailForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                if($model->sendEmail()):
                    Yii::$app->getSession()->setFlash('warning', 'Check your email!');
                    return $this->goHome();
                else:
                    Yii::$app->getSession()->setFlash('error', 'Can not reset password!');
                endif;
            }
        }
        return $this->render('sendEmail', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($key)
    {
        try {
            $model = new ResetPasswordForm($key);
        }
        catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate() && $model->resetPassword()) {
                Yii::$app->getSession()->setFlash('warning', 'Password changed.');
                return $this->redirect(['/site/login']);
            }
        }
        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            return $this->render('error', ['exception' => $exception]);
        }
    }
}
