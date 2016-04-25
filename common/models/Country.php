<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "countries".
 *
 * @property string $id
 * @property string $title
 * @property string $alias
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'countries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alias'], 'required'],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguagesHasCountries()
    {
        return $this->hasMany(LanguagesHasCountries::className(), ['country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLangs()
    {
        return $this->hasMany(Language::className(), ['id' => 'lang_id'])->viaTable('languages_has_countries', ['country_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTvs()
    {
        return $this->hasMany(Tv::className(), ['country_id' => 'id']);
    }
}