<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "parts".
 *
 * @property integer $id
 * @property integer $parts_groups_id
 * @property string $pnc
 * @property string $oem
 * @property string $required
 * @property string $period
 * @property string $name
 * @property string $applicability
 * @property string $price
 * @property integer $created_at
 * @property integer $updated_at
 */
class Parts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'parts';
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
            [['parts_groups_id', 'created_at', 'updated_at'], 'integer'],
            [['applicability'], 'string'],
            [['pnc', 'oem', 'required', 'period', 'name', 'price'], 'string', 'max' => 255],
            //[['oem'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parts_groups_id' => 'Parts Groups ID',
            'pnc' => 'Pnc',
            'oem' => 'Oem',
            'required' => 'Required',
            'period' => 'Period',
            'name' => 'Name',
            'applicability' => 'Applicability',
            'price' => 'Price',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getGroup()
    {
        return $this->hasOne(PartsGroups::className(), ['id' => 'parts_groups_id']);
    }
}
