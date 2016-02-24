<?php

namespace app\controllers;

use app\models\Bookmark;
use app\models\Category;
use app\models\City;
use app\models\Currency;
use app\models\Pictures;
use app\models\Region;
use app\models\Subcategory;
use app\models\UploadForm;
use app\models\User;
use app\models\Views;
use Yii;
use app\models\Advert;
use app\models\AdvertSearch;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * AdvertController implements the CRUD actions for Advert model.
 */
class AdvertController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [
                    'index',
                    'view',
                    'file-upload',
                    'update',
                    'delete',
                    'create',
                    'my-adverts',
                    'upload'
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
     * Lists all Advert models.
     * @return mixed
     */
    public function actionIndex()
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
        $searchModel = new AdvertSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $catList = ArrayHelper::map(Category::find()->asArray()->all(), 'id', 'name');
        $regionList = ArrayHelper::map(Region::find()->asArray()->all(), 'id', 'name');
        $subcatList = [];
        $cityList = [];

        if (Yii::$app->request->get('search') == 'search'
            && Yii::$app->request->get('AdvertSearch')['category_id'] !== '') {
            $subcatList = ArrayHelper::map(Subcategory::find()
                ->where(['category_id' => Yii::$app->request->get('AdvertSearch')['category_id']])
                ->asArray()->all(), 'id', 'name');
            $disabled_subcat = false;
        }
        if (Yii::$app->request->get('search') == 'search'
            && Yii::$app->request->get('AdvertSearch')['region_id'] !== '') {
            $cityList = ArrayHelper::map(City::find()
                ->where(['region_id' => Yii::$app->request->get('AdvertSearch')['region_id']])
                ->asArray()->all(), 'id', 'name');
            $disabled_city = false;
        }

        if (Yii::$app->request->get() == null || Yii::$app->request->get('period') == 'period') {
            $beforeValue = '';
            $afterValue = '';
        } else {
            $beforeValue = Yii::$app->request->get('before');
            $afterValue = Yii::$app->request->get('after');
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'catList' => $catList,
            'subcatList' => $subcatList,
            'regionList' => $regionList,
            'cityList' => $cityList,
            'beforeValue' => $beforeValue,
            'afterValue' => $afterValue,
            'disabled_subcat' => $disabled_subcat,
            'disabled_city' => $disabled_city,
        ]);
    }

    /**
     * Displays a single Advert model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Currency::find()->where(['>', 'date', time()])->orderBy(['date' => SORT_DESC])
                ->asArray()->one() == null) {
            $currency = new Currency;
            if ($currency->exchangeRates()) {
                Yii::$app->session->setFlash('warning', 'Exchange rates might differ from actual ones');
            }
        }

        $model = $this->findModel($id);
        $pic = new Pictures();
        $imgModel = new UploadForm();

        if ($model->user_id == Yii::$app->user->identity->getId()) {

            if (isset($_POST['delete'])) {
                $model->deletePic();
            }

            if (Yii::$app->request->isPost) {
                $imgModel->imageFiles = UploadedFile::getInstances($imgModel, 'imageFiles');
                if ($imgModel->upload($id)) {
                    return $this->render('view-my-advert', [
                        'model' => $this->findModel($id),
                        'imgModel' => $imgModel,
                        'pic' => $pic,
                    ]);
                }
            }
            return $this->render('view-my-advert', [
                'model' => $this->findModel($id),
                'imgModel' => $imgModel,
                'pic' => $pic,
            ]);
        } else {
            $views = new Views();
            $n = Bookmark::find()->where(['user_id' => Yii::$app->user->identity->getId(), 'advert_id' => $id])->all();

            if (!empty($n)) {
                $value = 'Delete ' . 'from bookmarks';
            } else {
                $value = 'Add to bookmarks';
            }

            if (!$views->countViews($id)) {
                if ($model->user_id !== Yii::$app->user->identity->getId()) {
                    $advert = new Advert();
                    $advert->countViews($id);
                    $views->advert_id = $id;
                    $views->user_id = Yii::$app->user->identity->getId();
                    $views->save();
                }
            }

            return $this->render('view-adv', [
                'model' => $this->findModel($id),
                'pic' => $pic,
                'imgModel' => $imgModel,
                'value' => $value
            ]);
        }
    }

    public function actionFileUpload($id)
    {
        $imgModel = new UploadForm();

        if (Yii::$app->request->isPost) {
            $imgModel->imageFile = UploadedFile::getInstance($imgModel, 'imageFile');
            if ($imgModel->upload($id)) {
                echo Json::encode(['upload'=>'true']);
            }
        }

        echo Json::encode(['upload'=>'false']);
    }

    /**
     * Updates an existing Advert model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->user_id !== Yii::$app->user->identity->getId()) {
            throw new ForbiddenHttpException('You are allowed to update your adverts only.');
        }

        $catList = ArrayHelper::map(Category::find()->asArray()->all(), 'id', 'name');
        $subcatList = ArrayHelper::map(Subcategory::find()
            ->where(['category_id' => $model->category_id])
            ->asArray()->all(), 'id', 'name');
        $regionList = ArrayHelper::map(Region::find()->asArray()->all(), 'id', 'name');
        $cityList = ArrayHelper::map(City::find()
            ->where(['region_id' => $model->region_id])
            ->asArray()->all(), 'id', 'name');

        $model->updated_at = time();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update',
                [
                    'model' => $model,
                    'catList' => $catList,
                    'subcatList' => $subcatList,
                    'regionList' => $regionList,
                    'cityList' => $cityList
                ]);
        }
    }

    /**
     * Deletes an existing Advert model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->user_id !== Yii::$app->user->identity->getId()) {
            throw new ForbiddenHttpException('You are allowed to delete your adverts only.');
        }

        $model->delete();

        return $this->redirect(['my-adverts']);
    }

    /**
     * Finds the Advert model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Advert the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Advert::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new Advert model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $user = User::findOne(['id' => Yii::$app->user->id]);
//        $pic = new UploadForm();

        $catList = ArrayHelper::map(Category::find()->asArray()->all(), 'id', 'name');
        $subcatList = ArrayHelper::map(Subcategory::find()->asArray()->all(), 'id', 'name');
        $regionList = ArrayHelper::map(Region::find()->asArray()->all(), 'id', 'name');
        $cityList = ArrayHelper::map(City::find()->asArray()->all(), 'id', 'name');

        $model = new Advert();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->createAdvert()) {
                return $this->redirect(['upload']);
            }

            return $this->render('create', [
                'model' => $model,
                'user' => $user,
                'catList' => $catList,
                'subcatList' => $subcatList,
                'regionList' => $regionList,
                'cityList' => $cityList,
            ]);
        }

        return $this->render('create',
            [
                'model' => $model,
//                'pic' => $pic,
                'user' => $user,
                'catList' => $catList,
                'subcatList' => $subcatList,
                'regionList' => $regionList,
                'cityList' => $cityList,
            ]);
    }

    public function actionGetSubcat($id) {

        $countSubcats = Subcategory::find()
            ->where(['category_id' => $id])
            ->count();

        $subcats = Subcategory::find()
            ->where(['category_id' => $id])
            ->orderBy('id ASC')
            ->all();

        if ($countSubcats > 0){
            echo '<option value="" selected="">- Choose a Subcategory -</option>';
            foreach($subcats as $subcat){
                echo "<option value='".$subcat->id."'>".$subcat->name."</option>";
            }
        } else {
            echo "<option></option>";
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function actionGetCity($id) {

        $countCities = City::find()
            ->where(['region_id' => $id])
            ->count();

        $cities = City::find()
            ->where(['region_id' => $id])
            ->orderBy('id ASC')
            ->all();

        if($countCities>0){
            echo '<option value="">- Choose a City -</option>';
            foreach($cities as $city){
                echo "<option value='".$city->id."'>".$city->name."</option>";
            }
        }
        else{
            echo "<option></option>";
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function actionMyAdverts()
    {
        if (Currency::find()->where(['>', 'date', time()])->orderBy(['date' => SORT_DESC])
                ->asArray()->one() == null) {
            $currency = new Currency;
            if ($currency->exchangeRates()) {
                Yii::$app->session->setFlash('warning', 'Exchange rates might differ from actual ones');
            }
        }

        $searchModel = new AdvertSearch();
        $dataProvider = $searchModel->getMyAdverts();

        return $this->render('my-adverts', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpload()
    {
        $model = new UploadForm();
        $advert = Advert::find()
            ->where(['user_id' => Yii::$app->user->identity->getId()])
            ->orderBy('id DESC')
            ->asArray()
            ->one();
        $id = $advert['id'];

        if (Yii::$app->request->isPost) {
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            if ($model->upload($id)) {
                return $this->redirect('view?id=' . $id);
            }
        }

        return $this->render('upload', ['model' => $model]);
    }

    public function actionModal($id)
    {
        $advert = Advert::findOne(['id' => $id]);
        $advert->avatar = $_POST['img'];
        if ($advert->save()) {
            return true;
        }
        return false;
    }

    public function actionTry()
    {
        return $this->render('try');
    }
}
