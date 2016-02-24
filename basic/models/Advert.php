<?php

namespace app\models;

use Yii;
use yii\bootstrap\Carousel;
use yii\bootstrap\Modal;
use yii\db\ActiveRecord;
use yii\helpers\Html;
use yii\web\UploadedFile;
use yii\base\Model;

/**
 * This is the model class for table "advert".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $region_id
 * @property integer $city_id
 * @property integer $category_id
 * @property integer $subcategory_id
 * @property string $title
 * @property string $text
 * @property string $price
 * @property string $currency
 * @property string $u_price
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $views
 * @property string $avatar
 *
 * @property Category $category
 * @property City $city
 * @property Region $region
 * @property Subcategory $subcategory
 * @property User $user
 * @property Bookmark[] $bookmarks
 */
class Advert extends ActiveRecord
{
    public $imageFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'advert';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['region_id', 'city_id', 'category_id', 'subcategory_id', 'title', 'text', 'price', 'currency'], 'required'],
            [['user_id', 'region_id', 'city_id', 'category_id', 'subcategory_id', 'created_at', 'updated_at', 'views'], 'integer'],
            [['text'], 'string'],
            [['price'], 'number'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'region_id' => 'Region',
            'city_id' => 'City',
            'category_id' => 'Category',
            'subcategory_id' => 'Subcategory',
            'title' => 'Title',
            'text' => 'Text',
            'price' => 'Price',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'views' => 'Views',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubcategory()
    {
        return $this->hasOne(Subcategory::className(), ['id' => 'subcategory_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookmarks()
    {
        return $this->hasMany(Bookmark::className(), ['advert_id' => 'id']);
    }

    /**
     * creates an advert
     */
    public function createAdvert()
    {
        $currency = Currency::find()->where(['date' => 0])->asArray()->one();
        if ($this->validate()) {
            $advert = new Advert;
            $advert->user_id = Yii::$app->user->identity->getId();
            $advert->category_id = $this->category_id;
            $advert->subcategory_id = $this->subcategory_id;
            $advert->region_id = $this->region_id;
            $advert->city_id = $this->city_id;
            $advert->title = $this->title;
            $advert->text = $this->text;
            $advert->price = $this->price;
            $advert->currency = $this->currency;
            $advert->u_price = $this->price * $currency[$this->currency];
            $advert->created_at = time();
            $advert->updated_at = time();
            $advert->views = 0;
            if ($advert->save()) {
                return $advert;
            }
        }
        return null;
    }

    public function countViews($id)
    {
        $advert = Advert::findOne(['id' => $id]);
        $advert->views = $advert->views + 1;
        $advert->save();
    }

    public function renderAllPics($id)
    {
        if (file_exists('img/page_' . $id)) {
            if (count(scandir('img/page_' . $id)) > 2) {
                $max = count(scandir('img/page_' . $id)) - 2;
                $pics = array_splice(scandir('img/page_' . $id), 2, $max);
                return $pics;
            }
        }
        return [];
    }

    public function deletePic()
    {
        $advert = Advert::findOne(['id' => $_GET['id']]);
        $un = substr($_POST['delete'], 1);

//        var_dump($_POST['delete'] == $advert->avatar); die;
        if ($_POST['delete'] == $advert->avatar) {
            $advert->avatar = null;
            if ($advert->save()) {
                unlink($un);
            }
        }

        if ($_POST['delete'] == $advert->avatar) {
            unlink($un);
        }
    }

    public function carousel($id)
    {
        if (file_exists('img/page_' . $id) && count(scandir('img/page_' . $id)) > 2) {
            $items = [];
            for ($i = 2; $i < count(scandir('img/page_' . $id)); $i++) {
                $n = $i - 2;
                $items[$n] = '<img src="/img/page_' . $id . '/' . scandir('img/page_1')[$i] . '">';
            }
            return Carousel::widget([
                'items' => $items
            ]);
        }
        return null;
    }

    public function picture($id)
    {
        $advert = Advert::findOne(['id' => $id]);

        if (file_exists('img/page_' . $id)) {
            if (count(scandir('img/page_' . $id)) > 2) {
                if ($advert->avatar !== null) {
                    return substr($advert->avatar, 1);
                }
                return 'img/page_' . $id . '/' . scandir('img/page_' . $id)[2];
            }
        }
        return 'img/default.png';
    }
}
