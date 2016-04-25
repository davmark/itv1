<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "time_lines".
 *
 * @property string $id
 * @property string $title
 * @property integer $week_days
 * @property string $start_time
 * @property string $end_time
 * @property integer $created
 * @property integer $updated
 * @property string $tv_id
 *
 * @property Tvs $tv
 */
class TimeLine extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'time_lines';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created',
                'updatedAtAttribute' => 'updated',
                'value' => new Expression('NOW()'),

            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'title', 'week_days', 'start_time', 'end_time', 'tv_id'], 'required'],
            [['week_days','tv_id'], 'integer'],
            [['start_time', 'end_time', 'date'], 'safe'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'week_days' => 'Week Days',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'created' => 'Created',
            'updated' => 'Updated',
            'tv_id' => 'Tv Title',
            'tv.title' => 'Tv Title',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTv()
    {
        return $this->hasOne(Tv::className(), ['id' => 'tv_id']);
    }

}
