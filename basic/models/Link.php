<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "link".
 *
 * @property integer $id
 * @property string $url
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Link extends \yii\db\ActiveRecord
{
    const STATUS_WATING = 1;
    const STATUS_PARSED = 2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'link';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['url'], 'string', 'max' => 255],
            [['url'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public static function blackUrl()
    {
        return [
            'http://www.epc-data.com/',
            'http://toyota.epc-data.com/',
            'http://toyota-europe.epc-data.com/',
            'http://toyota-general.epc-data.com/',
            'http://toyota-usa.epc-data.com/'
        ];
    }
}
