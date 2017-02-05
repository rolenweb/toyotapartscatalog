<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "complectation".
 *
 * @property integer $id
 * @property integer $frame_id
 * @property string $complectation
 * @property string $engine
 * @property string $engine_title
 * @property string $period
 * @property string $body
 * @property string $body_title
 * @property string $transm
 * @property string $transm_title
 * @property integer $created_at
 * @property integer $updated_at
 */
class Complectation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'complectation';
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
            [['frame_id', 'created_at', 'updated_at'], 'integer'],
            [['complectation', 'engine', 'engine_title', 'period', 'body', 'body_title', 'grade', 'grade_title', 'transm', 'transm_title'], 'string', 'max' => 255],
            [['complectation'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'frame_id' => 'Frame ID',
            'complectation' => 'Complectation',
            'engine' => 'Engine',
            'engine_title' => 'Engine Title',
            'period' => 'Period',
            'body' => 'Body',
            'body_title' => 'Body Title',
            'grade' => 'Grade',
            'grade_title' => 'Grade Title',
            'transm' => 'Transm',
            'transm_title' => 'Transm Title',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getFrame()
    {
        return $this->hasOne(Frame::className(), ['id' => 'frame_id']);
    }

    public function getOptions()
    {
        return $this->hasMany(ComplectationOption::className(), ['complectation_id' => 'id'])->inverseOf('complectation');
    }

    public function getPartGroups()
    {
        return $this->hasMany(PartsGroups::className(), ['complectation_id' => 'id'])->inverseOf('complectation');
    }
}
