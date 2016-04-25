<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "categories".
 *
 * @property string $id
 * @property string $title
 * @property string $alias
 * @property string $description
 * @property integer $created
 * @property integer $updated
 * @property CategoriesShows[] $categoriesShows
 * @property Shows[] $shows
 * @property CategoriesTvs[] $categoriesTvs
 * @property Tvs[] $tvs
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
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
            [['alias', 'icon'], 'required'],
            [['alias'], 'trim'],
            [
                'alias',
                'match', 'not' => true, 'pattern' => '/[^a-zA-Z_-]/',
                'message' => 'Invalid characters in alias.',
            ],
            [['alias'], 'string', 'max' => 255],
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
            'alias' => 'Alias',
            'path'  => 'Path',
            'icon'  => 'Icon',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoriesShows()
    {
        return $this->hasMany(CategoryShow::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShows()
    {
        return $this->hasMany(Show::className(), ['id' => 'show_id'])->viaTable('categories_shows', ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoriesTvs()
    {
        return $this->hasMany(CategoriesTvs::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTvs()
    {
        return $this->hasMany(Tv::className(), ['id' => 'tv_id'])->viaTable('categories_tvs', ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguagesHasCategories()
    {
        return $this->hasMany(LanguagesHasCategories::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLangs()
    {
        return $this->hasMany(Language::className(), ['id' => 'lang_id'])->viaTable('languages_has_categories', ['category_id' => 'id']);
    }
}
