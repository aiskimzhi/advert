<?php

namespace app\controllers;

use app\models\Advert;
use app\models\Category;
use app\models\Currency;
use app\models\Region;
use Yii;
use app\models\Bookmark;
use app\models\BookmarkSearch;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * BookmarkController implements the CRUD actions for Bookmark model.
 */
class BookmarkController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [
                    'index',
                    'view',
                    'create',
                    'update',
                    'delete',
                    'my-bookmarks'
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
     * Lists all Bookmark models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BookmarkSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Bookmark model.
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
     * Creates a new Bookmark model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Bookmark();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Bookmark model.
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
     * Deletes an existing Bookmark model.
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
     * Finds the Bookmark model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Bookmark the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Bookmark::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAddToBookmarks($id)
    {
        $bookmark = new Bookmark();
        $n = Bookmark::find()->where(['user_id' => Yii::$app->user->identity->getId(), 'advert_id' => $id])->one();

        if (!empty($n)) {
            $n->delete();
            echo 'Add to bookmarks';
        } else {
            $bookmark->user_id = Yii::$app->user->identity->getId();
            $bookmark->advert_id = $id;
            $bookmark->save();
            echo 'Delete ' . 'from bookmarks';
        }
    }

    public function actionMyBookmarks()
    {
        if (Currency::find()->where(['>', 'date', time()])->orderBy(['date' => SORT_DESC])
                ->asArray()->one() == null) {
            $currency = new Currency;
            if ($currency->exchangeRates()) {
                Yii::$app->session->setFlash('warning', 'Exchange rates might differ from actual ones');
            }
        }

        $disabled_subcat = 'disabled';
        $disabled_city = 'disabled';

        $catList = ArrayHelper::map(Category::find()->asArray()->all(), 'id', 'name');
        $regionList = ArrayHelper::map(Region::find()->asArray()->all(), 'id', 'name');
        $subcatList = [];
        $cityList = [];

        $searchModel = new BookmarkSearch();
        $dataProvider = $searchModel->getMyBookmarks();
        $advert = new Advert();

        return $this->render('my-bookmarks', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'catList' => $catList,
            'subcatList' => $subcatList,
            'regionList' => $regionList,
            'cityList' => $cityList,
            'disabled_subcat' => $disabled_subcat,
            'disabled_city' => $disabled_city,
            'advert' => $advert,
        ]);
    }

    public function actionDeleteBm($advert_id)
    {
        Bookmark::findOne(['advert_id' => $advert_id, 'user_id' => Yii::$app->user->identity->getId()])->delete();

        return $this->redirect(['my-bookmarks']);
    }
}
