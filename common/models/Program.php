<?php

namespace common\models;

use common\components\Translate;
use frontend\models\Favorite;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "programs".
 *
 * @property string $id
 * @property string $title
 * @property string $alias
 * @property string $url
 * @property string $path
 * @property string $image_youtube
 * @property string $publishedAt
 * @property string $created
 * @property string $updated
 * @property integer $status
 * @property string $shows_id
 *
 * @property Comments[] $comments
 * @property Shows $shows
 */
class Program extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'programs';
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
            [['title', 'alias', 'url', 'shows_id'], 'required'],
            [['alias', 'title',], 'trim'],
            [
                'alias',
                'match', 'not' => true, 'pattern' => '/[^0-9a-zA-Z_-]/',
                'message' => 'Invalid characters in alias.',
            ],
            [['created', 'updated'], 'safe'],
            [['status', 'shows_id'], 'integer'],
            [['title', 'alias', 'url', 'path', 'image_youtube', 'publishedAt'], 'string', 'max' => 255],
            [['alias'], 'unique']
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
            'alias' => 'Alias',
            'url' => 'Url',
            'path' => 'Path',
            'image_youtube' => 'Image Youtube',
            'publishedAt' => 'Published At',
            'created' => 'Created',
            'updated' => 'Updated',
            'status' => 'Status',
            'shows_id' => 'Shows ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['program_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShows()
    {
        return $this->hasOne(Show::className(), ['id' => 'shows_id']);
    }

    public function getRates()
    {
        return $this->hasMany(Rate::className(), ['program_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFavorites()
    {
        return $this->hasMany(Favorite::className(), ['program_id' => 'id']);
    }
}
