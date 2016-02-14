<?php

namespace app\controllers;

use app\models\ChangePassword;
use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [
                    'update-data',
                    'change-password',
                    'delete-account',
                    'update',
                    'view',
                    'delete',
                    'index',
                    'create',
                    'account'
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Displays user's account without showing his ID
     */
    public function actionAccount()
    {
        return $this->render('account', [
            'model' => $this->findModel(Yii::$app->user->identity->getId()),
        ]);
    }

    /**
     * Updates user's data without showing his ID
     */
    public function actionUpdateData()
    {
        $model = $this->findModel(Yii::$app->user->identity->getId());

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Your data was changed successfully');
            return $this->redirect('account');
        } elseif (!($model->load(Yii::$app->request->post()) && $model->save()) && empty($_POST)) {
            return $this->render('up', [
                'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'Your data was not changed successfully');
            return $this->render('up', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Changes user's password
     */
    public function actionChangePassword()
    {
        $model = new ChangePassword();

        if ($model->changePassword()) {
            Yii::$app->session->setFlash('success', 'Your password changed successfully');
            return $this->redirect('account');
        } elseif (!$model->changePassword() && empty($_POST)) {
            return $this->render('change-password', [
                'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'Password was not changed, try again');
            return $this->render('change-password', [
                'model' => $model,
            ]);
        }
    }

    public function actionDeleteAccount()
    {
        $this->findModel(Yii::$app->user->identity->getId())->delete();

        return $this->redirect(['site/index']);
    }
}
