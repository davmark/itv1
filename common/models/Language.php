<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "languages".
 *
 * @property integer $id
 * @property string $name
 * @property string $iso
 * @property string $flag_path
 * @property integer $primary
 *
 * @property LanguagesHasCategories[] $languagesHasCategories
 * @property Category[] $categories
 * @property LanguagesHasCountries[] $languagesHasCountries
 * @property Country[] $countries
 * @property LanguagesHasShows[] $languagesHasShows
 * @property Show[] $shows
 * @property LanguagesHasTvs[] $languagesHasTvs
 * @property Tv[] $tvs
 */
class Language extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'languages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'iso'], 'required'],
            [['primary'], 'integer'],
            [['name'], 'string', 'max' => 45],
            [['iso'], 'string', 'max' => 3],
            [['flag_path'], 'string', 'max' => 255],
            [['iso'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'iso' => 'Iso',
            'flag_path' => 'Flag Path',
            'primary' => 'Primary',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguagesHasCategories()
    {
        return $this->hasMany(LanguagesHasCategories::className(), ['lang_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable('languages_has_categories', ['lang_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguagesHasCountries()
    {
        return $this->hasMany(LanguagesHasCountries::className(), ['lang_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountries()
    {
        return $this->hasMany(Country::className(), ['id' => 'country_id'])->viaTable('languages_has_countries', ['lang_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguagesHasShows()
    {
        return $this->hasMany(LanguagesHasShows::className(), ['lang_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShows()
    {
        return $this->hasMany(Show::className(), ['id' => 'show_id'])->viaTable('languages_has_shows', ['lang_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguagesHasTvs()
    {
        return $this->hasMany(LanguagesHasTvs::className(), ['lang_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTvs()
    {
        return $this->hasMany(Tv::className(), ['id' => 'tv_id'])->viaTable('languages_has_tvs', ['lang_id' => 'id']);
    }
}
