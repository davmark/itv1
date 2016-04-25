<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_tvs".
 *
 * @property integer $user_id
 * @property string $tv_id
 *
 * @property Tvs $tv
 * @property User $user
 */
class UserTv extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_tvs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'tv_id'], 'required'],
            [['user_id', 'tv_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('app', 'User ID'),
            'tv_id' => Yii::t('app', 'Tv ID'),
        ];
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
