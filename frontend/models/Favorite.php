<?php

namespace frontend\models;

use common\models\Program;
use common\models\Tv;
use common\models\User;
use Yii;

/**
 * This is the model class for table "favorites".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $tv_id
 * @property string $program_id
 *
 * @property Program $program
 * @property Tv $tv
 * @property User $user
 */
class Favorite extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'favorites';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'tv_id', 'program_id'], 'integer']
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
            'tv_id' => 'Tv ID',
            'program_id' => 'Program ID',
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
