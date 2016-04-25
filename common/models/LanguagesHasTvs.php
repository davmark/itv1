<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "languages_has_tvs".
 *
 * @property integer $lang_id
 * @property integer $tv_id
 * @property string $title
 * @property string $description
 *
 * @property Tvs $tv
 * @property Languages $lang
 */
class LanguagesHasTvs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'languages_has_tvs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'trim'],
            [['lang_id', 'tv_id', 'title'], 'required'],
            [['lang_id', 'tv_id'], 'integer'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['tv_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tv::className(), 'targetAttribute' => ['tv_id' => 'id']],
            [['lang_id'], 'exist', 'skipOnError' => true, 'targetClass' => Language::className(), 'targetAttribute' => ['lang_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'lang_id' => 'Lang ID',
            'tv_id' => 'Tv ID',
            'title' => 'Title',
            'description' => 'Description',
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
    public function getLang()
    {
        return $this->hasOne(Language::className(), ['id' => 'lang_id']);
    }

    /**
     * @param $post
     * @param $lang
     * @param $model_id
     */
    public function add($post, $lang, $model_id){

        foreach($lang as $item){
            $model = new LanguagesHasTvs();
            $model->lang_id = $item->id;
            $model->tv_id = $model_id;
            $model->title = $post['lang']['title_'.$item->id];
            $model->description = $post['lang']['description_'.$item->id];
            $model->save();
        }
    }

    /**
     * @param $model_id
     */
    public function remove($model_id){
        LanguagesHasTvs::deleteAll(['tv_id' => $model_id]);
    }
}
