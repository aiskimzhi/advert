<?php

namespace app\models;

use SimpleXMLElement;
use Yii;

/**
 * This is the model class for table "currency".
 *
 * @property integer $date
 * @property string $usd
 * @property string $eur
 * @property string $rur
 * @property string $uan
 */
class Currency extends \yii\db\ActiveRecord
{
    public $url = 'https://api.privatbank.ua/p24api/pubinfo?exchange&coursid=5';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'currency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'usd', 'eur', 'rur', 'uan'], 'required'],
            [['date'], 'integer'],
            [['usd', 'eur', 'rur', 'uan'], 'number'],
            [['date'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'date' => 'Date',
            'usd' => 'USD',
            'eur' => 'EURO',
            'rur' => 'руб.',
            'uan' => 'грн.',
        ];
    }

    public function exchangeRates()
    {
        $currency = new Currency;
        $url = 'https://api.privatbank.ua/p24api/pubinfo?exchange&coursid=3';
        $xml = new SimpleXMLElement($url, NULL, true);

        $eur = (array) $xml->row[0]->exchangerate['sale'];
        $rur = (array) $xml->row[1]->exchangerate['sale'];
        $usd = (array) $xml->row[2]->exchangerate['sale'];

        $currency->uan = 1;
        $currency->eur = $eur[0];
        $currency->rur = $rur[0];
        $currency->usd = $usd[0];
        $currency->date = 86400 * ceil(time() / 86400);

        if ($currency->save()) {
            return false;
        }

        return true;
    }
}
