<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rates".
 *
 * @property integer $id
 * @property integer $rate
 * @property string $tv_id
 * @property string $program_id
 * @property integer $user_id
 *
 * @property Program $program
 * @property Tv $tv
 * @property User $user
 */
class Rate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rate', 'user_id'], 'required'],
            [['rate', 'tv_id', 'program_id', 'user_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rate' => 'Rate',
            'tv_id' => 'Tv ID',
            'program_id' => 'Program ID',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgram()
    {
        return $this->hasOne(Program::className(), ['id' => 'program_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTv()
    {
        return $this->hasOne(Tv::className(), ['id' => 'tv_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
