<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "languages_has_countries".
 *
 * @property integer $lang_id
 * @property integer $country_id
 * @property string $title
 *
 * @property Language $lang
 * @property Country $country
 */
class LanguagesHasCountries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'languages_has_countries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'trim'],
            [['lang_id', 'country_id', 'title'], 'required'],
            [['lang_id', 'country_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['lang_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['lang_id' => 'id']],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'lang_id' => 'Lang ID',
            'country_id' => 'Country ID',
            'title' => 'Title',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLang()
    {
        return $this->hasOne(Language::className(), ['id' => 'lang_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

    /**
     * @param $post
     * @param $lang
     * @param $model_id
     */
    public function add($post, $lang, $model_id){

        foreach($lang as $item){
            $model = new LanguagesHasCountries();
            $model->lang_id = $item->id;
            $model->country_id = $model_id;
            $model->title = $post['lang']['title_'.$item->id];
            $model->save();
        }
    }

    /**
     * @param $model_id
     */
    public function remove($model_id){
        LanguagesHasCountries::deleteAll(['country_id' => $model_id]);
    }

}
