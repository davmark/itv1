<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "shows".
 *
 * @property string $id
 * @property string $title
 * @property string $alias
 * @property string $url
 * @property string $description
 * @property integer $created
 * @property integer $updated
 * @property integer $status
 *
 * @property CategoryShow[] $categoriesShows
 * @property Category[] $categories
 */
class Show extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shows';
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
            [['alias', 'url'], 'required'],
            [['alias'], 'trim'],
            [
                'alias',
                'match', 'not' => true, 'pattern' => '/[^a-zA-Z_-]/',
                'message' => 'Invalid characters in alias.',
            ],
            [['status', 'rating', 'tv_id'], 'integer'],
            [['alias', 'url', 'path'], 'string', 'max' => 255],
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
            'url' => 'Play List Id',
            'description' => 'Description',
            'path' => 'Path',
            'updated' => 'Updated',
            'created' => 'Created',
            'status' => 'Status',
            'rating' => 'Rating',
            'tv_id' => 'Tvs',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getCategoriesShows()
    {
        return $this->hasMany(CategoryShow::className(), ['show_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable('categories_shows', ['show_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrograms()
    {
        return $this->hasMany(Program::className(), ['shows_id' => 'id']);
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
    public function getLanguagesHasShows()
    {
        return $this->hasMany(LanguagesHasShows::className(), ['show_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLangs()
    {
        return $this->hasMany(Language::className(), ['id' => 'lang_id'])->viaTable('languages_has_shows', ['show_id' => 'id']);
    }
}
