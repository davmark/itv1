<?php

namespace common\models;

use frontend\models\Favorite;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;


/**
 * This is the model class for table "tvs".
 *
 * @property string $id
 * @property string $alias
 * @property string $title
 * @property string $description
 * @property string $url
 * @property string $path
 * @property integer $status
 * @property string $created
 * @property string $updated
 * @property string $country_id
 * @property integer $rating
 *
 * @property CategoriesTvs[] $categoriesTvs
 * @property Category[] $categories
 * @property Show[] $shows
 * @property TimeLine[] $timeLines
 * @property UserTv[] $userTvs
 * @property User[] $users
 */
class Tv extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tvs';
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
            [['alias', 'url', 'country_id',], 'required'],
            [['alias'], 'trim'],
            [
                'alias',
                'match', 'not' => true, 'pattern' => '/[^1-9a-zA-Z_-]/',
                'message' => 'Invalid characters in alias.',
            ],
            [['status'], 'integer'],
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
            'alias' => 'Alias',
            'rating' => 'Rating',
            'path' => 'Path',
            'url' => 'Url',
            'status' => 'Status',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoriesTvs()
    {
        return $this->hasMany(CategoriesTvs::className(), ['tv_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable('categories_tvs', ['tv_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShows()
    {
        return $this->hasMany(Show::className(), ['tv_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTimeLines()
    {
        return $this->hasMany(TimeLine::className(), ['tv_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserTvs()
    {
        return $this->hasMany(UserTv::className(), ['tv_id' => 'id']);
    }

    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRates()
    {
        return $this->hasMany(Rate::className(), ['tv_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('user_tvs', ['tv_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFavorites()
    {
        return $this->hasMany(Favorite::className(), ['tv_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguagesHasTvs()
    {
        return $this->hasMany(LanguagesHasTvs::className(), ['tv_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLangs()
    {
        return $this->hasMany(Language::className(), ['id' => 'lang_id'])->viaTable('languages_has_tvs', ['tv_id' => 'id']);
    }


}